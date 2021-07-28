{{--@extends('layouts.app')--}}

{{--@section('content')--}}
{{--<div class="container">--}}
{{--    <div class="row justify-content-center">--}}
{{--        <div class="col-md-8">--}}
{{--            <div class="card">--}}
{{--                <div class="card-header">{{ __('Verify Your Email Address') }}</div>--}}

{{--                <div class="card-body">--}}
{{--                    @if (session('resent'))--}}
{{--                        <div class="alert alert-success" role="alert">--}}
{{--                            {{ __('A fresh verification link has been sent to your email address.') }}--}}
{{--                        </div>--}}
{{--                    @endif--}}

{{--                    {{ __('Before proceeding, please check your email for a verification link.') }}--}}
{{--                    {{ __('If you did not receive the email') }},--}}
{{--                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">--}}
{{--                        @csrf--}}
{{--                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
{{--@endsection--}}

@extends('layouts.user-auth')

@section('title')
    {{ __('Verify') }}
@endsection

@section('content')
<div class="auth-content my-auto">
    <div class="text-center">
        <div class="avatar-lg mx-auto">
            <div class="avatar-title rounded-circle bg-light">
                <i class="bx bxs-envelope h2 mb-0 text-primary"></i>
            </div>
        </div>
        <div class="p-2 mt-4">
            <h4>Verify your email</h4>
            <p>We have sent you verification email <span class="fw-bold">{{ auth()->user()['email'] }}</span>, Please check it</p>
            <div class="mt-4">
                <p class="text-muted mb-0">Didn't receive an email?</p>
                <form action="{{ route('verification.resend') }}" method="post">@csrf
                    <button class="btn btn-primary w-10">Resend email</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
