<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/favicon.png">
    <title>Itrust Investments</title>
    <link rel="stylesheet" href="css/plugins.css">
    <link rel="stylesheet" href="css/theme/purple.css">
    <link rel="preload" href="css/font/thicccboi.css" as="style" onload="this.rel='stylesheet'">
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
</body>

</html>
