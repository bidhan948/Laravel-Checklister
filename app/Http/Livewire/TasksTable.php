<?php

namespace App\Http\Livewire;

use App\Models\Task;
use Livewire\Component;

class TasksTable extends Component
{
    public $checklist;
    public function render()
    {
        $tasks = $this->checklist->tasks()->whereNull('user_id')->orderBy('position')->get();
        return view('livewire.tasks-table',compact('tasks'));
    }

    public function taskUp($task_id)
    {
        $task = Task::find($task_id);
        if($task){
            Task::whereNull('user_id')->where('position',$task->position -1)->update(['position'=>$task->position]);
            $task->update(['position'=>$task->position -1]);
        }
    }
    public function taskDown($task_id)
    {
        $task = Task::find($task_id);
        if($task){
            Task::whereNull('user_id')->where('position',$task->position +1)->update(['position'=>$task->position]);
            $task->update(['position'=>$task->position +1]);
        }
    }
}
