@extends('layouts.user-auth')

@section('title')
    {{ __('Verified') }}
@endsection

@section('content')
    <div class="auth-content my-auto">
        <div class="text-center">
            <div class="avatar-lg mx-auto">
                <div class="avatar-title rounded-circle bg-light">
                    <i class="bx bx-mail-send h2 mb-0 text-primary"></i>
                </div>
            </div>
            <div class="p-2 mt-4">
                <h4>Success !</h4>
                <p class="text-muted">Your Email has been verified successfully, proceed to update your profile.</p>
                <div class="mt-4">
                    <a href="{{ route('user.index') }}" class="btn btn-primary w-100">Back to Home</a>
                </div>
            </div>
        </div>
    </div>
@endsection
