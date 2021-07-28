@extends('layouts.admin-auth')

@section('title')
    {{ __('Password Reset') }}
@endsection

@section('content')

    <div class="auth-content my-auto">
        <div class="text-center">
            <h5 class="mb-0">Reset Your Password</h5>
        </div>
        <form class="mt-4 pt-2" method="post" action="{{ route('admin.password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <div class="mb-3">
                <label class="form-label" for="email">Email</label>
                <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="Enter email" value="{{ $email }}" readonly>
            </div>
            <div class="mb-3">
                <div class="d-flex align-items-start">
                    <div class="flex-grow-1">
                        <label class="form-label" for="password">Password</label>
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
            <div class="mb-3">
                <div class="d-flex align-items-start">
                    <div class="flex-grow-1">
                        <label class="form-label" for="password">Confirm Password</label>
                    </div>
                </div>

                <div class="input-group auth-pass-inputgroup">
                    <input type="password" class="form-control" name="password_confirmation" placeholder="Enter password" aria-label="Password-confirm" aria-describedby="password-confirm">
                    <button class="btn btn-light shadow-none ms-0" type="button" id="password-confirm"><i class="mdi mdi-eye-outline"></i></button>
                </div>
            </div>

            <div class="mb-3">
                <button class="btn btn-primary w-100 waves-effect waves-light" type="submit">{{ __('Reset Password') }}</button>
            </div>
        </form>
    </div>
@endsection
