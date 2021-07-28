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
                <div class="float-end ms-2">
{{--                    <h5 class="font-size-14"><i class="bx bx-wallet text-primary font-size-16 align-middle me-1"></i> <a href="#!" class="text-reset text-decoration-underline">$4335.23</a></h5>--}}
                </div>
{{--                <h5 class="font-size-14 mb-4">Buy Coins</h5>--}}
                <h5 class="font-size-14 mb-4">Add Cash</h5>
                <div>
                    <div class="form-group mb-3">
                        <label>Payment method :</label>
                        <select class="form-select">
                            <option>Direct Bank Payment</option>
                            <option selected>Credit / Debit Card</option>
{{--                            <option>Paypal</option>--}}
{{--                            <option>Payoneer</option>--}}
{{--                            <option>Stripe</option>--}}
                        </select>
                    </div>

                    <div>
{{--                        <label>Add Amount :</label>--}}
{{--                        <div class="input-group mb-3">--}}
{{--                            <label class="input-group-text">Amount</label>--}}
{{--                            <select class="form-select" style="max-width: 90px;">--}}
{{--                                <option value="BT" selected>BTC</option>--}}
{{--                                <option value="ET">ETH</option>--}}
{{--                                <option value="LT">LTC</option>--}}
{{--                            </select>--}}
{{--                            <input type="text" class="form-control" placeholder="0.00121255">--}}
{{--                        </div>--}}

{{--                        <div class="input-group mb-3">--}}
{{--                            <label class="input-group-text">Price</label>--}}
{{--                            <input type="text" class="form-control" placeholder="$58,245">--}}
{{--                            <label class="input-group-text">$</label>--}}
{{--                        </div>--}}

                        <div class="input-group mb-3">
                            <label class="input-group-text">Amount</label>
                            <input type="text" class="form-control" placeholder="$36,854.25">
                        </div>
                    </div>

                    <div class="text-center">
                        <button type="button" class="btn btn-success w-md">Deposit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        // $('#datatable').DataTable()
    </script>
@endsection
