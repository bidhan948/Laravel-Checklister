<?php

namespace App\Http\View\Composers;

use App\Models\checklistGroup;
use Carbon\Carbon;
use Illuminate\View\View;

class menuComposer
{
    public function compose(View $view)
    {
        $user_menu = checklistGroup::with(
            ['checklists' => function ($query) {
                $query->whereNull('user_id');
            }]
        )->get()->toArray();

        $last_action_at = auth()->user()->last_action_at;
        if (is_null($last_action_at)) {
            $last_action_at = now()->subYear(10);
        }
        $groups = [];

        foreach ($user_menu as $group) {
            $group['is_new'] = Carbon::create($group['created_at'])->greaterThan($last_action_at);
            $group['is_updated'] = Carbon::create($group['created_at'])->greaterThan($last_action_at);
            foreach ($group['checklists'] as &$checklists) {
                $checklists['is_new'] = !($group['is_new']) && Carbon::create($checklists['created_at'])->greaterThan($last_action_at);
                $checklists['is_updated'] = !($group['is_updated']) && !($checklists['is_new']) && Carbon::create($checklists['updated_at'])->greaterThan($last_action_at);
                $checklists['tasks'] = 1;
                $checklists['completed_task'] = 0;
            }
            $groups[] = $group;
        }
        $view->with('menu', $groups);
    }
}
