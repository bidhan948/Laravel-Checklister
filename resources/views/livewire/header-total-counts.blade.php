<div class="col-md-12">
    <div class="row">
        <div class="col-md-8 ">
            <div class="card">
                <div class="card-header">
                    <h3>{{ __('Store Review') }}</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach ($checklists as $checklist)
                            <div class="col-md-2">
                                <p class="text-center" style="margin-bottom:10px;">
                                    <strong>{{ $checklist->name }}</strong></p>
                                <p class="text-center">
                                    <strong>{{ $checklist->user_tasks_count }}/{{ $checklist->tasks_count }}</strong>
                                </p>
                                @if ($checklist->tasks_count > 0)
                                    <div class="progress progress-xs mt-2">
                                        <div class="progress-bar bg-gradient-success" role="progressbar"
                                            style="width: {{ $checklist->user_tasks_count / $checklist->tasks_count * 100}}%" 
                                            aria-valuenow="{{ $checklist->user_tasks_count / $checklist->tasks_count * 100 }}" 
                                            aria-valuemin="0" aria-valuemax="100">
                                        </div>
                                    </div>
                                @else
                                    <div class="progress progress-xs mt-2">
                                        <div class="progress-bar bg-gradient-success" role="progressbar"
                                            style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                        <div class="col-md-4">
                            <h2 class="text-center">
                                <strong>{{ $checklists->sum('user_tasks_count') }}/{{ $checklists->sum('tasks_count') }}</strong>
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
