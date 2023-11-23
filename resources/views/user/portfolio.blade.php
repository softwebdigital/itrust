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
                                                    placeholder="Amount">
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
      if ($total_assets == 0) $total_assets = 1;
    @endphp
    <div class="row">
        <div class="col-md-8">
            <div class="row">
                <div class="col-xl-6 col-md-6">
                    <div class="card card-h-100">
                        <!-- card body -->
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <span class="text-muted mb-3 lh-1 d-block text-truncate">IRA Balance</span>
                                    <h4 class="mb-3">
                                        @php
                                            $symbol = \App\Models\Currency::where('id', $user->currency_id)->get();
                                        @endphp
                                        @foreach($symbol as $sym)
                                            <span class="" data-target="">{{ $sym->symbol }}</span> 
                                        @endforeach
                                        <span class="" data-target="">{{ number_format($ira, 2) }}</span>

                                        <!-- <span class="text-danger mt-3 text-truncate" style="font-size: 15px;">-35%</span> -->
                                        {{-- <span class="text-success mt-3 text-truncate" style="font-size: 15px;">{{ number_format($iraPercentage, 2) }}%</span> --}}
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
                                        @php
                                            $symbol = \App\Models\Currency::where('id', $user->currency_id)->get();
                                        @endphp
                                        @foreach($symbol as $sym)
                                            <span class="" data-target="">{{ $sym->symbol }}</span> 
                                        @endforeach
                                        <span class="" data-target="">{{ number_format($offshore, 2) }}</span>

                                        <!-- <span class="text-danger mt-3 text-truncate" style="font-size: 15px;">-35%</span> -->
                                        {{-- <span class="text-success mt-3 text-truncate" style="font-size: 15px;">{{ number_format($offshorePercentage, 2) }}%</span> --}}
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
                        <div class="card-header">
                            <div class="d-flex justify-content-end">
                                <a href="{{ route('user.portfolio') }}?slot=7" class="btn btn-small btn-outline-primary mx-1 {{request('slot') == 7 ? 'active' : ''}}">7d</a>
                                <a href="{{ route('user.portfolio') }}" class="btn btn-small btn-outline-primary mx-1 {{request('slot') != 7 && !request('all') ? 'active' : ''}}">30d</a>
                                <a href="{{ route('user.portfolio') }}?all=1" class="btn btn-small btn-outline-primary mx-1 {{request('all') != null ? 'active' : ''}}">All</a>
                            </div>
                        </div>
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

            <div class="col-md-12">
            <div class="row">
                <div class="col m-2 border">
                    <h6 class="mt-3 mb-4">Average Holding Time</h6>
                    <div class="table table-responsive" style="height: 370px;">
                        <table class="table">
                            <thead>
                                <tr>
                                <th scope="col">Coin</th>
                                <th scope="col">Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                <td>MASK</td>
                                <td>less than a minute</td>
                                </tr>
                                <tr>
                                <td>CELT</td>
                                <td>less than a minute</td>
                                </tr>
                                <tr>
                                <td>TON</td>
                                <td>2 minutes</td>
                                </tr>
                                <tr>
                                <td>TON</td>
                                <td>2 minutes</td>
                                </tr>
                                <tr>
                                <td>GTO</td>
                                <td>2 minutes</td>
                                </tr>
                                <tr>
                                <td>NEAR</td>
                                <td>5 minutes</td>
                                </tr>
                                <tr>
                                <td>ETHW</td>
                                <td>5 minutes</td>
                                </tr>
                                <tr>
                                <td>YOU</td>
                                <td>21 minutes</td>
                                </tr>
                                <tr>
                                <td>SAITAMA</td>
                                <td>37 minutes</td>
                                </tr>
                                <tr>
                                <td>APM</td>
                                <td>1 hour</td>
                                </tr>
                                <tr>
                                <td>QOM</td>
                                <td>1 hour</td>
                                </tr>
                                <tr>
                                <td>PERP</td>
                                <td>1 hour</td>
                                </tr>
                                <tr>
                                <td>UMEE</td>
                                <td>3 hour</td>
                                </tr>
                                <tr>
                                <td>CSPR</td>
                                <td>5 hour</td>
                                </tr>
                                <tr>
                                <td>XETA</td>
                                <td>7 hour</td>
                                </tr>
                                <tr>
                                <td>CVX</td>
                                <td>13 hour</td>
                                </tr>
                                <tr>
                                <td>CMT</td>
                                <td>16 hour</td>
                                </tr>
                                <tr>
                                <td>DHT</td>
                                <td>1 day</td>
                                </tr>
                                <tr>
                                <td>MXC</td>
                                <td>1 day</td>
                                </tr>
                                <tr>
                                <td>SUSHI</td>
                                <td>1 day</td>
                                </tr>
                                <tr>
                                <td>KISHU</td>
                                <td>3 day</td>
                                </tr>
                                <tr>
                                <td>MITH</td>
                                <td>3 day</td>
                                </tr>
                                <tr>
                                <td>APE</td>
                                <td>3 day</td>
                                </tr>
                                <tr>
                                <td>HEGIC</td>
                                <td>4 day</td>
                                </tr>
                                <tr>
                                <td>PST</td>
                                <td>7 day</td>
                                </tr>
                                <tr>
                                <td>CTC</td>
                                <td>8 day</td>
                                </tr>
                                <tr>
                                <td>PHA</td>
                                <td>17 day</td>
                                </tr>
                                <tr>
                                <td>MDT</td>
                                <td>18 day</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col m-2 border">
                    <h6 class="mt-3 mb-4">Average Profit Per Coin</h6>
                    <div class="table table-responsive" style="height: 370px;">
                        <table class="table">
                            <thead>
                                <tr>
                                <th scope="col">Coin</th>
                                <th scope="col">Profit</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                <td>DNA</td>
                                <td>7108413.26 %</td>
                                </tr>
                                <tr>
                                <td>USDC</td>
                                <td>166.16 %</td>
                                </tr>
                                <tr>
                                <td>HEGIC</td>
                                <td>154.45 %</td>
                                </tr>
                                <tr>
                                <td>PHA</td>
                                <td>91.51 %</td>
                                </tr>
                                <tr>
                                <td>PST</td>
                                <td>51.33 %</td>
                                </tr>
                                <tr>
                                <td>SWFTC</td>
                                <td>38.11 %</td>
                                </tr>
                                <tr>
                                <td>MOVEZ</td>
                                <td>36.26 %</td>
                                </tr>
                                <tr>
                                <td>ERN</td>
                                <td>28.94 %</td>
                                </tr>
                                <tr>
                                <td>ZRX</td>
                                <td>23.90 %</td>
                                </tr>
                                <tr>
                                <td>SD</td>
                                <td>23.85 %</td>
                                </tr>
                                <tr>
                                <td>ACA</td>
                                <td>21.59 %</td>
                                </tr>
                                <tr>
                                <td>CLV</td>
                                <td>18.53 %</td>
                                </tr>
                                <tr>
                                <td>CHAT</td>
                                <td>17.51 %</td>
                                </tr>
                                <tr>
                                <td>WEMIX</td>
                                <td>13.25 %</td>
                                </tr>
                                <tr>
                                <td>PLG</td>
                                <td>13.16 %</td>
                                </tr>
                                <tr>
                                <td>AERGO</td>
                                <td>13.05 %</td>
                                </tr>
                                <tr>
                                <td>LDN</td>
                                <td>12.90 %</td>
                                </tr>
                                <tr>
                                <td>LAMB</td>
                                <td>12.73 %</td>
                                </tr>
                                <tr>
                                <td>CTC</td>
                                <td>12.56 %</td>
                                </tr>
                                <tr>
                                <td>SC</td>
                                <td>12.40 %</td>
                                </tr>
                                <tr>
                                <td>HBAR</td>
                                <td>12.36 %</td>
                                </tr>
                                <tr>
                                <td>USTC</td>
                                <td>12.32 %</td>
                                </tr>
                                <tr>
                                <td>UMEE</td>
                                <td>12.21 %</td>
                                </tr>
                                <tr>
                                <td>LOON</td>
                                <td>11.79 %</td>
                                </tr>
                                <tr>
                                <td>SUN</td>
                                <td>11.60 %</td>
                                </tr>
                                <tr>
                                <td>ONT</td>
                                <td>11.58 %</td>
                                </tr>
                                <tr>
                                <td>SRM </td>
                                <td>11.55 %</td>
                                </tr>
                                <tr>
                                <td>KNC</td>
                                <td>11.23 %</td>
                                </tr>
                                <tr>
                                <td>MATIC </td>
                                <td>11.18 %</td>
                                </tr>
                                <tr>
                                <td>BHP</td>
                                <td>11.16 %</td>
                                </tr>
                                <tr>
                                <td>YOU</td>
                                <td>11.13 %</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col m-2 border">
                    <h6 class="mt-3 mb-4">Most Traded Coin</h6>
                    <div class="table table-responsive" style="height: 370px;">
                        <table class="table">
                            <thead>
                                <tr>
                                <th scope="col">Coin</th>
                                <th scope="col">Trades</th>
                                <th scope="col">Percent</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                <td>BTC</td>
                                <td>1660</td>
                                <td>10.54%</td>
                                </tr>
                                <tr>
                                <td>ETH</td>
                                <td>1232</td>
                                <td>8.50%</td>
                                </tr>
                                <tr>
                                <td>SWFTC</td>
                                <td>332</td>
                                <td>5.30%</td>
                                </tr>
                                <tr>
                                <td>ADA</td>
                                <td>287</td>
                                <td>4.58%</td>
                                </tr>
                                <tr>
                                <td>LINK</td>
                                <td>257</td>
                                <td>4.10%</td>
                                </tr>
                                <tr>
                                <td>SOL</td>
                                <td>249</td>
                                <td>3.98%</td>
                                </tr>
                                <tr>
                                <td>FIL</td>
                                <td>202</td>
                                <td>3.23%</td>
                                </tr>
                                <tr>
                                <td>RVN</td>
                                <td>201</td>
                                <td>3.21%</td>
                                </tr>
                                <tr>
                                <td>EGLD</td>
                                <td>188</td>
                                <td>3.00%</td>
                                </tr>
                                <tr>
                                <td>YFI</td>
                                <td>179</td>
                                <td>2.86%</td>
                                </tr>
                                <tr>
                                <td>AAVE</td>
                                <td>159</td>
                                <td>2.54%</td>
                                </tr>
                                <tr>
                                <td>XRP</td>
                                <td>144</td>
                                <td>2.30%</td>
                                </tr>
                                <tr>
                                <td>AVAX</td>
                                <td>141</td>
                                <td>2.25%</td>
                                </tr>
                                <tr>
                                <td>LTC</td>
                                <td>137</td>
                                <td>2.19%</td>
                                </tr>
                                <tr>
                                <td>OKT</td>
                                <td>120</td>
                                <td>1.92%</td>
                                </tr>
                                <tr>
                                <td>ATOM</td>
                                <td>106</td>
                                <td>1.69%</td>
                                </tr>
                                <tr>
                                <td>AZY</td>
                                <td>104</td>
                                <td>1.66%</td>
                                </tr>
                                <tr>
                                <td>IOTA</td>
                                <td>102</td>
                                <td>1.63%</td>
                                </tr>
                                <tr>
                                <td>JST</td>
                                <td>77</td>
                                <td>1.23%</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    
                </div>
            </div>

            <div class="col-md-12">
                
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
        </div>
        <div class="col-md-4">
            <!-- <div class="row"> -->
                <div class="col-md-12">
                    <div class="card w-100">
                        <div class="card-body">
                            <div class="table">
                                <table class="table table-borderless">
                                    <h4>Current Holdings</h4>
                                    <tr class="text-" style="border: 0 !important;">
                                        <td colspan="4">Cash</td>
                                        @php
                                            $symbol = \App\Models\Currency::where('id', $user->currency_id)->get();
                                        @endphp
                                                

                                        <td class="float-end"> 
                                            @foreach($symbol as $sym) {{ $sym->symbol }} @endforeach {{ number_format($cash, 2) }}
                                        </td>
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
                                                case 'Properties': case 'Cash':
                                                    $color = '#deb2d2';
                                                    break;
                                                case 'Cryptocurrencies':
                                                    $color = '#6c96d3';
                                                    break;
                                                case 'ETF’S':
                                                    $color = '#ef6b6b';
                                                    break;
                                                case 'gold':
                                                    $color = '#69382c';
                                                    break;
                                                case 'Options':
                                                    $color = '#076262';
                                                    break;
                                                default:
                                                    $color = '#ffff00';
                                            }
                                        @endphp

                                        <tr class="text-" style="border: 0 !important;">
                                            <td colspan="4">{{ ucwords(str_replace('_', ' ', $asset->type)) }}</td>

                                            <td class="float-end">@foreach($symbol as $sym) {{ $sym->symbol }} @endforeach{{ number_format($asset->amount + $asset->ROI, 2) }}</td>
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
                <div class="col-md-12">
                    <!-- New Bots -->
                    @php
                                            
                            $copyBots = auth()->user()->copyBots;
                            $user = App\Models\User::find(auth()->id());
                        @endphp

                        <h5 class="mt-1 mb-2">Active Copy Bots</h5>
                        <div class="col-md-12 col-lg-10 order-md-1 mt-4">
                        @foreach($copyBots as $copyBot)
                            <div class="card-body mb-3" style="box-shadow: 0px 5px 15px rgba(0,0,0,0.1); border-radius: 20px;">
                                <div class="row border-bottom pb-1">
                                    <div class="col-2">
                                        <img style="border-radius: 999px; width: 50px; height: 50px;" class="bg-dark" src="{{ $copyBot->image }}" alt="" width="75">
                                    </div>
                                    <div class="col-10">
                                        <h5 class="m-0 p-0">{{ $copyBot->name }}</h5>
                                        <p class="m-0 p-0">From {{ $copyBot->creator }}</p>
                                    </div>
                                </div>
                                <div class="row mt-1">
                                    <div class="col-6">
                                        <h4 class="text-success">{{ $copyBot->yield }}</h4>
                                        <p>30D Yield</p>
                                    </div>
                                    <div class="col-6">
                                        <h4 class="text-dark">${{ number_format($copyBot->price) }}</h4>
                                        <p>Price</p>
                                    </div>
                                </div>
                                <div class="row mt-0">
                                    <div class="col-6">
                                        <h5 class="font-bold">{{ $copyBot->rate }}</h5>
                                        <p>Subscribe win rate</p>
                                    </div>
                                    <div class="col-6">
                                        <h5 class="font-bold">{{ $copyBot->aum }}</h5>
                                        <p>AMU (USDT)</p>
                                    </div>
                                </div>
                                <div class="row mt-1">
                                    <div class="col-6">

                                    </div>
                                    <div class="col-6">
                                        <a style="width: 130px; border-radius: 20px;" class="btn btn-md btn-success mx-1" href="javascript:void(0)">Active</a>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade" id="staticBackdrop-add-{{ $copyBot->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="staticBackdropLabel">Add Bot</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('user.bot.assign', $copyBot->id) }}" method="post">@csrf @method('PUT')
                                            <div class="modal-body">
                                                <p>Contact a third party signal provider for your bot configuration</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                <!-- <button type="submit" class="btn btn-success">Add</button> -->
                                            </div>
                                            <input type="hidden" name="copy_bot" value="{{ $copyBot->id }}">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        @if($copyBots->count() <= 0)
                            <div>
                                <p class="text-muted pt-4 pb-6">No Copy Bot Available...</p>
                            </div>
                        @endif
                        </div>
                </div>
            <!-- </div> -->
        </div>
    </div>

@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>

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

        $('input[type="radio"][name="formRadios"]').on('change', function() {
            if ($(this).is(':checked')) $('#cont-btn').attr('disabled', false)
        })

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

        // $('#datatable').DataTable()
        // console.log();
        const user = {!! json_encode(auth()->user()) !!};
        if (user['status'] === 'pending') $('#staticBackdrop-btn').click()

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
            if ($(id).val().length > 0) $('#crypto-amount').html((parseFloat($(id).val()) / parseFloat('{{ \App\Http\Controllers\Admin\AdminController::getBTC() }}')).toFixed(8) + ' BTC');
        }

        function calcEquivWithdraw(id) {
            if ($(id).val().length > 0) $('#crypto-amount-withdraw').html((parseFloat($(id).val()) / parseFloat('{{ \App\Http\Controllers\Admin\AdminController::getBTC() }}')).toFixed(8) +
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
