@extends('layouts.admin')

@section('head')
    {{ __('Settings') }}
@endsection

@section('title')
    {{ __('Settings') }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Settings</li>
@endsection

@section('content')

@endsection

@section('script')
    <script src="{{ asset('assets/libs/twitter-bootstrap-wizard/jquery.bootstrap.wizard.min.js') }}"></script>
    <script src="{{ asset('assets/libs/twitter-bootstrap-wizard/prettify.js') }}"></script>
    <script src="{{ asset('assets/libs/choices.js/public/assets/scripts/choices.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/form-wizard.init.js') }}"></script>
    <script>

    </script>
@endsection
