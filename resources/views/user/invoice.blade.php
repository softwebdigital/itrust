<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Latest Invoice</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

    <!-- plugin css -->
    {{-- <link href="{{ asset('assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css') }}" rel="stylesheet" type="text/css" /> --}}

    {{-- <link href="{{ asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" /> --}}
    {{-- <link href="{{ asset('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" /> --}}

    <!-- Responsive datatable examples -->
    {{-- <link href="{{ asset('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" /> --}}

    {{-- <link href="{{ asset('assets/libs/alertifyjs/build/css/alertify.min.css') }}" rel="stylesheet" type="text/css" /> --}}

    <!-- preloader css -->
    {{-- <link rel="stylesheet" href="{{ asset('assets/css/preloader.min.css') }}" type="text/css" /> --}}

    <!-- Bootstrap Css -->

    <!-- Icons Css -->
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> --}}

    {{-- <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" /> --}}
    <!-- App Css-->
    {{-- <link href="{{ asset('assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" /> --}}
    {{-- <link rel="stylesheet" href="{{ asset('assets/vendors/sweetalert2/sweetalert2.min.css') }}"> --}}
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js" integrity="sha512-Tn2m0TIpgVyTzzvmxLNuqbSJH3JP8jm+Cy3hvHrW7ndTDcJ1w5mBiksqDBb8GpE2ksktFvDB/ykZ0mDpsZj20w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <style>
        table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
        </style>
</head>

<body data-layout="horizontal">

<!-- Begin page -->
<div id="layout-wrapper">

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
                <div class="card-body">
                    {{-- {{ dd($array) }} --}}
{{--                    <div class="d-flex mb-5 justify-content-center"><img src="{{ $array['logo'] }}" class="mx-auto" alt="" height="65"></div>--}}
                    <h3>Latest Invoice for {{ $array['user'] }} </h3>
                    <table>
                        <tr>
                          <th>Title</th>
                          <th>Value</th>
                        </tr>
                        <tr>
                          <td>Type</td>
                          <td>{{ ucwords(str_replace('_', ' ', $array['data']->type)) }}</td>
                        </tr>
                        <tr>
                          <td>Amount</td>
                          <td>{{ $array['data']->type == 'stocks_and_funds' ? '$'.number_format($array['data']->amount, 2) : round($array['data']->amount, 8).' BTC' }}</td>
                        </tr>
                        @if($array['type'] == 'statement')
                        <tr>
                          <td>ROI</td>
                          <td>{{ $array['data']->type == 'stocks_and_funds' ? '$'.number_format($array['data']->ROI, 2) : round($array['data']->ROI, 8).' BTC' }}</td>
                        </tr>
                        @endif
                        <tr>
                          <td>Account</td>
                          <td>
                            @if($array['data']->acct_type == 'offshore')
                            Offshore
                            @elseif($array['data']->acct_type == 'basic_ira')
                            Basic IRA
                            @else
                            -----
                            @endif
                        </td>
                        </tr>
                        <tr>
                          <td>Status</td>
                          <td> <span class="badge p-2
                            {{ $array['data']->status == 'open' ? 'bg-success' : '' }}
                            {{ $array['data']->status == 'closed' ? 'bg-danger' : '' }}
                        ">{{ ucwords($array['data']->status) }}</td>
                        </tr>
                        <tr>
                          <td>Brokerage cost</td>
                          <td>$-----</td>
                        </tr>
                        <tr>
                            <td>Withdrawable funds</td>
                            <td>${{ $array['withdrawable'] }}</td>
                          </tr>
                          <tr>
                            <td>Date Recorded</td>
                            <td>{{ \Carbon\Carbon::make($array['data']->created_at)->format('Y/m/d') }}</td>
                          </tr>
                      </table>


                </div>
            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->


    </div>
    <!-- end main content-->

</div>
<!-- END layout-wrapper -->


<!-- Right Sidebar -->

</body>

</html>
