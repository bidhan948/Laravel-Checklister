<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CompletedTaskCount extends Component
{
    public $completed_task_count = 0;
    public $tasks_count = 0;
    public $checklistId;
    protected $listeners = ['task_complete' => 'reCalculateTask'];

    public function render()
    {
        return view('livewire.completed-task-count');
    }

    public function reCalculateTask($task_id,$checklist_id,$count_task=1)
    {
        if ($checklist_id == $this->checklistId) {
            $this->completed_task_count += $count_task;
        }
    }
}
