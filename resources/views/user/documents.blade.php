@extends('layouts.user')

@section('head')
    {{ __('Documents') }}
@endsection

@section('title')
    {{ __('Documents') }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('user.index') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Documents</li>
@endsection

@section('content')
<div class="col-md-8">
    <p>We generate monthly account statements for every month in which you have trading activity. These statements are typically available within two weeks of the end of the month</p>
    <div class="card-body mb-3 border">
        <div class="row align-items-center" id="">
            <div class="col-2">
                <img src="{{ asset('assets/images/logo-sm.svg') }}" alt="" width="40">
            </div>
            <div class="col-10 align-self-center d-flex justify-content-between">
                <div class="mt-4 mt-sm-0">
                    <h6><a href="javascript:void(0)">Statement for the month of June</a></h6>
                </div>
                <div class="align-self-auto my-auto"><a href="javascript:void(0)" title="Download"><i class="icon" data-feather="download"></i></a></div>
            </div>
        </div>
    </div>
    <div class="card-body mb-3 border">
        <div class="row align-items-center" id="">
            <div class="col-2">
                <img src="{{ asset('assets/images/logo-sm.svg') }}" alt="" width="40">
            </div>
            <div class="col-10 align-self-center d-flex justify-content-between">
                <div class="mt-4 mt-sm-0">
                    <h6><a href="javascript:void(0)">Receipt for $30K deposit</a></h6>
                </div>
                <div class="align-self-auto my-auto"><a href="javascript:void(0)" title="Download"><i class="icon" data-feather="download"></i></a></div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>
        // $('#datatable').DataTable()
    </script>
@endsection
