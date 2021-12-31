<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">
    <title>Itrust Investments</title>
    {{-- <link rel="stylesheet" href="css/plugins.css">
    <link rel="stylesheet" href="css/theme/purple.css"> --}}
    <link rel="stylesheet" href="{{ asset('css/plugins.css') }}">
  <link rel="stylesheet" href="{{ asset('css/theme/blue.css') }}">
  <link href="{{ asset('assets/libs/alertifyjs/build/css/alertify.min.css') }}" rel="stylesheet" type="text/css" />
    {{-- <link rel="preload" href="css/font/thicccboi.css" as="style" onload="this.rel='stylesheet'"> --}}
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
    <script src="{{ asset('js/plugins.js') }}"></script>
    <script src="{{ asset('js/theme.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-4+XzXVhsDmqanXGHaHvgh1gMQKX40OUvDEBTu8JcmNs=" crossorigin="anonymous"></script>
<script src="{{ asset('js/share.js') }}"></script>
<script src="{{ asset('assets/libs/alertifyjs/build/alertify.min.js') }}"></script>
<script>
    const success = {!! json_encode(Illuminate\Support\Facades\Session::get('success')) !!};
    const error = {!! json_encode(Illuminate\Support\Facades\Session::get('error')) !!};
    const warning = {!! json_encode(Illuminate\Support\Facades\Session::get('warning')) !!};
    const info = {!! json_encode(Illuminate\Support\Facades\Session::get('info')) !!};
    const theme = localStorage.getItem('theme') ?? 'light';


    // alertify.success('GGUSYIGHIUGSHi');
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
    // console.log(success);
        alertify.success(success);

    if (warning)
        alertify.warning(warning);

    if (info)
        alertify.message(info);

    if (error)
        alertify.error(error);
</script>
<script>
    function loadMoreData(page){
        $.ajax({
            url: '?page=' + page,
            type: 'get',
            beforeSend: function(){
                $(".ajax-load").show();
            }
        })
        .done(function(data){
            if(data.html == ""){
                $('.loadmore').hide();
                alertify.error('No More Comments')
                return;
            }
            $('.ajax-load').hide();
            $("#singlecomments").append(data.html)
        })
        .fail(function(jqXHR, ajaxOptions, thrownError){
            alertify.message('Server not responding....')
        });
    }

    var page = 1;
    $(function(){
    $('.loadmore').click(function() {
            page++;
            loadMoreData(page);
    });
});
        // }
    // })
</script>
</body>

</html>
