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
    public function store(storeTaskRequest $request, checklist $checklist): RedirectResponse
    {
        $position = $checklist->tasks()->whereNull('user_id')->max('position') + 1;
        $checklist->tasks()->create($request->validated() + ['position' => $position]);
        session()->flash('msg', 'Task has been added');
        return redirect()->route('welcome');
    }

    public function edit(checklist $checklist, Task $task): View
    {
        return view('Admin.task.edit', compact('checklist', 'task'));
    }

    public function update(storeTaskRequest $request, checklist $checklist, Task $task): RedirectResponse
    {
        $task->update($request->validated());
        session()->flash('msg', 'Task has been successfully edited');
        return redirect()->route('admin.checklist_groups.checklists.edit', [$checklist->checklist_group_id, $checklist]);
    }

    public function destroy(checklist $checklist, Task $task): RedirectResponse
    {
        $checklist->tasks()->whereNull('user_id')->where('position', '>', $task->position)->update(['position' => \DB::raw('position - 1')]);
        session()->flash('msg', $task->name . ' has been successfully deleted');
        $task->delete();
        return redirect()->route('admin.checklist_groups.checklists.edit', [$checklist->checklist_group_id, $checklist]);
    }
}
