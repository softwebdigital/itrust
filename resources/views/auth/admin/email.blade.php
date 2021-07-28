@extends('layouts.admin-auth')

@section('title')
    {{ __('Password Reset') }}
@endsection

@section('content')
<div class="auth-content my-auto">
    <div class="text-center">
        <h5 class="mb-0">Reset Your Password </h5>
        <p class="text-muted mt-2">A password reset link would be sent to your mail</p>
    </div>
    <form class="mt-4 pt-2" action="{{ route('admin.password.email') }}" method="post">
        @csrf
        <div class="mb-3">
            <label class="form-label" for="email">Email</label>
            <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="Enter email" value="{{ old('email') }}">
            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="mb-3">
            <button class="btn btn-primary w-100 waves-effect waves-light" type="submit">{{ __('Send Password Reset Link') }} </button>
        </div>
    </form>
</div>
@endsection
