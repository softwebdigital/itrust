@extends('layouts.user')

@section('head')
    {{ __('Settings') }}
@endsection

@section('title')
    {{ __('Settings') }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('user.index') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Settings</li>
@endsection

@section('script')
    <style>
        .accordion-button::after { background-image: none }
        .accordion-button:not(.collapsed)::after { background-image: none }
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-3 col-sm-4">
            <div class="nav flex-column nav-pills mt-2" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <a class="nav-link mb-2 active" id="v-pills-home-tab" data-bs-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Investment Profile</a>
                <a class="nav-link mb-2" id="v-pills-profile-tab" data-bs-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Investing</a>
                <a class="nav-link mb-2" id="v-pills-messages-tab" data-bs-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">Security and Privacy</a>
            </div>
        </div><!-- end col -->
        <div class="col-md-9 col-sm-8">
            <div class="tab-content text-muted mt-4 mt-md-0" id="v-pills-tabContent">
                <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                    <div class="accordion accordion-flush mb-4" id="accordionFlushExample">
                        <h5>Personal Details</h5>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingOne">
                                <button onclick="$('#employmentVal').toggle()" class="accordion-button fw-medium collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#flush-collapseOne" aria-expanded="true" aria-controls="flush-collapseOne">
                                    Employment <span id="employmentVal" style="position: absolute; right: 15px">{{ $emp ?? '---' }}</span>
                                </button>

                            </h2>
                            <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne">
                                <div class="accordion-body text-muted">
                                    <div class="row">
                                        <div class="col-5">
                                            <h6>Are you employed?</h6>
                                            <p>Federal law requires {{ env('APP_NAME') }} to collect this information to help prevent money laundering.</p>
                                        </div>
                                        <div class="col-7">
                                            <div class="form-group">
                                                <select name="employment" id="employment" class="form-select">
                                                    <option value="employed" @if(auth()->user()['employment'] == 'employed') selected @endif>Employed</option>
                                                    <option value="unemployed" @if(auth()->user()['employment'] == 'unemployed') selected @endif>Unemployed</option>
                                                    <option value="retired" @if(auth()->user()['employment'] == 'retired') selected @endif>Retired</option>
                                                    <option value="student" @if(auth()->user()['employment'] == 'student') selected @endif>Student</option>
                                                </select>
                                                <div class="d-flex justify-content-end mt-3">
                                                    <button onclick="$('#employmentVal').toggle()" class="btn btn-danger btn-block px-4 mr-2"
                                                            type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false"
                                                            aria-controls="flush-collapseOne">Cancel</button>&nbsp;&nbsp;&nbsp;
                                                    <button type="button" class="btn btn-success btn-block px-4 ml-2" onclick="event.preventDefault(); updateInvestmentProfile('employment', '#employmentVal')">Save</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingTwo">
                                <button onclick="$('#msVal').toggle()" class="accordion-button fw-medium collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                    Marital Status <span id="msVal" style="position: absolute; right: 15px">{{ $ms != "" ? $ms : '---' }}</span>
                                </button>
                            </h2>

                            <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo">
                                <div class="accordion-body text-muted">
                                    <div class="row">
                                        <div class="col-5"><h6>What is your marital status?</h6></div>
                                        <div class="col-7">
                                            <div class="form-group">
                                                <select name="marital_status" id="marital_status" class="form-select">
                                                    <option value="single" @if(auth()->user()['marital_status'] == 'single') selected @endif>Single</option>
                                                    <option value="married" @if(auth()->user()['marital_status'] == 'married') selected @endif>Married</option>
                                                    <option value="divorced" @if(auth()->user()['marital_status'] == 'divorced') selected @endif>Divorced</option>
                                                    <option value="widowed" @if(auth()->user()['marital_status'] == 'widowed') selected @endif>Widowed</option>
                                                </select>
                                                <div class="d-flex justify-content-end mt-3">
                                                    <button onclick="$('#msVal').toggle()" class="btn btn-danger btn-block px-4 mr-2"
                                                            type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false"
                                                            aria-controls="flush-collapseTwo">Cancel</button>&nbsp;&nbsp;&nbsp;
                                                    <button type="button" class="btn btn-success btn-block px-4 ml-2" onclick="event.preventDefault(); updateInvestmentProfile('marital_status', '#msVal')">Save</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h5 class="mt-5">Assets</h5>
                        <div class="accordion-item"></div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingFour">
                                <button onclick="$('#YIVal').toggle()" class="accordion-button fw-medium collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
                                    Yearly Income <span id="YIVal" style="position: absolute; right: 15px">{{ $yi ?? '---' }}</span>
                                </button>
                            </h2>
                            <div id="flush-collapseFour" class="accordion-collapse collapse" aria-labelledby="flush-headingFour">
                                <div class="accordion-body text-muted">
                                    <div class="row">
                                        <div class="col-5"><h6>What is your approximate yearly income?</h6></div>
                                        <div class="col-7">
                                            <div class="form-group">
                                                <select name="yearly_income" id="yearly_income" class="form-select">
                                                    <option value="default" @if(auth()->user()['$yearly_income'] == 'default') selected @endif>Up to $25,000</option>
                                                    <option value="25-39" @if(auth()->user()['$yearly_income'] == '25-39') selected @endif>$25,000 to $39,999</option>
                                                    <option value="40-49" @if(auth()->user()['$yearly_income'] == '40-49') selected @endif>$40,000 to $49,999</option>
                                                    <option value="50-74" @if(auth()->user()['$yearly_income'] == '50-74') selected @endif>$50,000 to $74,999</option>
                                                    <option value="75-99" @if(auth()->user()['$yearly_income'] == '75-99') selected @endif>$75,000 to $99,999</option>
                                                    <option value="100-199" @if(auth()->user()['$yearly_income'] == '100-199') selected @endif>$100,000 to $199,999</option>
                                                    <option value="200-299" @if(auth()->user()['$yearly_income'] == '200-299') selected @endif>$200,000 to $299,999</option>
                                                    <option value="300-499" @if(auth()->user()['$yearly_income'] == '300-499') selected @endif>$300,000 to $499,999</option>
                                                    <option value="500-1199" @if(auth()->user()['$yearly_income'] == '500-1199') selected @endif>$500,000 to $1,199,999</option>
                                                    <option value="1200" @if(auth()->user()['$yearly_income'] == '1200') selected @endif>$1,200,000 or higher</option>
                                                </select>
                                                <div class="d-flex justify-content-end mt-3">
                                                    <button onclick="$('#YIVal').toggle()" class="btn btn-danger btn-block px-4 mr-2"
                                                            type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false"
                                                            aria-controls="flush-collapseFour">Cancel</button>&nbsp;&nbsp;&nbsp;
                                                    <button type="button" class="btn btn-success btn-block px-4 ml-2" onclick="event.preventDefault(); updateInvestmentProfile('yearly_income', '#YIVal')">Save</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingSource">
                                <button onclick="$('#sofVal').toggle()" class="accordion-button fw-medium collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#flush-collapseSource" aria-expanded="false" aria-controls="flush-collapseSource">
                                    Source of Funds <span id="sofVal" style="position: absolute; right: 15px">{{ $sof ?? '---' }}</span>
                                </button>
                            </h2>
                            <div id="flush-collapseSource" class="accordion-collapse collapse" aria-labelledby="flush-headingSource">
                                <div class="accordion-body text-muted">
                                    <div class="row">
                                        <div class="col-5"><h6>What is your primary source of investment funds?</h6></div>
                                        <div class="col-7">
                                            <div class="form-group">
                                                <select name="sof" id="sof" class="form-select">
                                                    <option value="default" @if(auth()->user()['source_of_funds'] == 'default') selected @endif>Savings or Personal Income</option>
                                                    <option value="pension" @if(auth()->user()['source_of_funds'] == 'pension') selected @endif>Pension or Retirement</option>
                                                    <option value="insurance" @if(auth()->user()['source_of_funds'] == 'insurance') selected @endif>Insurance Payout</option>
                                                    <option value="inheritance" @if(auth()->user()['source_of_funds'] == 'inheritance') selected @endif>Inheritance</option>
                                                    <option value="gift" @if(auth()->user()['source_of_funds'] == 'gift') selected @endif>Gift</option>
                                                    <option value="property" @if(auth()->user()['source_of_funds'] == 'property') selected @endif>Sale of Business or Property</option>
                                                    <option value="something_else" @if(auth()->user()['source_of_funds'] == 'something_else') selected @endif>Something Else</option>
                                                </select>
                                                <div class="d-flex justify-content-end mt-3">
                                                    <button onclick="$('#sofVal').toggle()" class="btn btn-danger btn-block px-4 mr-2"
                                                            type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseSource" aria-expanded="false"
                                                            aria-controls="flush-collapseSource">Cancel</button>&nbsp;&nbsp;&nbsp;
                                                    <button type="button" class="btn btn-success btn-block px-4 ml-2" onclick="event.preventDefault(); updateInvestmentProfile('sof', '#sofVal')">Save</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h5 class="mt-5">Investment</h5>
                        <div class="accordion-item"></div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingFive">
                                <button onclick="$('#goalVal').toggle()" class="accordion-button fw-medium collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#flush-collapseFive" aria-expanded="false" aria-controls="flush-collapseFive">
                                    Goal <span id="goalVal" style="position: absolute; right: 15px">{{ $goal ?? '---' }}</span>
                                </button>
                            </h2>
                            <div id="flush-collapseFive" class="accordion-collapse collapse" aria-labelledby="flush-headingFive">
                                <div class="accordion-body text-muted">
                                    <div class="row">
                                        <div class="col-5"><h6>What is your overall investment objective?</h6></div>
                                        <div class="col-7">
                                            <div class="form-group">
                                                <select name="goal" id="goal" class="form-select">
                                                    <option value="default" @if(auth()->user()['goal'] == 'default') selected @endif>Preserve my savings</option>
                                                    <option value="growth" @if(auth()->user()['goal'] == 'growth') selected @endif>Growth</option>
                                                    <option value="income" @if(auth()->user()['goal'] == 'income') selected @endif>A source of income</option>
                                                    <option value="trading" @if(auth()->user()['goal'] == 'trading') selected @endif>Speculation trading</option>
                                                    <option value="something_else" @if(auth()->user()['goal'] == 'something_else') selected @endif>Something else</option>
                                                </select>
                                                <div class="d-flex justify-content-end mt-3">
                                                    <button onclick="$('#goalVal').toggle()" class="btn btn-danger btn-block px-4 mr-2"
                                                            type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFive" aria-expanded="false"
                                                            aria-controls="flush-collapseFive">Cancel</button>&nbsp;&nbsp;&nbsp;
                                                    <button type="button" class="btn btn-success btn-block px-4 ml-2" onclick="event.preventDefault(); updateInvestmentProfile('goal', '#goalVal')">Save</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingSix">
                                <button onclick="$('#timelineVal').toggle()" class="accordion-button fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseSix" aria-expanded="false" aria-controls="flush-collapseSix">
                                    Timeline <span id="timelineVal" style="position: absolute; right: 15px">{{ $timeline ?? '---' }}</span>
                                </button>
                            </h2>
                            <div id="flush-collapseSix" class="accordion-collapse collapse" aria-labelledby="flush-headingSix">
                                <div class="accordion-body text-muted">
                                    <div class="row">
                                        <div class="col-5"><h6>How long do you plan to invest your money?</h6></div>
                                        <div class="col-7">
                                            <div class="form-group">
                                                <select name="timeline" id="timeline" class="form-select">
                                                    <option value="default" @if(auth()->user()['timeline'] == 'default') selected @endif>Less than 4 years</option>
                                                    <option value="4-7" @if(auth()->user()['timeline'] == '4-7') selected @endif>4 to 7 years</option>
                                                    <option value="7" @if(auth()->user()['timeline'] == '7') selected @endif>7 or more years</option>
                                                </select>
                                                <div class="d-flex justify-content-end mt-3">
                                                    <button onclick="$('#timelineVal').toggle()" class="btn btn-danger btn-block px-4 mr-2"
                                                            type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseSix" aria-expanded="false"
                                                            aria-controls="flush-collapseSix">Cancel</button>&nbsp;&nbsp;&nbsp;
                                                    <button type="button" class="btn btn-success btn-block px-4 ml-2"  onclick="event.preventDefault(); updateInvestmentProfile('timeline', '#timelineVal')">Save</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingSeven">
                                <button onclick="$('#experienceVal').toggle()" class="accordion-button fw-medium collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#flush-collapseSeven" aria-expanded="false" aria-controls="flush-collapseSeven">
                                    Experience <span id="experienceVal" style="position: absolute; right: 15px">{{ $exp ?? '---' }}</span>
                                </button>
                            </h2>
                            <div id="flush-collapseSeven" class="accordion-collapse collapse" aria-labelledby="flush-headingSeven">
                                <div class="accordion-body text-muted">
                                    <div class="row">
                                        <div class="col-5"><h6>How much investment experience do you have?</h6></div>
                                        <div class="col-7">
                                            <div class="form-group">
                                                <select name="experience" id="experience" class="form-select">
                                                    <option selected value="">Select an Answer</option>
                                                    <option value="none" @if(auth()->user()['experience'] == 'none') selected @endif>None</option>
                                                    <option value="beginner" @if(auth()->user()['experience'] == 'beginner') selected @endif>Not much</option>
                                                    <option value="amateur" @if(auth()->user()['experience'] == 'amateur') selected @endif>I know what I'm doing</option>
                                                    <option value="expert" @if(auth()->user()['experience'] == 'expert') selected @endif>I'm an expert</option>
                                                </select>
                                                <div class="d-flex justify-content-end mt-3">
                                                    <button onclick="$('#experienceVal').toggle()" class="btn btn-danger btn-block px-4 mr-2"
                                                            type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseSeven" aria-expanded="false"
                                                            aria-controls="flush-collapseSeven">Cancel</button>&nbsp;&nbsp;&nbsp;
                                                    <button type="button" class="btn btn-success btn-block px-4 ml-2" onclick="event.preventDefault(); updateInvestmentProfile('experience', '#experienceVal')">Save</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item"></div>
                    </div>
                </div>
                <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                    <div class="accordion accordion-flush mb-4" id="accordionFlushExample">
                        <h5>Investing</h5>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingDevices">
                                <button class="accordion-button fw-medium collapsed" type="button">
                                    Dividend Reinvestment <span id="experienceVal" style="position: absolute; right: 15px"><a href="javascript:void(0)">{{ 'Enable Dividend Reinvestment' }}</a></span>
                                </button>
                            </h2>
                        </div>
                        <div class="accordion-item"></div>
                    </div>
                </div>
                <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                    <div class="accordion accordion-flush mb-4" id="accordionFlushExample">
                        <h5>Security</h5>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingDevices">
                                <button class="accordion-button fw-medium collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#flush-collapseDevices" aria-expanded="true" aria-controls="flush-collapseDevices">
                                    Devices
                                </button>

                            </h2>
                            <div id="flush-collapseDevices" class="accordion-collapse collapse" aria-labelledby="flush-headingDevices">
                                <div class="accordion-body text-muted">
                                    <div class="">
                                        <h6 class="mb-2">You are currently signed in to <strong id="device-count">{{ count($devices) }}</strong> device(s).</h6>
                                        <div id="dsp-tab">
                                        @foreach($devices as $device)
                                            <div class="card" id="device-{{ $device->id }}">
                                                <div class="d-flex justify-content-between p-2">
                                                    <div class="">
                                                        <div class="row">
                                                            <div class="col-2 align-self-center">
                                                                @if($device->os != 'Android' && $device->os != 'iPhone' && $device->os != 'Windows Phone')
                                                                    <i class="icon-xl" data-feather="monitor"></i>
                                                                @else
                                                                    <i class="icon-xl" data-feather="smartphone"></i>
                                                                @endif
                                                            </div>
                                                            <div class="col-10">
                                                                <p class="mt-0 mb-0"><strong>{{ $device->os }} ({{ $device->browser }})</strong> <br> {{ $device->location }} - <small>{{ $device->created_at ? \Illuminate\Support\Carbon::make($device->created_at)->format('dM') : '' }}</small></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="align-self-center">
                                                        @if($device->id != session()->getId())
                                                            <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#modal-{{ $device->id }}"><h6 class="text-danger">Remove</h6></a>
                                                        @else
                                                            <a href="javascript:void(0)"><h6 class="text-success">Current</h6></a>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="modal fade bs-example-modal-sm" id="modal-{{ $device->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                                <div class="modal-dialog modal-sm">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Remove Device</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <h6>Your account will be logged out of this device. Next time you log in from it, you may need to verify your identity.</h6>
                                                            <button type="button" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#modal-submit-{{ $device->id }}" class="btn w-100 btn-block btn-danger waves-effect waves-light mb-2">Remove</button>
                                                            <button type="button" data-bs-dismiss="modal"  class="btn w-100 btn-block btn-outline-success waves-effect waves-light">Cancel</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="modal fade bs-example-modal-sm" id="modal-submit-{{ $device->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                                <div class="modal-dialog modal-sm">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Remove Device</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <h6>Confirm your password to continue this action.</h6>
                                                            <input type="password" name="confirm_password" id="confirm-password" class="form-control mb-2" autofocus autocomplete="off">
                                                            <button type="button" data-bs-dismiss="modal" onclick="event.preventDefault(); removeDeviceByID('{{ $device->id }}');" class="btn w-100 btn-block btn-outline-success waves-effect waves-light mb-2">Continue</button>
                                                            <button type="button" data-bs-dismiss="modal"  class="btn w-100 btn-block btn-outline-danger waves-effect waves-light">Cancel</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                        </div>
                                        <div class="d-flex justify-content-end mt-3">
                                            <button class="btn btn-outline-success btn-block px-4" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseDevices" aria-expanded="false" aria-controls="flush-collapseDevices">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingDSP">
                                <button onclick="$('#dspVal').toggle()" class="accordion-button fw-medium collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#flush-collapseDSP" aria-expanded="false" aria-controls="flush-collapseDSP">
                                    Data Sharing and Permission <span id="dspVal" style="position: absolute; right: 15px">{{ $dsp }}</span>
                                </button>
                            </h2>
                            <div id="flush-collapseDSP" class="accordion-collapse collapse" aria-labelledby="flush-headingDSP">
                                <div class="accordion-body text-muted">
                                    <div class="form-group">
                                        <div class="d-flex justify-content-between mb-2">
                                            <h6 class="align-self-center">Data Sharing</h6>
                                            <div class="form-check form-switch form-switch-lg align-self-center" dir="ltr">
                                                <input type="checkbox" class="form-check-input" id="customSwitchsizelg" {{ $dsp == 'Enabled' ? 'checked' : '' }} onchange="event.preventDefault(); updateDSP(this)">
                                            </div>
                                        </div>
                                        <p>{{ env('APP_NAME') }} works with marketing partners to more effectively market our services to you across other websites.
                                            This makes the advertisements you see on other platforms more relevant to your interests and provides us
                                            advertising-related services.</p>

                                        <p>By disabling data sharing, {{ env('APP_NAME') }} will no longer share personal information with these partners for the
                                            purposes mentioned above.</p>

                                        <p>Please note that this feature does not relate to data shared with market makers.
                                            {{ env('APP_NAME') }} only sends market makers anonymized order data, not personal information,
                                            to help get you the best possible <a href="javascript:void(0)">execution price</a>.</p>

                                        <p>To better understand how we use personal information, be sure to read our <a href="javascript:void(0)">Privacy Policy</a>.</p>

                                        <a href="javascript:void(0)">Learn more about data sharing</a>

                                        <div class="d-flex justify-content-end mt-3">
                                            <button onclick="$('#dspVal').toggle()" class="btn btn-outline-success btn-block px-4 mr-2"
                                                    type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseDSP" aria-expanded="false"
                                                    aria-controls="flush-collapseDSP">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item"></div>
                    </div>
                </div>
            </div>
        </div><!--  end col -->
    </div>
@endsection

@section('script')
    <script>

    </script>
@endsection
