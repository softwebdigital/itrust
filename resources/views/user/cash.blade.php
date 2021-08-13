@extends('layouts.user')

@section('head')
    {{ __('Cash') }}
@endsection

@section('title')
    {{ __('Cash') }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('user.index') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Cash</li>
@endsection

@section('content')
    <div class="card-body border col-md-6">
        <div class="tab-content">
            <div class="tab-pane active" id="buy-tab" role="tabpanel">
                <button class="d-none" id="staticBackdrop-btn" data-bs-toggle="modal" data-bs-target="#staticBackdrop"></button>
                <div class="float-end ms-2">
{{--                    <h5 class="font-size-14"><i class="bx bx-wallet text-primary font-size-16 align-middle me-1"></i> <a href="#!" class="text-reset text-decoration-underline">$4335.23</a></h5>--}}
                </div>
{{--                <h5 class="font-size-14 mb-4">Buy Coins</h5>--}}
                <h5 class="font-size-14 mb-4">Add Cash</h5>
                <form action="{{ route('user.deposit.store') }}" method="post">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="method">Payment Method :</label>
                        <select class="form-select @error('method') is-invalid @enderror" name="method" id="method" onchange="showMethod(this)">
                            <option value="">Select Payment Method</option>
                            <option value="bank" {{ old('method') == 'bank' ? 'selected' : '' }}>Direct Bank Payment</option>
                            <option value="bitcoin" {{ old('method') == 'bitcoin' ? 'selected' : '' }}>Bitcoin</option>
                        </select>
                        @error('method') <strong class="text-danger" role="alert">{{ $message }}</strong> @enderror
                    </div>

                    <div style="display: none;" id="crypto-method">
                        <label>Add Amount in USD:</label>
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <label class="input-group-text" for="amount"><strong>$</strong></label>
                                <input type="number" id="amount" step="any" name="btc_amount" value="{{ old('btc_amount') }}" class="form-control @error('amount') is-invalid @enderror" placeholder="Amount" onkeyup="calcEquiv(this)">
                            </div>
                            @error('amount') <strong class="text-danger" role="alert">{{ $message }}</strong> @enderror
                        </div>

                        <div class="card bg-light mt-2 mb-3">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-4"><p class="mt-3"><strong>Wallet Address:</strong></p></div>
                                    <div class="col-8"><p class="mt-3">67hds67e6787wedgie38e87dcy</p></div>
                                    <div class="col-4"><p><strong>Amount:</strong></p></div>
                                    <div class="col-8"><p id="crypto-amount">0.00 BTC</p></div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-success w-md">Deposit</button>
                        </div>
                    </div>
                    <div style="display: none" id="bank-method">
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <label class="input-group-text" for="amount">$</label>
                                <input type="number" step="any" class="form-control @error('amount') is-invalid @enderror" name="amount" value="{{ old('amount') }}" id="amount" placeholder="Amount">
                            </div>
                            @error('amount') <strong class="text-danger" role="alert">{{ $message }}</strong> @enderror
                        </div>
                        <div class="card bg-light mt-2 mb-3">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-4"><p class="mt-3"><strong>Bank Name:</strong></p></div>
                                    <div class="col-8"><p class="mt-3">Test Bank</p></div>
                                    <div class="col-4"><p><strong>Account Number:</strong></p></div>
                                    <div class="col-8"><p>3367252168</p></div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-success w-md">Deposit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Info</h5>
                </div>
                <div class="modal-body">
                    <p>Your account is pending approval, please make sure you have verified your identity</p>
                </div>
                <div class="modal-footer">
                    <a type="button" href="{{ route('user.portfolio') }}" class="btn btn-primary">Ok</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        // $('#datatable').DataTable()
        const user = {!! json_encode(auth()->user()) !!};
        if (user['status'] === 'pending') $('#staticBackdrop-btn').click()

        console.log({!! json_encode(session()) !!})
        const validation = {!! json_encode(session('validation')) !!};
        const method = {!! json_encode(session('method')) !!};

        if (validation) {
            if (method) {
                if (method === 'bank') $('#bank-method').show(500);
                else if (method === 'bitcoin') $('#crypto-method').show(500);
                else {
                    $('#crypto-method').hide(500);
                    $('#bank-method').hide(500);
                }
            }
        }

        function showMethod(id) {
            const value = $(id).val()
            if (value === 'bank') $('#bank-method').show(500); else $('#bank-method').hide(500);
            if (value === 'bitcoin') $('#crypto-method').show(500); else $('#crypto-method').hide(500);
        }

        function calcEquiv(id) {
            if ($(id).val().length > 0) $('#crypto-amount').html((parseFloat($(id).val()) / 44000).toFixed(8) + ' BTC');
        }
    </script>
@endsection
