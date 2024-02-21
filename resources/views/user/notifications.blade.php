@extends('layouts.user')

@section('head')
    {{ __('Notifications') }}
@endsection

@section('title')
    {{ __('Notifications') }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('user.index') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Notifications</li>
@endsection

@section('content')
    @if($type == 'all')
        @foreach($notifications as $key => $notis)
            <div class="col-md-8 mb-2">
                <div class="card-body border">
                    <div class="d-flex">
                        <div class="flex-shrink-0 me-3">
                            <img src="{{ asset($notis->data['image'] ?? 'assets/images/logo-sm.svg') }}" class="rounded-circle avatar-sm" alt="user-pic">
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="mb-1">{{ ucwords($notis->data['title']) }} <small><i class="mdi mdi-clock-outline"></i> {{ \Carbon\Carbon::make($notis->created_at)->diffForHumans() }}</small></h6>
                            <div class="mt-4">
    @php
        $user = \App\Models\User::find(auth()->id());
        $sym = \App\Models\Currency::where('id', $user->currency_id)->first();
        $symbol = $sym->symbol;

        // Replace any object array with the symbol
        $message = preg_replace('/\{[^{}]+\}/', $symbol, $notis->data['message']);
    @endphp
    <p class="mb-1">{!! $message !!}</p>
</div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <div class="d-flex">
            <div class="flex-shrink-0 me-3">
                <img src="{{ asset($notification->data['image'] ?? 'assets/images/logo-sm.svg') }}" class="rounded-circle avatar-sm" alt="user-pic">
            </div>
            <div class="flex-grow-1">
                <h6 class="mb-1">{{ ucwords($notification->data['title']) }} <small><i class="mdi mdi-clock-outline"></i> {{ \Carbon\Carbon::make($notification->created_at)->diffForHumans() }}</small></h6>
                <div class="mt-4">
                    <p class="mb-1">{!! $notification->data['message'] !!}</p>
                </div>
            </div>
        </div>
    @endif
@endsection
