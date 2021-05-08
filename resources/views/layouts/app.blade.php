<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- CoreUI CSS -->
    <link rel="stylesheet" href="{{asset('Coreui/Style.css')}}">
</head>
<body>
    <main class="c-app c-dark-theme c-no-layout-transition">
        @include('Components.Sidebar')
        <div class="c-wrapper">
            <header class="c-header c-header-light c-header-fixed">
                <button class="c-header-toggler c-class-toggler d-lg-none mfe-auto" type="button" data-target="#sidebar"
                    data-class="c-sidebar-show">
                    <svg class="c-icon c-icon-lg">
                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-menu"></use>
                    </svg>
                </button><a class="c-header-brand d-lg-none c-header-brand-sm-up-center" href="#">
                    <svg width="118" height="46" alt="CoreUI Logo">
                        <use xlink:href="assets/brand/coreui-pro.svg#full"></use>
                    </svg></a>
                <button class="c-header-toggler c-class-toggler mfs-3 d-md-down-none" type="button"
                    data-target="#sidebar" data-class="c-sidebar-lg-show" responsive="true">
                    <svg class="c-icon c-icon-lg">
                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-menu"></use>
                    </svg>
                </button>
                <ul class="c-header-nav mfs-auto">
                    <li class="c-header-nav-item dropdown mx-3"><a class="c-header-nav-link" data-toggle="dropdown" href="#"
                            role="button" aria-haspopup="true" aria-expanded="false">
                            <div class="c-avatar"><img class="c-avatar-img" src="{{asset('assets/img/avatars/FOFH8654.jpg')}}"
                                    alt="user@email.com"></div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right pt-0">
                            <div class="dropdown-header bg-light py-2"><strong>Account</strong></div><a
                                class="dropdown-item" href="#">
                                <svg class="c-icon mfe-2">
                                    <use xlink:href="{{asset('vendors/@coreui/icons/svg/free.svg#cil-user')}}"></use>
                                </svg> Profile</a><a class="dropdown-item" href="#">
                                <svg class="c-icon mfe-2">
                                    <use xlink:href="{{asset('vendors/@coreui/icons/svg/free.svg#cil-settings')}}"></use>
                                </svg> Settings</a><a class="dropdown-item" href="#">
                                <svg class="c-icon mfe-2">
                                    <use xlink:href="{{asset('vendors/@coreui/icons/svg/free.svg#cil-credit-card')}}"></use>
                                </svg> Payments<span class="badge badge-secondary mfs-auto">42</span></a><a
                                class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                              document.getElementById('logout-form').submit();">
                                <svg class=" c-icon mfe-2">
                                    <use xlink:href="{{asset('vendors/@coreui/icons/svg/free.svg#cil-account-logout')}}"></use>
                                </svg>{{ __('Logout') }}
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </a>
                        </div>
                    </li>
                </ul>
            </header>
            <div class="c-body">
                <main class="c-main">
                    @yield('content')
                </main>
            </div>
            <!-- Optional JavaScript -->
            <!-- Popper.js first, then CoreUI JS -->
            <script src="{{asset('Core-js/scrollbar.js')}}"></script>
            <script src="{{asset('Core-js/popper.js')}}"></script>
            <script src="{{asset('Core-js/dist.js')}}"></script>
            <script src="{{asset('Ckeditor/ckeditor.js')}}"></script>
            @yield('ckEditor')
</body>
</html>