@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-12">
                        <h1 class="text-center">{{$checklist->name}}</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
