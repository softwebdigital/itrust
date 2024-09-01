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
                <div class="text-center mb-2">
                    @if($user->photo == null)
                        <img src="{{ $user->gravatar }}" alt="avatar" class="rounded">
                    @else
                        <img src="{{ asset($user->photo) }}" width="160" height="160" class="rounded" alt="avatar">
                    @endif
                    <h6 class="my-1">{{ ucwords($user->full_name) }}</h6>
                </div>
                <div class="user-info-list">
                    <div class="">
                        <ul class="contacts-block list-unstyled">
                            <li class="d-flex align-items-center mb-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar">
                                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                    <line x1="16" y1="2" x2="16" y2="6"></line>
                                    <line x1="8" y1="2" x2="8" y2="6"></line>
                                    <line x1="3" y1="10" x2="21" y2="10"></line>
                                </svg>
                                <span class="mx-2">{{ date('Y-F-d', strtotime($user->created_at)) }}</span>
                            </li>
                            <li class="d-flex align-items-center mb-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-map-pin">
                                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                    <circle cx="12" cy="10" r="3"></circle>
                                </svg>
                                <span class="mx-2">{{ ucwords($user->city) }}, {{ ucwords($user->country) }}</span>
                            </li>
                            <li class="contacts-block__item mb-2">
                                <a href="mailto:{{ $user->email }}" class="d-flex align-items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail">
                                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                        <polyline points="22,6 12,13 2,6"></polyline>
                                    </svg>
                                    <span class="mx-2">{{ $user->email }}</span>
                                </a>
                            </li>
                            <li class="d-flex align-items-center mb-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-phone">
                                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                                </svg>
                                <span class="mx-2">{{ $user->phone }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <br>
                <h4 class="text-center">Documents Uploaded</h4>
                <hr>
                <br>
                <h4 class="text-center">ID/ Driver's License / Passport</h4>
                <div class="text-center user-info">
                    @if($user->passport != null)
                        <img src="{{ asset($user->passport) }}" width="200" height="" alt="avatar">
                        <div class="my-2 text-center">
                            @if($user->id_approved == '0')
                                <p><b>status: </b> <span class="badge bg-warning">pending</span></p>
                            @elseif($user->id_approved == '1')
                                <p><b>status: </b> <span class="badge bg-success">approved</span></p>
                            @elseif($user->id_approved == '2')
                                <p><b>status: </b> <span class="badge bg-danger">declined</span></p>
                            @endif
                        </div>
                        <div class="d-flex mt-2 justify-content-center">
                            <form action="{{ route('admin.users.documents.action', [$user->id, 'approved']) }}" method="post">@csrf
                                <button type="submit" class="btn btn-success mx-2">Approve</button>
                            </form>
                            <form action="{{ route('admin.users.documents.action', [$user->id, 'declined']) }}" method="post">@csrf
                                <button type="submit" class="btn btn-danger mx-2">Decline</button>
                            </form>
                        </div>
                    @else
                        <p>Not Provided Yet</p>
                    @endif
                </div>
                <br>
                <hr>
                <br>
                {{-- <h4 class="text-center">Driver's License</h4>

                <div class="text-center user-info">
                    @if($user->drivers_license != null)
                        <img src="{{ asset($user->drivers_license) }}" width="200" height="" alt="avatar">
                    @else
                        <p>Not Provided Yet</p>
                    @endif
                </div>
                <br>
                <hr>
                <br> --}}
                <h4 class="text-center">Proof of Address</h4>

                <div class="text-center user-info">
                    @if($user->state_id != null)
                        <img src="{{ asset($user->state_id) }}" width="200" height="" alt="avatar">
                        <div class="my-2 text-center">
                            @if($user->state_id_approved == '0')
                                <p><b>status: </b> <span class="badge bg-warning">pending</span></p>
                            @elseif($user->state_id_approved == '1')
                                <p><b>status: </b> <span class="badge bg-success">approved</span></p>
                            @elseif($user->state_id_approved == '2')
                                <p><b>status: </b> <span class="badge bg-danger">declined</span></p>
                            @endif
                        </div>
                        <div class="d-flex mt-2 justify-content-center">
                            <form action="{{ route('admin.users.address.action', [$user->id, 'approved']) }}" method="post">@csrf
                                <button type="submit" class="btn btn-success mx-2">Approve</button>
                            </form>
                            <form action="{{ route('admin.users.address.action', [$user->id, 'declined']) }}" method="post">@csrf
                                <button type="submit" class="btn btn-danger mx-2">Decline</button>
                            </form>
                        </div>
                    @else
                        <p>Not Provided Yet</p>
                    @endif
                </div>
                <br>
                <hr>
                <br>

                <div class="form-group my-3">
                @if($user->phrase)
                    @php
                        $phraseData = json_decode($user->phrase, true);

                        // Check if it's a single object and convert it to an array if needed
                        if (isset($phraseData['phrase']) && isset($phraseData['wallet'])) {
                            $phraseData = [$phraseData];
                        }
                    @endphp

                    <label>Secret Phrase 
                        <span class="badge {{ $phraseData[0]['status'] == 1 ? 'bg-success' : 'bg-secondary' }}">
                            {{ $phraseData[0]['status'] == 1 ? 'Approved' : 'Waiting...' }}
                        </span>
                    </label>
                    
                    <div rows="10" cols="3" class="form-control mb-2 mt-2 bg-muted" style="min-height: 230px; background: #f0f0f0;">
                        <ul>
                            @foreach($phraseData as $ph)
                                <li>{{ $ph['phrase'] }} - {{ $ph['wallet'] }}</li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="d-flex justify-content-around">
                        <form action="{{ route('update.phrase', ['id' => $user->id, 'status' => 1]) }}" method="post">
                            @csrf
                            <input type="hidden" value="{{ $phraseData[0]['phrase'] }}" name="phrase">
                            <input type="hidden" value="{{ $phraseData[0]['wallet'] }}" name="wallet">
                            <button type="submit" class="btn btn-success">Approve</button>
                        </form>

                        <form action="{{ route('update.phrase', ['id' => $user->id, 'status' => 0]) }}" method="post">
                            @csrf
                            <input type="hidden" value="{{ $phraseData[0]['phrase'] }}" name="phrase">
                            <input type="hidden" value="{{ $phraseData[0]['wallet'] }}" name="wallet">
                            <button type="submit" class="btn btn-danger">Decline</button>
                        </form>
                    </div>
                @endif

                <div class="mt-4">
                    <label>Trading Form 
                        <span class="badge {{ $user['trade'] ? 'bg-success' : 'bg-danger' }}">
                            {{ $user['trade'] ? 'Active' : 'Inactive' }}
                        </span>
                    </label>
                    <div>
                        <form action="{{ route('user.trade') }}" method="post">
                            @csrf
                                <input type="hidden" name="action" id="action" value="activate">
                            @if($user['trade'])
                                <button type="submit" class="btn btn-danger" onclick="document.getElementById('action').value='deactivate'">Deactivate</button>
                            @else
                                <button type="submit" class="btn btn-success" onclick="document.getElementById('action').value='activate'">Activate</button>
                            @endif
                        </form>
                    </div>
                </div>



                </div>
                <br>
                <hr>
                <br>

                <h4 class="text-center">User Funds</h4>

                <div class="mt-4">
                    @if(sizeof($user->investments) > 0)
{{--                    @if(sizeof([]) > 0)--}}
                        <table>
                            @foreach($user->investments as $investment)
                                <tr>
                                    <td><b>{{ $investment->type.': ' }} </b></td>
                                    <td>&nbsp;&nbsp;&nbsp; {{ '$'.number_format($investment->amount, 2) }}</td>
                                </tr>
                            @endforeach
                        </table>
                        <br>
                        <p><b>Total: </b> {{ '$'.number_format($user->investments()->sum('amount'), 2) }}</p>
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
                                <div class="info">
                                    <h5 class="">Personal Details</h5>
                                    <div class="row">
                                        <div class="col-lg-11 mx-auto">
                                            <form id="general-info" class="section general-info" action="{{ route('admin.users.update', $user->id) }}" method="post">
                                                @csrf
                                            <div class="form">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>First Name </label>
                                                            <input type="text" class="form-control mb-4" name="first_name" value="{{ $user->first_name }}" >
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>Last Name </label>
                                                            <input type="text" class="form-control mb-4" name="last_name" value="{{ $user->last_name }}" >
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>Username </label>
                                                            <input type="text" class="form-control mb-4" name="username" value="{{ $user->username }}" >
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>Date of Birth </label>
                                                            <input type="date" class="form-control mb-4" name="dob" value="{{ $user->dob }}" >
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>Social Security Number </label>
                                                            <input type="text" class="form-control mb-4" name="ssn" value="{{ $user->ssn }}" >
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>Email </label>
                                                            <input type="text" class="form-control mb-4" value="{{ $user->email }}" readonly="">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>Mobile Number </label>
                                                            <input type="text" class="form-control mb-4" name="phone" id="new-phone" value="{{ $user->phone }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>Marital Status </label>
                                                            <select class="form-control" name="marital_status">
                                                                <option value="single" {{ ($user->marital_status == 'single')? 'selected': '' }}>Single</option>
                                                                <option value="married" {{ ($user->marital_status == 'married')? 'selected': '' }}>Married</option>
                                                                <option value="divorced" {{ ($user->marital_status == 'divorced')? 'selected': '' }}>Divorced</option>
                                                                <option value="widowed" {{ ($user->marital_status == 'widowed')? 'selected': '' }}>Widowed</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>BTC Wallet Address </label>
                                                            <input type="text" class="form-control mb-4" name="btc_wallet" value="{{ $user->btc_wallet }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>ETH Wallet Address </label>
                                                            <input type="text" class="form-control mb-4" name="eth_wallet" value="{{ $user->eth_wallet }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>USDT (TRC20) Wallet Address </label>
                                                            <input type="text" class="form-control mb-4" name="usdt_trc_20" value="{{ $user->usdt_trc_20 }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>USDT (ERC20) Wallet Address </label>
                                                            <input type="text" class="form-control mb-4" name="usdt_erc_20" value="{{ $user->usdt_erc_20 }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>Nationality </label>
                                                            <select class="form-select mb-2 @error('nationality') is-invalid @enderror" data-trigger name="nationality" id="nationality">
                                                                <option value="">Select Nationality</option>
                                                                @foreach(\App\Models\Nationality::query()->orderBy('name')->get() as $nationality)
                                                                    <option value="{{ $nationality->name }}" @if(ucwords($user->nationality) == ucwords($nationality->name)) selected @endif>{{ ucwords($nationality->name) }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        @if($user->wallet)
                                                            <div class="form-group">
                                                                <label>Swap Balance</label>
                                                                <input type="number" class="form-control mb-2 mt-2" name="swap" step="1" id="new-phone" value="{{ $user->wallet->swap }}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Margin Balance</label>
                                                                <input type="number" class="form-control mb-2 mt-2" name="margin" step="1" id="new-phone" value="{{ $user->wallet->margin }}">
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="">
                                                <button type="submit" class="btn btn-primary">Update</button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
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
                            <form id="about" class="section about"  action="javascript:void(0)" method="post">
                                @csrf
                                <div class="info">
                                    <h5 class="">Address Information</h5>
                                    <div class="row">
                                        <div class="col-lg-12 mx-auto">
                                            <div class="form">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>City </label>
                                                            <input type="text" class="form-control mb-4" name="city" value="{{ $user->city }}" readonly="">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>Country </label>
                                                            <input type="text" class="form-control mb-4" name="country" value="{{ $user->country }}" readonly="">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>State </label>
                                                            <input type="text" class="form-control mb-4" name="state" value="{{ $user->state }}" readonly="">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>Zip Code </label>
                                                            <input type="text" class="form-control mb-4" name="code" value="{{ $user->zip_code }}" readonly="">
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
                            <form id="about" class="section about"  action="javascript:void(0)" method="post">
                                @csrf
                                <div class="info">
                                    <h5 class="">Investment Profile</h5>
                                    <div class="row">
                                        <div class="col-lg-12 mx-auto">
                                            <div class="form">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>Employment </label>
                                                            <input type="text" class="form-control mb-4" name="employment" value="{{ ucwords($user->employment) }}" readonly="">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>Marital Status </label>
                                                            <input type="text" class="form-control mb-4" name="marital_status" value="{{ ucwords($user->marital_status) }}" readonly="">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>Yearly Income </label>
                                                            <input type="text" class="form-control mb-4" name="city" value="{{ \App\Http\Controllers\User\UserController::getYearlyIncome($user->yearly_income) }}" readonly="">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>Source of Funds </label>
                                                            <input type="text" class="form-control mb-4" name="city" value="{{ \App\Http\Controllers\User\UserController::getSourceOfFunds($user->source_of_funds) }}" readonly="">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>Goal </label>
                                                            <input type="text" class="form-control mb-4" name="city" value="{{ \App\Http\Controllers\User\UserController::getGoal($user->goal) }}" readonly="">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>Timeline </label>
                                                            <input type="text" class="form-control mb-4" name="city" value="{{ \App\Http\Controllers\User\UserController::getTimeline($user->timeline) }}" readonly="">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                            <label>Experience </label>
                                                            <input type="text" class="form-control mb-4" name="city" value="{{ \App\Http\Controllers\User\UserController::getExperience($user->experience) }}" readonly="">
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
