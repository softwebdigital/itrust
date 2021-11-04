<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>@yield('head') | {{ env('APP_NAME') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

    <link href="{{ asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />


    <link href="{{ asset('assets/libs/alertifyjs/build/css/alertify.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Responsive datatable examples -->
    <link href="{{ asset('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('assets/libs/admin-resources/rwd-table/rwd-table.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- plugin css -->
    <link href="{{ asset('assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css') }}" rel="stylesheet" type="text/css" />

    <!-- preloader css -->
    <link rel="stylesheet" href="{{ asset('assets/css/preloader.min.css') }}" type="text/css" />

    <!-- Bootstrap Css -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('assets/vendors/sweetalert2/sweetalert2.min.css') }}">
    @yield('style')
</head>

<body>

<!-- <body data-layout="horizontal"> -->

<!-- Begin page -->
<div id="layout-wrapper">
    <header id="page-topbar">
        <div class="navbar-header">
            <div class="d-flex">
                <!-- LOGO -->
                <div class="navbar-brand-box">
                    <a href="{{ '/admin' }}" class="logo logo-dark">
                                <span class="logo-sm">
                                    <img src="{{ asset('assets/images/logo-sm.svg') }}" alt="" height="24">
                                </span>
                        <span class="logo-lg">
                                    <img src="{{ asset('assets/images/logo-sm.svg') }}" alt="" height="24"> <span class="logo-txt">{{ env('APP_NAME') }}</span>
                                </span>
                    </a>

                    <a href="{{ '/admin' }}" class="logo logo-light">
                                <span class="logo-sm">
                                    <img src="{{ asset('assets/images/logo-sm.svg') }}" alt="" height="24">
                                </span>
                        <span class="logo-lg">
                                    <img src="{{ asset('assets/images/logo-sm.svg') }}" alt="" height="24"> <span class="logo-txt">{{ env('APP_NAME') }}</span>
                                </span>
                    </a>
                </div>

                <button type="button" class="btn btn-sm px-3 font-size-16 header-item" id="vertical-menu-btn">
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

                <div class="dropdown d-none d-sm-inline-block">
                    <button type="button" class="btn header-item" id="mode-setting-btn" onclick="setTheme('dark' === document.getElementsByTagName('body')[0].getAttribute('data-layout-mode') ? 'light' : 'dark')">
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
                </div>

                <div class="dropdown d-inline-block">
                    <button type="button" class="btn header-item right-bar-toggle me-2">
                        <i data-feather="settings" class="icon-lg"></i>
                    </button>
                </div>

                <div class="dropdown d-inline-block">
                    <button type="button" class="btn header-item bg-soft-light border-start border-end" id="page-header-user-dropdown"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img class="rounded-circle header-profile-user" src="{{ auth('admin')->user()['photo'] ? asset(auth('admin')->user()['photo']) : asset('img/avatar.png') }}"
                             alt="Header Avatar">
                        <span class="d-none d-xl-inline-block ms-1 fw-medium">{{ explode(' ', auth('admin')->user()['name'])[0] }}.</span>
                        <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <!-- item-->
                        <a class="dropdown-item" href="{{ route('admin.profile') }}"><i class="mdi mdi-face-profile font-size-16 align-middle me-1"></i> Profile</a>
{{--                        <a class="dropdown-item" href="auth-lock-screen.html"><i class="mdi mdi-lock font-size-16 align-middle me-1"></i> Lock screen</a>--}}
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#" onclick="event.preventDefault(); $('#logout-form').submit()"><i class="mdi mdi-logout font-size-16 align-middle me-1"></i> Logout</a>
                        <form action="{{ route('admin.logout') }}" method="post" id="logout-form" class="d-none">@csrf</form>
                    </div>
                </div>

            </div>
        </div>
    </header>

    <!-- ========== Left Sidebar Start ========== -->
    <div class="vertical-menu">

        <div data-simplebar class="h-100">

            <!--- Sidemenu -->
            <div id="sidebar-menu">
                <!-- Left Menu Start -->
                <ul class="metismenu list-unstyled" id="side-menu">
                    <li class="menu-title" data-key="t-menu">Menu</li>

                    <li class="{{ Route::currentRouteNamed('admin.index') ? 'mm-active' : '' }}">
                        <a href="{{ route('admin.index') }}">
                            <i data-feather="home"></i>
                            <span data-key="t-dashboard">Dashboard</span>
                        </a>
                    </li>

                    <li class="{{ Route::currentRouteNamed(['admin.users', 'admin.users.show']) ? 'mm-active' : '' }}">
                        <a href="{{ route('admin.users') }}">
                            <i data-feather="users"></i>
                            <span data-key="t-users">Users</span>
                        </a>
                    </li>

                    <li>
                        <a href="javascript: void(0);" class="has-arrow {{ Route::currentRouteNamed(['admin.deposits', 'admin.transactions', 'admin.payouts']) ? 'mm-active' : '' }}">
                            <i data-feather="dollar-sign"></i>
                            <span data-key="t-funds">Funds</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">

                            <li class="{{ Route::currentRouteNamed('admin.deposits') ? 'mm-active' : '' }}">
                                <a href="{{ route('admin.deposits') }}">
                                    <span data-key="t-deposit">Deposits</span>
                                </a>
                            </li>

                            <li class="{{ Route::currentRouteNamed('admin.payouts') ? 'mm-active' : '' }}">
                                <a href="{{ route('admin.payouts') }}">
                                    <span data-key="t-payouts">Payouts</span>
                                </a>
                            </li>

                            <li class="{{ Route::currentRouteNamed('admin.transactions') ? 'mm-active' : '' }}">
                                <a href="{{ route('admin.transactions') }}">
                                    <span data-key="t-transactions">Transactions</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="{{ Route::currentRouteNamed(['admin.investments']) ? 'mm-active' : '' }}">
                        <a href="{{ route('admin.investments') }}">
                            <i data-feather="dollar-sign"></i>
                            <span data-key="t-news">Investment</span>
                        </a>
                    </li>

                    <li class="{{ Route::currentRouteNamed(['admin.news', 'admin.news.create', 'admin.news.edit']) ? 'mm-active' : '' }}">
                        <a href="{{ route('admin.news') }}">
                            <i data-feather="book-open"></i>
                            <span data-key="t-news">News</span>
                        </a>
                    </li>

                    <li class="{{ Route::currentRouteNamed(['admin.blog']) ? 'mm-active' : '' }}">
                        <a href="{{ route('admin.blog') }}">
                            <i data-feather="book-open"></i>
                            <span data-key="t-news">Blog</span>
                        </a>
                    </li>

                    <li class="{{ Route::currentRouteNamed(['admin.blogCategory']) ? 'mm-active' : '' }}">
                        <a href="{{ route('admin.blogCategory') }}">
                            <i data-feather="book-open"></i>
                            <span data-key="t-news">Blog Category</span>
                        </a>
                    </li>

                    <li class="{{ Route::currentRouteNamed(['admin.documents']) ? 'mm-active' : '' }}">
                        <a href="{{ route('admin.documents') }}">
                            <i data-feather="file"></i>
                            <span data-key="t-invoice">Invoice / Receipt</span>
                        </a>
                    </li>

                    <li class="{{ Route::currentRouteNamed('admin.settings') ? 'mm-active' : '' }}">
                        <a href="{{ route('admin.settings') }}">
                            <i data-feather="settings"></i>
                            <span data-key="t-settings">Settings</span>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- Sidebar -->
        </div>
    </div>
    <!-- Left Sidebar End -->



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
        </div>
        <!-- End Page-content -->


        <footer class="footer">
            <div class="mt-4 mt-md-5 text-center">
                <p class="mb-4">© <script>document.write(new Date().getFullYear())</script>
                    {{ env('APP_NAME') }} . Crafted with <i class="mdi mdi-heart text-danger"></i> by Soft-Web Digital</p>
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
                       id="layout-mode-light" value="light" onchange="if (this.checked === true) setTheme('light')">
                <label class="form-check-label" for="layout-mode-light">Light</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="layout-mode"
                       id="layout-mode-dark" value="dark" onchange="if (this.checked === true) setTheme('dark')">
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
    </div><!-- end slimscroll-menu-->
</div>
<!-- /Right-bar -->

<!-- Right bar overlay-->
<div class="rightbar-overlay"></div>

<!-- JAVASCRIPT -->
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

<script src="{{ asset('assets/js/app.js') }}"></script>
<script src="{{ asset('assets/vendors/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Required datatable js -->
<script src="{{ asset('assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<!-- Buttons examples -->
<script src="{{ asset('assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/libs/alertifyjs/build/alertify.min.js') }}"></script>
<!-- Datatable init js -->
<script src="{{ asset('assets/js/pages/datatables.init.js') }}"></script>

<script>
    const success = {!! json_encode(Illuminate\Support\Facades\Session::get('success')) !!};
    const error = {!! json_encode(Illuminate\Support\Facades\Session::get('error')) !!};
    const warning = {!! json_encode(Illuminate\Support\Facades\Session::get('warning')) !!};
    const info = {!! json_encode(Illuminate\Support\Facades\Session::get('info')) !!};
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

    function setTheme(theme) {
        if (theme === 'light') {
            localStorage.setItem('theme', 'light');
            localStorage.setItem('topbar', 'light');
            localStorage.setItem('sidebar-theme', 'light');
            document.getElementById('layout-mode-light').checked = true
            document.getElementById('topbar-color-light').checked = true
            document.getElementById('sidebar-color-light').checked = true;
        }
        if (theme === 'dark') {
            localStorage.setItem('theme', 'dark');
            localStorage.setItem('topbar', 'dark');
            localStorage.setItem('sidebar-theme', 'dark');
            document.getElementById('layout-mode-dark').checked = true
            document.getElementById('topbar-color-dark').checked = true
            document.getElementById('sidebar-color-dark').checked = true;
        }
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
</script>
@yield('script')
</body>

</html>
