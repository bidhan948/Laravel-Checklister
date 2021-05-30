<?php

namespace App\Http\View\Composers;

use App\Models\checklist;
use App\Models\checklistGroup;
use Carbon\Carbon;
use Illuminate\View\View;

class menuComposer
{
    public function compose(View $view)
    {
        $user_menu = checklistGroup::with(
            [
                'checklists' => function ($query) {
                    $query->whereNull('user_id');
                }, 'checklists.tasks' => function ($query) {
                    $query->whereNull('tasks.user_id');
                }, 'checklists.user_tasks'
            ]
        )->get();

        $view->with('admin_menu', $user_menu);

        $last_action_at = auth()->user()->last_action_at;
        if (is_null($last_action_at)) {
            $last_action_at = now()->subYear(10);
        }
        $groups = [];

        $user_checklist = checklist::where('user_id', auth()->user()->id)->get();
        foreach ($user_menu->toArray() as $group) {
            if (count($group['checklists']) > 0) {
                $group_updated = $user_checklist->where('checklist_group_id', $group['id'])->max('updated_at');
                $group['is_new'] = Carbon::create($group['created_at'])->greaterThan($group_updated);
                $group['is_updated'] = Carbon::create($group['created_at'])->greaterThan($group_updated);
                foreach ($group['checklists'] as &$checklists) {
                    $checklist_updated = $user_checklist->where('checklist_id', $checklists['id'])->max('updated_at');
                    $checklists['is_new'] = !($group['is_new']) && Carbon::create($checklists['created_at'])->greaterThan($checklist_updated);
                    $checklists['is_updated'] = !($group['is_updated']) && !($checklists['is_new']) && Carbon::create($checklists['updated_at'])->greaterThan($checklist_updated);
                }
                $groups[] = $group;
            }
        }
        $view->with('menu', $groups);
    }
}
