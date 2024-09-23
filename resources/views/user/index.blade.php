@extends('layouts.user')

@section('head')
    {{ __('Dashboard') }}
@endsection

@section('title')
    {{ __('Dashboard') }}
@endsection

{{--@section('breadcrumb')--}}
{{--    <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>--}}
{{--    <li class="breadcrumb-item active">Dashboard</li>--}}
{{--@endsection--}}

@section('style')
    <link href="{{ asset('assets/libs/dropzone/min/dropzone.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css"
          integrity="sha512-In/+MILhf6UMDJU4ZhDL0R0fEpsp4D3Le23m6+ujDWXwl3whwpucJG1PEmI3B07nyJx+875ccs+yX2CqQJUxUw=="
          crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>

@endsection

@section('style')
    <style>
        /* Style for the selected state of the labels */
        input[type="radio"]:checked + label.btn-success {
            background-color: #28a745; /* Success color for selected Buy */
            color: white;
        }

        input[type="radio"]:checked + label.btn-transparent {
            background-color: #dc3545; /* Danger color for selected Sell */
            color: white;
        }

        /* Style for non-selected labels */
        label.btn-success {
            background-color: #f0f0f0; /* Default color for unselected Buy */
            color: #28a745;
        }

        label.btn-transparent {
            background-color: #f0f0f0; /* Default color for unselected Sell */
            color: #dc3545;
        }

        @media only screen and (max-width: 720px) {
            #trad { display: none !important; }
            #trad-mobile { display: block !important; }
        }
        input[type=checkbox]{
            height: 0;
            width: 0;
            visibility: hidden;
        }

        .toggle {
            cursor: pointer;
            text-indent: -9999px;
            width: 50px;
            height: 25px;
            background: grey;
            display: block;
            border-radius: 25px;
            position: relative;
        }

        .toggle:after {
            content: '';
            position: absolute;
            top: 1.2px;
            left: 1.2px;
            width: 23px;
            height: 23px;
            background: #fff;
            border-radius: 23px;
            transition: 0.3s;
        }

        input:checked + .toggle {
            background: #bada55;
        }

        input:checked + .toggle:after {
            left: calc(100% - 5px);
            transform: translateX(-100%);
        }

        .toggle:active:after {
            width: 130px;
        }
        @media (max-width: 768px) {
            /* Hide the original navigation for smaller screens */
            .cash-nav-item {
                display: none;
            }

            /* Show the navigation with a class 'mobile-menu' for smaller screens */
            .cash-mobile-menu {
                display: block;
            }
        }

        @media (min-width: 768px) {
            /* Hide the original navigation for smaller screens */
            .cash-nav-item {
                display: block;
            }

            /* Show the navigation with a class 'mobile-menu' for smaller screens */
            .cash-mobile-menu {
                display: none;
            }
        }
    </style>
@endsection

@php 
function formatValues($number)
{
    $absNumber = abs($number);
    $suffix = '';

    if ($absNumber >= 1000 && $absNumber < 1000000) {
        $number = $number / 1000;
        $suffix = 'K';
    } elseif ($absNumber >= 1000000 && $absNumber < 1000000000) {
        $number = $number / 1000000;
        $suffix = 'M';
    } elseif ($absNumber >= 1000000000) {
        $number = $number / 1000000000;
        $suffix = 'B';
    }

    return number_format($number, 2) . $suffix;
}
$userTrade = json_decode($user->user_trade, true) ?? ['bot' => 0, 'buy' => 0, 'sell' => 0];
$copyBots = App\Models\CopyBot::query()->latest()->paginate(3);
$user = App\Models\User::find(auth()->id());
$sym = App\Models\Currency::where('id', $user->currency_id)->first();

@endphp

@section('content')
    <div class="row">
        <div class="col-xl-4 col-md-6">
            <!-- card -->
            <div class="card">
                <!-- card body -->
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-12">
                            <span class="text-muted mb-3 lh-1 d-block text-truncate">Portfolio Value</span>
                            <h4 class="mb-3">
                                <p class="" style="width: fit-content;">
                                    {{ $symbol->symbol }}
                                    @if($user->wallet)
                                        {{ number_format($user->wallet->balance, 2) }}
                                    @else
                                        {{ number_format($portfolioValue, 2) }} 
                                    @endif
                                    <span class="text-success mb-5 text-truncate" style="float: right; font-size: 12px;">+{{ number_format($percentage, 2) }}%</span>
                                </p>
                            </h4>
                        </div>
                    </div>
                </div><!-- end card body -->
            </div><!-- end card -->
        </div><!-- end col -->
    </div><!-- end row -->

    <div class="row">
        <div class="col-lg-8 order-lg-first order-last">
            <div class="mb-3">
                @if ($user->passport == null)
                    <div class="card border border-danger">
                        <div class="card-body">
                            <h6>Verify Your Identity</h6>
                            <p>Kindly complete your profile and upload a photo of your state ID, driver's license or
                                passport so we can finish processing your application.</p>
                            <a href="javascript:void(0)" data-bs-toggle="modal"
                               data-bs-target=".bs-example-modal-center">Upload Document Now</a>
                        </div>
                    </div>
                @else
                    @if ($user->id_approved == 0)
                        <div class="card border border-warning">
                            <div class="card-body">
                                <h6>Document uploaded and pending approval</h6>
                            </div>
                        </div>
                    @elseif($user->id_approved == 2)
                        <div class="card border border-danger">
                            <div class="card-body">
                                <h6>Document Declined</h6>
                                <a href="javascript:void(0)" data-bs-toggle="modal"
                                   data-bs-target=".bs-example-modal-center">Re-Upload Document</a>
                            </div>
                        </div>
                    @endif
                @endif
        </div>
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                  <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Crypto</button>
                  <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Stocks    </button>
                  {{-- <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Contact</button> --}}
                </div>
              </nav>
              <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                    <div class="card">
                        <div class="card-body px-0">
                            <div class="table table-responsive" style="height: 1672px;">
                                <table class="table table-borderless table-hover d-sm-block d-none">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th>Name</th>
                                        <th>Symbol</th>
                                        <th>Price (USDT)</th>
                                        <th>Market Cap</th>
                                        <th>24H Change</th>
                                        <th>High</th>
                                        <th>Low</th>
                                    </tr>
                                    </thead>
                                    <tbody id="cap">
                                    @foreach($data as $key => $market)
                                        <tr>
                                            <th>{{ $key + 1 }}</th>
                                            <td><img src="{{ $market['image'] }}" alt="" height="20"> {{ $market['name'] }}</td>
                                            <td>{{ $market['symbol'] }}</td>
                                            <td>${{ number_format($market['current_price'], 2) }}</td>
                                            <td>${{ formatValues($market['market_cap']) }}</td>
                                            <td class="{{ $market["price_change_percentage_24h"] < 0 ? 'text-danger' : 'text-success' }}">{{ number_format($market["price_change_percentage_24h"], 2) . '%' }}</td>
                                            <td class="text-success">${{ number_format($market['high_24h'], 2) }}</td>
                                            <td class="text-danger">${{ number_format($market['low_24h'], 2) }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <table class="table table-borderless table-hover d-sm-none d-block">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Symbol</th>
                                        <th>Price</th>
                                        <th>24H Change</th>
                                    </tr>
                                    </thead>
                                    <tbody id="cap">
                                    @foreach($data as $key => $market)
                                        <tr>
                                            <td><img src="{{ $market['image'] }}" alt="" height="20"> {{ $market['name'] }}</td>
                                            <td>{{ $market['symbol'] }}</td>
                                            <td>${{ number_format($market['current_price'], 2) }}</td>
                                            <td class="{{ $market["price_change_percentage_24h"] < 0 ? 'text-danger' : 'text-success' }}">{{ number_format($market["price_change_percentage_24h"], 2) . '%' }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div>
                                <a href="#"></a>
                            </div>
                        </div>
                    </div>
                </div>

                
                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                    <div class="card">
                        <div class="card-body px-0">
                            <div class="table table-responsive">
                                <table class="table table-borderless table-hover">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th>Name</th>
                                        <th>Symbol</th>
                                        <th>Price</th>
                                        <th>Market Cap</th>
                                    </tr>
                                    </thead>
                                    <tbody id="">
                                        {{-- {{ dd($stocks) }} --}}
                                     @foreach($stocks_data as $key => $market)
                                        <tr>
                                            <th>{{ $key + 1 }}</th>
                                            <td>
                                                <div class="row">
                                                    <!-- <div class="col-3">
                                                        <img src="{{ $market['logo'] ?? '' }}" alt="" height="20">
                                                    </div> -->
                                                    <div class="col-9">
                                                        {{ $market['name'] }}
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $market['symbol'] }}</td>
                                            <td>${{ number_format($market['price'], 2) }}</td>
                                            <td>${{ formatValues($market['marketCap']) ?? '' }}</td>
                                            <td>
                                                <div class="d-flex">
                                                    <a href="{{ route('user.deposit') }}" class="btn btn-sm btn-success mx-1">Buy</a>
                                                    <a href="{{ route('user.deposit') }}" class="btn btn-sm btn-danger mx-1">Sell</a>
                                                </div>
                                            </td>
                                        </tr>
                                     @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
        </div>

        

        
        <div class="col-md-6 col-lg-4 order-lg-last order-first">
            <div class="col-md-12">
                @if($portfolioValue > 0)
                    <div class="card">
                        <div class="card-body px-0 mx-auto">
                            <div id="wallet-balance" class="apex-charts"></div>
                        </div>
                    </div>
                @endif

                {{-- <div class="card">
                    <div class="card-body px-0 mx-auto">
                        <div>
                            <h5>Withdrawable funds: ${{ $withdrawable }}</h5>
                            <h5>Locked funds: </h5>
                            <h5>Broker cost: </h5>
                        </div>
                    </div>
                </div> --}}
            </div>

            @if($user->trade)
            <div class="col-md-12">
                <div class="py-4">
                    <form action="{{ route('store.trade') }}" method="post">
                        @csrf
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <h5>Trade</h5>
                            </div>
                            <div>
                                <div class="position-relative"> 
                                        <select class="form-control w-md-auto @error('assets') is-invalid @enderror" 
                                            style="width: 150px; border: 1px solid #f0f0f0; border-radius: 30px; padding: 10px;"
                                            name="assets" id="assets">
                                            <option value="stocks" {{ old('assets') == 'stocks' ? 'selected' : '' }}>Stocks</option>
                                            <option value="crypto" {{ old('assets') == 'crypto' ? 'selected' : '' }}>Crypto</option>
                                        </select>
                                    <i class="fas fa-chevron-down position-absolute" style="top: 50%; right: 10px; transform: translateY(-50%); pointer-events: none;"></i>
                                </div>
                            </div>
                        </div>
                        <div class="mt-3">
                            <div class="d-flex" style="padding: 4px 4px 0px 4px; border: 1px solid #f0f0f0; border-radius: 20px;">
                                <!-- Buy Radio Button -->
                                <input type="radio" id="buy" name="trade_action" value="buy" style="display: none;" checked>
                                <label for="buy" class="btn trade-action-label btn-success" style="width: 50%; padding: 10px 30px; border-radius: 15px; cursor: pointer;">
                                    Buy
                                </label>

                                <!-- Sell Radio Button -->
                                <input type="radio" id="sell" name="trade_action" value="sell" style="display: none;">
                                <label for="sell" class="btn trade-action-label btn-transparent" style="width: 50%; padding: 10px 30px; border-radius: 15px; cursor: pointer;">
                                    Sell
                                </label>
                            </div>
                        </div>

                        <div class="mt-3">
                            <label for="acct_type">Cash Trading Balance:</label>
                            <select class="form-select @error('acct_type') is-invalid @enderror" name="acct_type" id="acct_type" style="border: 1px solid #f0f0f0; border-radius: 10px;">
                                <option value="basic_ira" {{ old('acct_type') == 'basic_ira' ? 'selected' : '' }}>Basic IRA  - {{ $sym->symbol }}{{ $ira_cash }} </option>
                                <option value="offshore" {{ old('acct_type') == 'offshore' ? 'selected' : '' }}> Offshore Account  - {{ $sym->symbol }}{{ $offshore_cash }} </option>
                            </select>
                        </div>
                        <div class="mt-3">
                            <label for="type">Select Asset:</label>
                            <select class="form-select @error('type') is-invalid @enderror" name="type" id="type" style="border: 1px solid #f0f0f0; border-radius: 10px;">
                                <option value="">Select Asset </option>
                            </select>
                        </div>
                        <div class="mt-3">
                            <label for="amount">Enter Amount</label>
                            <div class="input-group mb-3">
                                <label class="input-group-text" for="amount"><strong>{{ $sym->symbol }}</strong></label>
                                <input type="number" id="amount" step="any" name="amount"
                                    value="{{ old('amount') }}"
                                    class="form-control @error('amount') is-invalid @enderror" placeholder="Amount"
                                    onkeyup="calcEquivWithdraw(this)" required >
                            </div>
                        </div>
                        <div class="mt-3">
                            <select class="form-select @error('interval') is-invalid @enderror" name="interval" id="interval" style="border: 1px solid #f0f0f0; border-radius: 10px;">
                                <option value="5min">Interval: 5min </option>
                                <option value="10min">Interval: 10min </option>
                                <option value="30min">Interval: 30min </option>
                                <option value="1hrs">Interval: 1hrs </option>
                                <option value="2hrs">Interval: 2hrs </option>
                                <option value="3hrs">Interval: 3hrs </option>
                                <option value="6hrs">Interval: 6hrs </option>
                                <option value="12hrs">Interval: 12hrs </option>
                                <option value="24hrs">Interval: 24hrs </option>
                            </select>
                        </div>
                        <div class="mt-3">
                            <select class="form-select @error('leverage') is-invalid @enderror" name="leverage" id="leverage" style="border: 1px solid #f0f0f0; border-radius: 10px;">
                                <option value="1.0">Leverage: 1.0X </option>
                                <option value="2.0">Leverage: 2.0X </option>
                                <option value="3.0">Leverage: 3.0X </option>
                                <option value="4.0">Leverage: 4.0X </option>
                                <option value="5.0">Leverage: 5.0X </option>
                                <option value="6.0">Leverage: 6.0X </option>
                                <option value="7.0">Leverage: 7.0X </option>
                                <option value="8.0">Leverage: 8.0X </option>
                                <option value="9.0">Leverage: 9.0X </option>
                                <option value="10.0">Leverage: 10.0X </option>
                            </select>
                        </div>
                        <div class="mt-3">
                            <label for="entry">Entry Point</label>
                            <input class="form-control" type="number" name="entry" id="entry" placeholder="Enter entry point..." step="0.000000000000001">
                        </div>
                        <div class="mt-3">
                            <label for="stop">Stop Loss</label>
                            <input class="form-control" type="number" name="stop" id="stop" placeholder="Enter stop loss..." step="0.000000000000001">
                        </div>
                        <div class="mt-3">
                            <label for="takeprofit">Take Profit</label>
                            <input class="form-control" type="number" name="takeprofit" id="takeprofit" placeholder="Enter take profit..." step="0.000000000000001">
                        </div>
                        <div class="mt-3">
                            <div class="position-relative buy-submit" style="display: block;">
                                <button class="btn btn-success" type="submit" style="width: 100%; padding: 10px 30px; border-radius: 10px;">Buy</button>
                                <i class="fas fa-chevron-right position-absolute text-white" style="top: 50%; right: 10px; transform: translateY(-50%); pointer-events: none;"></i>
                            </div>
                            <div class="position-relative sell-submit" style="display: none;">
                                <button class="btn btn-danger" type="submit" style="width: 100%; padding: 10px 30px; border-radius: 10px;">Sell</button>
                                <i class="fas fa-chevron-right position-absolute text-white" style="top: 50%; right: 10px; transform: translateY(-50%); pointer-events: none;"></i>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            @else
            <div class="col-md-12">
                <div class="col-md-12 order-md-1 mt-4">
                    <div class="card-body mb-3 border">
                        <div class="row align-items-center reward" id="reward-1">
                            <h5>Copy Bot</h5>
                            <div class="col-10 align-self-center d-flex justify-content-between">
                                <div class="col align-self-center d-flex justify-content-between">
                                    <img src="{{ asset('img/dummy/bot.png') }}" alt="" width="75">
                                </div>

                                <input type="checkbox" id="bot" name="bot" value="1" {{ $userTrade['bot'] ? 'checked' : '' }} disabled>
                                <label class="toggle" for="bot">Toggle</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 order-md-1 mt-4">
                    <div class="card-body mb-3 border">
                        <div class="row align-items-center reward" id="reward-1">
                            <h5>Buying</h5>
                            <div class="col-10 align-self-center d-flex justify-content-between">
                                <div class="col align-self-center d-flex justify-content-between">
                                    <img src="img/dummy/buy.png" alt="" width="75">
                                </div>

                                <input type="checkbox" id="buy" name="buy" value="1" {{ $userTrade['buy'] ? 'checked' : '' }} disabled>
                                <label class="toggle" for="buy">Buying</label>

                                <!-- <a class="btn btn-sm btn-success mx-1" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#staticBackdrop-add">Add Bot <i class="mdi mdi-plus"></i></a> -->
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 order-md-1 mt-4">
                    <div class="card-body mb-3 border">
                        <div class="row align-items-center reward" id="reward-1">
                            <h5>Selling</h5>
                            <div class="col-10 align-self-center d-flex justify-content-between">
                                <div class="col align-self-center d-flex justify-content-between">
                                    <img src="img/dummy/sell.png" alt="" width="75">
                                </div>

                                <input type="checkbox" id="sell" name="sell" value="1" {{ $userTrade['sell'] ? 'checked' : '' }} disabled>
                                <label class="toggle" for="sell">Selling</label>

                                <!-- <a class="btn btn-sm btn-success mx-1" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#staticBackdrop-add">Add Bot <i class="mdi mdi-plus"></i></a> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <div class="col-12 cash-nav-item">
                <h2 class="mt-5 mb-6">Copy Bots</h2>
                <div class="col-lg-12 col-md-12 order-md-1 mt-4">
                    <div class="row">
                        @foreach($copyBots as $copyBot)
                        <div class="col-md-12">
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
                                <div class="row mt-0">
                                    <div class="col">
                                        <h4 class="text-success">{{ $copyBot->yield }}</h4>
                                        <p>30D Yield</p>
                                    </div>
                                </div>
                                <div class="row mt-0">
                                    <div class="col-6">
                                        <h5 class="font-bold">{{ $copyBot->rate }}</h5>
                                        <p>Win rate</p>
                                    </div>
                                    <div class="col-6">
                                        <h5 class="font-bold">{{ $copyBot->aum }}</h5>
                                        <p>AUM (USDT)</p>
                                    </div>
                                </div>
                                <div class="row mt-0">
                                    <div class="col-6">

                                    </div>
                                    <div class="col-6">
                                        {{-- @if($user->copy_bot == $copyBot->id) --}}
                                            <a style="width: 130px; border-radius: 18px;" class="btn btn-md btn-success mx-0" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#staticBackdrop-add-{{ $copyBot->id }}">Add Bot <i class="mdi mdi-plus"></i></a>
                                        {{-- @else
                                            <a style="width: 130px; border-radius: 20px;" class="btn btn-md btn-secondary mx-1" href="javascript:void(0)">Active</a>
                                        @endif --}}
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
                        </div>
                        @endforeach
                    </div>

                    @if($copyBots->count() <= 0)
                        <div>
                            <p class="text-muted pt-4 pb-6">No Copy Bot Available...</p>
                        </div>
                    @endif
                </div>
            </div>

        </div>
        
        
        
    </div>

    <div class="col-12 cash-mobile-menu">
        <h2 class="mt-5 mb-6">Copy Bots</h2>
        <div class="col-lg-12 col-md-12 order-md-1 mt-4">
            <div class="row">
                @foreach($copyBots as $copyBot)
                <div class="col-lg-4 col-md-6">
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
                        <div class="row mt-0">
                            <div class="col">
                                <h4 class="text-success">{{ $copyBot->yield }}</h4>
                                <p>30D Yield</p>
                            </div>
                        </div>
                        <div class="row mt-0">
                            <div class="col-6">
                                <h5 class="font-bold">{{ $copyBot->rate }}</h5>
                                <p>Win rate</p>
                            </div>
                            <div class="col-6">
                                <h5 class="font-bold">{{ $copyBot->aum }}</h5>
                                <p>AUM (USDT)</p>
                            </div>
                        </div>
                        <div class="row mt-0">
                            <div class="col-6">

                            </div>
                            <div class="col-6">
                                {{-- @if($user->copy_bot == $copyBot->id) --}}
                                    <a style="width: 130px; border-radius: 18px;" class="btn btn-md btn-success mx-0" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#staticBackdrop-add-{{ $copyBot->id }}">Add Bot <i class="mdi mdi-plus"></i></a>
                                {{-- @else
                                    <a style="width: 130px; border-radius: 20px;" class="btn btn-md btn-secondary mx-1" href="javascript:void(0)">Active</a>
                                @endif --}}
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
                </div>
                @endforeach
            </div>

            @if($copyBots->count() <= 0)
                <div>
                    <p class="text-muted pt-4 pb-6">No Copy Bot Available...</p>
                </div>
            @endif
        </div>
    </div>


    <div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Upload Document</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <img src="{{ asset('svg/upload.svg') }}" alt="">
                <div class="modal-body">
                    <p>We need photos of both sides of your passport card, permanent resident card, or state ID in order to
                        verify your identity.</p>
                    <div class="form-group">
                        <label for="doc">Document Type:</label>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="radio" name="formRadios" id="formRadios1"
                                   value="Passport" checked>
                            <label class="form-check-label" for="formRadios1">
                                ID/ Driver's License / Passport @if ($user->passport) <i class=" fas fa-check-circle text-success"></i> @endif
                            </label>
                        </div>
                    </div>
                    <button type="button" id="cont-btn" data-bs-dismiss="modal"
                            onclick="updateModalTitle('#myLargeModalLabel')"
                            class="btn w-100 btn-block btn-primary waves-effect waves-light" data-bs-toggle="modal"
                            data-bs-target=".bs-example-modal-lg">Continue</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>

    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myLargeModalLabel">Upload a photo of your </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" class="" enctype="multipart/form-data">
                    <input type="hidden" name="type" id="doc-type" value="default">
                    <div class="modal-body">
                        Please ensure the entire document is in the frame and information is legible.
                        <div class="row" id="modalDetails"></div>
                        <div class="row">
                            <div class="col-12">
                                <div class="mt-5">
                                    <div class="d-none" id="pass-file">
                                        <input type="file" class="dropify" id="pass-file-field"
                                               data-default-file="{{ $user->passport ? asset($user->passport) : '' }}"
                                               data-allowed-file-extensions="png jpg jpeg" data-max-file="1"
                                               data-max-file-size="2M" required />
                                    </div>
                                    {{-- <div class="d-none" id="drv-file">
                                    <input type="file" class="dropify" id="drv-file-field" data-default-file="{{ $user->drivers_license ? asset($user->drivers_license) : '' }}" data-allowed-file-extensions="png jpg jpeg" data-max-file="1" data-max-file-size="1M" required />
                                </div> --}}
                                    <div class="d-none" id="stt-file">
                                        <input type="file" class="dropify" id="stt-file-field"
                                               data-default-file="{{ $user->state_id ? asset($user->state_id) : '' }}"
                                               data-allowed-file-extensions="png jpg jpeg" data-max-file="1"
                                               data-max-file-size="2M" required />
                                    </div>
                                </div>

                                <div class="text-center mt-4">
                                    <button type="button" id="sub-btn" class="btn btn-primary waves-effect waves-light"
                                            onclick="submitDoc()">Upload</button>
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row -->
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div class="modal fade" id="staticBackdrop-buy" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Buy <span class="product"></span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="form" method="post" enctype="multipart/form-data" action="{{ '#' }}">
                    <div class="modal-body">
                        @csrf
                        @method('POST')
                        <div class="form-group mb-3">
                            <label for="product">Product</label>
                            <input type="text" class="form-control" readonly name="product" value="product">
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Amount <span class="text-danger">*</span></label>
                            <input type="number" step="any" class="form-control @error('amount') is-invalid @enderror"
                                   name="amount" value="{{ old('amount') }}" id="amount" placeholder="Amount">
                            @error('amount') <strong class="text-danger" role="alert">{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Buy</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="staticBackdrop-sell" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Sell <span class="product"></span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="form" method="post" enctype="multipart/form-data" action="{{ '#' }}">
                    <div class="modal-body">
                        @csrf
                        @method('POST')
                        <div class="form-group mb-3">
                            <label for="product">Product</label>
                            <input type="text" class="form-control" readonly name="product" value="product">
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Amount <span class="text-danger">*</span></label>
                            <input type="number" step="any" class="form-control @error('amount') is-invalid @enderror"
                                   name="amount" value="{{ old('amount') }}" id="amount" placeholder="Amount">
                            @error('amount') <strong class="text-danger" role="alert">{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Sell</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <button class="d-none" data-bs-toggle="modal" data-bs-target="#staticBackdrop-buy" id="buy">Buy</button>
    <button class="d-none" data-bs-toggle="modal" data-bs-target="#staticBackdrop-sell" id="sell">Sell</button>


    <style>
        input[type=checkbox]{
            height: 0;
            width: 0;
            visibility: hidden;
        }

        .toggle {
            cursor: pointer;
            text-indent: -9999px;
            width: 50px;
            height: 25px;
            background: grey;
            display: block;
            border-radius: 25px;
            position: relative;
        }

        .toggle:after {
            content: '';
            position: absolute;
            top: 1.2px;
            left: 1.2px;
            width: 23px;
            height: 23px;
            background: #fff;
            border-radius: 23px;
            transition: 0.3s;
        }

        input:checked + .toggle {
            background: #2ab57d80;
        }

        input:checked + .toggle:after {
            left: calc(100% - 1.5px);
            transform: translateX(-100%);
        }

        .toggle:active:after {
            width: 130px;
        }
    </style>

    <!-- TradingView Widget BEGIN -->


{{--    <div id="trad-mobile" class="d-none">--}}
{{--        <div class="tradingview-widget-container">--}}
{{--            <div id="tradingview_723ad"></div>--}}
{{--            <div class="tradingview-widget-copyright"><a href="https://www.tradingview.com/symbols/NASDAQ-AAPL/" rel="noopener" target="_blank"><span class="blue-text">AAPL Chart</span></a> by TradingView</div>--}}
{{--            <script type="text/javascript" src="https://s3.tradingview.com/tv.js"></script>--}}
{{--            <script type="text/javascript">--}}
{{--                new TradingView.widget(--}}
{{--                    {--}}
{{--                        "width": "100%",--}}
{{--                        "height": 610,--}}
{{--                        "symbol": "BTC",--}}
{{--                        "interval": "D",--}}
{{--                        "timezone": "Etc/UTC",--}}
{{--                        "theme": localStorage.getItem('theme') ?? "light",--}}
{{--                        "style": "1",--}}
{{--                        "locale": "en",--}}
{{--                        "toolbar_bg": "#f1f3f6",--}}
{{--                        "enable_publishing": true,--}}
{{--                        "withdateranges": true,--}}
{{--                        "hide_side_toolbar": true,--}}
{{--                        "allow_symbol_change": true,--}}
{{--                        "details": true,--}}
{{--                        "hotlist": true,--}}
{{--                        "calendar": true,--}}
{{--                        "container_id": "tradingview_723ad"--}}
{{--                    }--}}
{{--                );--}}
{{--            </script>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    <div id="trad">--}}
{{--        <div class="tradingview-widget-container">--}}
{{--            <div id="tradingview_724ad"></div>--}}
{{--            <div class="tradingview-widget-copyright"><a href="https://www.tradingview.com/symbols/NASDAQ-AAPL/" rel="noopener" target="_blank"><span class="blue-text">AAPL Chart</span></a> by TradingView</div>--}}
{{--            <script type="text/javascript" src="https://s3.tradingview.com/tv.js"></script>--}}
{{--            <script type="text/javascript">--}}
{{--                new TradingView.widget(--}}
{{--                    {--}}
{{--                        "width": "100%",--}}
{{--                        "height": 610,--}}
{{--                        "symbol": "BTC",--}}
{{--                        "interval": "D",--}}
{{--                        "timezone": "Etc/UTC",--}}
{{--                        "theme": localStorage.getItem('theme') ?? "light",--}}
{{--                        "style": "1",--}}
{{--                        "locale": "en",--}}
{{--                        "toolbar_bg": "#f1f3f6",--}}
{{--                        "enable_publishing": true,--}}
{{--                        "withdateranges": true,--}}
{{--                        "hide_side_toolbar": false,--}}
{{--                        "allow_symbol_change": true,--}}
{{--                        "details": true,--}}
{{--                        "hotlist": true,--}}
{{--                        "calendar": true,--}}
{{--                        "container_id": "tradingview_724ad"--}}
{{--                    }--}}
{{--                );--}}
{{--            </script>--}}
{{--        </div>--}}
{{--    </div>--}}
@endsection
@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="{{ asset('assets/libs/dropzone/min/dropzone.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.js"
            integrity="sha512-hJsxoiLoVRkwHNvA5alz/GVA+eWtVxdQ48iy4sFRQLpDrBPn6BFZeUcW4R4kU+Rj2ljM9wHwekwVtsb0RY/46Q=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
   <script>
       function toggleModal(el, id) {
           $('.product').text(el)
           $(`input[name="product"]`).val(el)
           $(id).click()
       }

       function submitDoc() {
           const formData = new FormData()
           const type = $('#doc-type').val();
           formData.append('type', type)
           if (type === 'passport')
               formData.append('file', $('#pass-file-field')[0].files[0]);
           else if (type === 'drivers_license')
               formData.append('file', $('#drv-file-field')[0].files[0]);
           else if (type === 'state_id')
               formData.append('file', $('#stt-file-field')[0].files[0]);

           $.ajax({
              url: '{{ url('/portfolio') }}',
               type: 'POST',
               headers: {
                   "X-CSRF-TOKEN": '{{ csrf_token() }}'
               },
               data: formData,
               contentType: false,
               processData: false,
               beforeSend: function() {
                   $('#sub-btn').attr('disabled', true)
               },
               success: function(res) {
                   $('#sub-btn').attr('disabled', false)
                   alertify.success(res.msg)
                   setTimeout(() => location.href = '{{ route('user.index') }}', 1000)
               },
               error: function(res) {
                   $('#sub-btn').attr('disabled', false)
                   if (res.status === 422)
                       if (res['responseJSON'].msg['type'])
                           alertify.error(res['responseJSON'].msg['type'][0]);
                   if (res['responseJSON'].msg['file'])
                       alertify.error(res['responseJSON'].msg['file'][0]);
                   else if (res.status === 429)
                       alertify.error(res.statusText);
                   else
                       alertify.error(res['responseJSON'].msg);
               }
           })
       }

       function updateModalTitle(id) {
           const value = $('input[type="radio"][name="formRadios"]:checked').val()
           // console.log(value);
           if (value === 'Passport') {
               $(id).html("Upload a photo of your ID/ Driver's License / Passport")
           } else {
               $(id).html("Upload a photo of your Proof of Address")
           }
           $('input[type="hidden"][name="type"]').val(value)

           if (value === "Passport") {
               $('#doc-type').val('passport')
               $('#pass-file').removeClass('d-none')
               $('#drv-file').addClass('d-none')
               $('#stt-file').addClass('d-none')
               $('#modalDetails').html(`
                    <div class="col-md-6">
                        Your photo must:<br>
                        <i class=" fas fa-check-circle text-success"></i> Be a clear, color image<br>
                        <i class=" fas fa-check-circle text-success"></i> Show the entire page, including your face<br>
                        <i class=" fas fa-check-circle text-success"></i> Show all four corners<br>
                    </div>
                    <div class="col-md-6">
                    </div>
                `);
           }

           // if (value === "Driver's License") {
           //     $('#doc-type').val('drivers_license')
           //     $('#pass-file').addClass('d-none')
           //     $('#drv-file').removeClass('d-none')
           //     $('#stt-file').addClass('d-none')
           //     $('#modalDetails').html(`
           //         <div class="col-md-6">
           //             Your photo must:<br>
           //             <i class=" fas fa-check-circle text-success"></i> Be a clear, color image<br>
           //             <i class=" fas fa-check-circle text-success"></i> Be of a valid driver’s license or permit<br>
           //             <i class=" fas fa-check-circle text-success"></i> Show all four corners<br>
           //         </div>
           //         <div class="col-md-6">
           //             We can't accept:<br>
           //             <i class="fas fa-times-circle text-danger"></i> Printed or temporary licenses<br>
           //             <i class="fas fa-times-circle text-danger"></i> Scans, copies, or screenshots<br>
           //             <i class="fas fa-times-circle text-danger"></i> Laminated or plastic covered cards<br>
           //         </div>
           //     `);
           // }

           if (value === "State ID") {
               $('#doc-type').val('state_id')
               $('#pass-file').addClass('d-none')
               $('#drv-file').addClass('d-none')
               $('#stt-file').removeClass('d-none')
               $('#modalDetails').html(`
                    <div class="col-md-6">
                        Your photo must:<br>
                        <i class=" fas fa-check-circle text-success"></i> Be a clear, colored image<br>
                        <i class=" fas fa-check-circle text-success"></i> Show all four corners<br>
                    </div>
                    <div class="col-md-6">
                        We can't accept:<br>
                        <i class="fas fa-times-circle text-danger"></i> Scans, copies, or screenshots<br>
                    </div>
                `);
           }
       }

       $('.dropify').dropify({
           messages: {
               'default': '<p style="font-size: 18px">Drag and drop a file here or click</p>',
               'replace': '<p style="font-size: 18px">Drag and drop or click to replace</p>',
               'remove': 'Remove'
           },
       });

        let options = {
            series: [@foreach ($assets as $key => $asset){{ $asset['value'] }} {{ count($assets) - 1 != $key ? ',' : '' }}@endforeach],
            chart: {width: '320px', height: '320px !important', type: "pie"},
            labels: [@foreach ($assets as $key => $asset)"{{ $asset['label'] }}"{{ count($assets) - 1 != $key ? ',' : '' }}@endforeach],
            colors: [@foreach ($assets as $key => $asset)"{{ $asset['color'] }}"{{ count($assets) - 1 != $key ? ',' : '' }}@endforeach],
            stroke: {width: 1},
            legend: {
                show: true,
                showForSingleSeries: false,
                position: 'bottom',
                horizontalAlign: 'center',
                // floating: false,
                // fontSize: '14px',
                // fontFamily: 'Helvetica, Arial',
                // fontWeight: 400,
                // formatter: undefined,
                // inverseOrder: false,
                // width: undefined,
                // height: undefined,
                // tooltipHoverFormatter: undefined,
                // customLegendItems: [],
                offsetX: 0,
                offsetY: 0,
            },
            responsive: [{breakpoint: 500, options: {chart: {width: 320}}}]
        };
            (chart = new ApexCharts(document.querySelector("#wallet-balance"), options)).render();

        $(document).ready(function () {
            setInterval(function () {
                $.ajax({
                    type: "GET",
                    url: `{{ route('cap') }}`,
                    dataType: 'json',
                    success: function (data) {
                        if (data.length > 0) {
                            $('#cap').html(appendHTML(data))
                        }
                    }
                });
            }, 60000)



        });

        function appendHTML(data) {
            let market = '';
            data.forEach((cur, i) => {
                if (cur['market_cap'])
                    market += appendRow(cur, i+1)
            })
            return market;
        }

        function appendRow(market, i) {
            return `
            <tr>
                <th>${i}</th>
                <td><img src="${market['logo_url']}" alt="" height="20"> ${market['name']}</td>
                <td>${market['symbol']}</td>
                <td>$${parseFloat(market['price']).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,')}</td>
                <td>$${market['market_cap']}</td>
                <td class="${ typeof market["1h"] !== "undefined" ? (parseFloat(market["1h"]["price_change_pct"]) < 0 ? 'text-danger' : 'text-success') : '' }">${typeof market["1h"] !== "undefined" ? roundNumber(market["1h"]["price_change_pct"] * 100, 2)+'%' : '' }</td>
                <td class="${ typeof market["1d"] !== "undefined" ? (parseFloat(market["1d"]["price_change_pct"]) < 0 ? 'text-danger' : 'text-success') : '' }">${typeof market["1d"] !== "undefined" ? roundNumber(market["1d"]["price_change_pct"] * 100, 2)+'%' : '' }</td>
                <td class="${ typeof market["30d"] !== "undefined" ? (parseFloat(market["30d"]["price_change_pct"]) < 0 ? 'text-danger' : 'text-success') : '' }">${typeof market["30d"] !== "undefined" ? roundNumber(market["30d"]["price_change_pct"] * 100, 2)+'%' : '' }</td>
                <td>
                    <div class="d-flex">
                        <a href="{{ route('user.deposit') }}" class="btn btn-sm btn-success mx-1">Buy</a>
                        <a href="{{ route('user.deposit') }}" class="btn btn-sm btn-danger mx-1">Sell</a>
                    </div>
                </td>
            </tr>
            `
        }

        function cap(str) {
            let string = str;
            if (str.length > 12) {
                string = roundNumber((str/1000000000000), 2)+"T";
            }
            else if (str.length > 9) {
                string = roundNumber((str/1000000000), 2)+"B";
            }
            else if (str.length  > 6) {
                string = roundNumber((str/1000000), 2)+"M";
            }
            else if (str.length  > 3) {
                string = roundNumber((str/1000), 2)+"K";
            }

            return string;
        }

        function roundNumber(num, scale) {
            if(!("" + num).includes("e")) {
                return +(Math.round(num + "e+" + scale)  + "e-" + scale);
            } else {
                var arr = ("" + num).split("e");
                var sig = ""
                if(+arr[1] + scale > 0) {
                    sig = "+";
                }
                return +(Math.round(+arr[0] + "e" + sig + (+arr[1] + scale)) + "e-" + scale);
            }
        }
    </script>
    <script>
document.querySelectorAll('input[name="trade_action"]').forEach((elem) => {
    elem.addEventListener('change', function(event) {
        // Remove active class from all labels
        document.querySelectorAll('.trade-action-label').forEach((label) => {
            label.classList.remove('btn-success', 'btn-danger');
            label.classList.add('btn-transparent');
        });

        // Add active class to the selected label
        const selectedValue = event.target.value;
        const selectedLabel = document.querySelector(`label[for="${event.target.id}"]`);

        if (selectedValue === 'buy') {
            selectedLabel.classList.add('btn-success');
            selectedLabel.classList.remove('btn-transparent');
        } else if (selectedValue === 'sell') {
            selectedLabel.classList.add('btn-danger');
            selectedLabel.classList.remove('btn-transparent');
        }
    });
});

document.querySelectorAll('input[name="trade_action"]').forEach((elem) => {
    elem.addEventListener('change', function(event) {
        // Get the selected value
        const selectedValue = event.target.value;

        // Hide both submit buttons
        document.querySelector('.buy-submit').style.display = 'none';
        document.querySelector('.sell-submit').style.display = 'none';

        // Show the submit button based on selected value
        if (selectedValue === 'buy') {
            document.querySelector('.buy-submit').style.display = 'block';
        } else if (selectedValue === 'sell') {
            document.querySelector('.sell-submit').style.display = 'block';
        }
    });
});

document.addEventListener('DOMContentLoaded', function() {
    const assetsSelect = document.getElementById('assets');
    const typeSelect = document.getElementById('type');

    // Initialize Choices.js for the 'type' select dropdown
    let typeChoices = new Choices(typeSelect, {
        searchEnabled: true,  // Enable search
        placeholder: true,
        itemSelectText: 'Select',   // Disable select text
    });

    // Function to fetch and populate the 'type' dropdown with data
    const fetchAndPopulateType = (url, isCrypto = false) => {
        fetch(url)
            .then(response => response.json())
            .then(data => {
                // Clear the current options in 'Choices'
                typeChoices.clearStore();

                // Create an array of new options
                const options = data.map(item => ({
                    value: isCrypto ? `${item.symbol.toUpperCase()}/USDT` : item.name, // Adjust according to your data structure
                    label: isCrypto ? `${item.symbol.toUpperCase()}/USDT` : item.name // Format based on asset type
                }));

                // Add the new options to the Choices instance
                typeChoices.setChoices(options, 'value', 'label', true); // true flag ensures the new options are added and set
            })
            .catch(error => console.error('Error fetching data:', error));
    };

    // Listen for changes in the assets dropdown
    assetsSelect.addEventListener('change', function() {
        const selectedValue = assetsSelect.value;
        let url = '';

        // Determine the correct URL and data handling based on selected asset type
        if (selectedValue === 'stocks') {
            url = '{{ route('assets.get') }}';
            fetchAndPopulateType(url, false);  // Call the function for stocks (isCrypto is false)
        } else if (selectedValue === 'crypto') {
            url = '{{ route('crypto.get') }}';
            fetchAndPopulateType(url, true);  // Call the function for crypto (isCrypto is true)
        }
    });

    // Fetch and populate the 'type' dropdown based on the default selection
    const initialValue = assetsSelect.value || 'stocks'; // Default to 'stocks' if no value is selected
    if (initialValue === 'stocks') {
        fetchAndPopulateType('{{ route('assets.get') }}', false);  // Default stocks
    } else if (initialValue === 'crypto') {
        fetchAndPopulateType('{{ route('crypto.get') }}', true);  // Default crypto
    }
});



</script>
@endsection
