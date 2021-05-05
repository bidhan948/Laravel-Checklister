@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-sm-12 ">
                        <div class="card">
                            <div class="card-header"><strong>{{ __('New Checklist Group') }}</strong> Form</div>
                            <form action="{{ route('admin.checklist_groups.store') }}" method="POST">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label class="form-col-form-label" for="inputSuccess1">{{__('Name')}}</label>
                                        <input class="form-control @error('name') is-invalid @enderror" id="inputSuccess1" type="text" name="name">
                                        @error('name')
                                           <p class="p-1 text-danger"> {{$message}}</p>
                                        @enderror
                                    </div>
                                    <div class="card-footer">
                                        <button class="btn btn-primary" type="submit"
                                            style="width: 7%;">{{ __('Save') }}</button>
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
