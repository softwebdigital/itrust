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

@section('content')
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
        <li>Account Name: {{ $setting['acct_name'] }}</li>
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
    <div class="card-body">

        <div class="border col-md-6 mb-3 p-2">
            <div class="tab-content">
                <div class="tab-pane active" id="buy-tab" role="tabpanel">
                    <button class="d-none" id="staticBackdrop-btn" data-bs-toggle="modal"
                        data-bs-target="#staticBackdrop"></button>
                    <div class="float-end ms-2">
                    </div>
                    <h5 class="font-size-14 mb-4">Add Cash</h5>
                    <form action="{{ route('user.deposit.store') }}" method="post" id="depositForm">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="method">Payment Method :</label>
                            <select class="form-select @error('method') is-invalid @enderror" name="method" id="method"
                                onchange="showMethod(this)">
                                <option value="">Select Payment Method</option>
                                <option value="bank" {{ old('method') == 'bank' ? 'selected' : '' }}>Direct Bank Payment
                                </option>
                                <option value="bitcoin" {{ old('method') == 'bitcoin' ? 'selected' : '' }}>Bitcoin</option>
                            </select>
                            @error('method') <strong class="text-danger" role="alert">{{ $message }}</strong> @enderror
                        </div>

                        <div style="display: none;" id="crypto-method">
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
                                            <p class="mt-3">{{ $user->btc_wallet }}</p>
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
                            <div class="text-center">
                                <button class="btn btn-success w-md" type="button" onclick="startDepositbtc()"  data-toggle="modal" data-target="#exampleModalCenterbtc">Request Deposit</button>
                            </div>
                        </div>
                        <div style="display: none" id="bank-method">
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <label class="input-group-text" for="amount">$</label>
                                    <input type="number" step="any" class="form-control @error('amount') is-invalid @enderror"
                                       id="bank_amount" required name="amount" value="{{ old('amount') }}" id="amount" placeholder="Amount">
                                </div>
                                @error('amount') <strong class="text-danger" role="alert">{{ $message }}</strong>
                                @enderror
                            </div>
                            <div class="card bg-light mt-2 mb-3">
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
                            </div>
                            <div class="text-center">
                                <button type="button" class="btn btn-success w-md" onclick="startDeposit()"  data-toggle="modal" data-target="#exampleModalCenterbank">Request Deposit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

<hr class="mt-2 mb-2">

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
                        {{ $transaction->status == 'declined' || $transaction->status == 'cancelled' ? 'bg-danger' : '' }}
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
        if ($(id).val().length > 0) $('#crypto-amount').html((parseFloat($(id).val()) / parseFloat('{{ \App\Http\Controllers\Admin\AdminController::getBTC() }}')).toFixed(8) + ' BTC');
    }

    function calcEquivWithdraw(id) {
        if ($(id).val().length > 0) $('#crypto-amount-withdraw').html((parseFloat($(id).val()) / parseFloat('{{ \App\Http\Controllers\Admin\AdminController::getBTC() }}')).toFixed(8) + ' BTC');
    }
    function submitForm(){

        document.getElementById("depositForm").submit();
    }

        // var note = document.getElementById('banknote').innerHtml;
        // note
</script>
@endsection
