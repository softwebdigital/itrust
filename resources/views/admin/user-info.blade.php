@extends('layouts.admin')

@section('head')
    {{ 'User' }}
@endsection

@section('title')
    {{ $user->username }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.users') }}">Users</a></li>
    <li class="breadcrumb-item active">Details</li>
@endsection

@section('content')
<div class="row">
    <div class="col-xl-4 col-lg-6 col-md-5 col-sm-12 layout-top-spacing">
        <div class="card">
            <div class="card-body">
                <div class="text-center user-info">
                    @if($user->id_card == null)
                        <img src="{{ $user->gravatar }}" alt="avatar">
                    @else
                        <img src="{{ asset($user->id_card) }}" width="160" height="160" alt="avatar">
                    @endif
                    <p class="">{{ ucwords($user->firstname." ".$user->surname) }}</p>
                </div>
                <div class="user-info-list">
                    <div class="">
                        <ul class="contacts-block list-unstyled">
                            <li class="contacts-block__item">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar">
                                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                    <line x1="16" y1="2" x2="16" y2="6"></line>
                                    <line x1="8" y1="2" x2="8" y2="6"></line>
                                    <line x1="3" y1="10" x2="21" y2="10"></line>
                                </svg>
                                {{ date('Y-F-d', strtotime($user->created_at)) }}
                            </li>
                            <li class="contacts-block__item">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-map-pin">
                                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                    <circle cx="12" cy="10" r="3"></circle>
                                </svg>
                                {{ ucwords($user->city) }}, {{ ucwords($user->country) }}
                            </li>
                            <li class="contacts-block__item">
                                <a href="mailto:{{ $user->email }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail">
                                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                        <polyline points="22,6 12,13 2,6"></polyline>
                                    </svg>
                                    {{ $user->email }}
                                </a>
                            </li>
                            <li class="contacts-block__item">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-phone">
                                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                                </svg>
                                {{ $user->phone }}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <br>
                <h4 class="text-center">KYC/ Identity</h4>
                <br>
                <h4 class="text-center">Id Card</h4>
                <div class="text-center user-info">
                    @if($user->id_card != null)
                        <img src="{{ asset($user->id_card) }}" width="160" height="160" alt="avatar">
                    @else
                        <p>Not Provided Yet</p>
                    @endif
                </div>
                <br>
                <hr>
                <br>
                <h4 class="text-center">Proof of Residence</h4>

                <div class="text-center user-info">
                    @if($user->residence_image != null)
                        <img src="{{ asset($user->residence_image) }}" width="160" height="160" alt="avatar">
                    @else
                        <p>Not Provided Yet</p>
                    @endif
                </div>
                <br>
                <hr>
                <br>
                <h4 class="text-center">User Funds</h4>

                <div class="mt-4">
                    {{--                @if(sizeof($investments) > 0)--}}
                    @if(sizeof([]) > 0)
                        <table>
                            @foreach($investments as $investment)
                                <tr>
                                    <td><b>{{ $investment->plan.': ' }} </b></td>
                                    <td>&nbsp;&nbsp;&nbsp; {{ '$'.number_format($investment->amount, 2) }}</td>
                                </tr>
                            @endforeach
                        </table>
                        <br>
                        <p><b>Total: </b> {{ '$'.number_format(20000, 2) }}</p>
                    @else
                        <div class="text-center user-info">
                            <p>Account Not Funded Yet</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-8 col-lg-6 col-md-7 col-sm-12 layout-top-spacing">
        <div class="card">
            <div class="card-body">
                <div class="scrollspy-example" data-spy="scroll" data-target="#account-settings-scroll" data-offset="-100">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                            <form id="general-info" class="section general-info" action="{{ route('user.profile.update') }}" method="post">
                                @csrf
                                <div class="info">
                                    <h5 class="">Personal Details</h5>
                                    <div class="row">
                                        <div class="col-lg-11 mx-auto">
                                            <div class="row">
                                                <div class="col-xl-10 col-lg-12 col-md-8 mt-md-0 mt-4">
                                                    <div class="form">
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label>First Name <span class="text-danger">*</span></label>
                                                                    <input type="text" class="form-control mb-4" name="firstname" value="{{ $user->first_name }}" readonly="">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label>Last Name <span class="text-danger">*</span></label>
                                                                    <input type="text" class="form-control mb-4" name="lastname" value="{{ $user->last_name }}" readonly="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label>Username <span class="text-danger">*</span></label>
                                                                    <input type="text" class="form-control mb-4" name="username" value="{{ $user->username }}" readonly="">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label>Date of Birth <span class="text-danger">*</span></label>
                                                                    <input type="date" class="form-control mb-4" name="dob" value="{{ $user->dob }}" readonly="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label>Social Security Number <span class="text-danger">*</span></label>
                                                                    <input type="text" class="form-control mb-4" name="id_number" value="{{ $user->ssn }}" readonly="">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label>Email <span class="text-danger">*</span></label>
                                                                    <input type="text" class="form-control mb-4" name="email" value="{{ $user->email }}" readonly="">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label>Mobile Number <span class="text-danger">*</span></label>
                                                                    <input type="text" class="form-control mb-4" name="phone" value="+1 {{$user->phone }}" readonly="">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label>Marital Status <span class="text-danger">*</span></label>
                                                                    <select class="form-control" name="marital_status" disabled="">
                                                                        <option value="single" {{ ($user->marital_status == 'single')? 'selected': '' }}>Single</option>
                                                                        <option value="married" {{ ($user->marital_status == 'married')? 'selected': '' }}>Married</option>
                                                                        <option value="divorced" {{ ($user->marital_status == 'divorced')? 'selected': '' }}>Divorced</option>
                                                                        <option value="widowed" {{ ($user->marital_status == 'widowed')? 'selected': '' }}>Widowed</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                    <label>Citizenship <span class="text-danger">*</span></label>
                                                                    <input type="text" class="form-control mb-4" name="nationality" value="{{ $user->nationality }}" readonly="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mt-4">
            <div class="card-body">
                <div class="">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                            <form id="about" class="section about"  action="{{ route('user.profile.update') }}" method="post">
                                @csrf
                                <div class="info">
                                    <h5 class="">Address Information</h5>
                                    <div class="row">
                                        <div class="col-lg-11 mx-auto">
                                            <div class="row">
                                                <div class="col-xl-10 col-lg-12 col-md-8 mt-md-0 mt-4">
                                                    <div class="form">
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label>City <span class="text-danger">*</span></label>
                                                                    <input type="text" class="form-control mb-4" name="city" value="{{ $user->city }}" readonly="">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label>Country <span class="text-danger">*</span></label>
                                                                    <input type="text" class="form-control mb-4" name="country" value="{{ $user->country }}" readonly="">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label>State <span class="text-danger">*</span></label>
                                                                    <input type="text" class="form-control mb-4" name="state" value="{{ $user->state }}" readonly="">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label>Zip Code <span class="text-danger">*</span></label>
                                                                    <input type="text" class="form-control mb-4" name="code" value="{{ $user->zip_code }}" readonly="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
