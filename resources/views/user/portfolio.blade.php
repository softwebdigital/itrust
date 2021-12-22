@extends('layouts.user')

@section('head')
    {{ __('Portfolio') }}
@endsection

@section('title')
    {{ __('Portfolio') }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('user.index') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Portfolio</li>
@endsection

@section('style')
    <link href="{{ asset('assets/libs/dropzone/min/dropzone.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css"
        integrity="sha512-In/+MILhf6UMDJU4ZhDL0R0fEpsp4D3Le23m6+ujDWXwl3whwpucJG1PEmI3B07nyJx+875ccs+yX2CqQJUxUw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('content')
    <div class="modal fade" id="exampleModalCenterdeposit" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Offshore Deposit</h5>
                    {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button> --}}
                </div>
                <div class="modal-body border p-3">
                    <div class="col-md-12 order-md-1">
                        <div class="card-body mb-3 border">
                            <div class="row align-items-center reward" id="reward-11">
                                <div class="col">
                                    <img src="{{ asset('svg/bank-deposit.svg') }}" alt="" width="50">
                                </div>
                                <div class="col-10 align-self-center d-flex justify-content-between">
                                    <div class="mt-4 mt-sm-0">
                                        <p class="mb-1">Bank Deposit</p>
                                        {{-- <h6>$250K Crypto Bonus.</h6> --}}
                                    </div>
                                    <div class="align-self-auto my-auto"><a href="javascript:void(0)"
                                            onclick="showReward(11)">Deposit
                                            Now <i class="mdi mdi-arrow-down"></i></a></div>
                                </div>
                            </div>
                            <div class="d-none reward-panel" id="reward-panel-11">
                                <div class="col">
                                    <img src="{{ asset('svg/bank-deposit.svg') }}" alt="" width="50">
                                    <h5 class="font-size-14 mb-4">Add Cash (Bank Deposit)</h5>
                                </div>
                                {{-- <div style="display: none;" id="crypto-method">
                                    <label>Add Amount in USD:</label>
                                    <div class="form-group">
                                        <div class="input-group mb-3">
                                            <label class="input-group-text" for="amount"><strong>$</strong></label>
                                            <input type="number" id="amount" step="any" name="btc_amount"
                                                value="{{ old('btc_amount') }}"
                                                class="form-control @error('amount') is-invalid @enderror" placeholder="Amount"
                                                onkeyup="calcEquiv(this)">
                                        </div>
                                        @error('amount') <strong class="text-danger" role="alert">{{ $message }}</strong>
                                        @enderror
                                    </div>


                                    <div class="card bg-light mt-2 mb-3">
                                        <div class="container-fluid">
                                            <div class="row">
                                                <div class="col-4">
                                                    <p class="mt-3"><strong>Wallet Address:</strong></p>
                                                </div>
                                                <div class="col-8">
                                                    <p class="mt-3">{{ $setting['btc_wallet'] }}</p>
                                                </div>
                                                <div class="col-4">
                                                    <p><strong>Amount:</strong></p>
                                                </div>
                                                <div class="col-8">
                                                    <p id="crypto-amount">0.00 BTC</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-center d-grid gap-2">
                                        <button class="btn btn-success w-md" type="button" onclick="startDepositbtc()"
                                            data-toggle="modal" data-target="#exampleModalCenterbtc">Request Deposit</button>
                                    </div>
                                </div> --}}
                                <form action="{{ route('user.deposit.store') }}" method="post" id="depositFormBank">
                                    @csrf
                                    <input type="hidden" value="bank" name="method">
                                    <div id="bank-method">
                                        <div class="form-group">
                                            <input type="hidden" name="acct_type" value="offshore">
                                            <div class="input-group mb-3">
                                                <label class="input-group-text" for="amount">$</label>
                                                <input type="number" step="any"
                                                    class="form-control @error('amount') is-invalid @enderror"
                                                    id="bank_amount" required name="amount" value="{{ old('amount') }}"
                                                    id="amount" placeholder="Amount">
                                            </div>
                                            @error('amount') <strong class="text-danger"
                                                    role="alert">{{ $message }}</strong>
                                            @enderror
                                        </div>
                                        {{-- <div class="card bg-light mt-2 mb-3">
                                        <div class="container-fluid">
                                            <div class="row">
                                                <div class="col-4">
                                                    <p class="mt-3"><strong>Bank Name:</strong></p>
                                                </div>
                                                <div class="col-8">
                                                    <p class="mt-3">{{ $setting['bank_name'] ?? ''}}</p>
                                                </div>
                                                <div class="col-4">
                                                    <p><strong>Account Number:</strong></p>
                                                </div>
                                                <div class="col-8">
                                                    <p>{{ $setting['acct_no'] ?? ''}}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}
                                        <div class="text-center d-grid gap-2">
                                            <button type="button" class="btn btn-success w-md" onclick="startDeposit()"
                                                data-toggle="modal" data-target="#exampleModalCenterbank">Request
                                                Deposit</button>
                                        </div>
                                    </div>
                                </form>
                                <div class="mx-4">
                                    <a href="javascript:void(0)" class="float-end" onclick="showLess(11)">View less <i
                                            class="mdi mdi-arrow-up"></i></a>
                                    <div class="d-flex justify-content-between align-items-center mb-4 mt-4">
                                        {{-- <button class="btn btn-success d-none btn-block px-4">Share Link</button> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body mb-3 border">
                            <div class="row align-items-center reward" id="reward-22">
                                <div class="col">
                                    <img src="{{ asset('svg/new_btc.svg') }}" alt="" width="50">
                                </div>
                                <div class="col-10 align-self-center d-flex justify-content-between">
                                    <div class="mt-4 mt-sm-0">
                                        <p class="mb-1">Bitcoin</p>
                                        {{-- <h6>Get a free stock. Limitations apply</h6> --}}
                                    </div>
                                    <div class="align-self-auto my-auto"><a href="javascript:void(0)"
                                            onclick="showReward(22)">Deposit
                                            Now <i class="mdi mdi-arrow-down"></i></a></div>
                                </div>
                            </div>
                            <div class="d-none reward-panel" id="reward-panel-22">
                                <div class="col">
                                    <img src="{{ asset('svg/new_btc.svg') }}" alt="" width="50">
                                    {{-- <p class="mb-1">Bitcoin</p> --}}
                                </div>
                                <h5 class="font-size-14 mb-4">Add Cash (Bitcoin)</h5>
                                <form action="{{ route('user.deposit.store') }}" method="post" id="depositFormBtc">
                                    @csrf
                                    <input type="hidden" value="bitcoin" name="method">

                                    <div id="crypto-method">
                                        <label>Add Amount in USD:</label>
                                        <div class="form-group">
                                            <input type="hidden" name="acct_type" value="offshore">
                                            <div class="input-group mb-3">
                                                <label class="input-group-text" for="amount"><strong>$</strong></label>
                                                <input type="number" id="amount" step="any" name="btc_amount"
                                                    value="{{ old('btc_amount') }}"
                                                    class="form-control @error('amount') is-invalid @enderror"
                                                    placeholder="Amount" onkeyup="calcEquiv(this)">
                                            </div>
                                            @error('amount') <strong class="text-danger"
                                                    role="alert">{{ $message }}</strong>
                                            @enderror
                                        </div>


                                        <div class="card bg-light mt-2 mb-3">
                                            <div class="container-fluid">
                                                <div class="row">
                                                    <div class="col-4">
                                                        <p class="mt-3"><strong>Wallet Address:</strong></p>
                                                    </div>
                                                    <div class="col-8">
                                                        <p class="mt-3">{{ $user['btc_wallet'] ?? 'NULL' }}</p>
                                                    </div>
                                                    <div class="col-4">
                                                        <p><strong>Amount:</strong></p>
                                                    </div>
                                                    <div class="col-8">
                                                        <p id="crypto-amount">0.00 BTC</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-center d-grid gap-2">
                                            <button class="btn btn-success w-md" type="button" onclick="startDepositbtc()"
                                                data-toggle="modal" data-target="#exampleModalCenterbtc">Request
                                                Deposit</button>
                                        </div>
                                    </div>
                                    <div style="display: none" id="bank-method">
                                        <div class="form-group">
                                            <div class="input-group mb-3">
                                                <label class="input-group-text" for="amount">$</label>
                                                <input type="number" step="any"
                                                    class="form-control @error('amount') is-invalid @enderror"
                                                    id="bank_amount" required name="amount" value="{{ old('amount') }}"
                                                    id="amount" placeholder="Amount">
                                            </div>
                                            @error('amount') <strong class="text-danger"
                                                    role="alert">{{ $message }}</strong>
                                            @enderror
                                        </div>
                                        {{-- <div class="card bg-light mt-2 mb-3">
                                            <div class="container-fluid">
                                                <div class="row">
                                                    <div class="col-4">
                                                        <p class="mt-3"><strong>Bank Name:</strong></p>
                                                    </div>
                                                    <div class="col-8">
                                                        <p class="mt-3">{{ $setting['bank_name'] ?? ''}}</p>
                                                    </div>
                                                    <div class="col-4">
                                                        <p><strong>Account Number:</strong></p>
                                                    </div>
                                                    <div class="col-8">
                                                        <p>{{ $setting['acct_no'] ?? ''}}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> --}}
                                        <div class="text-center d-grid gap-2">
                                            <button type="button" class="btn btn-success w-md" onclick="startDeposit()"
                                                data-toggle="modal" data-target="#exampleModalCenterbank">Request
                                                Deposit</button>
                                        </div>
                                    </div>
                                </form>
                                <div class="mx-4">
                                    <a href="javascript:void(0)" class="float-end" onclick="showLess(22)">View less <i
                                            class="mdi mdi-arrow-up"></i></a>
                                    <div class="d-flex justify-content-between align-items-center mb-4 mt-4">
                                        {{-- <button class="btn btn-success d-none btn-block px-4">Share Link</button> --}}
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeBtn">Close</button>
                    {{-- <button type="button" onclick="depositFormBtc()" class="btn btn-primary">Confirm</button> --}}
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModalCenterbank" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Confirm Deposit</h5>
                    {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button> --}}
                </div>
                <div class="modal-body border p-3">
                    <div id="banknote"></div>
                    {{-- <p>Please deposit to the account below</p>
        <p>Kindly make a deposit of [requested amount in USD(bank deposit) or
            btc(bitcoin deposit)] to
            [Bank Details(bank deposit) or Deposit adddress(bitcoin deposit)],</p> --}}
                    <li>Bank Name: {{ $setting['bank_name'] ?? '' }}</li>
                    <li>Account Number: {{ $setting['acct_name'] ?? '' }}</li>
                    <li>Account Number: {{ $setting['acct_no'] ?? '' }}</li>
                    <br>
                    <p>Deposits will be processed after we’ve confirmed your payment. Thank you!</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" onclick="depositFormBank()" class="btn btn-primary">Confirm</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModalCenterbtc" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Confirm Deposit</h5>
                    {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button> --}}
                </div>
                <div class="modal-body border p-3">
                    <div id="btcnote"></div>
                    <li>BTC Wallet: {{ $user['btc_wallet'] }}</li>
                    <br>
                    <p>Deposits will be processed after we’ve confirmed your payment. Thank you!</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" onclick="depositFormBtc()" class="btn btn-primary">Confirm</button>
                </div>
            </div>
        </div>
    </div>
    @php
    if ($total_assets == 0) {
        $total_assets = 1;
    }
    @endphp
    <div class="row">
        <div class="col-md-8">
            <div>
                @if ($user->passport == null)
                    <div class="card border border-danger">
                        <div class="card-body">
                            <h6>Verify Your Identity</h6>
                            <p>Kindly complete your profile and upload a photo of your state ID, driver's license or
                                passport so we can finish processing your application.</p>
                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                data-bs-target=".bs-example-modal-center">Upload Document Now</a>
                        </div>
                    </div>
                @else
                    @if ($user->status != 'approved')
                        <div class="card border border-success">
                            <div class="card-body">
                                <h6>Documents Uploaded</h6>
                                {{-- <p></p> --}}
                            </div>
                        </div>
                    @endif
                @endif
            </div>
            <div class="row">
                <div class="col-xl-6 col-md-6">
                    <div class="card card-h-100">
                        <!-- card body -->
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <span class="text-muted mb-3 lh-1 d-block text-truncate">IRA Balance</span>
                                    <h4 class="mb-3">
                                        $<span class="" data-target="">{{ number_format($ira, 2) }}</span>
                                    </h4>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->
                <div class="col-xl-6 col-md-6">


                    <div class="card card-h-100">
                        <!-- card body -->
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-12">
                                    @if ($offshore == 0)
                                        <div class="align-self-auto my-auto float-end"><a href="javascript:void(0)"
                                                onclick="startDeposit()" data-toggle="modal"
                                                data-target="#exampleModalCenterdeposit">DEPOSIT NOW <i
                                                    class="mdi mdi-arrow-down"></i></a></div>
                                    @endif
                                    <span class="text-muted mb-3 lh-1 d-block text-truncate">Offshore Account
                                        Balance</span>
                                    <h4 class="mb-3">
                                        $<span class=""
                                            data-target="">{{ number_format($offshore, 2) }}</span>
                                    </h4>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->
            </div><!-- end row -->

            <div>
                {{-- <div class="card">
                    <div class="card-body">
                        <div id="live-chart" class="apex-charts" dir="ltr"></div>
                    </div>
                </div> --}}

                <div class="col-md-12">
                    <div class="card card-h-100">
                        <!-- card body -->
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="apex-charts" id="live-chart"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end card-->
            </div>

            <div>
                <h4>News</h4>
                <hr>
                <div class="">

                    @foreach ($news as $info)
                        {{-- <div class="row">
                        <div class="col-9">
                            <h6>{{ ucfirst($info->title)  }} <small>{{ \Carbon\Carbon::make($info->date_range)->shortAbsoluteDiffForHumans() }}</small></h6>
                            <p>{!! $info->body !!}</p>
                        </div>
                        <div class="col-3">
                            <img src="{{ $info->image ? asset($info->image) : '' }}" alt="" style="height: 100%; width: 100%; object-fit: contain;">
                        </div>
                    </div> --}}
                        <div class="card-body mb-3 border">
                            <div class="row align-items-center reward{{ $info->id }}"
                                id="reward-{{ $info->id }}">
                                <div class="col">
                                    <img src="{{ $info->image ? asset($info->image) : '' }}" alt="" width="75">
                                </div>
                                <div class="col-10 align-self-center d-flex justify-content-between">
                                    <div class="mt-4 mt-sm-0">
                                        <p class="mb-1">{{ ucfirst($info->title) }} <small
                                                class="text-info">{{ \Carbon\Carbon::make($info->date_range)->shortAbsoluteDiffForHumans() }}</small>
                                        </p>
                                        <h6>{{ ucfirst($info->heading) }}</h6>
                                    </div>
                                    <div class="align-self-auto my-auto"><a href="javascript:void(0)"
                                            onclick="showReward({{ $info->id }})">Read More <i
                                                class="mdi mdi-arrow-down"></i></a></div>
                                </div>
                            </div>
                            <div class="d-none reward-panel{{ $info->id }}" id="reward-panel-{{ $info->id }}">
                                <div class="row">
                                    <div class="col-9">
                                        <h6>{{ ucfirst($info->title) }}
                                            <small>{{ \Carbon\Carbon::make($info->date_range)->shortAbsoluteDiffForHumans() }}</small>
                                        </h6>
                                        <p>{!! $info->body !!}</p>
                                    </div>
                                    <div class="col-3">
                                        <img src="{{ $info->image ? asset($info->image) : '' }}" alt=""
                                            style="height: 100%; width: 100%; object-fit: contain;">
                                    </div>
                                </div>
                                <hr>
                                <div class="mx-4">
                                    <div class="d-flex justify-content-between align-items-center mb-4 mt-4">
                                        <button class="btn btn-success btn-block px-4">Share News</button>
                                        <a href="javascript:void(0)" class=""
                                            onclick="showLess({{ $info->id }})">View less <i
                                                class="mdi mdi-arrow-up"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card w-100">
                <div class="card-body">
                    <div class="table">
                        <table class="table table-borderless">
                            <h4>Current Holdings</h4>
                            <tr class="text-" style="border: 0 !important;">
                                <td colspan="4">Cash</td>

                                <td class="float-end">${{ $cash }}</td>
                            </tr>
                            <tr>
                                <td colspan="6">
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar"
                                            style="width: {{ ($cash / $total_assets) * 100 }}%; background-color: #90bcbc;"
                                            aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </td>
                            </tr>
                            @foreach ($assets as $asset)
                                @php
                                    $percentage = (($asset->amount + $asset->ROI) / $total_assets) * 100;
                                    switch ($asset->type) {
                                        case 'stocks':
                                            $color = '#62d9d7';
                                            break;
                                        case 'Fixed income(bonds)':
                                            $color = '#0d1189';
                                            break;
                                        case 'Cash':
                                            $color = '#deb2d2';
                                            break;
                                        case 'Properties':
                                            $color = '#deb2d2';
                                            break;
                                        case 'Cryptocurrencies':
                                            $color = '#69382c';
                                            break;
                                        case 'EFT’S':
                                            $color = '#ff0000';
                                            break;
                                        case 'gold':
                                            $color = '#6c96d3';
                                            break;
                                        default:
                                            $color = '#ffff00';
                                    }
                                @endphp

                                <tr class="text-" style="border: 0 !important;">
                                    <td colspan="4">{{ ucwords(str_replace('_', ' ', $asset->type)) }}</td>

                                    <td class="float-end">${{ $asset->amount + $asset->ROI }}</td>
                                </tr>
                                <tr>
                                    <td colspan="6">
                                        <div class="progress">
                                            <div class="progress-bar" role="progressbar"
                                                style="width: {{ $percentage }}%; background-color: {{ $color }};"
                                                aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Upload Document</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <img src="{{ asset('svg/upload.svg') }}" alt="">
                <div class="modal-body">
                    <p>We need photos of both sides of your passport card, permanent resident card, or state ID in order to
                        verify your identity.</p>
                    <div class="form-group">
                        <label for="doc">Document Type:</label>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="radio" name="formRadios" id="formRadios1"
                                value="Passport">
                            <label class="form-check-label" for="formRadios1">
                                ID/ Driver's License / Passport @if ($user->passport) <i class=" fas fa-check-circle text-success"></i> @endif
                            </label>
                        </div>
                        {{-- <div class="form-check mb-3">
                        <input class="form-check-input" type="radio" name="formRadios"
                               id="formRadios2" value="Driver's License">
                        <label class="form-check-label" for="formRadios2">
                            Driver's License  @if ($user->drivers_license) <i class=" fas fa-check-circle text-success"></i> @endif
                        </label>
                    </div> --}}
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="radio" name="formRadios" id="formRadios3"
                                value="State ID">
                            <label class="form-check-label" for="formRadios3">
                                Proof Of Address @if ($user->state_id) <i class=" fas fa-check-circle text-success"></i> @endif
                            </label>
                        </div>
                    </div>
                    <button type="button" id="cont-btn" data-bs-dismiss="modal"
                        onclick="updateModalTitle('#myLargeModalLabel')" disabled
                        class="btn w-100 btn-block btn-primary waves-effect waves-light" data-bs-toggle="modal"
                        data-bs-target=".bs-example-modal-lg">Continue</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>

    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myLargeModalLabel">Upload a photo of your </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" class="" enctype="multipart/form-data">
                    <input type="hidden" name="type" id="doc-type" value="default">
                    <div class="modal-body">
                        Please ensure the entire document is in the frame and information is legible.
                        <div class="row" id="modalDetails"></div>
                        <div class="row">
                            <div class="col-12">
                                <div class="mt-5">
                                    <div class="d-none" id="pass-file">
                                        <input type="file" class="dropify" id="pass-file-field"
                                            data-default-file="{{ $user->passport ? asset($user->passport) : '' }}"
                                            data-allowed-file-extensions="png jpg jpeg" data-max-file="1"
                                            data-max-file-size="1M" required />
                                    </div>
                                    {{-- <div class="d-none" id="drv-file">
                                    <input type="file" class="dropify" id="drv-file-field" data-default-file="{{ $user->drivers_license ? asset($user->drivers_license) : '' }}" data-allowed-file-extensions="png jpg jpeg" data-max-file="1" data-max-file-size="1M" required />
                                </div> --}}
                                    <div class="d-none" id="stt-file">
                                        <input type="file" class="dropify" id="stt-file-field"
                                            data-default-file="{{ $user->state_id ? asset($user->state_id) : '' }}"
                                            data-allowed-file-extensions="png jpg jpeg" data-max-file="1"
                                            data-max-file-size="1M" required />
                                    </div>
                                </div>

                                <div class="text-center mt-4">
                                    <button type="button" id="sub-btn" class="btn btn-primary waves-effect waves-light"
                                        onclick="submitDoc()">Upload</button>
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row -->
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection

@section('script')
    <script src="{{ asset('assets/libs/dropzone/min/dropzone.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.js"
        integrity="sha512-hJsxoiLoVRkwHNvA5alz/GVA+eWtVxdQ48iy4sFRQLpDrBPn6BFZeUcW4R4kU+Rj2ljM9wHwekwVtsb0RY/46Q=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        function submitDoc() {
            const formData = new FormData()
            const type = $('#doc-type').val();
            formData.append('type', type)
            if (type === 'passport')
                formData.append('file', $('#pass-file-field')[0].files[0]);
            else if (type === 'drivers_license')
                formData.append('file', $('#drv-file-field')[0].files[0]);
            else if (type === 'state_id')
                formData.append('file', $('#stt-file-field')[0].files[0]);

            $.ajax({
                url: '{{ route('user.documents.upload') }}',
                type: 'POST',
                headers: {
                    "X-CSRF-TOKEN": '{{ csrf_token() }}'
                },
                data: formData,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('#sub-btn').attr('disabled', true)
                },
                success: function(res) {
                    $('#sub-btn').attr('disabled', false)
                    alertify.success(res.msg)
                    setTimeout(() => location.href = '{{ route('user.portfolio') }}', 2000)
                },
                error: function(res) {
                    $('#sub-btn').attr('disabled', false)
                    if (res.status === 422)
                        if (res['responseJSON'].msg['type'])
                            alertify.error(res['responseJSON'].msg['type'][0]);
                    if (res['responseJSON'].msg['file'])
                        alertify.error(res['responseJSON'].msg['file'][0]);
                    else if (res.status === 429)
                        alertify.error(res.statusText);
                    else
                        alertify.error(res['responseJSON'].msg);
                }
            })
        }

        // (chart = new ApexCharts(document.querySelector("#live-chart"), {
        //     chart: {
        //         height: 350,
        //         type: "area",
        //         toolbar: {
        //             show: !1
        //         }
        //     },
        //     dataLabels: {
        //         enabled: !1
        //     },
        //     stroke: {
        //         curve: "smooth",
        //         width: 3
        //     },
        //     series: [{
        //             name: "Balance",
        //             data: {!! json_encode($data) !!}
        //         },
        //         // {name: "series2", data: [32, 60, 34, 46, 34, 52, 41]}
        //     ],
        //     colors: ['#5156be'],
        //     xaxis: {
        //         type: "date",
        //         categories: {!! json_encode($days) !!}
        //         // categories: ["2018-09-19T00:00:00", "2018-09-19T01:30:00", "2018-09-19T02:30:00", "2018-09-19T03:30:00", "2018-09-19T04:30:00", "2018-09-19T05:30:00", "2018-09-19T06:30:00"]
        //     },
        //     grid: {
        //         borderColor: "#f1f1f1"
        //     },
        //     tooltip: {
        //         x: {
        //             format: "dd/MM"
        //         }
        //     }
        // })).render();

        $('.dropify').dropify({
            messages: {
                'default': '<p style="font-size: 18px">Drag and drop a file here or click</p>',
                'replace': '<p style="font-size: 18px">Drag and drop or click to replace</p>',
                'remove': 'Remove'
            },
        });

        $('input[type="radio"][name="formRadios"]').on('change', function() {
            if ($(this).is(':checked')) $('#cont-btn').attr('disabled', false)
        })

        function updateModalTitle(id) {
            const value = $('input[type="radio"][name="formRadios"]:checked').val()
            // console.log(value);
            if (value == 'Passport') {
                $(id).html("Upload a photo of your ID/ Driver's License / Passport")
            } else {
                $(id).html("Upload a photo of your Proof of Address")
            }
            $('input[type="hidden"][name="type"]').val(value)

            if (value === "Passport") {
                $('#doc-type').val('passport')
                $('#pass-file').removeClass('d-none')
                $('#drv-file').addClass('d-none')
                $('#stt-file').addClass('d-none')
                $('#modalDetails').html(`
                    <div class="col-md-6">
                        Your photo must:<br>
                        <i class=" fas fa-check-circle text-success"></i> Be a clear, color image<br>
                        <i class=" fas fa-check-circle text-success"></i> Show the entire page, including your face<br>
                        <i class=" fas fa-check-circle text-success"></i> Show all four corners<br>
                    </div>
                    <div class="col-md-6">
                        We can't accept:<br>
                        <i class="fas fa-times-circle text-danger"></i> Scans, copies, or screenshots<br>
                        <i class="fas fa-times-circle text-danger"></i> U.S. military ID and trusted traveller cards<br>
                        <i class="fas fa-times-circle text-danger"></i> Employment authorization documents<br>
                        <i class="fas fa-times-circle text-danger"></i> Documents not from the U.S. government<br>
                    </div>
                `);
            }

            // if (value === "Driver's License") {
            //     $('#doc-type').val('drivers_license')
            //     $('#pass-file').addClass('d-none')
            //     $('#drv-file').removeClass('d-none')
            //     $('#stt-file').addClass('d-none')
            //     $('#modalDetails').html(`
        //         <div class="col-md-6">
        //             Your photo must:<br>
        //             <i class=" fas fa-check-circle text-success"></i> Be a clear, color image<br>
        //             <i class=" fas fa-check-circle text-success"></i> Be of a valid driver’s license or permit<br>
        //             <i class=" fas fa-check-circle text-success"></i> Show all four corners<br>
        //         </div>
        //         <div class="col-md-6">
        //             We can't accept:<br>
        //             <i class="fas fa-times-circle text-danger"></i> Printed or temporary licenses<br>
        //             <i class="fas fa-times-circle text-danger"></i> Scans, copies, or screenshots<br>
        //             <i class="fas fa-times-circle text-danger"></i> Laminated or plastic covered cards<br>
        //         </div>
        //     `);
            // }

            if (value === "State ID") {
                $('#doc-type').val('state_id')
                $('#pass-file').addClass('d-none')
                $('#drv-file').addClass('d-none')
                $('#stt-file').removeClass('d-none')
                $('#modalDetails').html(`
                    <div class="col-md-6">
                        Your photo must:<br>
                        <i class=" fas fa-check-circle text-success"></i> Be a clear, colored image<br>
                        <i class=" fas fa-check-circle text-success"></i> Show all four corners<br>
                    </div>
                    <div class="col-md-6">
                        We can't accept:<br>
                        <i class="fas fa-times-circle text-danger"></i> Scans, copies, or screenshots<br>
                    </div>
                `);
            }
        }
    </script>
    <script>
        function showReward(i) {
            $('.reward' + i).removeClass('d-none')
            $('.reward-panel' + i).addClass('d-none')
            $('#reward-' + i).addClass('d-none')
            $('#reward-panel-' + i).removeClass('d-none')
        }

        function showLess(i) {
            $('#reward-' + i).removeClass('d-none')
            $('#reward-panel-' + i).addClass('d-none')
        }

        function copyToClipBoard() {
            const link = document.getElementById('link');
            link.select();
            link.setSelectionRange(0, 99999); /* For mobile devices */
            navigator.clipboard.writeText(link.value);
        }
    </script>



    <script>
        // $('#datatable').DataTable()
        // console.log();
        const user = {!! json_encode(auth()->user()) !!};
        if (user['status'] === 'pending') $('#staticBackdrop-btn').click()

        console.log({!! json_encode(session()) !!})
        const validation = {!! json_encode(session('validation')) !!};
        const method = {!! json_encode(session('method')) !!};
        const w_method = {!! json_encode(session('w_method')) !!};

        if (validation) {
            if (method) {
                if (method === 'bank') $('#bank-method').show(500);
                else if (method === 'bitcoin') $('#crypto-method').show(500);
                else {
                    $('#crypto-method').hide(500);
                    $('#bank-method').hide(500);
                }
            }

            if (w_method) {
                if (w_method === 'bank') $('#bank-method-withdraw').show(500);
                else if (w_method === 'bitcoin') $('#crypto-method-withdraw').show(500);
                else {
                    $('#crypto-method-withdraw').hide(500);
                    $('#bank-method-withdraw').hide(500);
                }
            }
        }

        function showMethod(id) {
            $('#bank-method-withdraw').hide(500);
            $('#crypto-method-withdraw').hide(500);
            const value = $(id).val()
            if (value === 'bank') $('#bank-method').show(500);
            else $('#bank-method').hide(500);
            if (value === 'bitcoin') $('#crypto-method').show(500);
            else $('#crypto-method').hide(500);
        }

        function showMethodwithdraw(id) {
            $('#bank-method').hide(500);
            $('#crypto-method').hide(500);
            const value = $(id).val()
            if (value === 'bank') $('#bank-method-withdraw').show(500);
            else $('#bank-method-withdraw').hide(500);
            if (value === 'bitcoin') {
                $('#crypto-method-withdraw').show(500);
                $("#bank-method-withdraw").find("input").attr("disabled");
            } else $('#crypto-method-withdraw').hide(500);
        }

        function calcEquiv(id) {
            if ($(id).val().length > 0) $('#crypto-amount').html((parseFloat($(id).val()) / 44000).toFixed(8) + ' BTC');
        }

        function calcEquivWithdraw(id) {
            if ($(id).val().length > 0) $('#crypto-amount-withdraw').html((parseFloat($(id).val()) / 44000).toFixed(8) +
                ' BTC');
        }

        function depositFormBtc() {

            document.getElementById("depositFormBtc").submit();
        }

        function depositFormBank() {

            document.getElementById("depositFormBank").submit();
        }

        // var note = document.getElementById('banknote').innerHtml;
        // note
    </script>
    <script>
        function startDeposit() {
            $('#closeBtn').click();
            var amount = document.getElementById('bank_amount').value
            $('#banknote').html(`
            <p>Kindly make a deposit of $` + amount + ` in USD to the
            Bank Details below</p>
            `);
        }

        function startDepositbtc() {
            $('#closeBtn').click();
            var amount = document.getElementById('crypto-amount').innerText
            $('#btcnote').html(`
            <p>Kindly make a deposit of ` + amount + ` in BTC to the
            Address below</p>
            `);
        }
    </script>
    <script>
        (chart = new ApexCharts(document.querySelector("#live-chart"), {
            chart: {
                height: 350,
                type: "area",
                toolbar: {
                    show: !1
                }
            },
            dataLabels: {
                enabled: !1
            },
            stroke: {
                curve: "smooth",
                width: 3
            },
            series: [{
                    name: "Basic IRA",
                    data: {!! json_encode($iraData) !!}
                },
                {
                    name: "Offshore",
                    data: {!! json_encode($offshoreData) !!}
                }
            ],
            colors: ['#098738', '#5156be'],
            xaxis: {
                type: "date",
                categories: {!! json_encode($days) !!}
            },
            grid: {
                borderColor: "#f1f1f1"
            },
            tooltip: {
                x: {
                    format: "dd/MM"
                }
            }
        })).render();
    </script>
@endsection
