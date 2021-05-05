@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-sm-12 ">
                        <div class="card">
                            <div class="card-header"><strong>{{ __('Edit Checklist Group') }}</strong> Form</div>
                            <form action="{{ route('admin.checklist_groups.update', $checklistGroup) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    <div class="form-group">
                                        <label class="form-col-form-label" for="inputSuccess1">{{ __('Name') }}</label>
                                        <input class="form-control @error('name') is-invalid @enderror" id="inputSuccess1"
                                            type="text" name="name" value="{{ $checklistGroup->name }}">
                                        @error('name')
                                            <p class="p-1 text-danger"> {{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="card-footer">
                                        <button class="btn btn-primary" type="submit"
                                            style="width: 7%;">{{ __('Save') }}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <form action="{{ route('admin.checklist_groups.destroy', $checklistGroup) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <div class="form-group">
                                <button class="btn btn-danger" type="submit"
                                    onclick="return confirm('{{__('Are you Sure you want to delete this Checklist Group?')}}')">
                                    {{__('Delete this Checklist Group')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
