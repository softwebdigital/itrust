<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Statements</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">
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
                    {{-- {{ dd($investments) }} --}}
                    <img src="https://itrustinvestment.com/img/itrust-logo-large.png" alt="" height="65">
                    <h3>Account Statement for {{ $investments['user'] }}</h3>
                    <table id="datatable" class="table">
                        <thead>
                        <tr>
                            <th>Date</th>
                            <th>Type</th>
                            <th>Amount Invested</th>
                            <th>ROI</th>
                            {{-- <th>Status</th> --}}
                        </tr>
                        </thead>

                        <tbody>
                       @foreach($investments['inv'] as $investment)
                           <tr>
                               <td>{{ \Carbon\Carbon::make($investment->created_at)->format('Y/m/d') }}</td>
                               <td>{{ ucwords(str_replace('_', ' ', $investment->type)) }}</td>
                               <td>${{ $investment->amount }}</td>
                               <td>${{ $investment->ROI }}</td>
                               {{-- <td> <span class="badge p-2
                                       {{ $investment->status == 'open' ? 'bg-success' : '' }}
                                       {{ $investment->status == 'closed' ? 'bg-danger' : '' }}
                                   ">{{ ucwords($investment->status) }}</td> --}}
                           </tr>
                       @endforeach
                        </tbody>
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
