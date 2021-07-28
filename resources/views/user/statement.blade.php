@extends('layouts.user')

@section('head')
    {{ __('Statement') }}
@endsection

@section('title')
    {{ __('My Statement') }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('user.index') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Statement</li>
@endsection

@section('content')

@endsection
