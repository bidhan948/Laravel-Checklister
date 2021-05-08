<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\storeTaskRequest;
use App\Models\checklist;
use App\Models\Task;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class TaskController extends Controller
{
    public function store(storeTaskRequest $request,checklist $checklist) : RedirectResponse
    {
        $checklist->tasks()->create($request->validated());
        session()->flash('msg','Task has been added');
        return redirect()->route('home');
    }

    public function edit(checklist $checklist,Task $task):View
    {
        return view('Admin.task.edit',compact('checklist','task'));
    }

    public function update(storeTaskRequest $request, checklist $checklist, Task $task):RedirectResponse
    {
        $task->update($request->validated());
        session()->flash('msg','Task has been successfully edited');
        return redirect()->route('admin.checklist_groups.checklists.edit',[$checklist->checklist_group_id,$checklist]);
    }

    public function destroy(checklist $checklist, Task $task): RedirectResponse
    {
        session()->flash('msg', $task->name .' has been successfully deleted');
        $task->delete();
        return redirect()->route('admin.checklist_groups.checklists.edit',[$checklist->checklist_group_id,$checklist]);
    }
}
