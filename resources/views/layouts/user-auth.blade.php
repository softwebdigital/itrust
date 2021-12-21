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

    <link href="{{ asset('assets/libs/choices.js/public/assets/styles/choices.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Bootstrap Css -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('assets/vendors/sweetalert2/sweetalert2.min.css') }}">
    <link
     rel="stylesheet"
     href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css"
   />
    <style>
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        input[type=number]{
            -moz-appearance: textfield;
        }
        .choices { margin-bottom: 0 !important; }

        .iti{
            display: block !important;
        }
    </style>
       <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>

</head>

<body>

<!-- <body data-layout="horizontal"> -->
<div class="auth-page">
    <div class="container-fluid p-0">
        <div class="d-flex">
            <div class="@if(Route::currentRouteNamed('register')) col-xxl-6 col-lg-8 col-md-12 @else col-xxl-3 col-lg-4 col-md-6 @endif mx-auto">
                <div class="auth-full-page-content d-flex p-sm-5 p-4">
                    <div class="w-100">
                        <div class="d-flex flex-column h-100">
                            <div class="mb-4 mb-md-5 text-center">
                                <a href="/" class="d-block auth-logo">
                                    <img src="{{ asset('assets/images/logo-sm.svg') }}" alt="" height="28"> <span class="logo-txt">{{ env('APP_NAME') }}</span>
                                </a>
                            </div>
                            @yield('content')
                            <div class="mt-4 mt-md-5 text-center">
                                <p class="mb-4">Copyright © <script>document.write(new Date().getFullYear())</script>
                                    {{ env('APP_NAME') }} . All rights reserved</p>
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
@yield('script')
<script>
    const phoneInputField = document.querySelector("#phone");
    const phoneInput = window.intlTelInput(phoneInputField, {
      separateDialCode: true,
      preferredCountries:["in"],
      hiddenInput: "phone",
      utilsScript:
        "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
    });

    $("form").submit(function() {
    var full_number = phoneInput.getNumber(intlTelInputUtils.numberFormat.E164);

     $("input[name='phone'").val(full_number);

    });
  </script>
<script>
    const status = {!! json_encode(session('status')) !!};
    const resent = {!! json_encode(session('resent')) !!};
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

    if (resent) {
        Toast.fire({
            icon: 'success',
            title: 'A verification link has been sent to your mail'
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
    let n = document.getElementsByTagName("body")[0]
    // const theme = localStorage.getItem('theme') ? localStorage.getItem('theme') : 'light';
    // theme === "light" ? (document.body.setAttribute("data-layout-mode", "light"), document.body.setAttribute("data-topbar", "light"), document.body.setAttribute("data-sidebar", "light"), n.hasAttribute("data-layout") && "horizontal" === n.getAttribute("data-layout") || document.body.setAttribute("data-sidebar", "light"), s("topbar-color-light"), s("sidebar-color-light"), s("topbar-color-light")) : (document.body.setAttribute("data-layout-mode", "dark"), document.body.setAttribute("data-topbar", "dark"), document.body.setAttribute("data-sidebar", "dark"), n.hasAttribute("data-layout") && "horizontal" === n.getAttribute("data-layout") || document.body.setAttribute("data-sidebar", "dark"), s("layout-mode-dark"), s("sidebar-color-dark"), s("topbar-color-dark"))
</script>
</body>

</html>
