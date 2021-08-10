@extends('layouts.user')

@section('head')
    {{ __('Rewards') }}
@endsection

@section('title')
    {{ __('Rewards') }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('user.index') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Rewards</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-4 order-md-2">
            <div class="card">
                <div class="card-header"><strong>Your referral link</strong></div>
                <div class="card-body">
                    <input type="text" name="" readonly class="form-control mb-3" value="gbjhrfdrffjyfejdgukjhbfneklfnhkd" id="">
                    <button class="btn btn-success btn-block w-100">Copy link</button>
                    <hr>
                    <button class="btn btn-info w-100"><i class="icon-sm" style="margin-right: 8px" data-feather="twitter"></i>Share on Twitter</button>
                </div>
                <div class="card-footer" style="background: inherit">
                    <p>Stock referral rewards limited to $500 total per user per year</p>
                </div>
            </div>
        </div>
        <div class="col-md-8 order-md-1">
            <div class="card-body mb-3 border">
                <div class="row align-items-center reward" id="reward-1">
                    <div class="col">
                        <img src="{{ asset('svg/undraw_Gifts_re_97j6.svg') }}" alt="" width="75">
                    </div>
                    <div class="col-10 align-self-center d-flex justify-content-between">
                        <div class="mt-4 mt-sm-0">
                            <p class="mb-1">Offered by {{ env('APP_NAME') }} Investments.</p>
                            <h6>Get a free stock. Limitations apply</h6>
                        </div>
                        <div class="align-self-auto my-auto"><a href="javascript:void(0)" onclick="showReward(1)">Learn more <i class="mdi mdi-arrow-down"></i></a></div>
                    </div>
                </div>
                <div class="d-none reward-panel" id="reward-panel-1">
                    <h5>Invite a friend. Get a free stock</h5>
                    <p>Invite friends to Itrust Investment. Once they sign up and link their bank account, you’ll both get a free stock.</p>
                    <div class="mb-2 d-flex justify-content-center">
                        <img src="{{ asset('svg/undraw_Gifts_re_97j6.svg') }}" class="align-self-center" alt="" width="280">
                    </div>
                    <div class="row align-items-center mt-4">
                        <div class="col-2">
                            <img src="{{ asset('svg/star.svg') }}" alt="" width="50">
                        </div>
                        <div class="col-10 align-self-center d-flex justify-content-between">
                            <div class="mt-4 mt-sm-0">
                                <h6>100% chance to get a free stock</h6>
                                <p class="mb-1">Each time a friend signs up and deposit account, a new stock appears in your account (up to $1000). Certain limitations apply.</p>
                            </div>
                        </div>
                    </div>
                    <div class="row align-items-center mt-4">
                        <div class="col-2">
                            <img src="{{ asset('svg/star.svg') }}" alt="" width="50">
                        </div>
                        <div class="col-10 align-self-center d-flex justify-content-between">
                            <div class="mt-4 mt-sm-0">
                                <h6>Unlimited invites</h6>
                                <p class="mb-1">Invite as many friends as you want and receive up to $1000 in free stocks.</p>
                            </div>
                        </div>
                    </div>
                    <div class="mx-4">
                        <div class="d-flex justify-content-between align-items-center mb-4 mt-4">
                            <button class="btn btn-success btn-block px-4">Share Link</button>
                            <a href="javascript:void(0)" class="" onclick="showLess(1)">View less <i class="mdi mdi-arrow-up"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body mb-3 border">
                <div class="row align-items-center reward" id="reward-2">
                    <div class="col">
                        <img src="{{ asset('svg/btc.svg') }}" alt="" width="75">
                    </div>
                    <div class="col-10 align-self-center d-flex justify-content-between">
                        <div class="mt-4 mt-sm-0">
                            <p class="mb-1">Expires 21/07/2021. Offered by {{ env('APP_NAME') }} Investments.</p>
                            <h6>$250K Crypto Bonus.</h6>
                        </div>
                        <div class="align-self-auto my-auto"><a href="javascript:void(0)" onclick="showReward(2)">Learn more <i class="mdi mdi-arrow-down"></i></a></div>
                    </div>
                </div>
                <div class="d-none reward-panel" id="reward-panel-2">
                    <h5>$250K Crypto Bonus.</h5>
                    <p>Itrust Crypto is splitting up a $250K pie! Earn a piece when you invite friends and they buy crypto</p>
                    <div class="d-flex justify-content-center mb-2">
                        <img src="{{ asset('svg/btc.svg') }}" alt="" width="260">
                    </div>
                    <div class="row align-items-center mt-4">
                        <div class="col-2">
                            <img src="{{ asset('svg/star.svg') }}" alt="" width="45">
                        </div>
                        <div class="col-10 align-self-center d-flex justify-content-between">
                            <div class="mt-4 mt-sm-0">
                                <h6>Your piece of $250K</h6>
                                <p class="mb-1">The pie will be split into even pieces once this promo ends. Keep in mind: this promo is only open to Itrust Crypto customers.</p>
                            </div>
                        </div>
                    </div>
                    <div class="row align-items-center mt-4">
                        <div class="col-2">
                            <img src="{{ asset('svg/star.svg') }}" alt="" width="50">
                        </div>
                        <div class="col-10 align-self-center d-flex justify-content-between">
                            <div class="mt-4 mt-sm-0">
                                <h6>Special promo link</h6>
                                <p class="mb-1">Make sure your friends use your specific referral link for this promo to qualify!</p>
                            </div>
                        </div>
                    </div>
                    <div class="row align-items-center mt-4">
                        <div class="col-2">
                            <img src="{{ asset('svg/star.svg') }}" alt="" width="50">
                        </div>
                        <div class="col-10 align-self-center d-flex justify-content-between">
                            <div class="mt-4 mt-sm-0">
                                <h6>Limited-time only</h6>
                                <p class="mb-1">This bonus offer ends July 20. You’ll receive your bonus by July 28. You’ll still be eligible for the gift stock from Itrust Investments. <a href="#">Terms and conditions</a>.</p>
                            </div>
                        </div>
                    </div>
                    <div class="row align-items-center mt-4">
                        <div class="col-2">
                            <img src="{{ asset('svg/star.svg') }}" alt="" width="50">
                        </div>
                        <div class="col-10 align-self-center d-flex justify-content-between">
                            <div class="mt-4 mt-sm-0">
                                <h6>More referrals, more pieces</h6>
                                <p class="mb-1">The more friends you refer, the more you’ll earn. You’re gonna have a lot of pie if you do this right…</p>
                            </div>
                        </div>
                    </div>
                    <div class="mx-4">
                        <div class="d-flex justify-content-between align-items-center mb-4 mt-4">
                            <button class="btn btn-success btn-block px-4">Share Link</button>
                            <a href="javascript:void(0)" class="" onclick="showLess(2)">View less <i class="mdi mdi-arrow-up"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function showReward(i) {
            $('.reward').removeClass('d-none')
            $('.reward-panel').addClass('d-none')
            $('#reward-'+i).addClass('d-none')
            $('#reward-panel-'+i).removeClass('d-none')
        }
        function showLess(i) {
            $('#reward-'+i).removeClass('d-none')
            $('#reward-panel-'+i).addClass('d-none')
        }
    </script>
@endsection
