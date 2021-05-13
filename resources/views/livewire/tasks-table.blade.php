<table class="table table-responsive-sm" wire:sortable="updateTaskOrder">
    <thead>
        <tr>
            <th class="text-center">Task name</th>
            <th colspan="2" class="text-center">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($tasks as $task)
            <tr wire:sortable.item="{{ $task->id }}" wire:key="task-{{ $task->id }}">
                <td class="text-center">{{ $task->name }}</td>
                <td class="text-center"><a href="{{ route('admin.checklists.tasks.edit', [$checklist, $task]) }}"
                        class="btn btn-success">Edit</a></td>
                <td class="text-center">
                    <form action="{{ route('admin.checklists.tasks.destroy', [$checklist, $task]) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <div class="form-group">
                            <button class="btn btn-danger" type="submit"
                                onclick="return confirm('{{ __('Are you Sure you want to delete this ?') }}')">
                                {{ __('Delete this task') }}</button>
                        </div>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
