@extends('layouts.admin')

@section('head')
    {{ __('Profile') }}
@endsection

@section('title')
    {{ __('Profile') }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Profile</li>
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/libs/twitter-bootstrap-wizard/prettify.css') }}">
    <link href="{{ asset('assets/libs/choices.js/public/assets/styles/choices.min.css') }}" rel="stylesheet" type="text/css" />
    <style>
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        input[type=number]{
            -moz-appearance: textfield;
        }
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-xl-8 col-md-8">
            <div class="card card-h-100">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Personal Information</h4>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('admin.profile.update') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="name">Name <span class="text-danger">*</span></label>
                            <input type="text" id="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') ?? $admin->name }}">
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="email"> Email</label>
                            <input type="text" id="email" class="form-control" name="email" readonly value="{{ $admin->email }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="photo"> Photo</label>
                            <input type="file" id="photo" class="form-control @error('photo') is-invalid @enderror" name="photo">
                            @error('photo')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary w-md">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-4">
            <div class="card card-h-100">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Password Update</h4>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('admin.password.update') }}">
                        @csrf
                        <div class="mb-3">
                            <div class="d-flex align-items-start">
                                <div class="flex-grow-1">
                                    <label class="form-label" for="old-password">Old Password</label>
                                </div>
                            </div>
                            <div class="input-group">
                                <input type="password" id="old-password" autocomplete="current-password" class="form-control @error('old_password') is-invalid @enderror" name="old_password" placeholder="">
                                <button class="btn btn-light shadow-none ms-0" type="button" id="old-password-btn"><i class="mdi mdi-eye-outline"></i></button>
                                @error('old_password')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="d-flex align-items-start">
                                <div class="flex-grow-1">
                                    <label class="form-label" for="new-password">New Password</label>
                                </div>
                            </div>
                            <div class="input-group">
                                <input type="password" id="new-password" autocomplete="new-password" class="form-control @error('new_password') is-invalid @enderror" name="new_password" placeholder="">
                                <button class="btn btn-light shadow-none ms-0" type="button" id="new-password-btn"><i class="mdi mdi-eye-outline"></i></button>
                                @error('new_password')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="d-flex align-items-start">
                                <div class="flex-grow-1">
                                    <label class="form-label" for="confirm-password">Confirm Password</label>
                                </div>
                            </div>

                            <div class="input-group">
                                <input type="password" class="form-control" autocomplete="new-password" id="confirm-password" name="new_password_confirmation" placeholder="">
                                <button class="btn btn-light shadow-none ms-0" type="button" id="confirm-password-btn"><i class="mdi mdi-eye-outline"></i></button>
                            </div>
                        </div>
                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary w-md">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('assets/libs/twitter-bootstrap-wizard/jquery.bootstrap.wizard.min.js') }}"></script>
    <script src="{{ asset('assets/libs/twitter-bootstrap-wizard/prettify.js') }}"></script>
    <script src="{{ asset('assets/libs/choices.js/public/assets/scripts/choices.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/form-wizard.init.js') }}"></script>
    <script>
        $("#old-password-btn").on("click",function(){0<$(this).siblings("input").length&&("password"==$(this).siblings("input").attr("type")?$(this).siblings("input").attr("type","input"):$(this).siblings("input").attr("type","password"))});
        $("#new-password-btn").on("click",function(){0<$(this).siblings("input").length&&("password"==$(this).siblings("input").attr("type")?$(this).siblings("input").attr("type","input"):$(this).siblings("input").attr("type","password"))});
        $("#confirm-password-btn").on("click",function(){0<$(this).siblings("input").length&&("password"==$(this).siblings("input").attr("type")?$(this).siblings("input").attr("type","input"):$(this).siblings("input").attr("type","password"))});
    </script>
@endsection
