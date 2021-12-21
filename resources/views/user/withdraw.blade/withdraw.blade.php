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

@section('content')
    <div class="card-body">

        <div class="border col-md-6 mb-3 p-2">
            <div class="tab-content">
                <div class="tab-pane active" id="buy-tab" role="tabpanel">
                    <button class="d-none" id="staticBackdrop-btn" data-bs-toggle="modal"
                        data-bs-target="#staticBackdrop"></button>
                    <div class="float-end ms-2">
                    </div>
                    <h5 class="font-size-14 mb-4">Withdraw Cash</h5>
                    <form action="{{ route('user.withdraw.store') }}" method="post">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="w_method">Withdrawal Method :</label>
                            <select class="form-select @error('w_method') is-invalid @enderror" name="w_method" id="w_method"
                                onchange="showMethodwithdraw(this)">
                                <option value="">Select Withdrawal Method</option>
                                <option value="bank" {{ old('w_method') == 'bank' ? 'selected' : '' }}>Direct Bank Payment
                                </option>
                                <option value="bitcoin" {{ old('w_method') == 'bitcoin' ? 'selected' : '' }}>Bitcoin</option>
                            </select>
                            @error('w_method') <strong class="text-danger" role="alert">{{ $message }}</strong> @enderror
                        </div>

                        <div style="display: none;" id="crypto-method-withdraw">
                            <label>Add Amount in USD:</label>
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <label class="input-group-text" for="w_amount"><strong>$</strong></label>
                                    <input type="number" id="w_amount" step="any" name="w_amount"
                                        value="{{ old('w_amount') }}"
                                        class="form-control @error('w_amount') is-invalid @enderror" placeholder="Amount"
                                        onkeyup="calcEquivWithdraw(this)">
                                </div>
                                @error('w_amount') <strong class="text-danger" role="alert">{{ $message }}</strong>
                                @enderror
                            </div>

                            <div class="form-group">
                                <div class="input-group mb-3">
                                    {{-- <label class="input-group-text" for="btc_wallet"><strong>$</strong></label> --}}
                                    <input type="text" id="btc_wallet" step="any" name="btc_wallet"
                                        value="{{ old('btc_wallet') }}"
                                        class="form-control @error('btc_wallet') is-invalid @enderror" placeholder="Btc Wallet"
                                        onkeyup="calcEquiv(this)">
                                </div>
                                @error('btc_wallet') <strong class="text-danger" role="alert">{{ $message }}</strong>
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
                                            <p id="crypto-amount-withdraw">0.00 BTC</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-success btn-block">Withdraw</button>
                            </div>
                        </div>
                        <div style="display: none" id="bank-method-withdraw">
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <label class="input-group-text" for="bank_amount">$</label>
                                    <input type="bank_amount" step="any" class="form-control @error('bank_amount') is-invalid @enderror"
                                        name="bank_amount" value="{{ old('bank_amount') }}" id="bank_amount" placeholder="Amount">
                                </div>
                                @error('bank_amount') <strong class="text-danger" role="alert">{{ $message }}</strong>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    {{-- <label class="input-group-text" for="bank_name">$</label> --}}
                                    <input type="text" step="any" class="form-control @error('bank_name') is-invalid @enderror"
                                        name="bank_name" value="{{ old('bank_name') }}" id="bank_name" placeholder="Bank Name">
                                </div>
                                @error('bank_name') <strong class="text-danger" role="alert">{{ $message }}</strong>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    {{-- <label class="input-group-text" for="acct_name">$</label> --}}
                                    <input type="text" step="any" class="form-control @error('acct_name') is-invalid @enderror"
                                        name="acct_name" value="{{ old('acct_name') }}" id="acct_name" placeholder="Account Name">
                                </div>
                                @error('acct_name') <strong class="text-danger" role="alert">{{ $message }}</strong>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    {{-- <label class="input-group-text" for="acct_no">$</label> --}}
                                    <input type="number" step="any" class="form-control @error('acct_no') is-invalid @enderror"
                                        name="acct_no" value="{{ old('acct_no') }}" id="acct_no" placeholder="Account Number">
                                </div>
                                @error('acct_no') <strong class="text-danger" role="alert">{{ $message }}</strong>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    {{-- <label class="input-group-text" for="acct_no">$</label> --}}
                                    {{-- <input type="number" step="any"
                                        name="acct_no" id="acct_no" placeholder="Account Number"> --}}
                                        <textarea name="info" class="form-control @error('acct_no') is-invalid @enderror" id="info" cols="30" rows="4" placeholder="Additional Info">{{ old('info') }}</textarea>
                                </div>
                                @error('acct_no') <strong class="text-danger" role="alert">{{ $message }}</strong>
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
                            <div class="text-center">
                                <button type="submit" class="btn btn-success w-md">Withdraw</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <hr class="mt-2 mb-2">



        <!-- Modal -->
        <div class="modal fade" id="exampleModalCenterbank" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                <li>Bank Name: {{ $setting['bank_name'] }}</li>
                <li>Account Number: {{ $setting['acct_name'] }}</li>
                <li>Account Number: {{ $setting['acct_no'] }}</li>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" onclick="submitForm()" class="btn btn-primary">Confirm</button>
                </div>
            </div>
            </div>
        </div>
        <div class="modal fade" id="exampleModalCenterbtc" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                <li>BTC Wallet: {{ $setting['btc_wallet'] }}</li>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" onclick="submitForm()" class="btn btn-primary">Confirm</button>
                </div>
            </div>
            </div>
        </div>
        <table id="datatable" class="table table-borderless table-striped table-responsive  nowrap w-100 mt-3">
            <thead>
            <tr>
                <th>Amount</th>
                <th>Method</th>
                <th>Status</th>
                {{-- <th>type</th> --}}
                <th>Date</th>
            </tr>
            </thead>

            <tbody>
            @foreach($transactions as $transaction)
                <tr>
                    <td>{{ $transaction->method == 'bank' ? '$'.number_format($transaction->amount, 2) : round($transaction->amount, 8).' BTC' }}</td>
                    <td>{{ $transaction->method ? ucwords($transaction->method) : '----' }}</td>
                    <td> <span class="badge
                                {{ $transaction->status == 'pending' ? 'bg-warning' : '' }}
                        {{ $transaction->status == 'declined' ? 'bg-danger' : '' }}
                        {{ $transaction->status == 'approved' ? 'bg-success' : '' }}
                            ">{{ ucwords($transaction->status) }}</td>
                    {{-- <td>{{ ucwords($transaction->type) }}</td> --}}
                    <td>{{ \Carbon\Carbon::make($transaction->created_at)->format('Y/m/d') }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

    </div>
@endsection

@section('script')
<script>
    function startDeposit(){
    var amount = document.getElementById('bank_amount').value
        $('#banknote').html(`
        <p>Please deposit to the account below</p>
                <p>Kindly make a deposit of $` + amount + ` to the
                Bank Details below</p>
                `);
    }
    function startDepositbtc(){
    var amount = document.getElementById('crypto-amount').innerText
        $('#btcnote').html(`
        <p>Please deposit to the account below</p>
                <p>Kindly make a deposit of ` + amount + ` to the
                BTC Address below</p>
                `);
    }
</script>
    <script>
        $('#datatable').DataTable({
            "order": [[ 3, "desc" ]]
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
        }
        else $('#crypto-method-withdraw').hide(500);
    }

    function calcEquiv(id) {
        if ($(id).val().length > 0) $('#crypto-amount').html((parseFloat($(id).val()) / 44000).toFixed(8) + ' BTC');
    }

    function calcEquivWithdraw(id) {
        if ($(id).val().length > 0) $('#crypto-amount-withdraw').html((parseFloat($(id).val()) / 44000).toFixed(8) + ' BTC');
    }
    function submitForm(){

        document.getElementById("depositForm").submit();
    }

        // var note = document.getElementById('banknote').innerHtml;
        // note
</script>
@endsection
