@extends('layouts.user')

@section('head')
    {{ __('Withdrawal') }}
@endsection

@section('title')
    {{ __('Withdrawal') }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('user.index') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Transactions</li>
@endsection

@php
    $user = \App\Models\User::find(auth()->id());
    $sym = \App\Models\Currency::where('id', $user->currency_id)->first();
@endphp

@section('content')
    <div class="modal fade" id="exampleModalCenterbank" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Confirm Withdrawal</h5>
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
                    {{-- <li>Bank Name: {{ $setting['bank_name'] }}</li>
                    <li>Account Number: {{ $setting['acct_name'] }}</li>
                    <li>Account Number: {{ $setting['acct_no'] }}</li> --}}
                    {{-- <br> --}}
                    {{-- <p>Deposits will be processed after we’ve confirmed your payment. Thank you!</p> --}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" onclick="submitFormBank()" class="btn btn-primary">Confirm</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModalCenterbtc" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Confirm Withdrawal</h5>
                    {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button> --}}
                </div>
                <div class="modal-body border p-3">
                    <div id="btcnote"></div>
                    <br>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" onclick="submitFormBtc()" class="btn btn-primary">Confirm</button>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">

        <div class="col-md-8">
            <div class="card w-100">
                <div class="card-body">
                    <div class="table">
                        <table class="table table-borderless">
                            
                            <tr class="text-" style="border: 0 !important;">
                                <td colspan="4"><h4>Available Cash Balance:</h4></td>
                                @php
                                    $symbol = \App\Models\Currency::where('id', $user->currency_id)->get();
                                @endphp
                                        

                                <td class="float-end"> 
                                    <h3 class="text-success text-bold">@foreach($symbol as $sym) {{ $sym->symbol }} @endforeach {{ number_format($cash, 2) }}</h3>
                                </td>
                            </tr>

                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8 order-md-1">
            <div class="card-body mb-3 border">
                <div class="row align-items-center reward" id="reward-1">
                    <div class="col">
                        <img src="{{ asset('svg/bank.png') }}" alt="" width="50">
                    </div>
                    <div class="col-10 align-self-center d-flex justify-content-between">
                        <div class="mt-4 mt-sm-0">
                            <p class="mb-1">Bank Withdrawal</p>
                            {{-- <h6>$250K Crypto Bonus.</h6> --}}
                        </div>
                        <div class="align-self-auto my-auto"><a href="javascript:void(0)" class="btn btn-primary" onclick="showReward(1)">Withdraw
                                Now <i class="mdi mdi-arrow-down"></i></a></div>
                    </div>
                </div>
                <div class="d-none reward-panel" id="reward-panel-1">
                    <div class="row align-items-center reward" id="">
                        <div class="col-2">
                            <img src="{{ asset('svg/bank.png') }}" alt="" width="50">
                        </div>
                        <div class="col-12">
                            <div class="mt-4 mt-sm-0">
                                <p class="mb-1 mt-2">Bank Withdrawal</p>
                                {{-- <h6>$250K Crypto Bonus.</h6> --}}
                            </div>
                            {{-- <div class="align-self-auto my-auto"><a href="javascript:void(0)" onclick="showReward(1)">Withdraw Now <i class="mdi mdi-arrow-down"></i></a></div> --}}
                            <form action="{{ route('user.withdraw.store') }}" method="post" id="withdrawFormBank">
                                @csrf
                                <input type="hidden" value="bank" name="w_method">
                                <div id="bank-method-withdraw">
                                    <div class="form-group">
                                        @if ($offshore != 0)
                                            <div class="form-group mb-3">
                                                <label for="acct_type">Account :</label>
                                                <select class="form-select @error('acct_type') is-invalid @enderror"
                                                    name="acct_type" id="acct_type">
                                                    <option value="">Select Account</option>
                                                    <option value="basic_ira">Basic IRA </option>
                                                    <option value="offshore"> Offshore Account </option>
                                                </select>
                                                @error('acct_type') <strong class="text-danger"
                                                    role="alert">{{ $message }}</strong> @enderror
                                            </div>
                                        @else
                                            <input type="hidden" name="acct_type" value="basic_ira">
                                        @endif
                                        <div class="input-group mb-3">
                                            <label class="input-group-text" for="bank_amount">{{ $sym->symbol }}</label>
                                            <input type="bank_amount" step="any"
                                                class="form-control @error('bank_amount') is-invalid @enderror"
                                                name="bank_amount" value="{{ old('bank_amount') }}" id="bank_amount"
                                                placeholder="Amount">
                                        </div>
                                        @error('bank_amount') <strong class="text-danger"
                                                role="alert">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group mb-3">
                                            {{-- <label class="input-group-text" for="bank_name">$</label> --}}
                                            <input type="text" step="any"
                                                class="form-control @error('bank_name') is-invalid @enderror"
                                                name="bank_name" value="{{ old('bank_name') }}" id="bank_name"
                                                placeholder="Bank Name">
                                        </div>
                                        @error('bank_name') <strong class="text-danger"
                                                role="alert">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group mb-3">
                                            {{-- <label class="input-group-text" for="acct_name">$</label> --}}
                                            <input type="text" step="any"
                                                class="form-control @error('acct_name') is-invalid @enderror"
                                                name="acct_name" value="{{ old('acct_name') }}" id="acct_name"
                                                placeholder="Account Name">
                                        </div>
                                        @error('acct_name') <strong class="text-danger"
                                                role="alert">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group mb-3">
                                            {{-- <label class="input-group-text" for="acct_no">$</label> --}}
                                            <input type="number" step="any"
                                                class="form-control @error('acct_no') is-invalid @enderror" name="acct_no"
                                                value="{{ old('acct_no') }}" id="acct_no" placeholder="Account Number">
                                        </div>
                                        @error('acct_no') <strong class="text-danger"
                                                role="alert">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group mb-3">
                                            {{-- <label class="input-group-text" for="acct_no">$</label> --}}
                                            {{-- <input type="number" step="any"
                                                name="acct_no" id="acct_no" placeholder="Account Number"> --}}
                                            <textarea name="info"
                                                class="form-control @error('acct_no') is-invalid @enderror" id="info"
                                                cols="30" rows="4"
                                                placeholder="Additional Info">{{ old('info') }}</textarea>
                                        </div>
                                        @error('acct_no') <strong class="text-danger"
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
                                                    <p class="mt-3">Test Bank</p>
                                                </div>
                                                <div class="col-4">
                                                    <p><strong>Account Number:</strong></p>
                                                </div>
                                                <div class="col-8">
                                                    <p>3367252168</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}
                                    <div class="text-center d-grid gap-2">
                                        <button type="button" class="btn btn-success w-md" onclick="startWithdrawal()"
                                            data-toggle="modal" data-target="#exampleModalCenterbank">Request
                                            Withdraw</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
            <div class="card-body mb-3 border">
                <div class="row align-items-center reward" id="reward-2">
                    <div class="col">
                        <img src="{{ asset('svg/new_btc.svg') }}" alt="" width="50">
                    </div>
                    <div class="col-10 align-self-center d-flex justify-content-between">
                        <div class="mt-4 mt-sm-0">
                            <p class="mb-1">Cryptocurrency</p>
                            {{-- <h6>Get a free stock. Limitations apply</h6> --}}
                        </div>
                        <div class="align-self-auto my-auto"><a href="javascript:void(0)" class="btn btn-primary" onclick="showReward(2)">Withdraw
                                Now <i class="mdi mdi-arrow-down"></i></a></div>
                    </div>
                </div>
                <div class="d-none reward-panel" id="reward-panel-2">
                    <div class="row align-items-center reward">
                        <div class="col-2">
                            <img src="{{ asset('svg/new_btc.svg') }}" alt="" width="50">
                        </div>
                        <div class="col-12">
                            <div class="mt-4 mt-sm-0">
                                <p class="mb-1 mt-2">Cryptocurrency</p>
                                {{-- <h6>Get a free stock. Limitations apply</h6> --}}
                            </div>
                            {{-- <div class="align-self-auto my-auto"><a href="javascript:void(0)" onclick="showReward(2)">Withdraw Now <i class="mdi mdi-arrow-down"></i></a></div> --}}
                            <form action="{{ route('user.withdraw.store') }}" method="post" id="withdrawFormBtc">
                                @csrf
                                <input type="hidden" value="bitcoin" name="w_method">
                                <div id="crypto-method-withdraw">
                                    {{-- <p class="mb-1">Cryptocurrency</p> --}}
                                    <label>Add Amount in {{ $sym->name }}:</label>
                                    <div class="form-group">
                                        @if($offshore != 0)
                                        <div class="form-group mb-3">
                                            <label for="acct_type">Account :</label>
                                            <select class="form-select @error('acct_type') is-invalid @enderror" name="acct_type"
                                                id="acct_type">
                                                <option value="">Select Account</option>
                                                <option value="basic_ira">Basic IRA </option>
                                                <option value="offshore"> Offshore Account </option>
                                            </select>
                                            @error('acct_type') <strong class="text-danger"
                                                role="alert">{{ $message }}</strong> @enderror
                                        </div>
                                        @else
                                        <input type="hidden" name="acct_type" value="basic_ira">
                                        @endif
                                        <div class="input-group mb-3">
                                            <label class="input-group-text" for="w_amount">
                                                <select class="form-select @error('info') is-invalid @enderror" name="info" id="w_info">
                                                    <option value="BTC">BTC</option>
                                                    <option value="ETH">ETH</option>
                                                    <option value="USDT"> USDT </option>
                                                </select>
                                            </label>
                                            <input type="number" id="w_amount" step="any" name="w_amount"
                                                value="{{ old('w_amount') }}"
                                                class="form-control @error('w_amount') is-invalid @enderror"
                                                placeholder="Amount in USD ($)" onkeyup="calcEquivWithdraw(this)">
                                        </div>
                                        @error('w_amount') <strong class="text-danger"
                                                role="alert">{{ $message }}</strong>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <div class="input-group mb-3">
                                            {{-- <label class="input-group-text" for="btc_wallet"><strong>{{ $sym->symbol }}</strong></label> --}}
                                            <input type="text" id="btc_wallet" step="any" name="btc_wallet"
                                                value="{{ old('btc_wallet') }}"
                                                class="form-control @error('btc_wallet') is-invalid @enderror"
                                                placeholder="Wallet Address" onkeyup="calcEquiv(this)">
                                        </div>
                                        @error('btc_wallet') <strong class="text-danger"
                                                role="alert">{{ $message }}</strong>
                                        @enderror
                                    </div>

                                    <div class="card bg-light mt-2 mb-3">
                                        <div class="container-fluid">
                                            <div class="row">
                                                <div class="col-4">
                                                    {{-- <p class="mt-3"><strong>Wallet Address:</strong></p> --}}
                                                </div>
                                                <div class="col-8">
                                                    {{-- <p class="mt-3">{{ Auth()->user()->btc_wallet ?? '67hds67e6787wedgie38e87dcy' }}</p> --}}
                                                </div>
                                                <div class="col-4">
                                                    <p><strong>Amount:</strong></p>
                                                </div>
                                                <div class="col-8">
                                                    <p id="crypto-amount-withdraw">0.00</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-center d-grid gap-2">
                                        <button type="button" class="btn btn-success btn-block"
                                            onclick="startWithdrawalbtc()" data-toggle="modal"
                                            data-target="#exampleModalCenterbtc">Request Withdraw
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>

        </div>



        <!-- Modal -->

        <div class="table-responsive">
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
                            Offshore
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
                                @if($transaction->type == 'payout')   
                        <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-dark btn-sm dropdown-toggle dropdown-toggle-split" id="dropdownMenuReference1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-reference="parent">
                                    <span>Menu </span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down">
                                        <polyline points="6 9 12 15 18 9"></polyline>
                                    </svg>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuReference1">
                                    <a class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#staticBackdrop-view-{{ $transaction->id }}">View Payout</a>
                                    @if($transaction->status == 'pending') 
                                        <a class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#staticBackdrop-cancel-{{ $transaction->id }}">Cancel Payout</a>
                                    @endif
                                </div>
                            </div>
                        </td>
                        @endif
                        <div class="modal fade" id="staticBackdrop-cancel-{{ $transaction->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel">Confirm Cancellation</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('user.transaction.cancel', [$transaction->id, 'cancelled']) }}" method="post">@csrf @method('PUT')
                                        <div class="modal-body">
                                            <p>Are you sure you want to Cancel this payout?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Approve</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="staticBackdrop-view-{{ $transaction->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel">Payout Preview</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">

                                        @if($transaction->method == 'bank')
                                        <div class="form-group">
                                            <label for="">Amount</label>
                                            <input type="text" class="form-control-plaintext" value="${{ $transaction->amount ?? '-----' }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Bank Name</label>
                                            <input type="text" class="form-control-plaintext" value="{{ $transaction->bank_name ?? '-----' }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Account Name</label>
                                            <input type="text" class="form-control-plaintext" value="{{ $transaction->acct_name ?? '-----' }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Account Number</label>
                                            <input type="text" class="form-control-plaintext" value="{{ $transaction->acct_no ?? '-----' }}">
                                        </div>
                                        @else
                                        <div class="form-group">
                                            <label for="">Amount</label>
                                            <input type="text" class="form-control-plaintext" value="{{ $transaction->amount.'($'.$transaction->actual_amount.')' ?? '-----' }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="">BTC Wallet</label>
                                            <input type="text" class="form-control-plaintext" value="{{ $transaction->btc_wallet ?? '-----' }}">
                                        </div>
                                        @endif
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

    </div>
@endsection

@section('script')
    <script>
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
        function startWithdrawal() {
            var amount = document.getElementById('bank_amount').value;
            var bank_name = document.getElementById('bank_name').value;
            var acct_name = document.getElementById('acct_name').value;
            var acct_no = document.getElementById('acct_no').value;
            console.log(amount, bank_name, acct_no, acct_name);
            $('#banknote').html(`
        <p>Please confirm your withdrawal to the account below</p>
                <li>Bank Name: ` + bank_name + `</li>
                    <li>Account Name:  ` + acct_name + `</li>
                    <li>Account Number:  ` + acct_no + `</li>
                `);
        }

        function startWithdrawalbtc() {
            var amount = document.getElementById('w_amount').value;
            var btc_wallet = document.getElementById('btc_wallet').value;
            var wallet = document.getElementById('w_info').value;
            <?php echo 'var currencySymbol = "' . $sym['symbol'] . '";'; ?>
            console.log(amount);
            $('#btcnote').html(`
        <p>Please confirm your withdrawal to the ` + wallet + ` Address below</p>
        <li>Amount: `+ currencySymbol + amount + `</li>
        <li> ` + wallet + ` Wallet:  ` + btc_wallet + `</li>
                `);
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
            if ($(id).val().length > 0) $('#crypto-amount').html((parseFloat($(id).val()) / parseFloat('{{ \App\Http\Controllers\Admin\AdminController::getBTC() }}')).toFixed(8) + ' BTC');
        }

        function calcEquivWithdraw(id) {
            // if ($(id).val().length > 0) $('#crypto-amount-withdraw').html((parseFloat($(id).val()) / parseFloat('{{ \App\Http\Controllers\Admin\AdminController::getBTC() }}')).toFixed(8) +
            //     ' BTC');
            <?php echo 'var currencySymbol = "' . $sym['symbol'] . '";'; ?>

            if ($(id).val().length > 0) $('#crypto-amount-withdraw').html((parseFloat($(id).val()) ));
        }

        function submitFormBank() {

            document.getElementById("withdrawFormBank").submit();
        }

        function submitFormBtc() {

            document.getElementById("withdrawFormBtc").submit();
        }

        // var note = document.getElementById('banknote').innerHtml;
        // note
    </script>
@endsection
