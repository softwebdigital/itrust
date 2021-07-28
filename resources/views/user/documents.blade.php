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
    <p>We generate monthly account statements for every month in which you have trading activity. These statements are typically available within two weeks of the end of the month</p>
@endsection

@section('script')
    <script>
        // $('#datatable').DataTable()
    </script>
@endsection
