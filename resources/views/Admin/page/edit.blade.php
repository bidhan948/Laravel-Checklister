@extends('layouts.app')
@section('ckEditor')
    <script>
        CKEDITOR.replace('page_desc');

    </script>
@endsection
@section('content')
    <div class="container">
        @if (session('msg'))
            <p class="alert alert-success">{{ session('msg') }}</p>
        @endif
        <div class="row d-flex justify-content-center">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-sm-12 ">
                        <div class="card">
                            <div class="card-header"><strong>{{ __('Edit Checklist') }}</strong></div>
                            <form action="{{ route('admin.pages.update', $page) }}" method="POST">
                                @method('PUT')
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label class="form-col-form-label" for="inputSuccess1">{{ __('Title') }}</label>
                                        <input class="form-control @error('title') is-invalid @enderror" id="inputSuccess1"
                                            type="text" name="title" value="{{ $page->title }}">
                                        @error('title')
                                            <p class="p-1 text-danger"> {{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="form-col-form-label"
                                            for="task_desc">{{ __('Page Content') }}</label>
                                        <textarea class="form-control @error('content') is-invalid @enderror" name="content"
                                            id="page_desc">{{ $page->content }}</textarea>
                                        @error('content')
                                            <p class="p-1 text-danger"> {{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="card-footer">
                                        <button class="btn btn-primary" type="submit"
                                            style="width: 7%;">{{ __('Edit') }}</button>
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
