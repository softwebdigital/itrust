@extends('layouts.admin-auth')

@section('title')
    {{ __('Login') }}
@endsection

@section('content')
{{--<div class="col-md-8 pl-md-0">--}}
{{--    <div class="auth-form-wrapper px-4 py-5">--}}
{{--        <a href="#" class="noble-ui-logo logo-light d-block mb-2">{{ env('APP_NAME') }} <span>Admin</span></a>--}}
{{--        <h5 class="text-muted font-weight-normal mb-4">Welcome back! Log in to your account.</h5>--}}
{{--        <form class="forms-sample" method="post" action="{{ route('admin.login') }}">--}}
{{--            @csrf--}}
{{--            <div class="form-group">--}}
{{--                <label for="exampleInputEmail1">Email address</label>--}}
{{--                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="exampleInputEmail1" placeholder="Email" value="{{ old('email') }}">--}}
{{--                @error('email')--}}
{{--                <span class="invalid-feedback" role="alert">--}}
{{--                    <strong>{{ $message }}</strong>--}}
{{--                </span>--}}
{{--                @enderror--}}
{{--            </div>--}}
{{--            <div class="form-group">--}}
{{--                <label for="exampleInputPassword1">Password</label>--}}
{{--                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="exampleInputPassword1" autocomplete="current-password" placeholder="Password">--}}
{{--                @error('password')--}}
{{--                <span class="invalid-feedback" role="alert">--}}
{{--                    <strong>{{ $message }}</strong>--}}
{{--                </span>--}}
{{--                @enderror--}}
{{--            </div>--}}
{{--            <div class="d-flex justify-content-between">--}}
{{--                <div class="form-check form-check-flat form-check-primary my-auto">--}}
{{--                    <label class="form-check-label">--}}
{{--                        <input type="checkbox" class="form-check-input" name="remember" {{ old('remember') ? 'checked' : '' }}>--}}
{{--                        Remember me--}}
{{--                    </label>--}}
{{--                </div>--}}
{{--                <div class="my-auto">--}}
{{--                    <a href="{{ route('admin.password.email') }}">Forgot your password?</a>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="mt-3">--}}
{{--                <button type="submit" class="btn btn-primary mr-2 mb-2 mb-md-0 text-white">Login</button>--}}
{{--            </div>--}}
{{--        </form>--}}
{{--    </div>--}}
{{--</div>--}}

<div class="auth-content my-auto">
    <div class="text-center">
        <h5 class="mb-0">Welcome Back !</h5>
        <p class="text-muted mt-2">Sign in to continue to {{ env('APP_NAME') }}.</p>
    </div>
    <form class="mt-4 pt-2" action="{{ route('admin.login') }}" method="post">
        @csrf
        <div class="mb-3">
            <label class="form-label" for="email">Email</label>
            <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="Enter email" {{ old('email') }}>
            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="mb-3">
            <div class="d-flex align-items-start">
                <div class="flex-grow-1">
                    <label class="form-label" for="password">Password</label>
                </div>
                <div class="flex-shrink-0">
                    <div class="">
                        <a href="{{ route('admin.password.email') }}" class="text-muted">Forgot password?</a>
                    </div>
                </div>
            </div>

            <div class="input-group auth-pass-inputgroup">
                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Enter password" aria-label="Password" aria-describedby="password-addon">
                <button class="btn btn-light shadow-none ms-0" type="button" id="password-addon"><i class="mdi mdi-eye-outline"></i></button>
            </div>
            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="row mb-4">
            <div class="col">
                <div class="form-check">
                    <input class="form-check-input" name="remember" type="checkbox" id="remember-check" {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="remember-check">
                        Remember me
                    </label>
                </div>
            </div>

        </div>
        <div class="mb-3">
            <button class="btn btn-primary w-100 waves-effect waves-light" type="submit">Log In</button>
        </div>
    </form>
</div>
@endsection
