<?php

namespace App\Http\Livewire;

use Livewire\Component;

class UserTaskCounter extends Component
{
    public string $task_type;
    public int $task_count;

    protected $listeners = ['user_task_counter_change'=>'recalculate_tasks'];
  
    public function render()
    {
        return view('livewire.user-task-counter');
    }
    public function recalculate_tasks($task_type,$count_change=1)
    {
        if ($this->task_type == $task_type) {
            $this->task_count += $count_change;
        }
    }
}
