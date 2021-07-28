{{--@extends('layouts.app')--}}

{{--@section('content')--}}
{{--<div class="container">--}}
{{--    <div class="row justify-content-center">--}}
{{--        <div class="col-md-8">--}}
{{--            <div class="card">--}}
{{--                <div class="card-header">{{ __('Confirm Password') }}</div>--}}

{{--                <div class="card-body">--}}
{{--                    {{ __('Please confirm your password before continuing.') }}--}}

{{--                    <form method="POST" action="{{ route('password.confirm') }}">--}}
{{--                        @csrf--}}

{{--                        <div class="form-group row">--}}
{{--                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">--}}

{{--                                @error('password')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row mb-0">--}}
{{--                            <div class="col-md-8 offset-md-4">--}}
{{--                                <button type="submit" class="btn btn-primary">--}}
{{--                                    {{ __('Confirm Password') }}--}}
{{--                                </button>--}}

{{--                                @if (Route::has('password.request'))--}}
{{--                                    <a class="btn btn-link" href="{{ route('password.request') }}">--}}
{{--                                        {{ __('Forgot Your Password?') }}--}}
{{--                                    </a>--}}
{{--                                @endif--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
{{--@endsection--}}

@extends('layouts.user-auth')

@section('title')
    {{ __('Lock Screen') }}
@endsection

@section('content')

    <div class="auth-content my-auto">
        <div class="text-center">
            <h5 class="mb-0">Lock screen</h5>
            <p class="text-muted mt-2">Enter your password to unlock the screen!</p>
        </div>
        <div class="user-thumb text-center mb-4 mt-4 pt-2">
            <img src="{{ asset('img/avatar.png') }}" class="rounded-circle img-thumbnail avatar-lg" alt="thumbnail">
            <h5 class="font-size-15 mt-3">{{ auth()->user()['username'] }}</h5>
        </div>
        <form class="mt-4" action="{{ route('password.confirm') }}" method="post">
            @csrf
            <div class="mb-3">
                <label class="form-label" for="password">Password</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" placeholder="Enter password">
                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="mb-3 mt-4">
                <button class="btn btn-primary w-100 waves-effect waves-light" type="submit">Unlock</button>
            </div>
        </form>

        <div class="mt-5 text-center">
            <p class="text-muted mb-0">Not you ? return <a href="{{ route('user.signIn') }}" class="text-primary fw-semibold"> Sign In </a> </p>
        </div>
    </div>
@endsection
