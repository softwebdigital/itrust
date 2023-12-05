@extends('layouts.admin')

@section('head')
    {{ __('Settings') }}
@endsection

@section('title')
    {{ __('Settings') }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Settings</li>
@endsection

@section('content')

<div class="row">
    <div class="col-md-3 col-sm-4">
        <div class="nav flex-column nav-pills mt-2" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <a class="nav-link mb-2 active" id="v-pills-home-tab" data-bs-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Account</a>
            {{-- <a class="nav-link mb-2" id="v-pills-profile-tab" data-bs-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Investing</a>
            <a class="nav-link mb-2" id="v-pills-messages-tab" data-bs-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">Security and Privacy</a>
            <a class="nav-link mb-2" id="v-pills-documents-tab" data-bs-toggle="pill" href="#v-pills-documents" role="tab" aria-controls="v-pills-documents" aria-selected="false">Documents</a> --}}
        </div>
    </div><!-- end col -->
    <div class="col-md-9 col-sm-8">
        <div class="tab-content text-muted mt-4 mt-md-0" id="v-pills-tabContent">
            <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                <div class="accordion accordion-flush mb-4" id="accordionFlushExample">
                    <h5>Account Details</h5>
                    <div class="accordion-item"></div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingOne">
                            <button onclick="$('#employmentVal').toggle()" class="accordion-button fw-medium collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapseOne" aria-expanded="true" aria-controls="flush-collapseOne">
                                Account </span>
                            </button>

                        </h2>
                        <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne">
                            <div class="accordion-body text-muted">
                                <div class="row">
                                    <div class="col-3">
                                        <h6>Bank Account Details</h6>
                                        {{-- <p>Federal law requires {{ env('APP_NAME') }} to collect this information to help prevent money laundering.</p> --}}
                                    </div>
                                    <div class="col-9">
                                        <form action="{{ route('admin.settings.post') }}" method="POST">
                                            @csrf @method('POST')
                                            <div class="form-group">
                                                <div class="input-group mb-3">
                                                    {{-- <label class="input-group-text" for="bank_name">$</label> --}}
                                                    <input type="text" step="any" class="form-control @error('bank_name') is-invalid @enderror"
                                                        name="bank_name" value="{{ $setting['bank_name'] ?? '' }}" id="bank_name" placeholder="Bank Name">
                                                </div>
                                                @error('bank_name') <strong class="text-danger" role="alert">{{ $message }}</strong>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group mb-3">
                                                    {{-- <label class="input-group-text" for="acct_name">$</label> --}}
                                                    <input type="text" step="any" class="form-control @error('acct_name') is-invalid @enderror"
                                                        name="acct_name" value="{{ $setting['acct_name'] ?? '' }}" id="acct_name" placeholder="Account Name">
                                                </div>
                                                @error('acct_name') <strong class="text-danger" role="alert">{{ $message }}</strong>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group mb-3">
                                                    {{-- <label class="input-group-text" for="acct_no">$</label> --}}
                                                    <input type="number" step="any" class="form-control @error('acct_no') is-invalid @enderror"
                                                        name="acct_no" value="{{ $setting['acct_no'] ?? '' }}" id="acct_no" placeholder="Account Number">
                                                </div>
                                                @error('acct_no') <strong class="text-danger" role="alert">{{ $message }}</strong>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group mb-3">
                                                    {{-- <label class="input-group-text" for="acct_no">$</label> --}}
                                                    {{-- <input type="number" step="any"
                                                        name="acct_no" id="acct_no" placeholder="Account Number"> --}}
                                                        <textarea name="other_details" class="form-control @error('other_details') is-invalid @enderror" id="other_details" cols="30" rows="4" placeholder="Additional Info">{{ $setting['other_details'] ?? '' }}</textarea>
                                                </div>
                                                @error('other_details') <strong class="text-danger" role="alert">{{ $message }}</strong>
                                                @enderror
                                            </div>
                                            <div class="d-flex justify-content-end mt-3">
                                                <button onclick="$('#employmentVal').toggle()" class="btn btn-danger btn-block px-4 mr-2"
                                                        type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false"
                                                        aria-controls="flush-collapseOne">Cancel</button>&nbsp;&nbsp;&nbsp;
                                                <button class="btn btn-success btn-block px-4 ml-2">Save</button>
                                            </div>
                                        </div>
                                    </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item"></div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingTwo">
                            <button onclick="$('#msVal').toggle()" class="accordion-button fw-medium collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                Wallet Address
                            </button>
                        </h2>

                        <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo">
                            <div class="accordion-body text-muted">
                                <div class="row">
                                    <!-- <div class="col-3"><h6>BTC Wallet</h6></div> -->
                                    <div class="col-9">
                                        <form action="{{ route('admin.settings.post') }}" method="POST">
                                        @csrf @method('POST')
                                        <div class="form-group">
                                            <div class="input-group mb-3">
                                                <label class="input-group-text" for="btc_wallet"><strong>BTC Wallet</strong></label>
                                                <input type="text" id="btc_wallet" step="any" name="btc_wallet"
                                                    value="{{ $setting['btc_wallet'] ?? '' }}"
                                                    class="form-control @error('btc_wallet') is-invalid @enderror" placeholder="Btc Wallet"
                                                    onkeyup="calcEquiv(this)">
                                            </div>
                                            @error('btc_wallet') <strong class="text-danger" role="alert">{{ $message }}</strong>
                                            @enderror

                                            <div class="input-group mb-3">
                                                <label class="input-group-text" for="eth_wallet"><strong>ETH Wallet</strong></label>
                                                <input type="text" id="eth_wallet" step="any" name="eth_wallet"
                                                    value="{{ $setting['eth_wallet'] ?? '' }}"
                                                    class="form-control @error('eth_wallet') is-invalid @enderror" placeholder="ETH Wallet"
                                                    onkeyup="calcEquiv(this)">
                                            </div>
                                            @error('eth_wallet') <strong class="text-danger" role="alert">{{ $message }}</strong>
                                            @enderror

                                            <div class="input-group mb-3">
                                                <label class="input-group-text" for="usdt_trc_20"><strong>USDT (TRC20)</strong></label>
                                                <input type="text" id="usdt_trc_20" step="any" name="usdt_trc_20"
                                                    value="{{ $setting['usdt_trc_20'] ?? '' }}"
                                                    class="form-control @error('usdt_trc_20') is-invalid @enderror" placeholder="USDT (TRC20)"
                                                    onkeyup="calcEquiv(this)">
                                            </div>
                                            @error('usdt_trc_20') <strong class="text-danger" role="alert">{{ $message }}</strong>
                                            @enderror

                                            <div class="input-group mb-3">
                                                <label class="input-group-text" for="usdt_erc_20"><strong>USDT (ERC20)</strong></label>
                                                <input type="text" id="usdt_erc_20" step="any" name="usdt_erc_20"
                                                    value="{{ $setting['usdt_erc_20'] ?? '' }}"
                                                    class="form-control @error('usdt_erc_20') is-invalid @enderror" placeholder="USDT (ERC20)"
                                                    onkeyup="calcEquiv(this)">
                                            </div>
                                            @error('usdt_erc_20') <strong class="text-danger" role="alert">{{ $message }}</strong>
                                            @enderror

                                            <div class="input-group mb-3">
                                                <label class="input-group-text" for="usdt_eth"><strong>USDT (ETH)</strong></label>
                                                <input type="text" id="usdt_eth" step="any" name="usdt_eth"
                                                    value="{{ $setting['usdt_eth'] ?? '' }}"
                                                    class="form-control @error('usdt_eth') is-invalid @enderror" placeholder="USDT (ETH)"
                                                    onkeyup="calcEquiv(this)">
                                            </div>
                                            @error('usdt_eth') <strong class="text-danger" role="alert">{{ $message }}</strong>
                                            @enderror
                                        </div>
                                        <p>Note: Updating wallet address will overwrite all users wallet address</p>
                                        <div class="d-flex justify-content-end mt-3">
                                            <button onclick="$('#employmentVal').toggle()" class="btn btn-danger btn-block px-4 mr-2"
                                                    type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false"
                                                    aria-controls="flush-collapseOne">Cancel</button>&nbsp;&nbsp;&nbsp;
                                            <button class="btn btn-success btn-block px-4 ml-2">Save</button>
                                        </div>
                                    </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <h5 class="mt-5">Email</h5>
                    <div class="accordion-item"></div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingFour">
                            <button onclick="$('#YIVal').toggle()" class="accordion-button fw-medium collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
                                Email Address <span id="YIVal" style="position: absolute; right: 15px">{{ $yi ?? '---' }}</span>
                            </button>
                        </h2>
                        <div id="flush-collapseFour" class="accordion-collapse collapse" aria-labelledby="flush-headingFour">
                            <div class="accordion-body text-muted">
                                <div class="row">
                                    <div class="col-5"><h6>Email Address?</h6></div>
                                    <div class="col-7">
                                        <form action="{{ route('admin.settings.post') }}" method="POST">
                                            @csrf @method('POST')
                                            <div class="form-group">
                                                <div class="input-group mb-3">
                                                    {{-- <label class="input-group-text" for="bank_name">$</label> --}}
                                                    <input type="email" step="any" class="form-control @error('email') is-invalid @enderror"
                                                        name="email" value="{{ $setting['email'] ?? '' }}" id="email" placeholder="Email Address">
                                                </div>
                                                @error('email') <strong class="text-danger" role="alert">{{ $message }}</strong>
                                                @enderror
                                            </div>
                                            <div class="d-flex justify-content-end mt-3">
                                                <button onclick="$('#employmentVal').toggle()" class="btn btn-danger btn-block px-4 mr-2"
                                                        type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false"
                                                        aria-controls="flush-collapseOne">Cancel</button>&nbsp;&nbsp;&nbsp;
                                                <button class="btn btn-success btn-block px-4 ml-2">Save</button>
                                            </div>
                                        </div>
                                    </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--
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
                    </div> --}}
                    <div class="accordion-item"></div>
                </div>
            </div>
            {{-- <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
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
                                    <h6 class="mb-2">You are currently signed in to <strong id="device-count">{{ $devices }}</strong> device(s).</h6>
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
                                                        <input type="password" name="confirm_password" id="settings_confirm-password" class="form-control mb-2" autofocus autocomplete="off">
                                                        <button type="button" data-bs-dismiss="modal" onclick="event.preventDefault(); removeDeviceByID('{{ $device->id }}', $(this).prev().val());" class="btn w-100 btn-block btn-outline-success waves-effect waves-light mb-2">Continue</button>
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
            <div class="tab-pane fade" id="v-pills-documents" role="tabpanel" aria-labelledby="v-pills-documents-tab">
                <div class="accordion accordion-flush mb-4" id="accordionFlushExample">
                    <h5>Documents</h5>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingPassport">
                            <button onclick="$('#passportVal').toggle()" class="accordion-button fw-medium collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapsePassport" aria-expanded="false" aria-controls="flush-collapsePassport">
                                Passport <span id="passportVal" style="position: absolute; right: 15px">{{ $user->passport ? 'Uploaded' : '---' }}</span>
                            </button>
                        </h2>
                        <div id="flush-collapsePassport" class="accordion-collapse collapse" aria-labelledby="flush-headingPassport">
                            <div class="accordion-body text-muted">
                                <div class="row">
                                    <div class="col-5">
                                        <div class="card p-3 mx-auto" style="min-height: 100px;">
                                            <img src="{{ $user->passport ? asset($user->passport) : '' }}" alt="" style="max-width: 200px" id="passport-preview">
                                        </div>
                                    </div>
                                    <div class="col-7">
                                        <div class="form-group">
                                            <input type="file" name="passport" id="passport-file" class="form-control" onchange="imagePreview(this, '#passport-preview', null, '{{ str_replace('\\', '/', asset($user->passport)) }}')">
                                            <div class="d-flex justify-content-end mt-3">
                                                <button onclick="$('#passportVal').toggle()" class="btn btn-danger btn-block px-4 mr-2"
                                                        type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapsePassport" aria-expanded="false"
                                                        aria-controls="flush-collapsePassport">Cancel</button>&nbsp;&nbsp;&nbsp;
                                                <button type="button" class="btn btn-success btn-block px-4 ml-2" onclick="event.preventDefault(); updateDocument('passport', '#passport-file')">Upload</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingLicense">
                            <button onclick="$('#driversLicenceVal').toggle()" class="accordion-button fw-medium collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapseLicense" aria-expanded="false" aria-controls="flush-collapseLicense">
                                Driver's License <span id="driversLicenceVal" style="position: absolute; right: 15px">{{ $user->drivers_license ? 'Uploaded' : '---' }}</span>
                            </button>
                        </h2>
                        <div id="flush-collapseLicense" class="accordion-collapse collapse" aria-labelledby="flush-headingLicense">
                            <div class="accordion-body text-muted">
                                <div class="row">
                                    <div class="col-5">
                                        <div class="card p-3 mx-auto" style="min-height: 100px;">
                                            <img src="{{ $user->drivers_license ? asset($user->drivers_license) : '' }}" alt="" style="max-width: 200px" id="license-preview">
                                        </div>
                                    </div>
                                    <div class="col-7">
                                        <div class="form-group">
                                            <input type="file" name="license" id="license-file" class="form-control" onchange="imagePreview(this, '#license-preview', null, '{{ str_replace('\\', '/', asset($user->drivers_license)) }}')">
                                            <div class="d-flex justify-content-end mt-3">
                                                <button onclick="$('#driversLicenceVal').toggle()" class="btn btn-danger btn-block px-4 mr-2"
                                                        type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseLicense" aria-expanded="false"
                                                        aria-controls="flush-collapseLicense">Cancel</button>&nbsp;&nbsp;&nbsp;
                                                <button type="button" class="btn btn-success btn-block px-4 ml-2" onclick="event.preventDefault(); updateDocument('drivers_license', '#license-file')">Upload</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingStateID">
                            <button onclick="$('#stateIDVal').toggle()" class="accordion-button fw-medium collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapseStateID" aria-expanded="false" aria-controls="flush-collapseStateID">
                                State ID <span id="stateIDVal" style="position: absolute; right: 15px">{{ $user->state_id ? 'Uploaded' : '---' }}</span>
                            </button>
                        </h2>
                        <div id="flush-collapseStateID" class="accordion-collapse collapse" aria-labelledby="flush-headingStateID">
                            <div class="accordion-body text-muted">
                                <div class="row">
                                    <div class="col-5">
                                        <div class="card p-3 mx-auto" style="min-height: 100px;">
                                            <img src="{{ $user->state_id ? asset($user->state_id) : '' }}" alt="" style="max-width: 200px" id="state_id-preview">
                                        </div>
                                    </div>
                                    <div class="col-7">
                                        <div class="form-group">
                                            <input type="file" name="state_id" id="state_id-file" class="form-control" onchange="imagePreview(this, '#state_id-preview', null, '{{ str_replace('\\', '/', asset($user->state_id)) }}')">
                                            <div class="d-flex justify-content-end mt-3">
                                                <button onclick="$('#stateIDVal').toggle()" class="btn btn-danger btn-block px-4 mr-2"
                                                        type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseStateID" aria-expanded="false"
                                                        aria-controls="flush-collapseStateID">Cancel</button>&nbsp;&nbsp;&nbsp;
                                                <button type="button" class="btn btn-success btn-block px-4 ml-2" onclick="event.preventDefault(); updateDocument('state_id', '#state_id-file')">Upload</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item"></div>
                </div>
            </div> --}}
        </div>
    </div><!--  end col -->
</div>

@endsection

@section('script')
    <script src="{{ asset('assets/libs/twitter-bootstrap-wizard/jquery.bootstrap.wizard.min.js') }}"></script>
    <script src="{{ asset('assets/libs/twitter-bootstrap-wizard/prettify.js') }}"></script>
    <script src="{{ asset('assets/libs/choices.js/public/assets/scripts/choices.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/form-wizard.init.js') }}"></script>
    <script>

    </script>
@endsection
