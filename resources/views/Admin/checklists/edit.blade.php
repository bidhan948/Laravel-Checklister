@extends('layouts.app')
@section('ckEditor')
    <script>
        CKEDITOR.replace('task_desc');
    </script>
@endsection
@section('content')
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-sm-12 ">
                        <div class="card">
                            <div class="card-header"><strong>{{ __('Edit Checklist') }}</strong></div>
                            <form
                                action="{{ route('admin.checklist_groups.checklists.update', [$checklistGroup, $checklist]) }}"
                                method="POST">
                                @method('PUT')
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label class="form-col-form-label" for="inputSuccess1">{{ __('Name') }}</label>
                                        <input class="form-control @error('name') is-invalid @enderror" id="inputSuccess1"
                                            type="text" name="name" value="{{ $checklist->name }}">
                                        @error('name')
                                            <p class="p-1 text-danger"> {{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="card-footer">
                                        <button class="btn btn-primary" type="submit"
                                            style="width: 7%;">{{ __('Edit') }}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <form
                            action="{{ route('admin.checklist_groups.checklists.destroy', [$checklistGroup, $checklist]) }}"
                            method="post">
                            @csrf
                            @method('DELETE')
                            <div class="form-group">
                                <button class="btn btn-danger" type="submit"
                                    onclick="return confirm('{{ __('Are you Sure you want to delete this Checklist?') }}')">
                                    {{ __('Delete this Checklist') }}</button>
                            </div>
                        </form>
                        <div class="card mt-5">
                            <div class="card-header"><strong>{{ __('List of task') }}</strong></div>
                            <div class="card-body">
                                @if (session('msg'))
                                    <p class="text-success font-weight-bold">{{ session('msg') }}</p>
                                @endif
                                <table class="table table-responsive-sm">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Task name</th>
                                            <th colspan="2" class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($checklist->tasks as $task)
                                            <tr>
                                                <td class="text-center">{{ $task->name }}</td>
                                                <td class="text-center"><a
                                                        href="{{ route('admin.checklists.tasks.edit', [$checklist, $task]) }}"
                                                        class="btn btn-success">Edit</a></td>
                                                <td class="text-center">
                                                    <form
                                                        action="{{ route('admin.checklists.tasks.destroy', [$checklist, $task]) }}"
                                                        method="post">
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
                            </div>
                        </div>
                        <div class="card my-5">
                            <div class="card-header"><strong>{{ __('New Task') }}</strong></div>
                            <form action="{{ route('admin.checklists.tasks.store', [$checklist]) }}" method="POST">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label class="form-col-form-label"
                                            for="inputSuccess1">{{ __('Task name') }}</label>
                                        <input class="form-control @error('name') is-invalid @enderror" id="inputSuccess1"
                                            type="text" name="name" value="{{ old('name') }}">
                                        @error('name')
                                            <p class="p-1 text-danger"> {{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group" >
                                        <label for="description">{{ __('Description') }}</label>
                                        <textarea class="form-control" name="desc"id="task_desc"
                                            >{{ old('desc') }}</textarea>
                                        @error('desc')
                                            <p class="p-1 text-danger"> {{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="card-footer">
                                        <button class="btn btn-primary" type="submit"
                                            style="width: 7%;">{{ __('Save ') }}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
