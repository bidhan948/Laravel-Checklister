<div class="col-md-12">
    <div class="row">
        <div class="col-8">
            <div class="card">
                <div class="card-header">
                    {{ $checklist->name }}
                    <div class="card-body">
                        <table class="table">
                            @foreach ($checklist->tasks->where('user_id', null) as $task)
                                <tr>
                                    <td><input type="checkbox" wire:click="completeTask({{ $task->id }})" @if (in_array($task->id, $completed_task)) checked="checked" @endif /></td>
                                    <td>
                                        <a href="#" wire:click.prevent="toggle_task({{ $task->id }})"
                                            style="text-decoration: none; color: #000;">{{ $task->name }}</a>
                                    </td>
                                    <td wire:click="toggle_task({{ $task->id }})">
                                        @if (in_array($task->id, $opened_tasks))
                                            <svg class="c-sidebar-nav-icon " id="icon-up-{{ $task->id }}">
                                                <use
                                                    xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-caret-top') }}">
                                                </use>
                                            </svg>
                                        @else
                                            <svg class="c-sidebar-nav-icon" id="icon-down-{{ $task->id }}">
                                                <use
                                                    xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-caret-bottom') }}">
                                                </use>
                                            </svg>
                                        @endif
                                    </td>
                                </tr>
                                @if (in_array($task->id, $opened_tasks))
                                    <tr>
                                        <td></td>
                                        <td colspan="2">{!! $task->desc !!}</td>
                                    </tr>
                                @endif
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-4">
            @if (!is_null($current_task))
                <div class="card-header">
                    <a href="" class="ml-3">&star; {{ $current_task->name }}</a>
                </div>
                <div class="card-header">
                    @if ($current_task->added_to_my_day_at)
                        &#x2600; <a wire:click.prevent="add_to_my_day({{$current_task->id}})" href="#" class="ml-3">{{ __('Remove from my day') }}</a>
                    @else
                        &#x2600; <a wire:click.prevent="add_to_my_day({{$current_task->id}})" href="#" class="ml-3">{{ __('Add to my day') }}</a>
                    @endif
                </div>
                <div class="card-header my-3">
                    &#x260F; <a href="" class="py-2 ml-3">{{ __('Remind me') }}</a>
                    <hr>
                    &#x2611; <a href="" class="py-2 ml-3">{{ __('Add due date') }}</a>
                </div>
                <div class="card-header">
                    &#x270D; <a href="" class="ml-3">{{ __('Note') }}</a>
                </div>
            @endif
        </div>
    </div>
</div>
