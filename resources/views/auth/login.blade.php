@extends('layouts.user-auth')

@section('title')
    {{ __('Login') }}
@endsection

@section('content')

    <div class="auth-content my-auto">
        <div class="text-center">
            <h5 class="mb-0">Welcome Back !</h5>
            <p class="text-muted mt-2">Sign in to continue to {{ env('APP_NAME') }}.</p>
        </div>
        <form class="mt-4 pt-2" autocomplete="off" action="{{ isset($alt) ? route('altLogin') : route('login') }}" method="post">
            <input autocomplete="off" name="email" type="text" style="display:none;">
            @csrf
            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" autocomplete="false" class="form-control @error('username') is-invalid @enderror" name="username" placeholder="Enter username" value="{{ $user ?? old('username') }}">
                @error('username')
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
                    @if(!isset($alt))
                        <div class="flex-shrink-0">
                            <div class="">
                                <a href="{{ route('password.request') }}" class="text-muted">Forgot password?</a>
                            </div>
                        </div>
                    @endif
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
            @if(!isset($alt))
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
            @endif
            <div class="mb-3">
                <button class="btn btn-primary w-100 waves-effect waves-light" type="submit">Log In</button>
            </div>
        </form>
        @if(!isset($alt))
            <div class="mt-5 text-center">
                <p class="text-muted mb-0">Don't have an account ? <a href="{{ route('register') }}" class="text-primary fw-semibold"> Signup </a> </p>
            </div>
        @endif
    </div>
@endsection
