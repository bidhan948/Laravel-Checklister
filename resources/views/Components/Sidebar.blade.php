<div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">
    <div class="c-sidebar-brand d-md-down-none">
        <svg class="c-sidebar-brand-full" width="118" height="46" alt="CoreUI Logo">
            <use xlink:href="{{ asset('assets/brand/coreui-pro.svg#full') }}"></use>
        </svg>
        <svg class="c-sidebar-brand-minimized" width="46" height="46" alt="CoreUI Logo">
            <use xlink:href="assets/brand/coreui-pro.svg#signet"></use>
        </svg>
    </div>
    <ul class="c-sidebar-nav">
        <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{ route('welcome') }}">
                <svg class="c-sidebar-nav-icon">
                    <use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-speedometer') }}"></use>
                </svg> {{ __('Dashboard') }}<span class="badge badge-info">{{ Auth::user()->name }}</span></a></li>
        @if (!auth()->user()->is_admin)
            @foreach ($user_task_menu as $key => $user_task_menu)
                <li class="c-sidebar-nav-item c-sidebar-nav-dropdown c-show">
                    <a class="c-sidebar-nav-link" href="{{ route('welcome') }}">
                        <svg class="c-sidebar-nav-icon">
                            <use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-'.$user_task_menu['icon']) }}"></use>
                        </svg> {{$user_task_menu['name']}}
                        @livewire('user-task-counter', ['task_type'=>$key,'task_count'=>$user_task_menu['tasks_count']])
                    </a>
                </li>
            @endforeach
        @endif
        @if (auth()->user()->is_admin)
            <li class="c-sidebar-nav-title">{{ __('Manage Checklist') }}</li>
            @foreach ($admin_menu as $group)
                <li class="c-sidebar-nav-dropdown c-show">
                <li class="c-sidebar-nav-item c-sidebar-nav-dropdown c-show">
                    <a class="c-sidebar-nav-link" href="{{ route('admin.checklist_groups.edit', $group->id) }}">
                        <svg class="c-sidebar-nav-icon">
                            <use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-folder-open') }}">
                            </use>
                        </svg> {{ $group->name }}
                    </a>
                    <ul class="c-sidebar-nav-dropdown-items">
                        @foreach ($group->checklists as $checklist)
                            <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link"
                                    href="{{ route('admin.checklist_groups.checklists.edit', [$group, $checklist]) }}">
                                    {{ $checklist->name }}</a></li>
                        @endforeach
                        <li class="c-sidebar-nav-item"><a
                                href="{{ route('admin.checklist_groups.checklists.create', $group) }}"
                                class="c-sidebar-nav-link"> {{ __('New Checklist') }}</a></li>
                    </ul>
                </li>
            @endforeach
            <li class="c-sidebar-nav-item c-sidebar-nav-dropdown"><a
                    href="{{ route('admin.checklist_groups.create') }}" class="c-sidebar-nav-link"> New Checklist
                    Group</a></li>
            <li class="c-sidebar-nav-title">{{ __('Pages') }}</li>
            @foreach (\App\Models\Page::all() as $page)
                <li class="c-sidebar-nav-item c-sidebar-nav-dropdown">
                    <a class="c-sidebar-nav-link" href="{{ route('admin.pages.edit', $page) }}">
                        <svg class="c-sidebar-nav-icon">
                            <use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-puzzle') }}"></use>
                        </svg>{{ $page->title }}
                    </a>
                </li>
            @endforeach
            <li class="c-sidebar-nav-title">{{ __('Manage Data') }}</li>
            <li class="c-sidebar-nav-item c-sidebar-nav-dropdown">
                <a class="c-sidebar-nav-link" href="{{ route('admin.users.index') }}">
                    <svg class="c-sidebar-nav-icon">
                        <use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-user') }}"></use>
                    </svg>{{ __('Users Data') }}
                </a>
            </li>
        @else
            @foreach ($menu as $group)
                <li class="c-sidebar-nav-item c-sidebar-nav-dropdown c-show">
                <li class="c-sidebar-nav-title text-center" style="margin-top: 0px; margin-bottom:-14px;">
                    <div class="d-flex justify-content-center">
                        <svg class="c-sidebar-nav-icon">
                            <use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-sort-descending') }}">
                            </use>
                        </svg>
                        <p style="padding-right:35px;">{{ $group['name'] }}</p>
                    </div>
                    @if ($group['is_new'])
                        <span class="mx-2 badge badge-info">
                            {{ __('New') }}
                        </span>
                    @elseif($group['is_updated'])
                        <span class="mx-2 badge badge-info">
                            {{ __('Updated') }}
                        </span>
                    @endif
                </li>
                @foreach ($group['checklists'] as $checklist)
                    <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link"
                            href="{{ route('users.checklist.show', $checklist['id']) }}">
                            <svg class="c-sidebar-nav-icon">
                                <use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-list') }}">
                                </use>
                            </svg> {{ $checklist['name'] }}

                            @livewire('completed-task-count',
                            ['completed_task_count'=>count($checklist['user_completed_task']),
                            'tasks_count'=>count($checklist['tasks']),
                            'checklistId'=>$checklist['id']
                            ])
                            @if ($checklist['is_new'])
                                <span class="mx-2 badge badge-info">
                                    {{ __('New') }}
                                </span>
                            @elseif($checklist['is_updated'])
                                <span class="mx-2 badge badge-info">
                                    {{ __('Updated') }}
                                </span>
                            @endif
                        </a>

                    </li>
                @endforeach
                </li>
                {{-- @dd($group->checklists) --}}
            @endforeach
        @endif
    </ul>
</div>
