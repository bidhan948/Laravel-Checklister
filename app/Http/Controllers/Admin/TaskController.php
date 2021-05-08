<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\storeTaskRequest;
use App\Models\checklist;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \storeTaskRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(storeTaskRequest $request,checklist $checklist)
    {
        $checklist->tasks()->create($request->validated());
        session()->flash('msg','Task has been added');
        return redirect()->route('home');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  storeTaskRequest $request
     * @return \Illuminate\Http\Response
     */
    public function edit(checklist $checklist,Task $task)
    {
        return view('Admin.task.edit',compact('checklist','task'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(storeTaskRequest $request, checklist $checklist, Task $task)
    {
        $task->update($request->validated());
        session()->flash('msg','Task has been successfully edited');
        return redirect()->route('admin.checklist_groups.checklists.edit',[$checklist->checklist_group_id,$checklist]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(checklist $checklist, Task $task)
    {
        session()->flash('msg', $task->name .' has been successfully deleted');
        $task->delete();
        return redirect()->route('admin.checklist_groups.checklists.edit',[$checklist->checklist_group_id,$checklist]);
    }
}
