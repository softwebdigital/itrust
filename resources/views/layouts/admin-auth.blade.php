<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>@yield('title') | {{ env('APP_NAME') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

    <!-- preloader css -->
    <link rel="stylesheet" href="{{ asset('assets/css/preloader.min.css') }}" type="text/css" />

    <!-- Bootstrap Css -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('assets/vendors/sweetalert2/sweetalert2.min.css') }}">

</head>

<body>

<!-- <body data-layout="horizontal"> -->
<div class="auth-page">
    <div class="container-fluid p-0">
        <div class="d-flex">
            <div class="col-xxl-3 col-lg-4 col-md-5 mx-auto">
                <div class="auth-full-page-content d-flex p-sm-5 p-4">
                    <div class="w-100">
                        <div class="d-flex flex-column h-100">
                            <div class="mb-4 mb-md-5 text-center">
                                <a href="#" class="d-block auth-logo">
                                    <img src="{{ asset('assets/images/logo-sm.svg') }}" alt="" height="28"> <span class="logo-txt">{{ env('APP_NAME') }}</span>
                                </a>
                            </div>
                            @yield('content')
                            <div class="mt-4 mt-md-5 text-center">
                                <p class="mb-0">© <script>document.write(new Date().getFullYear())</script>
                                    {{ env('APP_NAME') }}   . Crafted with <i class="mdi mdi-heart text-danger"></i> by Soft-Web Digital</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end container fluid -->
</div>


<!-- JAVASCRIPT -->
<script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/libs/metismenu/metisMenu.min.js') }}"></script>
<script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
<script src="{{ asset('assets/libs/node-waves/waves.min.js"') }}"></script>
<script src="{{ asset('assets/libs/feather-icons/feather.min.js') }}"></script>
<!-- pace js -->
<script src="{{ asset('assets/libs/pace-js/pace.min.js') }}"></script>
<!-- password addon init -->
<script src="{{ asset('assets/js/pages/pass-addon.init.js') }}"></script>
<script src="{{ asset('assets/vendors/sweetalert2/sweetalert2.min.js') }}"></script>
<script>
    const status = {!! json_encode(session('status')) !!};
    const success = {!! json_encode(Illuminate\Support\Facades\Session::get('success')) !!};
    const error = {!! json_encode(Illuminate\Support\Facades\Session::get('error')) !!};
    const warning = {!! json_encode(Illuminate\Support\Facades\Session::get('warning')) !!};
    const info = {!! json_encode(Illuminate\Support\Facades\Session::get('info')) !!};

    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 7000,
        background: 'whitesmoke'
    });

    if (status) {
        Toast.fire({
            icon: 'success',
            title: status
        })
    }

    if (success) {
        Toast.fire({
            icon: 'success',
            title: success
        })
    }
    if (warning) {
        Toast.fire({
            icon: 'warning',
            title: warning
        })
    }
    if (info) {
        Toast.fire({
            icon: 'info',
            title: info
        })
    }
    if (error) {
        Toast.fire({
            icon: 'error',
            title: error
        })
    }
</script>
</body>

</html>
