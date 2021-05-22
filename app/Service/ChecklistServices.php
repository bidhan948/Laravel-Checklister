<?php

namespace App\Service;

use App\Models\checklist;

class ChecklistServices
{
    public function sync_checklist(checklist $checklist, int $user_id)
    {
        $checklist = checklist::firstOrcreate(
        [
            'user_id' => $user_id,
            'checklist_id' => $checklist->id
        ],
        [
            'checklist_group_id' => $checklist->checklist_group_id,
            'name' => $checklist->name,
        ]);

        $checklist->touch();
        return $checklist;
    }
}
