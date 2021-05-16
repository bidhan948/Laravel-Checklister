<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\checklist;
use App\Service\ChecklistServices;
use Illuminate\Contracts\View\View;

class checklistController extends Controller
{
    public function show(checklist $checklist):View
    {
        (new ChecklistServices())->sync_checklist($checklist, auth()->id());
        return view('User.checklist.show',compact('checklist'));
    }
}
