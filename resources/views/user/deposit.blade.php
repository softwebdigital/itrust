@extends('layouts.user')

@section('head')
    {{ __('Deposit') }}
@endsection

@section('title')
    {{ __('Deposits') }}
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
    <div class="card-body">

    <div class="col-md-8">
            <div class="card w-100">
                <div class="card-body">
                    <div class="table">
                        <table class="table table-borderless">
                            
                            <tr class="text-" style="border: 0 !important;">
                                <td colspan="4"><h4>Total Deposit:</h4></td>
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
                            <p class="mb-1">Bank Deposit</p>
                            {{-- <h6>$250K Crypto Bonus.</h6> --}}
                        </div>
                        <div class="align-self-auto my-auto"><a href="javascript:void(0)" class="btn btn-primary" onclick="showReward(1)">Deposit
                                Now <i class="mdi mdi-arrow-down"></i></a></div>
                    </div>
                </div>
                <div class="d-none reward-panel" id="reward-panel-1">
                    <div class="col">
                        <img src="{{ asset('svg/bank.png') }}" alt="" width="50">
                        <h5 class="font-size-14 mb-2 mt-2">Add Cash (Bank Deposit)</h5>
                    </div>

                    <form action="{{ route('user.deposit.store') }}" method="post" id="depositFormBank">
                        @csrf
                        <input type="hidden" value="bank" name="method">
                        <div id="bank-method">
                            <div class="form-group">
                                @if($offshore != 0)
                                <div class="form-group mb-3">
                                    <label for="acct_type">Account :</label>
                                    <select class="form-select @error('acct_type') is-invalid @enderror" name="acct_type"
                                        id="acct_type">
                                        <option value="">Select Account</option>
                                        <option value="basic_ira" {{ old('acct_type') == 'basic_ira' ? 'selected' : '' }}>Basic IRA </option>
                                        <option value="offshore" {{ old('acct_type') == 'offshore' ? 'selected' : '' }}> Offshore Account </option>
                                    </select>
                                    @error('acct_type') <strong class="text-danger"
                                        role="alert">{{ $message }}</strong> @enderror
                                </div>
                                @else
                                <input type="hidden" name="acct_type" value="basic_ira">
                                @endif
                                <div class="input-group mb-3">
                                    <label class="input-group-text" for="amount">{{ $sym->symbol }}</label>
                                    <input type="number" step="any"
                                        class="form-control @error('amount') is-invalid @enderror" id="bank_amount" required
                                        name="amount" value="{{ old('amount') }}" id="amount" placeholder="Amount">
                                </div>
                                @error('amount') <strong class="text-danger" role="alert">{{ $message }}</strong>
                                @enderror
                            </div>
                            <div class="text-center d-grid gap-2">
                                <button type="button" class="btn btn-success w-md" onclick="startDeposit()"
                                    data-toggle="modal" data-target="#exampleModalCenterbank">Request Deposit</button>
                            </div>
                        </div>
                    </form>
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
                        <div class="align-self-auto my-auto"><a href="javascript:void(0)" class="btn btn-primary" onclick="showReward(2)">Deposit
                                Now <i class="mdi mdi-arrow-down"></i></a></div>
                    </div>
                </div>
                <div class="d-none reward-panel" id="reward-panel-2">
                    <div class="col mb-3">
                        <img src="{{ asset('svg/new_btc.svg') }}" alt="" width="50">
                        {{-- <p class="mb-1">Bitcoin</p> --}}
                    </div>
                    <h5 class="font-size-14 mb-4">Add Cash (Cryptocurrency)</h5>
                    <form action="{{ route('user.deposit.store') }}" method="post" id="depositFormBtc">
                        @csrf
                        <!-- <input type="hidden" value="bitcoin" name="method"> -->

                        <label for="method">Cryptocurrency :</label>
                        <select class="form-select @error('method') is-invalid @enderror" name="method"
                            id="method">
                            <option value="">Select Account</option>
                            <option value="btc" {{ old('method') == 'btc' ? 'selected' : '' }}>BTC</option>
                            <option value="eth" {{ old('method') == 'eth' ? 'selected' : '' }}>ETH</option>
                            <option value="usdt_trc20" {{ old('method') == 'usdt_trc20' ? 'selected' : '' }}>USDT (TRC20)</option>
                            <option value="usdt_erc20" {{ old('method') == 'usdt_erc20' ? 'selected' : '' }}>USDT (ERC20)</option>
                            <!-- <option value="usdt_eth" {{ old('method') == 'usdt_eth' ? 'selected' : '' }}>USDT (ETH)</option> -->
                        </select>

                        @error('method')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        <div id="crypto-method">
                            <!-- <label>Add Amount in {{ $sym->name }}:</label> -->
                            <div class="form-group">
                                @if($offshore != 0)
                                <div class="form-group mb-3">
                                    <label for="acct_type">Account :</label>
                                    <select class="form-select @error('acct_type') is-invalid @enderror" name="acct_type"
                                        id="acct_type">
                                        <option value="">Select Account</option>
                                        <option value="basic_ira" {{ old('acct_type') == 'basic_ira' ? 'selected' : '' }}>Basic IRA </option>
                                        <option value="offshore" {{ old('acct_type') == 'offshore' ? 'selected' : '' }}> Offshore Account </option>
                                    </select>
                                    @error('acct_type') <strong class="text-danger"
                                        role="alert">{{ $message }}</strong> @enderror
                                </div>
                                @else
                                <input type="hidden" name="acct_type" value="basic_ira">
                                @endif
                                <div class="input-group mb-3">
                                    <label class="input-group-text" for="amount"><strong>{{ $sym->symbol }}</strong></label>
                                    <input type="number" id="crypto_amount" step="any" name="btc_amount"
                                        value="{{ old('btc_amount') }}"
                                        class="form-control @error('amount') is-invalid @enderror" placeholder="Amount"
                                        onkeyup="calcEquiv(this), changeMsg()">
                                </div>
                                @error('amount') <strong class="text-danger" role="alert">{{ $message }}</strong>
                                @enderror
                            </div>


                            <div class="card bg-light mt-2 mb-3">
                                <div class="container-fluid">
                                    <div class="row mt-4 mb-4">
                                        <div class="row m-auto mx-5 my-5">
                                            <div class="col-4">
                                                <img src="{{ asset('svg/new_btc.svg') }}" alt="" width="60">
                                            </div>
                                            <div class="col-4">
                                                <img src="https://cdn-icons-png.flaticon.com/512/6001/6001368.png" alt="" width="60">
                                            </div>
                                            <div class="col-4">
                                                <img src="https://seeklogo.com/images/T/tether-usdt-logo-FA55C7F397-seeklogo.com.png" alt="" width="60">
                                            </div>
                                        </div>
                                        <div class="col-12 text-center">
                                            <h6>Please send <span id="msgBox" style="font-weight: 100;"></span> to any of your deposit address below before requesting a deposit</h6>
                                        </div>
                                        <div class="col-12 text-center mt-2">
                                            <h6>BTC</h6>
                                            <h6>{{ $user['btc_wallet'] ?? '' }}</h6>
                                        </div>
                                        <div class="col-12 text-center mt-2">
                                            <h6>ETH </h6>
                                            <h6>{{ $user['eth_wallet'] ?? '' }}</h6>
                                        </div>
                                        <div class="col-12 text-center mt-2">
                                            <h6>USDT (TRC20)</h6>
                                            <h6>{{ $user['usdt_trc_20'] ?? '' }}</h6>
                                        </div>
                                        <div class="col-12 text-center mt-2">
                                            <h6>USDT (ERC20)</h6>
                                            <h6>{{ $user['usdt_erc_20'] ?? '' }}</h6>
                                        </div>
                                        <!-- <div class="col-12 text-center mt-2">
                                            <h6>USDT (ETH)</h6>
                                            <h6>{{ $user['usdt_eth'] ?? '' }}</h6>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                            <div class="text-center d-grid gap-2">
                                <button class="btn btn-success w-md" type="button" onclick="startDepositbtc()"
                                    data-toggle="modal" data-target="#exampleModalCenterbtc">Request Deposit</button>
                            </div>
                        </div>
                        <div style="display: none" id="bank-method">
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <label class="input-group-text" for="amount">{{ $sym->symbol }}</label>
                                    <input type="number" step="any"
                                        class="form-control @error('amount') is-invalid @enderror" id="bank_amount" required
                                        name="amount" value="{{ old('amount') }}" id="amount" placeholder="Amount">
                                </div>
                                @error('amount') <strong class="text-danger" role="alert">{{ $message }}</strong>
                                @enderror
                            </div>
                            {{-- <div class="card bg-light mt-2 mb-3">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-4">
                                            <p class="mt-3"><strong>Bank Name:</strong></p>
                                        </div>
                                        <div class="col-8">
                                            <p class="mt-3">{{ $setting['bank_name'] }}</p>
                                        </div>
                                        <div class="col-4">
                                            <p><strong>Account Number:</strong></p>
                                        </div>
                                        <div class="col-8">
                                            <p>{{ $setting['acct_no'] }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                            <div class="text-center d-grid gap-2">
                                <button type="button" class="btn btn-success w-md" onclick="startDeposit()"
                                    data-toggle="modal" data-target="#exampleModalCenterbank">Request Deposit</button>
                            </div>
                        </div>
                    </form>
                    <div class="mx-4">
                        {{-- <a href="javascript:void(0)" class="float-end" onclick="showLess(2)">View less <i
                                class="mdi mdi-arrow-up"></i></a> --}}
                        <div class="d-flex justify-content-between align-items-center mb-4 mt-4">
                            {{-- <button class="btn btn-success d-none btn-block px-4">Share Link</button> --}}
                        </div>
                    </div>
                </div>
            </div>

        </div>

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
