<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta property="og:image" content="{{ asset('card.jpeg') }}">
    <meta property="og:title" content="Invest globally in stocks, options, futures and many more from a single unified platform.">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">
    <title>Itrust Investments</title>
    <link rel="stylesheet" href="css/plugins.css">
    <link rel="stylesheet" href="css/theme/purple.css">
    <link rel="preload" href="css/font/thicccboi.css" as="style" onload="this.rel='stylesheet'">
    
    @yield('styles')
</head>

<body>
    <div class="content-wrapper">
        <header class="wrapper bg-soft-primary">
            @include('frontend.layouts.header')
            <!-- /.navbar -->
        </header>
        <!-- /header -->
        @yield('content')
        <!-- /section -->
    </div>
    <!-- /.content-wrapper -->
    @include('frontend.layouts.footer')
    <div class="progress-wrap">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
        </svg>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous"></script>
    <script src="js/plugins.js"></script>
    <script src="js/theme.js"></script>

      <!-- Include Bootstrap JS with jQuery and Popper.js -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

{{--    <!--Start of Tawk.to Script-->--}}
{{--    <script type="text/javascript">--}}
{{--        var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();--}}
{{--        (function(){--}}
{{--            var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];--}}
{{--            s1.async=true;--}}
{{--            s1.src='https://embed.tawk.to/61d72c31b84f7301d329b5b4/1foo899cg';--}}
{{--            s1.charset='UTF-8';--}}
{{--            s1.setAttribute('crossorigin','*');--}}
{{--            s0.parentNode.insertBefore(s1,s0);--}}
{{--        })();--}}
{{--    </script>--}}
{{--    <!--End of Tawk.to Script-->--}}

    <!--Start of Tawk.to Script-->
    // <script type="text/javascript">
    //     var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    //     (function(){
    //         var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
    //         s1.async=true;
    //         s1.src='https://embed.tawk.to/61d7335eb84f7301d329b6f4/1fooa1bol';
    //         s1.charset='UTF-8';
    //         s1.setAttribute('crossorigin','*');
    //         s0.parentNode.insertBefore(s1,s0);
    //     })();
    // </script>

    <script src="//code.tidio.co/24agp2azq6tkrizvwrrl8q8w1rawkfun.js" async></script>
    <!--End of Tawk.to Script-->
</body>

</html>
