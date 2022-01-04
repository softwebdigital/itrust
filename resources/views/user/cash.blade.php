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
<style>
    button{
        width: 100%;
    }
</style>
    {{-- <div class="card-body border col-md-6 mb-3">
        <div class="tab-content">
            <div class="tab-pane active" id="buy-tab" role="tabpanel">
                <h5 class="font-size-14 mb-4 float-start">Add Cash</h5>
                <button onclick="location.href='{{ route('user.deposit') }}';" class="btn btn-primary" id="staticBackdrop-btn" data-bs-toggle="modal"
                    data-bs-target="#staticBackdrop">Deposit</button>

            </div>
        </div>
    </div>
    <br><br><br>
    <div class="card-body border col-md-6">
        <div class="tab-content">
            <div class="tab-pane active" id="buy-tab" role="tabpanel">
                <h5 class="font-size-14 mb-4 float-start">Withdraw Cash</h5>
                <button onclick="location.href='{{ route('user.withdraw') }}';" class="btn btn-secondary" id="staticBackdrop-btn" data-bs-toggle="modal"
                    data-bs-target="#staticBackdrop">Withdraw</button>

            </div>
        </div>
    </div> --}}


    <div class="col-md-8 order-md-1">
        <div class="card-body mb-3 border">
            <div class="row align-items-center reward" id="reward-1">
                <div class="col">
                    <img src="{{ asset('svg/deposit_new.jpg') }}" alt="" width="70">
                </div>
                <div class="col-10 align-self-center d-flex justify-content-between">
                    <div class="mt-4 mt-sm-0">
                        <p class="mb-1">Add Cash</p>
                        <h6>Deposit cash via Bank or Cryptocurrencies.</h6>
                    </div>
                    <div class="align-self-auto my-auto" style="font-weight: bolder;"><a href="{{ route('user.deposit') }}" class="btn btn-primary" onclick="showReward(1)">Deposit <i class="mdi mdi-arrow-right"></i></a></div>
                </div>
            </div>
        </div>
        <div class="card-body mb-3 border">
            <div class="row align-items-center reward" id="reward-2">
                <div class="col">
                    <img src="{{ asset('svg/add_money.webp') }}" alt="" width="70">
                </div>
                <div class="col-10 align-self-center d-flex justify-content-between">
                    <div class="mt-4 mt-sm-0">
                        <p class="mb-1">Withdrawal</p>
                        <h6>Withdraw funds from your portfolio to your personal Bank Account or Crypto wallet.</h6>
                    </div>
                    <div class="align-self-auto my-auto" style="font-weight: bolder;"><a href="{{ route('user.withdraw') }}" class="btn btn-primary" onclick="showReward(2)">Withdraw <i class="mdi mdi-arrow-right"></i></a></div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
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
    </script>
@endsection
