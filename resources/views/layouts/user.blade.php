<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>@yield('head') | {{ env('APP_NAME') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta property="og:image" content="{{ asset('seo.jpeg') }}">
    <meta property="og:title" content="Access The Most Powerful Stock & Crypto Trading Bot - Itrust Investment">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

    <!-- plugin css -->
    <link href="{{ asset('assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="{{ asset('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('assets/libs/alertifyjs/build/css/alertify.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- preloader css -->
    <link rel="stylesheet" href="{{ asset('assets/css/preloader.min.css') }}" type="text/css" />

    <!-- Bootstrap Css -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('assets/vendors/sweetalert2/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js" integrity="sha512-Tn2m0TIpgVyTzzvmxLNuqbSJH3JP8jm+Cy3hvHrW7ndTDcJ1w5mBiksqDBb8GpE2ksktFvDB/ykZ0mDpsZj20w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    @yield('style')
</head>

<body data-layout="horizontal">

<!-- Begin page -->
<div id="layout-wrapper">

    <header id="page-topbar">
        <div class="navbar-header">
            <div class="d-flex">
                <!-- LOGO -->
                <div class="navbar-brand-box">
                    <a href="{{ route('user.index') }}" class="logo logo-dark">
                                <span class="logo-sm">
                                    <img src="{{ asset('assets/images/logo-sm.svg') }}" alt="" height="24">
                                </span>
                        <span class="logo-lg">
                                    <img src="{{ asset('assets/images/logo-sm.svg') }}" alt="" height="24"> <span class="logo-txt">{{ env('APP_NAME') }}</span>
                                </span>
                    </a>

                    <a href="{{ route('user.index') }}" class="logo logo-light">
                                <span class="logo-sm">
                                    <img src="{{ asset('assets/images/logo-sm.svg') }}" alt="" height="24">
                                </span>
                        <span class="logo-lg">
                                    <img src="{{ asset('assets/images/logo-sm.svg') }}" alt="" height="24"> <span class="logo-txt">{{ env('APP_NAME') }}</span>
                                </span>
                    </a>
                </div>

                <button type="button" class="btn btn-sm px-3 font-size-16 d-lg-none header-item waves-effect waves-light" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                    <i class="fa fa-fw fa-bars"></i>
                </button>
                    <!-- App Search-->
{{--                <form class="app-search d-none d-lg-block">--}}
{{--                    <div class="position-relative">--}}
{{--                        <input type="text" class="form-control" placeholder="Search...">--}}
{{--                        <button class="btn btn-primary" type="button"><i class="bx bx-search-alt align-middle"></i></button>--}}
{{--                    </div>--}}
{{--                </form>--}}
            </div>

            <div class="d-flex">

                <div class="dropdown d-inline-block d-lg-none ms-2">
                    <button type="button" class="btn header-item" id="page-header-search-dropdown"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i data-feather="search" class="icon-lg"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                         aria-labelledby="page-header-search-dropdown">

                        <form class="p-3">
                            <div class="form-group m-0">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search ..." aria-label="Search Result">

                                    <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                {{-- <div class="dropdown d-sm-inline-block">
                    <button type="button" class="btn header-item" id="mode-setting-btn" onclick="window.localStorage.setItem('theme', ('dark' === document.getElementsByTagName('body')[0].getAttribute('data-layout-mode')) ? 'light' : 'dark')">
                        <i data-feather="moon" class="icon-lg layout-mode-dark"></i>
                        <i data-feather="sun" class="icon-lg layout-mode-light"></i>
                    </button>
                </div>

                <div class="dropdown d-none d-lg-inline-block ms-1">
                    <button type="button" class="btn header-item"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i data-feather="grid" class="icon-lg"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                        <div class="p-2">
                            <div class="row g-0">
                                <div class="col">
                                    <a class="dropdown-icon-item" href="#">
                                        <img src="{{ asset('assets/images/brands/github.png') }}" alt="Github">
                                        <span>GitHub</span>
                                    </a>
                                </div>
                                <div class="col">
                                    <a class="dropdown-icon-item" href="#">
                                        <img src="{{ asset('assets/images/brands/bitbucket.png') }}" alt="bitbucket">
                                        <span>Bitbucket</span>
                                    </a>
                                </div>
                                <div class="col">
                                    <a class="dropdown-icon-item" href="#">
                                        <img src="{{ asset('assets/images/brands/dribbble.png') }}" alt="dribbble">
                                        <span>Dribbble</span>
                                    </a>
                                </div>
                            </div>

                            <div class="row g-0">
                                <div class="col">
                                    <a class="dropdown-icon-item" href="#">
                                        <img src="{{ asset('assets/images/brands/dropbox.png') }}" alt="dropbox">
                                        <span>Dropbox</span>
                                    </a>
                                </div>
                                <div class="col">
                                    <a class="dropdown-icon-item" href="#">
                                        <img src="{{ asset('assets/images/brands/mail_chimp.png') }}" alt="mail_chimp">
                                        <span>Mail Chimp</span>
                                    </a>
                                </div>
                                <div class="col">
                                    <a class="dropdown-icon-item" href="#">
                                        <img src="{{ asset('assets/images/brands/slack.png') }}" alt="slack">
                                        <span>Slack</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}

                @php $user = App\Models\User::find(auth()->id()); @endphp
                <div class="dropdown d-inline-block">
                    <button type="button" class="btn header-item noti-icon position-relative" id="page-header-notifications-dropdown"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i data-feather="bell" class="icon-lg"></i>
                        @if($user->unreadNotifications()->count() > 0) <span class="badge bg-danger rounded-pill">{{ $user->unreadNotifications()->count() }}</span> @endif
                    </button>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                         aria-labelledby="page-header-notifications-dropdown">
                        <div class="p-3">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h6 class="m-0"> Notifications </h6>
                                </div>
                                <div class="col-auto">
                                    <a href="#!" class="small text-reset text-decoration-underline"> Unread ({{ $user->unreadNotifications()->count() }})</a>
                                </div>
                            </div>
                        </div>
                        @if($user->notifications()->count() > 0)
                            <div data-simplebar style="max-height: 250px;">
                                @foreach($user->notifications()->latest()->limit(2)->get() as $notis)
                                    <a href="{{ route('user.notifications.show', $notis->id) }}#{{ $notis->id }}" class="text-reset notification-item">
                                        <div class="d-flex {{ $notis->read_at == null ? 'bg-light' : '' }}">
                                            <div class="flex-shrink-0 me-3">
                                                <img src="{{ asset($notis->data['image'] ?? 'img/avatar.png') }}" class="rounded-circle avatar-sm" alt="user-pic">
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="mb-1">{{ ucwords($notis->data['title']) }}</h6>
                                                <div class="font-size-13 text-muted">
                                                    <p class="mb-0">{!! strlen($notis->data['message']) > 30 ? substr($notis->data['message'], 0, 30).'...' : $notis->data['message'] !!}
                                                        <br> <span><i class="mdi mdi-clock-outline"></i> {{ \Carbon\Carbon::make($notis->created_at)->diffForHumans() }}</span></p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                            @if($user->notifications()->count() > 2)
                                <div class="p-2 border-top d-grid">
                                    <a class="btn btn-sm btn-link font-size-14 text-center" href="{{ route('user.notifications') }}">
                                        <i class="mdi mdi-arrow-right-circle me-1"></i> <span>View All</span>
                                    </a>
                                </div>
                            @endif
                        @else
                            <div class="p-2 border-top d-grid">
                                <p>No notifications</p>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="dropdown d-inline-block">
                    <button type="button" class="btn header-item right-bar-toggle me-2">
                        <i data-feather="settings" class="icon-lg"></i>
                    </button>
                </div>

                <div class="dropdown d-inline-block">
                    <button type="button" class="btn header-item bg-soft-light border-start border-end" id="page-header-user-dropdown"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img class="rounded-circle header-profile-user" src="{{ auth()->user()['photo'] ? asset(auth()->user()['photo']) : asset('img/avatar.png') }}"
                             alt="Header Avatar">
                        <span class="d-none d-xl-inline-block ms-1 fw-medium">{{ auth()->user()['username'] }}.</span>
                        <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <!-- item-->
                        <a class="dropdown-item" href="{{ route('user.settings') }}"><i class="mdi mdi-clipboard-text-outline font-size-16 align-middle me-1"></i> Application Status</a>
                        {{-- <a class="dropdown-item" href="{{ route('user.profile') }}"><i class="mdi mdi-chat-question-outline font-size-16 align-middle me-1"></i> Help</a> --}}
                        <a class="dropdown-item" href="{{ route('frontend.contact') }}"><i class="mdi mdi-chat-processing-outline font-size-16 align-middle me-1"></i> Contact Us</a>
                        <a class="dropdown-item" href="{{ route('user.profile') }}"><i class="mdi mdi-face-profile font-size-16 align-middle me-1"></i> Profile</a>
                        <a class="dropdown-item" href="{{ route('user.lock') }}"><i class="mdi mdi-lock font-size-16 align-middle me-1"></i> Lock screen</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="javascript:void(0)" onclick="event.preventDefault(); $('#logout-form').submit()"><i class="mdi mdi-logout font-size-16 align-middle me-1"></i> Logout</a>
                        <form action="{{ route('logout') }}" method="post" id="logout-form" class="d-none">@csrf</form>
                    </div>
                </div>

            </div>
        </div>
    </header>

    <div class="topnav">
        <div class="container-fluid">
            <nav class="navbar navbar-light navbar-expand-lg topnav-menu">

                <div class="collapse navbar-collapse" id="topnav-menu-content">
                    <ul class="navbar-nav">

                        <li class="nav-item dropdown {{ Route::currentRouteNamed('user.index') ? 'mm-active' : '' }}">
                            <a class="nav-link dropdown-toggle arrow-none" href="{{ route('user.index') }}" id="topnav-dashboard" role="button">
                                <i data-feather="home"></i><span data-key="t-dashboards">Account</span>
                            </a>
                        </li>

                        <li class="nav-item dropdown {{ Route::currentRouteNamed('user.portfolio') ? 'mm-active' : '' }}">
                            <a class="nav-link dropdown-toggle arrow-none" href="{{ route('user.portfolio') }}" id="topnav-portfolio" role="button">
                                <i data-feather="briefcase"></i><span data-key="t-portfolio">Portfolio</span>
                            </a>
                        </li>

                        <li class="nav-item dropdown {{ Route::currentRouteNamed(['user.statements', 'user.transactions']) ? 'mm-active' : '' }}">
                            <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-history" role="button">
                                <i data-feather="save"></i><span data-key="t-history">History</span> <div class="arrow-down"></div>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="topnav-pages">

                                <a href="{{ route('user.statements') }}" class="dropdown-item" data-key="t-calendar">Statement</a>
                                <a href="{{ route('user.transactions') }}" class="dropdown-item" data-key="t-chat">Transactions</a>

                            </div>
                        </li>

                        <style>
                            @media (max-width: 768px) {
                                /* Hide the original navigation for smaller screens */
                                .cash-nav-item {
                                    display: none;
                                }

                                /* Show the navigation with a class 'mobile-menu' for smaller screens */
                                .cash-mobile-menu {
                                    display: block;
                                }
                            }

                            @media (min-width: 768px) {
                                /* Hide the original navigation for smaller screens */
                                .cash-nav-item {
                                    display: block;
                                }

                                /* Show the navigation with a class 'mobile-menu' for smaller screens */
                                .cash-mobile-menu {
                                    display: none;
                                }
                            }
                        </style>

                        <li class="cash-mobile-menu nav-item dropdown {{ Route::currentRouteNamed(['user.deposit', 'user.withdraw']) ? 'mm-active' : '' }}">
                            <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-history" role="button">
                                <i data-feather="dollar-sign"></i><span data-key="t-history">Cash</span> <div class="arrow-down"></div>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="topnav-pages">

                                <a href="{{ route('user.deposit') }}" class="dropdown-item" data-key="t-calendar">Deposit</a>
                                <a href="{{ route('user.withdraw') }}" class="dropdown-item" data-key="t-chat">Withdrawal</a>

                            </div>
                        </li>

                        <li class="cash-nav-item nav-item dropdown {{ Route::currentRouteNamed('user.cash') ? 'mm-active' : '' }}">
                            <a class="nav-link dropdown-toggle arrow-none" href="{{ route('user.cash') }}" id="topnav-cash" role="button">
                                <i data-feather="dollar-sign"></i><span data-key="t-cash">Cash</span>
                            </a>
                        </li>

                        <li class="nav-item dropdown {{ Route::currentRouteNamed('user.documents') ? 'mm-active' : '' }}">
                            <a class="nav-link dropdown-toggle arrow-none" href="{{ route('user.documents') }}" id="topnav-documents" role="button">
                                <i data-feather="file-text"></i><span data-key="t-documents">Documents</span>
                            </a>
                        </li>

                        <li class="nav-item dropdown {{ Route::currentRouteNamed('user.rewards') ? 'mm-active' : '' }}">
                            <a class="nav-link dropdown-toggle arrow-none" href="{{ route('user.rewards') }}" id="topnav-rewards" role="button">
                                <i data-feather="gift"></i><span data-key="t-rewards">Rewards</span>
                            </a>
                        </li>

                        <li class="nav-item dropdown {{ Route::currentRouteNamed('user.settings') ? 'mm-active' : '' }}">
                            <a class="nav-link dropdown-toggle arrow-none" href="{{ route('user.settings') }}" id="topnav-settings" role="button">
                                <i data-feather="settings"></i><span data-key="t-settings">Settings</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->

    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">@yield('title')</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    @yield('breadcrumb')
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->
                @yield('content')
            </div>
            <!-- container-fluid -->

            <button type="button" class="btn btn-primary waves-effect waves-light d-none" id="alert-btn" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                Static backdrop modal
            </button>
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Account not verified</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p id="msg"></p>
                        </div>
{{--                        <div class="modal-footer">--}}
{{--                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>--}}
{{--                            <button type="button" class="btn btn-primary">Understood</button>--}}
{{--                        </div>--}}
                    </div>
                </div>
            </div>
        </div>
        <!-- End Page-content -->

        <footer class="footer">
            <div class="mt-4 mt-md-5 text-center">
                <p class="mb-4">Copyright © <script>document.write(new Date().getFullYear())</script>
                    {{ env('APP_NAME') }} . All rights reserved</p>
            </div>
        </footer>
    </div>
    <!-- end main content-->

</div>
<!-- END layout-wrapper -->


<!-- Right Sidebar -->
    <div class="right-bar">
        <div data-simplebar class="h-100">
            <div class="rightbar-title d-flex align-items-center bg-dark p-3">

                <h5 class="m-0 me-2 text-white">Theme Customizer</h5>

                <a href="javascript:void(0);" class="right-bar-toggle ms-auto">
                    <i class="mdi mdi-close noti-icon"></i>
                </a>
            </div>

            <!-- Settings -->
            <hr class="m-0" />

            <div class="p-4">
                <h6 class="mb-3">Layout Mode</h6>

                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="layout-mode"
                           id="layout-mode-light" value="light" onchange="(() => {
                           if (this.checked === true) {
                               localStorage.setItem('theme', 'light');
                               localStorage.setItem('topbar', 'light');
                           }
                       })()">
                    <label class="form-check-label" for="layout-mode-light">Light</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="layout-mode"
                           id="layout-mode-dark" value="dark" onchange="(() => {
                           if (this.checked === true) {
                               localStorage.setItem('theme', 'dark');
                               localStorage.setItem('topbar', 'dark');
                           }
                       })()">
                    <label class="form-check-label" for="layout-mode-dark">Dark</label>
                </div>

                <h6 class="mt-4 mb-3 pt-2">Topbar Color</h6>

                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="topbar-color"
                           id="topbar-color-light" value="light" onchange="(() => {
                           document.body.setAttribute('data-topbar', 'light');
                           if (this.checked === true) localStorage.setItem('topbar', 'light');
                       })()">
                    <label class="form-check-label" for="topbar-color-light">Light</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="topbar-color"
                           id="topbar-color-dark" value="dark" onchange="(() => {
                           document.body.setAttribute('data-topbar', 'dark')
                           if (this.checked === true) localStorage.setItem('topbar', 'dark');
                       })()">
                    <label class="form-check-label" for="topbar-color-dark">Dark</label>
                </div>

                <h6 class="mt-4 mb-3 pt-2 sidebar-setting">Sidebar Size</h6>

                <div class="form-check sidebar-setting">
                    <input class="form-check-input" type="radio" name="sidebar-size"
                           id="sidebar-size-default" value="default" onchange="(() => {
                           document.body.setAttribute('data-sidebar-size', 'lg');
                           if (this.checked === true) localStorage.setItem('sidebar', 'lg');
                       })()">
                    <label class="form-check-label" for="sidebar-size-default">Default</label>
                </div>
                <div class="form-check sidebar-setting">
                    <input class="form-check-input" type="radio" name="sidebar-size"
                           id="sidebar-size-compact" value="compact" onchange="(() => {
                           document.body.setAttribute('data-sidebar-size', 'md');
                           if (this.checked === true) localStorage.setItem('sidebar', 'md');
                       })()">
                    <label class="form-check-label" for="sidebar-size-compact">Compact</label>
                </div>
                <div class="form-check sidebar-setting">
                    <input class="form-check-input" type="radio" name="sidebar-size"
                           id="sidebar-size-small" value="small" onchange="(() => {
                           document.body.setAttribute('data-sidebar-size', 'sm');
                           if (this.checked === true) localStorage.setItem('sidebar', 'sm');
                       })()">
                    <label class="form-check-label" for="sidebar-size-small">Small (Icon View)</label>
                </div>

                <h6 class="mt-4 mb-3 pt-2 sidebar-setting">Sidebar Color</h6>

                <div class="form-check sidebar-setting">
                    <input class="form-check-input" type="radio" name="sidebar-color"
                           id="sidebar-color-light" value="light" onchange="(() => {
                           document.body.setAttribute('data-sidebar', 'light');
                           if (this.checked === true) localStorage.setItem('sidebar-theme', 'light');
                       })()">
                    <label class="form-check-label" for="sidebar-color-light">Light</label>
                </div>
                <div class="form-check sidebar-setting">
                    <input class="form-check-input" type="radio" name="sidebar-color"
                           id="sidebar-color-dark" value="dark" onchange="(() => {
                           document.body.setAttribute('data-sidebar', 'dark');
                           if (this.checked === true) localStorage.setItem('sidebar-theme', 'dark');
                       })()">
                    <label class="form-check-label" for="sidebar-color-dark">Dark</label>
                </div>
                <div class="form-check sidebar-setting">
                    <input class="form-check-input" type="radio" name="sidebar-color"
                           id="sidebar-color-brand" value="brand" onchange="(() => {
                           document.body.setAttribute('data-sidebar', 'brand');
                           if (this.checked === true) localStorage.setItem('sidebar-theme', 'brand');
                       })()">
                    <label class="form-check-label" for="sidebar-color-brand">Brand</label>
                </div>

                <div class="d-none">
                    <h6 class="mb-3">Layout</h6>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="layout"
                               id="layout-vertical" value="vertical">
                        <label class="form-check-label" for="layout-vertical">Vertical</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="layout"
                               id="layout-horizontal" value="horizontal">
                        <label class="form-check-label" for="layout-horizontal">Horizontal</label>
                    </div>

                    <h6 class="mt-4 mb-3 pt-2">Layout Width</h6>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="layout-width"
                               id="layout-width-fuild" value="fuild" onchange="(() => { document.body.setAttribute('data-layout-size', 'fluid');
                            if (this.checked === true) localStorage.setItem('layout-width', 'fluid'); else localStorage.setItem('layout-width', 'boxed');})()">
                        <label class="form-check-label" for="layout-width-fuild">Fluid</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="layout-width"
                               id="layout-width-boxed" value="boxed" onchange="(() => { document.body.setAttribute('data-layout-size', 'boxed');
                            if (this.checked === true) localStorage.setItem('layout-width', 'boxed'); else localStorage.setItem('layout-width', 'fluid');})()">
                        <label class="form-check-label" for="layout-width-boxed">Boxed</label>
                    </div>

                    <h6 class="mt-4 mb-3 pt-2">Layout Position</h6>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="layout-position"
                               id="layout-position-fixed" value="fixed" onchange="document.body.setAttribute('data-layout-scrollable', 'false')">
                        <label class="form-check-label" for="layout-position-fixed">Fixed</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="layout-position"
                               id="layout-position-scrollable" value="scrollable" onchange="document.body.setAttribute('data-layout-scrollable', 'true')">
                        <label class="form-check-label" for="layout-position-scrollable">Scrollable</label>
                    </div>

                    <h6 class="mt-4 mb-3 pt-2">Direction</h6>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="layout-direction"
                               id="layout-direction-ltr" value="ltr">
                        <label class="form-check-label" for="layout-direction-ltr">LTR</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="layout-direction"
                               id="layout-direction-rtl" value="rtl">
                        <label class="form-check-label" for="layout-direction-rtl">RTL</label>
                    </div>
                </div>
            </div>

        </div> <!-- end slimscroll-menu-->
    </div>
    <!-- /Right-bar -->

    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>



<!-- JAVASCRIPT -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/libs/metismenu/metisMenu.min.js') }}"></script>
<script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
<script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>
<script src="{{ asset('assets/libs/feather-icons/feather.min.js') }}"></script>
<!-- pace js -->
<script src="{{ asset('assets/libs/pace-js/pace.min.js') }}"></script>
<!-- apexcharts -->
<script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>
<!-- Plugins js-->
<script src="{{ asset('assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
<script src="{{ asset('assets/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-world-mill-en.js') }}"></script>
<!-- apexcharts js -->
<script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>

<script src="{{ asset('assets/js/app.js') }}"></script>
<script src="{{ asset('assets/vendors/sweetalert2/sweetalert2.min.js') }}"></script>

<!-- Required datatable js -->
<script src="{{ asset('assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<!-- Buttons examples -->
<script src="{{ asset('assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/libs/alertifyjs/build/alertify.min.js') }}"></script>

<script>
    const success = {!! json_encode(Illuminate\Support\Facades\Session::get('success')) !!};
    const error = {!! json_encode(Illuminate\Support\Facades\Session::get('error')) !!};
    const warning = {!! json_encode(Illuminate\Support\Facades\Session::get('warning')) !!};
    const info = {!! json_encode(Illuminate\Support\Facades\Session::get('info')) !!};
    const get_location = {!! json_encode(Illuminate\Support\Facades\Session::get('get_location')) !!};
    const theme = localStorage.getItem('theme') ?? 'light';

    // const Toast = Swal.mixin({
    //     toast: true,
    //     position: 'top-end',
    //     showConfirmButton: false,
    //     timer: 5000,
    //     background: theme === 'light' ? 'whitesmoke' : 'white'
    // });
    // Toast.fire({
    //     icon: 'warning',
    //     title: warning
    // })

    if (success)
        alertify.success(success);

    if (warning)
        alertify.warning(warning);

    if (info)
        alertify.message(info);

    if (error)
        alertify.error(error);

    function s(t) {
        document.getElementById(t).checked = !0
    }

    let n = document.getElementsByTagName("body")[0]
    const topbar = localStorage.getItem('topbar') ?? 'light';
    const sidebar = localStorage.getItem('sidebar') ?? 'lg';
    const sidebarTheme = localStorage.getItem('sidebar-theme') ?? 'light';

    theme === "light" ? (document.body.setAttribute("data-layout-mode", "light"), document.body.setAttribute("data-topbar", "light"), document.body.setAttribute("data-sidebar", "light"), n.hasAttribute("data-layout") && "horizontal" === n.getAttribute("data-layout") || document.body.setAttribute("data-sidebar", "light"), s("topbar-color-light"), s("sidebar-color-light"), s("topbar-color-light")) : (document.body.setAttribute("data-layout-mode", "dark"), document.body.setAttribute("data-topbar", "dark"), document.body.setAttribute("data-sidebar", "dark"), n.hasAttribute("data-layout") && "horizontal" === n.getAttribute("data-layout") || document.body.setAttribute("data-sidebar", "dark"), s("layout-mode-dark"), s("sidebar-color-dark"), s("topbar-color-dark"))
    topbar === "light" ? (document.body.setAttribute('data-topbar', 'light'), document.getElementById('topbar-color-light').checked = true) : (document.body.setAttribute('data-topbar', 'dark'), document.getElementById('topbar-color-dark').checked = true);

    if (sidebar === "sm") {
        document.body.setAttribute('data-sidebar-size', 'sm');
        document.getElementById('sidebar-size-small').checked = true;
    } else if (sidebar === "md") {
        document.body.setAttribute('data-sidebar-size', 'md');
        document.getElementById('sidebar-size-compact').checked = true;
    } else {
        document.body.setAttribute('data-sidebar-size', 'lg');
        document.getElementById('sidebar-size-default').checked = true;
    }

    if (sidebarTheme === "dark") {
        document.body.setAttribute('data-sidebar', 'dark');
        document.getElementById('sidebar-color-dark').checked = true;
    } else if (sidebarTheme === "brand") {
        document.body.setAttribute('data-sidebar', 'brand');
        document.getElementById('sidebar-color-brand').checked = true;
    } else {
        document.body.setAttribute('data-sidebar', 'light');
        document.getElementById('sidebar-color-light').checked = true;
    }

    if (1024 <= window.innerWidth && window.innerWidth <= 1200) {
        document.body.setAttribute('data-sidebar-size', 'sm');
        document.getElementById('sidebar-size-small').checked = true;
    }

    let os = [
        { name: 'Windows Phone', value: 'Windows Phone', version: 'OS', fullValue: 'Windows Phone' },
        { name: 'Windows', value: 'Win', version: 'NT', fullValue: 'Windows' },
        { name: 'iPhone', value: 'iPhone', version: 'OS', fullValue: 'iPhone' },
        { name: 'iPad', value: 'iPad', version: 'OS', fullValue: 'iPad OS' },
        { name: 'Kindle', value: 'Silk', version: 'Silk', fullValue: 'Silk' },
        { name: 'Android', value: 'Android', version: 'Android', fullValue: 'Android' },
        { name: 'PlayBook', value: 'PlayBook', version: 'OS', fullValue: 'PlayBook OS' },
        { name: 'BlackBerry', value: 'BlackBerry', version: '/', fullValue: 'BlackBerry' },
        { name: 'Macintosh', value: 'Mac', version: 'OS X', fullValue: 'Mac OS X' },
        { name: 'Linux', value: 'Linux', version: 'rv', fullValue: 'Linus' },
        { name: 'Palm', value: 'Palm', version: 'PalmOS', fullValue: 'Palm PalmOS' }
    ]

    let browser = [
        { name: 'Chrome', value: 'Chrome', version: 'Chrome' , fullValue: 'Chrome' },
        { name: 'Firefox', value: 'Firefox', version: 'Firefox' , fullValue: 'Firefox' },
        { name: 'Safari', value: 'Safari', version: 'Version' , fullValue: 'Safari' },
        { name: 'Internet Explorer', value: 'MSIE', version: 'MSIE' , fullValue: 'Internet Explorer' },
        { name: 'Opera', value: 'Opera', version: 'Opera' , fullValue: 'Opera' },
        { name: 'BlackBerry', value: 'CLDC', version: 'CLDC' , fullValue: 'BlackBerry' },
        { name: 'Mozilla', value: 'Mozilla', version: 'Mozilla' , fullValue: 'Mozilla' }
    ]

    let header = [
        navigator.platform,
        navigator.userAgent,
        navigator.appVersion,
        navigator.vendor,
        window.opera
    ];

    function matchItem(string, data) {
        let i, j = 0, html = '', regex, regexv, match, matches, version;

        for (i = 0; i < data.length; i += 1) {
            regex = new RegExp(data[i].value, 'i');
            match = regex.test(string);
            if (match) {
                regexv = new RegExp(data[i].version + '[- /:;]([\d._]+)', 'i');
                matches = string.match(regexv);
                version = '';
                if (matches) { if (matches[1]) { matches = matches[1]; } }
                if (matches) {
                    matches = matches.split(/[._]+/);
                    for (j = 0; j < matches.length; j += 1) {
                        if (j === 0) {
                            version += matches[j] + '.';
                        } else {
                            version += matches[j];
                        }
                    }
                } else {
                    version = '0';
                }
                return {
                    name: data[i].fullValue,
                    version: parseFloat(version)
                };
            }
        }
        return { name: 'unknown', version: 0 };
    }

    function getData() {
        let agent = header.join(' ');
        os = matchItem(agent, os);
        browser = matchItem(agent, browser);
        return { os: os.name, browser: browser.name }
    }

    $.getJSON('https://geolocation-db.com/json/').done(location => {
        const city = location.city;
        const state = location.state;
        const country = location.country_name;
        const loc = `${city ? city + ',' : (state ? state + ',' : '')} ${country ?? ''}`
        if (get_location) {
            $.ajax({
                url: `{{ route('user.devices.update') }}`,
                type: 'POST',
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                data: {...getData(), loc},
                success: function (res) {
                    console.log(res)
                },
                error: function (res) {
                    //
                }
            })
        }
    });

    function removeDeviceByID(id, password) {
        if (password.length)
            $.ajax({
                url: `/devices/${id}/destroy`,
                type: 'DELETE',
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                data: { password },
                success: function (res) {
                    alertify.success(res.msg);
                    $('#device-' + id).remove();
                    $('#device-count').html(res.count)
                },
                error: function (res) {
                    if (res.status === 429)
                        alertify.error(res.statusText);
                    else
                        alertify.error(res["responseJSON"].msg);
                }
            });
        else
            alertify.warning('Please enter you password to continue');
    }

    function updateInvestmentProfile(type, id) {
        let data;
        if (type === 'employment') data = { employment: $('select[name="employment"]').val() };
        if (type === 'marital_status') data = { marital_status: $('select[name="marital_status"]').val() };
        if (type === 'yearly_income') data = { yi: $('select[name="yearly_income"]').val() };
        if (type === 'sof') data = { sof: $('select[name="sof"]').val() };
        if (type === 'goal') data = { goal: $('select[name="goal"]').val() };
        if (type === 'timeline') data = { timeline: $('select[name="timeline"]').val() };
        if (type === 'experience') data = { experience: $('select[name="experience"]').val() };

        $.ajax({
            url: `/profile/investment/${type}/update`,
            type: 'POST',
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            data,
            success: function (res) {
                alertify.success(res.msg)
                $(id).html(res.data)
            },
            error: function (res) {
                if (res.status === 429)
                    alertify.error(res.statusText);
                else
                    alertify.error(res["responsJSON"].msg)
            }
        })
    }

    function updateDSP(id) {
        $.ajax({
            url: `/dsp`,
            type: 'POST',
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            data: { dsp: !!$(id).is(':checked') },
            success: function (res) {
                alertify.success(res.msg)
                $('#dspVal').html(res.msg)
            },
            error: function (res) {
                if (res.status === 429)
                    alertify.error(res.statusText);
                else
                    alertify.error(res['responseJSON'].msg);
            }
        })
    }

    function updateDocument(type, image) {
        const formData = new FormData()
        formData.append('type', type)
        formData.append('file', $(image)[0].files[0])

        $.ajax({
            url: '{{ route('user.documents.upload') }}',
            type: 'POST',
            headers: { "X-CSRF-TOKEN": '{{ csrf_token() }}' },
            data: formData,
            contentType: false,
            processData: false,
            beforeSend: function () {
            },
            success: function (res) {
                alertify.success(res.msg)
                if (type === 'passport')
                    $('#passportVal').html(res.data);
                if (type === 'drivers_license')
                    $('#driversLicenceVal').html(res.data);
                if (type === 'state_id')
                    $('#stateIDVal').html(res.data);
            },
            error: function (res) {
                if (res.status === 422)
                    if (res['responseJSON'].msg['type'])
                        alertify.error(res['responseJSON'].msg['type'][0]);
                if (res['responseJSON'].msg['file'])
                    alertify.error(res['responseJSON'].msg['file'][0]);
                else if (res.status === 429)
                    alertify.error(res.statusText);
                else
                    alertify.error(res['responseJSON'].msg);
            }
        })
    }

    function imagePreview(input, id, width = null, defaultImg = null) {
        if (defaultImg === null) defaultImg = $(id).attr('src')
        if (input.files && input.files[0]) {
            let reader = new FileReader();

            reader.onload = function (e) {
                $(id)
                    .attr('src', e.target.result)
                    .width(width)
                // .height(200);
            };

            reader.readAsDataURL(input.files[0]);
        } else $(id)
            .attr('src', defaultImg)
            .width(width)
    }


    $(document).ready(() => {
        @if(auth()->user()['id_approved'] != 1)
            $('#id-btn').click();
        @endif
        @if(auth()->user()['state_id_approved'] != 1)
            $('#state-btn').click();
        @endif
    })
</script>

@yield('script')

<!-- <script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
        var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
        s1.async=true;
        s1.src='https://embed.tawk.to/61d7335eb84f7301d329b6f4/1fooa1bol';
        s1.charset='UTF-8';
        s1.setAttribute('crossorigin','*');
        s0.parentNode.insertBefore(s1,s0);
    })();
</script> -->

<script src="//code.tidio.co/24agp2azq6tkrizvwrrl8q8w1rawkfun.js" async></script>
</body>

</html>
