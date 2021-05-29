@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row d-flex justify-content-center">
            @livewire('checklist-show', ['checklist' => $checklist])
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
