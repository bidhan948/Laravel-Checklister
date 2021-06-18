<div class="col-md-12">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ $list_name }}
                </div>
                <div class="card-body">
                    @if ($list_tasks->count())
                        <table class="table">
                            @foreach ($list_tasks as $task)
                                <tr>
                                    <td width="5%">
                                        <input type="checkbox" wire:click="complete_task({{ $task->id }})" @if (in_array($task->id, $completed_tasks)) checked="checked" @endif />
                                    </td>
                                    <td width="90%">
                                        <a wire:click.prevent="toggle_task({{ $task->id }})"
                                            href="#">{{ $task->name }}</a>
                                        @if ($user_task->where('task_id', $task->id)->first())
                                            <div style="font-style: italic; font-size: 11px">
                                                @if ($list_type)
                                                    {{ $task->checklist->name }} |
                                                @endif
                                                @if ($user_task->where('task_id', $task->id)->first()->added_to_my_day_at)
                                                    <span class="mr-2">
                                                        &#9788;
                                                        {{ __('My Day') }}
                                                    </span>
                                                @endif
                                                @if ($user_task->where('task_id', $task->id)->first()->due_date)
                                                    <span class="mr-2">
                                                        &#9745;&nbsp;
                                                        {{ __('Due') }}
                                                        {{ $user_task->where('task_id', $task->id)->first()->due_date->format('M d, Y') }}
                                                    </span>
                                                @endif
                                                @if ($user_task->where('task_id', $task->id)->first()->reminder_at)
                                                    <span class="mr-2">
                                                        &#9993;
                                                    </span>
                                                @endif
                                                @if ($user_task->where('task_id', $task->id)->first()->note)
                                                    <span class="mr-2">
                                                        &#9998;
                                                    </span>
                                                @endif
                                            </div>
                                        @endif
                                    </td>
                                    <td width="5%">
                                        @if (optional($user_task->where('task_id', $task->id)->first())->is_important)
                                            <a wire:click.prevent="mark_as_important({{ $task->id }})"
                                                href="#">&starf;</a>
                                        @else
                                            <a wire:click.prevent="mark_as_important({{ $task->id }})"
                                                href="#">&star;</a>
                                        @endif
                                        @if (in_array($task->id, $opened_tasks))
                                    <tr>
                                        <td></td>
                                        <td colspan="3">{!! $task->desc !!}</td>
                                    </tr>
                                @endif
                            @endforeach
                        </table>
                    @else
                        {{ __('No tasks found') }}
                    @endif
                </div>
            </div>
        </div>
        <div class="col-4">
            @if (!is_null($current_task))
                <div class="card-header">
                    <a href="" class="ml-3">{{ $current_task->name }}
                        @if ($current_task->is_important)
                            <a wire:click.prevent="mark_as_important({{ $current_task->id }})" href="#"><span
                                    class="float-right">&starf;</span></a>
                        @else
                            <a wire:click.prevent="mark_as_important({{ $current_task->id }})" href="#"><span
                                    class="float-right">&star;</span></a>
                        @endif
                    </a>
                </div>
                <div class="card-header">
                    @if ($current_task->added_to_my_day_at)
                        &#x2600; <a wire:click.prevent="add_to_my_day({{ $current_task->id }})" href="#"
                            class="ml-3">{{ __('Remove from my day') }}</a>
                    @else
                        &#x2600; <a wire:click.prevent="add_to_my_day({{ $current_task->id }})" href="#"
                            class="ml-3">{{ __('Add to my day') }}</a>
                    @endif
                </div>
                <div class="card-header my-3">
                    @if ($current_task->reminder_at)
                        {{ __('Reminder to be sent at') }} {{ $current_task->reminder_at->format('M j, Y H:i') }}
                        &nbsp;&nbsp;
                        <a wire:click.prevent="set_reminder({{ $current_task->id }})"
                            href="#">{{ __('Remove') }}</a>
                    @else
                        <a wire:click.prevent="toggle_reminder" href="#">{{ __('Remind me') }}</a>
                        @if ($reminder_opened)
                            <ul>
                                <li>
                                    <a wire:click.prevent="set_reminder({{ $current_task->id }}, '{{ today()->addDay()->toDateString() }}')"
                                        href="#">{{ __('Tomorrow') }} {{ date('H') }}:00</a>
                                </li>
                                <li>
                                    <a wire:click.prevent="set_reminder({{ $current_task->id }}, '{{ today()->addWeek()->startOfWeek()->toDateString() }}')"
                                        href="#">{{ __('Next Monday') }} {{ date('H') }}:00</a>
                                </li>
                                <li>
                                    {{ __('Or pick a date & time') }}
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input wire:model="reminder_date" class="form-control" type="date" />
                                        </div>
                                        <div class="col-md-3">
                                            <select wire:model="reminder_hour" class="form-control">
                                                @foreach (range(0, 23) as $hour)
                                                    <option value="{{ $hour }}">{{ $hour }}:00
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <button
                                                wire:click.prevent="set_reminder({{ $current_task->id }}, 'custom')"
                                                class="btn btn-primary">{{ __('Save') }}</button>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        @endif
                    @endif
                    <hr>
                    @if ($current_task->due_date)
                        {{ __('Due') }}&nbsp; {{ $current_task->due_date->format('M j, Y') }}
                        &nbsp;<a wire:click.prevent="set_due_date({{ $current_task->id }})"
                            href="#">{{ __('Remove') }}</a>
                    @else
                        <a wire:click.prevent="toggle_due_date" href="#"
                            class="text-center">{{ __('Add Due Date') }}</a>
                        @if ($due_date_opened)
                            <ul>
                                <li>
                                    <a wire:click.prevent="set_due_date({{ $current_task->id }}, '{{ today()->toDateString() }}')"
                                        href="#">{{ __('Today') }}</a>
                                </li>
                                <li>
                                    <a wire:click.prevent="set_due_date({{ $current_task->id }}, '{{ today()->addDay()->toDateString() }}')"
                                        href="#">{{ __('Tomorrow') }}</a>
                                </li>
                                <li>
                                    <a wire:click.prevent="set_due_date({{ $current_task->id }}, '{{ today()->addWeek()->startOfWeek()->toDateString() }}')"
                                        href="#">{{ __('Next week') }}</a>
                                </li>
                                <li>
                                    {{ __('Or pick a date') }}
                                    <br />
                                    <input wire:model="due_date" type="date" class="form-control" name="picker_date" />
                                </li>
                            </ul>
                        @endif
                    @endif
                </div>
                <div class="card-header">
                    @if ($current_task->note)
                        <a wire:click.prevent="toggle_note" href="#">{{ __('Note') }}</a>
                        @if (!$note_opened)
                            <p>
                                {{ $current_task->note }}
                                <br />
                                <a wire:click.prevent="toggle_note" href="#">{{ __('Edit') }}</a>
                            </p>
                        @endif
                    @else
                        <a wire:click.prevent="toggle_note" href="#">{{ __('Note') }}</a>
                    @endif
                    @if ($note_opened)
                        <div class="mt-4">
                            <textarea wire:model="note" class="form-control" rows="5"></textarea>
                            <button wire:click="save_note"
                                class="btn btn-sm btn-primary mt-2">{{ __('Save Note') }}</button>
                        </div>
                    @endif
                </div>
            @endif
        </div>
    </div>
</div>
