@extends('layouts.user-auth')

@section('title')
    {{ __('Register') }}
@endsection

@section('content')
    <div class="auth-content my-auto">
        <div class="text-center">
            <h5 class="mb-0">Register Account</h5>
            <p class="text-muted mt-2">Get your free {{ env('APP_NAME') }} account now.</p>
        </div>
        <div class="card">
            <div class="card-body">
                <form action="/register" id="registration-form" method="post">@csrf
                <div id="progrss-wizard" class="twitter-bs-wizard">
                    <ul class="twitter-bs-wizard-nav nav nav-pills nav-justified">
                        <li class="nav-item">
                            <a href="#progress-seller-details" class="nav-link" data-toggle="tab">
                                <div class="step-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Details">
                                    <i class="bx bx-list-ul"></i>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#progress-company-document" class="nav-link" data-toggle="tab">
                                <div class="step-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Contact Information">
                                    <i class="bx bx-book-bookmark"></i>
                                </div>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="#progress-bank-detail" class="nav-link" data-toggle="tab">
                                <div class="step-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Verify your Identity">
                                    <i class="bx bxs-id-card"></i>
                                </div>
                            </a>
                        </li>
                    </ul>
                    <!-- wizard-nav -->

                    <div id="bar" class="progress d-none mt-4">
                        <div class="progress-bar bg-success progress-bar-striped progress-bar-animated"></div>
                    </div>
                    <div class="tab-content twitter-bs-wizard-tab-content">
                        <div class="tab-pane" id="progress-seller-details">
                            <div class="text-center mb-4">
                                <h5>Details</h5>
                                <p class="card-title-desc">Fill all information below</p>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="first_name" class="form-label">First Name <strong class="text-danger">*</strong></label>
                                        <input type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" id="first_name" placeholder="Enter first name" value="{{ old('first_name') }}">
                                        @error('first_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="last_name" class="form-label">Last Name <strong class="text-danger">*</strong></label>
                                        <input type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" id="last_name" placeholder="Enter last name" value="{{ old('last_name') }}">
                                        @error('last_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="username" class="form-label">Username <strong class="text-danger">*</strong></label>
                                        <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" id="username" placeholder="Enter username" value="{{ old('username') }}">
                                        @error('username')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email <strong class="text-danger">*</strong></label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="Enter email" value="{{ old('email') }}">
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <div class="d-flex align-items-start">
                                            <div class="flex-grow-1">
                                                <label class="form-label" for="password">Password <strong class="text-danger">*</strong></label>
                                            </div>
                                        </div>
                                        <div class="input-group">
                                            <input type="password" id="password" autocomplete="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Enter password">
                                            <button class="btn btn-light shadow-none ms-0" type="button" id="password-btn"><i class="mdi mdi-eye-outline"></i></button>
                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <div class="d-flex align-items-start">
                                            <div class="flex-grow-1">
                                                <label class="form-label" for="confirm-password">Confirm Password <strong class="text-danger">*</strong></label>
                                            </div>
                                        </div>

                                        <div class="input-group">
                                            <input type="password" class="form-control" autocomplete="password" id="confirm-password" name="password_confirmation" placeholder="Confirm Password">
                                            <button class="btn btn-light shadow-none ms-0" type="button" id="confirm-password-btn"><i class="mdi mdi-eye-outline"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <ul class="pager wizard twitter-bs-wizard-pager-link">
                                <li class="next"><a href="javascript: void(0);" class="btn btn-primary" onclick="nextTab()">Next <i
                                            class="bx bx-chevron-right ms-1"></i></a></li>
                            </ul>
                        </div>
                        <div class="tab-pane" id="progress-company-document">
                            <div>
                                <div class="text-center mb-4">
                                    <h5>Contact Information</h5>
                                    <p class="card-title-desc">Please provide your contact information.</p>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <label for="phone" class="form-label">Phone <strong class="text-danger">*</strong></label><br>
                                            <input type="number" class="form-control @error('phone') is-invalid @enderror" name="phone" id="phone" placeholder="Enter phone" value="{{ old('phone') }}">
                                            @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="address">Residential Address <strong class="text-danger">*</strong></label>
                                            <textarea id="address" class="form-control @error('address') is-invalid @enderror" name="address" rows="2">{{ old('address') }}</textarea>
                                            @error('address')
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="country">Country <strong class="text-danger">*</strong></label>
                                            <select class="form-select @error('country') is-invalid @enderror" data-trigger name="country" id="country">
                                                <option selected value="">Select Country</option>
                                                @foreach(\App\Models\Country::query()->orderBy('name')->get() as $country)
                                                    <option value="{{ $country->name }}" @if(old('country') == $country->name) selected @endif>{{ ucwords($country->name) }}</option>
                                                @endforeach
                                            </select>
                                            @error('country')
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    {{-- <div class="form-group">
                                        <label for="title">Select state:</label>
                                        <select name="state" class="form-control">
                                        </select>
                                    </div> --}}
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="state">State/Province  <strong class="text-danger">*</strong></label>
                                            <select class="form-select @error('state') is-invalid @enderror" name="state" id="state">
                                                {{-- <option selected value="">Select State</option> --}}
                                                {{-- @foreach(\App\Models\State::query()->orderBy('name')->get() as $state)
                                                    <option value="{{ $state->name }}" @if(old('state') == $state->name) selected @endif>{{ ucwords($state->name) }}</option>
                                                @endforeach --}}
                                            </select>
                                            @error('state')
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="city">City  <strong class="text-danger">*</strong></label>
                                            <input type="text" class="form-control @error('city') is-invalid @enderror" name="city" id="city" value="{{ old('city') }}">
                                            @error('city')
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="zip_code">Zip Code</label>
                                            <input type="text" name="zip_code" class="form-control" id="zip_code" value="{{ old('zip_code') }}">
                                        </div>
                                    </div>
                                </div>
                                <ul class="pager wizard twitter-bs-wizard-pager-link">
                                    <li class="previous"><a href="javascript: void(0);" class="btn btn-primary" onclick="nextTab()"><i
                                                class="bx bx-chevron-left me-1"></i> Previous</a></li>
                                    <li class="next"><a href="javascript: void(0);" class="btn btn-primary" onclick="nextTab()">Next <i
                                                class="bx bx-chevron-right ms-1"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="tab-pane" id="progress-bank-detail">
                            <div>
                                <div class="text-center mb-4">
                                    <h5>Verify Your Identity</h5>
                                    <p class="card-title-desc">Please verify your identity below</p>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="ssn" class="form-label">Social Security Number / Identity Number  <strong class="text-danger">*</strong></label>
                                            <input type="text" class="form-control @error('ssn') is-invalid @enderror" id="ssn" name="ssn" value="{{ old('ssn') }}">
                                            @error('ssn')
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="dob" class="form-label">Date of Birth  <strong class="text-danger">*</strong></label>
                                            <input type="date" class="form-control @error('dob') is-invalid @enderror" id="dob" name="dob" value="{{ old('dob') ? date('Y-m-d', strtotime(old('dob'))) : '' }}">
                                            @error('dob')
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="nationality" class="form-label">Nationality <strong class="text-danger">*</strong></label>
                                            <select class="form-select @error('nationality') is-invalid @enderror" data-trigger name="nationality" id="nationality">
                                                <option value="">Select Nationality</option>
                                                @foreach(\App\Models\Nationality::query()->orderBy('name')->get() as $nationality)
                                                    <option value="{{ $nationality->name }}" @if(old('nationality') == $nationality->name) selected @endif>{{ ucwords($nationality->name) }}</option>
                                                @endforeach
                                            </select>
                                            @error('nationality')
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <h6>Further Questions</h6>
                                    <hr>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label" for="q1">How much investment experience do you have? </label>
                                            <select class="form-select @error('experience') is-invalid @enderror" name="experience" id="q1">
                                                <option selected value="">Select an Answer</option>
                                                <option value="none" @if(old('experience') == 'none') selected @endif>None</option>
                                                <option value="beginner" @if(old('experience') == 'beginner') selected @endif>Not much</option>
                                                <option value="amateur" @if(old('experience') == 'amateur') selected @endif>I know what I'm doing</option>
                                                <option value="expert" @if(old('experience') == 'expert') selected @endif>I'm an expert</option>
                                            </select>
                                            @error('experience')
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label" for="q2">Are you employed?</label>
                                            <select class="form-select @error('employment') is-invalid @enderror" name="employment" id="q2">
                                                <option selected value="">Select an Answer</option>
                                                <option value="employed" @if(old('employment') == 'employed') selected @endif>I'm employed</option>
                                                <option value="unemployed" @if(old('employment') == 'unemployed') selected @endif>I'm unemployed</option>
                                                <option value="retired" @if(old('employment') == 'retired') selected @endif>I'm retired</option>
                                                <option value="student" @if(old('employment') == 'student') selected @endif>I'm a student</option>
                                            </select>
                                            @error('employment')
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">Do you or a family member work for another brokerage?</label>
                                            <div class="d-flex">
                                                <div class="my-auto">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="related" id="formRadio" value="yes" {{ old('related') == 'yes' ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="formRadio">Yes</label>
                                                    </div>
                                                </div>
                                                &nbsp;&nbsp;&nbsp;&nbsp;
                                                <div class="my-auto">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="related" id="formRadio" value="no" {{ old('related') ? old('related') == 'no' ? 'checked' : '' : 'checked' }}>
                                                        <label class="form-check-label" for="formRadio">No</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-check mt-2 mb-3">
                                    <input class="form-check-input" type="checkbox" id="tc" name="tc" {{ old('tc') ? 'checked' : '' }} required>
                                    <label class="form-check-label" for="tc">
                                        I have read & accept <a href="#">Terms & conditions.</a>
                                    </label>
                                </div>
                                <ul class="pager wizard twitter-bs-wizard-pager-link">
                                    <li class="previous"><a href="javascript: void(0);" class="btn btn-primary" onclick="nextTab()"><i class="bx bx-chevron-left me-1"></i> Previous</a></li>
                                    <li class="float-end">
                                        {{-- <a href="javascript: void(0);" class="btn btn-primary">Submit</a> --}}
                                        <input type="submit" id="submit-btn" class="btn btn-primary">
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                    <input type="submit" id="submit-btn" class="d-none">
                </form>
            </div>
            <!-- end card body -->
            {{-- <div class="modal fade confirmModal" tabindex="-1" aria-hidden="true">
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
                                <h5>Proceed to submit?</h5>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-center">
                            <button type="button" class="btn btn-light w-md" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary w-md" data-bs-dismiss="modal"
                                    onclick="$('#registration-form').attr('action', '/register'); $('#submit-btn').click()">Yes, Submit!</button>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>

{{--        <div class="mt-4 pt-2 text-center">--}}
{{--            <div class="signin-other-title">--}}
{{--                <h5 class="font-size-14 mb-3 text-muted fw-medium">- Sign up using -</h5>--}}
{{--            </div>--}}

{{--            <ul class="list-inline mb-0">--}}
{{--                <li class="list-inline-item">--}}
{{--                    <a href="javascript:void(0)"--}}
{{--                       class="social-list-item bg-primary text-white border-primary">--}}
{{--                        <i class="mdi mdi-facebook"></i>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                <li class="list-inline-item">--}}
{{--                    <a href="javascript:void(0)"--}}
{{--                       class="social-list-item bg-info text-white border-info">--}}
{{--                        <i class="mdi mdi-twitter"></i>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                <li class="list-inline-item">--}}
{{--                    <a href="javascript:void(0)"--}}
{{--                       class="social-list-item bg-danger text-white border-danger">--}}
{{--                        <i class="mdi mdi-google"></i>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--            </ul>--}}
{{--        </div>--}}

        <div class="mt-5 text-center">
            <p class="text-muted mb-0">Already have an account ? <a href="{{ route('login') }}" class="text-primary fw-semibold"> Login </a> </p>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('assets/libs/twitter-bootstrap-wizard/jquery.bootstrap.wizard.min.js') }}"></script>
    <script src="{{ asset('assets/libs/twitter-bootstrap-wizard/prettify.js') }}"></script>
    <script src="{{ asset('assets/js/pages/form-wizard.init.js') }}"></script>
    <script src="{{ asset('assets/libs/choices.js/public/assets/scripts/choices.min.js') }}"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let e = document.querySelectorAll("[data-trigger]");
            for (let i = 0; i < e.length; ++i) {
                let a = e[i];
                new Choices(a, {
                    placeholderValue: "",
                    searchPlaceholderValue: "Search..."
                })
            }
        })
        $(document).ready(function () {
            const err = $('.is-invalid')
            err.each(i => {
                $(err[i]).on('keyup change input', () => {
                    if ($(err[i]).val() !== '') {
                        $(err[i]).removeClass('is-invalid')
                    } else {
                        $(err[i]).addClass('is-invalid')
                    }
                })
            })
            $("#password-btn").on("click",function(){0<$(this).siblings("input").length&&("password"==$(this).siblings("input").attr("type")?$(this).siblings("input").attr("type","input"):$(this).siblings("input").attr("type","password"))});
            $("#confirm-password-btn").on("click",function(){0<$(this).siblings("input").length&&("password"==$(this).siblings("input").attr("type")?$(this).siblings("input").attr("type","input"):$(this).siblings("input").attr("type","password"))});
        })
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
        $('select[name="country"]').on('change', function() {
            $("select").attr("data-trigger", "");
            var countryID = $(this).val();
            console.log(countryID);
                if(countryID) {
                $.ajax({
                    url: '/getStates/'+encodeURI(countryID),
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                        console.log(data);
                        // $('#state').removeAttr('data-trigger');
                    $('select[name="state"]').empty();
                    $.each(data, function(key, value) {
                        // console.log(value.name, key);
                        $('select[name="state"]').append('<option value="'+ value.name +'">'+ value.name.charAt(0).toUpperCase() + value.name.slice(1) +'</option>');
                        });
                    }

                });

                }else{
                $('select[name="state"]').empty();
                  }
               });
            });
        </script>
@endsection
