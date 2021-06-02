<?php

namespace App\Http\Livewire;

use App\Models\checklist;
use Livewire\Component;

class HeaderTotalCounts extends Component
{
    public $checklist_group_id;
    protected $listeners = ['task_complete'=>'render'];
    
    public function render()
    {
        $checklists = checklist::whereNull('user_id')
        ->where('checklist_group_id', $this->checklist_group_id)
        ->withCount(['tasks' => function ($query) {
            $query->whereNull('user_id');
        }])
        ->withCount(['user_tasks'=> function ($query) {
            $query->whereNotNull('completed_at');
        }])
        ->get();
        return view('livewire.header-total-counts', compact('checklists'));
    }
}
