<?php

namespace App\Service;

use App\Models\checklist;
use App\Models\checklistGroup;
use App\Models\Task;
use Carbon\Carbon;

class MenuService
{
    public function getMenu(): array
    {
        $user_menu = checklistGroup::with(
            [
                'checklists' => function ($query) {
                    $query->whereNull('user_id');
                }, 'checklists.tasks' => function ($query) {
                    $query->whereNull('tasks.user_id');
                }, 'checklists.user_tasks',
                'checklists.user_completed_task'
            ]
        )->get();

        $last_action_at = auth()->user()->last_action_at;
        if (is_null($last_action_at)) {
            $last_action_at = now()->subYear(10);
        }
        $groups = [];

        $user_checklist = checklist::where('user_id', auth()->user()->id)->get();
        foreach ($user_menu->toArray() as $group) {
            if (count($group['checklists']) > 0) {
                $group_updated = $user_checklist->where('checklist_group_id', $group['id'])->max('updated_at');
                $group['is_new'] = $group_updated && Carbon::create($group['created_at'])->greaterThan($group_updated);
                $group['is_updated'] = (!$group['is_new']) && $group_updated && Carbon::create($group['created_at'])->greaterThan($group_updated);
                foreach ($group['checklists'] as &$checklists) {
                    $checklist_updated = $user_checklist->where('checklist_id', $checklists['id'])->max('updated_at');
                    $checklists['is_new'] = !($group['is_new']) && $checklist_updated && Carbon::create($checklists['created_at'])->greaterThan($checklist_updated);
                    $checklists['is_updated'] = !($group['is_updated']) && $checklist_updated && !($checklists['is_new']) && Carbon::create($checklists['updated_at'])->greaterThan($checklist_updated);
                    $checklists['completed_tasks_count'] = count($checklists['user_completed_task']);
                }
                $groups[] = $group;
            }
        }
        $user_task_menu = [];
        if (!auth()->user()->is_admin) {
            $user_tasks = Task::where('user_id', auth()->id())->get();
            $user_task_menu = [
                'my day' => [
                    'name' => __('my day'),
                    'icon' => 'sun',
                    'tasks_count' => $user_tasks->whereNotNull('added_to_my_day_at')->count()
                ],
                'important' => [
                    'name' => __('important'),
                    'icon' => 'star',
                    'tasks_count' => $user_tasks->where('is_important',1)->count()
                ],
                'planned' => [
                    'name' => __('planned'),
                    'icon' => 'calendar',
                    'tasks_count' => $user_tasks->whereNotNull('due_date')->count()
                ],
            ];
        }
        return
            [
                'admin_menu' => $user_menu,
                'user_menu' => $groups,
                'user_task_menu' => $user_task_menu
            ];
    }
}
