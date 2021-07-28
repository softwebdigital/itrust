@extends('layouts.user')

@section('head')
    {{ __('Profile') }}
@endsection

@section('title')
    {{ __('Profile') }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('user.index') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Profile</li>
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/libs/twitter-bootstrap-wizard/prettify.css') }}">
    <link href="{{ asset('assets/libs/choices.js/public/assets/styles/choices.min.css') }}" rel="stylesheet" type="text/css" />
    <style>
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        input[type=number]{
            -moz-appearance: textfield;
        }
        .choices { margin-bottom: 0 !important; }
    </style>
@endsection

@section('content')
<div class="row">
    <div class="col-xl-8 col-md-8">
        <div class="card card-h-100">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Personal Information</h4>
            </div>
            <div class="card-body">
{{--                <form method="post" action="{{ route('user.profile.update') }}">--}}
{{--                    @csrf--}}
{{--                    <div class="mb-3">--}}
{{--                        <label class="form-label" for="name"> Full Name</label>--}}
{{--                        <input type="text" id="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') ?? $user->name }}">--}}
{{--                        @error('name')--}}
{{--                        <span class="invalid-feedback" role="alert">--}}
{{--                            <strong>{{ $message }}</strong>--}}
{{--                        </span>--}}
{{--                        @enderror--}}
{{--                    </div>--}}
{{--                    <div class="row">--}}
{{--                        <div class="col-md-6">--}}
{{--                            <div class="mb-3">--}}
{{--                                <label class="form-label" for="email"> Email</label>--}}
{{--                                <input type="text" id="email" class="form-control" name="email" readonly value="{{ $user->email }}">--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-md-6">--}}
{{--                            <div class="mb-3">--}}
{{--                                <label class="form-label" for="username"> Username</label>--}}
{{--                                <input type="text" id="username" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') ?? $user->username }}">--}}
{{--                                @error('username')--}}
{{--                                <span class="invalid-feedback" role="alert">--}}
{{--                                    <strong>{{ $message }}</strong>--}}
{{--                                </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="mb-3">--}}
{{--                        <label class="form-label" for="photo"> Photo</label>--}}
{{--                        <input type="file" id="photo" class="form-control @error('photo') is-invalid @enderror" name="photo">--}}
{{--                        @error('photo')--}}
{{--                        <span class="invalid-feedback" role="alert">--}}
{{--                            <strong>{{ $message }}</strong>--}}
{{--                        </span>--}}
{{--                        @enderror--}}
{{--                    </div>--}}
{{--                    <div class="mt-4">--}}
{{--                        <button type="submit" class="btn btn-primary w-md">Update</button>--}}
{{--                    </div>--}}
{{--                </form>--}}

                <div id="progrss-wizard" class="twitter-bs-wizard">
                    <ul class="twitter-bs-wizard-nav nav nav-pills nav-justified">
                        <li class="nav-item">
                            <a href="#progress-seller-details" class="nav-link" data-toggle="tab">
                                <div class="step-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Seller Details">
                                    <i class="bx bx-list-ul"></i>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#progress-company-document" class="nav-link" data-toggle="tab">
                                <div class="step-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Company Document">
                                    <i class="bx bx-book-bookmark"></i>
                                </div>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="#progress-bank-detail" class="nav-link" data-toggle="tab">
                                <div class="step-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Bank Details">
                                    <i class="bx bxs-bank"></i>
                                </div>
                            </a>
                        </li>
                    </ul>
                    <!-- wizard-nav -->

                    <div id="bar" class="progress mt-4 d-none">
                        <div class="progress-bar bg-success progress-bar-striped progress-bar-animated"></div>
                    </div>
                    <div class="tab-content twitter-bs-wizard-tab-content">
                        <div class="tab-pane" id="progress-seller-details">
                            <div class="text-center mb-4">
                                <h5>Seller Details</h5>
                                <p class="card-title-desc">Fill all information below</p>
                            </div>
                            <form>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="progresspill-firstname-input">First name</label>
                                            <input type="text" class="form-control" id="progresspill-firstname-input">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="progresspill-lastname-input">Last name</label>
                                            <input type="text" class="form-control" id="progresspill-lastname-input">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="progresspill-phoneno-input">Phone</label>
                                            <input type="text" class="form-control" id="progresspill-phoneno-input">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="progresspill-email-input">Email</label>
                                            <input type="email" class="form-control" id="progresspill-email-input">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label for="progresspill-address-input">Address</label>
                                            <textarea id="progresspill-address-input" class="form-control" rows="2"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <ul class="pager wizard twitter-bs-wizard-pager-link">
                                <li class="next"><a href="javascript: void(0);" class="btn btn-primary" onclick="nextTab()">Next <i class="bx bx-chevron-right ms-1"></i></a></li>
                            </ul>
                        </div>
                        <div class="tab-pane" id="progress-company-document">
                            <div>
                                <div class="text-center mb-4">
                                    <h5>Company Document</h5>
                                    <p class="card-title-desc">Fill all information below</p>
                                </div>
                                <form>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="progresspill-pancard-input" class="form-label">PAN Card</label>
                                                <input type="text" class="form-control" id="progresspill-pancard-input">
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="progresspill-vatno-input" class="form-label">VAT/TIN No.</label>
                                                <input type="text" class="form-control" id="progresspill-vatno-input">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="progresspill-cstno-input" class="form-label">CST No.</label>
                                                <input type="text" class="form-control" id="progresspill-cstno-input">
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="progresspill-servicetax-input" class="form-label">Service Tax No.</label>
                                                <input type="text" class="form-control" id="progresspill-servicetax-input">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="progresspill-companyuin-input" class="form-label">Company UIN</label>
                                                <input type="text" class="form-control" id="progresspill-companyuin-input">
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="progresspill-declaration-input" class="form-label">Declaration</label>
                                                <input type="text" class="form-control" id="progresspill-declaration-input">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <ul class="pager wizard twitter-bs-wizard-pager-link">
                                    <li class="previous"><a href="javascript: void(0);" class="btn btn-primary" onclick="nextTab()"><i class="bx bx-chevron-left me-1"></i> Previous</a></li>
                                    <li class="next"><a href="javascript: void(0);" class="btn btn-primary" onclick="nextTab()">Next <i class="bx bx-chevron-right ms-1"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="tab-pane" id="progress-bank-detail">
                            <div>
                                <div class="text-center mb-4">
                                    <h5>Bank Details</h5>
                                    <p class="card-title-desc">Fill all information below</p>
                                </div>
                                <form>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="bank">Bank Name</label>
                                                <select class="form-select" data-trigger id="bank" onchange="verifyAccount();">
                                                    @if(count($banks) > 0)
                                                        <option selected>Select Bank</option>
                                                        @foreach($banks as $bank)
                                                            <option value="{{ $bank['name'] }}">{{ ucwords($bank['name']) }}</option>
                                                        @endforeach
                                                    @else
                                                    @endif
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="account-number" class="form-label">Account Number</label>
                                                <input type="text" class="form-control" id="account-number"
                                                       onkeyup="const val = $(this).val(); if (val.length === 10) verifyAccount(); else if (val.length > 10) $(this).val(val.substr(0, 10));"
                                                >
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <div class="d-flex justify-content-between">
                                                    <label for="account-name" class="form-label">Account Name</label>
                                                    <div>
                                                        <small class="text-primary d-none" id="verifying">Verifying account number...</small>
                                                        <small class="text-success @if($user->account_name) '' @else d-none @endif" id="verified-success">Account number verified</small>
                                                        <small class="text-danger d-none" id="verified-failed">Invalid account number</small>
                                                    </div>
                                                </div>
                                                <input type="text" class="form-control" readonly id="account-name">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <ul class="pager wizard twitter-bs-wizard-pager-link">
                                    <li class="previous"><a href="javascript: void(0);" class="btn btn-primary" onclick="nextTab()"><i class="bx bx-chevron-left me-1"></i> Previous</a></li>
                                    <li class="float-end"><a href="javascript: void(0);" class="btn btn-primary" data-bs-toggle="modal" data-bs-target=".confirmModal">Save Changes</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-md-4">
        <div class="card card-h-100">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Password Update</h4>
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('user.password.update') }}">
                    @csrf
                    <div class="mb-3">
                        <div class="d-flex align-items-start">
                            <div class="flex-grow-1">
                                <label class="form-label" for="old-password">Old Password</label>
                            </div>
                        </div>
                        <div class="input-group">
                            <input type="password" id="old-password" autocomplete="current-password" class="form-control @error('old_password') is-invalid @enderror" name="old_password" placeholder="">
                            <button class="btn btn-light shadow-none ms-0" type="button" id="old-password-btn"><i class="mdi mdi-eye-outline"></i></button>
                            @error('old_password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex align-items-start">
                            <div class="flex-grow-1">
                                <label class="form-label" for="new-password">New Password</label>
                            </div>
                        </div>
                        <div class="input-group">
                            <input type="password" id="new-password" autocomplete="new-password" class="form-control @error('new_password') is-invalid @enderror" name="new_password" placeholder="">
                            <button class="btn btn-light shadow-none ms-0" type="button" id="new-password-btn"><i class="mdi mdi-eye-outline"></i></button>
                            @error('new_password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex align-items-start">
                            <div class="flex-grow-1">
                                <label class="form-label" for="confirm-password">Confirm Password</label>
                            </div>
                        </div>

                        <div class="input-group">
                            <input type="password" class="form-control" autocomplete="new-password" id="confirm-password" name="new_password_confirmation" placeholder="">
                            <button class="btn btn-light shadow-none ms-0" type="button" id="confirm-password-btn"><i class="mdi mdi-eye-outline"></i></button>
                        </div>
                    </div>
                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary w-md">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade confirmModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <div class="mb-3">
                        <i class="bx bx-check-circle display-4 text-success"></i>
                    </div>
                    <h5>Confirm Save Changes</h5>
                </div>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-light w-md" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary w-md" data-bs-dismiss="modal"
                        onclick="nextTab()">Save changes</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script src="{{ asset('assets/libs/twitter-bootstrap-wizard/jquery.bootstrap.wizard.min.js') }}"></script>
    <script src="{{ asset('assets/libs/twitter-bootstrap-wizard/prettify.js') }}"></script>
    <script src="{{ asset('assets/libs/choices.js/public/assets/scripts/choices.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/form-wizard.init.js') }}"></script>
    <script>
        $("#old-password-btn").on("click",function(){0<$(this).siblings("input").length&&("password"==$(this).siblings("input").attr("type")?$(this).siblings("input").attr("type","input"):$(this).siblings("input").attr("type","password"))});
        $("#new-password-btn").on("click",function(){0<$(this).siblings("input").length&&("password"==$(this).siblings("input").attr("type")?$(this).siblings("input").attr("type","input"):$(this).siblings("input").attr("type","password"))});
        $("#confirm-password-btn").on("click",function(){0<$(this).siblings("input").length&&("password"==$(this).siblings("input").attr("type")?$(this).siblings("input").attr("type","input"):$(this).siblings("input").attr("type","password"))});

        let e = document.querySelectorAll("[data-trigger]");
        for (let i = 0; i < e.length; ++i) {
            let a = e[i];
            new Choices(a, {
                placeholderValue: "",
                searchPlaceholderValue: "Search..."
            })
        }

        function verifyAccount() {
            const bank = $('#bank')
            const name = $('#account-name')
            const number = $('#account-number')

            if (bank.val() !== "Select Bank" && number.val().length === 10) {
                const banks = {!! json_encode($banks) !!}
                const code = banks.find(cur => cur.name === bank.val()).code
                $.ajax({
                    url: `https://api.paystack.co/bank/resolve?account_number=${number.val()}&bank_code=${code}`,
                    type: 'GET',
                    dataType: 'json',
                    beforeSend: function(request) {
                        request.setRequestHeader("Authorization", "Bearer {{ env('PAYSTACK_SECRET_KEY') }}");
                        $('#verifying').removeClass('d-none')
                        $('#verified-success').addClass('d-none')
                        $('#verified-failed').addClass('d-none')
                        number.attr('readonly', true)
                    },
                    success: function (res) {
                        number.attr('readonly', false)
                        $('#verifying').addClass('d-none')
                        if (res['status']) {
                            name.val(res['data']['account_name'])
                            $('#verified-success').removeClass('d-none')
                        }
                    },
                    error: function (res) {
                        number.attr('readonly', false)
                        $('#verifying').addClass('d-none')
                        if (res.status === 422) $('#verified-failed').removeClass('d-none');
                        else $('#verified-failed').html(res['responseJSON']['message']).addClass('d-none')
                    }
                })
            } else {
                //
            }
        }
    </script>
@endsection
