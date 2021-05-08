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
                        <form action="{{ route('admin.checklists.tasks.update', [$task->checklist_id,$task]) }}" method="POST">
                            @method('PUT')
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label class="form-col-form-label" for="inputSuccess1">{{ __('Name') }}</label>
                                    <input class="form-control @error('name') is-invalid @enderror" id="inputSuccess1" type="text" name="name" value="{{ $task->name }}">
                                    @error('name')
                                    <p class="p-1 text-danger"> {{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="form-col-form-label" for="task_desc">{{ __('Task Description') }}</label>
                                    <textarea class="form-control @error('desc') is-invalid @enderror" name="desc" id="task_desc">{{$task->desc}}</textarea>
                                    @error('desc')
                                    <p class="p-1 text-danger"> {{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="card-footer">
                                    <button class="btn btn-primary" type="submit" style="width: 7%;">{{ __('Edit') }}</button>
                                </div>
                            </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection