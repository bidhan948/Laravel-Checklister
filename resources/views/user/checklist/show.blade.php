@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                {{ $checklist->name }}
                                <div class="card-body">
                                    <table class="table">
                                        @foreach ($checklist->tasks as $task)
                                            <tr class="task-description-toggle  text-center" data-id="{{ $task->id }}">
                                                <td></td>
                                                <td>{{ $task->name }}</td>
                                                <td>
                                                    <svg class="c-sidebar-nav-icon " id="icon-up-{{ $task->id }}">
                                                        <use
                                                            xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-caret-top') }}">
                                                        </use>
                                                    </svg>
                                                    <svg class="c-sidebar-nav-icon d-none" id="icon-down-{{ $task->id }}">
                                                        <use
                                                            xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-caret-bottom') }}">
                                                        </use>
                                                    </svg>
                                                </td>
                                            </tr>
                                            <tr class="d-none" id="task-description-{{ $task->id }}">
                                                <td></td>
                                                <td colspan="2">{!! $task->desc !!}</td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('jquery_toggle')
    <script>
        $(document).ready(function() {
            $('.task-description-toggle').click(function() {
                $('#task-description-' + $(this).data('id')).toggleClass('d-none');
                $('#icon-up-' + $(this).data('id')).toggleClass('d-none');
                $('#icon-down-' + $(this).data('id')).toggleClass('d-none');
            });
        });

    </script>
@endsection
