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
        <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{ route('home') }}">
                <svg class="c-sidebar-nav-icon">
                    <use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-speedometer') }}"></use>
                </svg> {{__('Daashboard')}}<span class="badge badge-info">{{ Auth::user()->name }}</span></a></li>
        @if (auth()->user()->is_admin)
            <li class="c-sidebar-nav-title">{{ __('Manage Checklist') }}</li>
            @foreach (\App\Models\checklistGroup::with('checklists')->get() as $group)
                <li class="c-sidebar-nav-dropdown"><a class="c-sidebar-nav-link"
                        href="{{ route('admin.checklist_groups.edit',$group->id) }}">
                        <svg class="c-sidebar-nav-icon">
                            <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-puzzle"></use>
                        </svg> {{ $group->name }}</a>
                    <ul class="c-sidebar-nav-dropdown-items">
                        @foreach ($group->checklists as $checklist)
                            <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{route('admin.checklists.edit',$checklist->id)}}">
                                    {{ $checklist->name }}</a></li>
                        @endforeach
                    </ul>
                </li>
            @endforeach
            <li class="c-sidebar-nav-item"><a href="{{route('admin.checklist_groups.create')}}" class="c-sidebar-nav-link"> New Checklist Group</a></li>
        @endif
    </ul>
</div>
