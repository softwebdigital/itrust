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
    <style>
        @media only screen and (max-width: 720px) {
            #trad { display: none !important; }
            #trad-mobile { display: block !important; }
        }
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-xl-4 col-md-6">
            <!-- card -->
            <div class="card card-h-100">
                <!-- card body -->
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-6">
                            <span class="text-muted mb-3 lh-1 d-block text-truncate">Portfolio Value</span>
                            <h4 class="mb-3">
                                $<span class="" data-target="">{{ number_format($portfolioValue, 2) }}</span>
                            </h4>
                        </div>
                    </div>
                </div><!-- end card body -->
            </div><!-- end card -->
        </div><!-- end col -->
    </div><!-- end row -->

    <div class="row">
        <div class="col-md-8">
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
                                <th>1H Change</th>
                                <th>1D Change</th>
                                <th>30D Change</th>
                            </tr>
                            </thead>
                            <tbody id="cap">
                            @foreach($data as $key => $market)
                                <tr>
                                    <th>{{ $key + 1 }}</th>
                                    <td><img src="{{ $market['logo_url'] }}" alt="" height="20"> {{ $market['name'] }}</td>
                                    <td>{{ $market['symbol'] }}</td>
                                    <td>$ {{ number_format($market['price'], 2) }}</td>
                                    <td>$ {{ $market['market_cap'] }}</td>
                                    <td class="{{ isset($market["1h"]) ? ($market["1h"]["price_change_pct"] < 0 ? 'text-danger' : 'text-success') : '' }}">{{ isset($market["1h"]) ? ($market["1h"]["price_change_pct"] * 100).'%' : '' }}</td>
                                    <td class="{{ isset($market["1d"]) ? ($market["1d"]["price_change_pct"] < 0 ? 'text-danger' : 'text-success') : '' }}">{{ isset($market["1d"]) ? ($market['1d']['price_change_pct'] * 100).'%' : '' }}</td>
                                    <td class="{{ isset($market["30d"]) ? ($market["30d"]["price_change_pct"] < 0 ? 'text-danger' : 'text-success') : '' }}">{{ isset($market["30d"]) ? ($market['30d']['price_change_pct'] * 100).'%' : '' }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body px-0 mx-auto">
                    <div id="wallet-balance" class="apex-charts"></div>
                </div>
            </div>
        </div>
    </div>

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
   `<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            setInterval(function () {
                $.ajax({
                    type: "GET",
                    url: `https://api.nomics.com/v1/currencies/ticker?key=aba7d7994847e207e4e405132c98374a3c061c5e&interval=1h,1d,30d&convert=USD&per-page=100&page=1&ids=BTC,ETH,XRP`,
                    dataType: 'json',
                    success: function (data) {
                        if (data.length > 0) {
                            $('#cap').html(appendHTML(data))
                        }
                    }
                });
            }, 10000)

            let options = {
                series: [{!! json_encode($deposits) !!}, {!! json_encode($payouts) !!}],
                chart: {width: 320, height: 320, type: "pie"},
                labels: ["Deposits", "Withdrawals"],
                colors: ["#777aca", "#098738"],
                stroke: {width: 1},
                legend: {show: !0},
                responsive: [{breakpoint: 480, options: {chart: {width: 200}}}]
            };
            (chart = new ApexCharts(document.querySelector("#wallet-balance"), options)).render();
        });

        function appendHTML(data) {
            let market = '';
            data.forEach((cur, i) => {
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
                <td>$ ${parseFloat(market['price']).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,')}</td>
                <td>$ ${cap(market['market_cap'])}</td>
                <td class="${ typeof market["1h"] !== "undefined" ? (parseFloat(market["1h"]["price_change_pct"]) < 0 ? 'text-danger' : 'text-success') : '' }">${typeof market["1h"] !== "undefined" ? roundNumber(market["1h"]["price_change_pct"] * 100, 2)+'%' : '' }</td>
                <td class="${ typeof market["1d"] !== "undefined" ? (parseFloat(market["1d"]["price_change_pct"]) < 0 ? 'text-danger' : 'text-success') : '' }">${typeof market["1d"] !== "undefined" ? roundNumber(market["1d"]["price_change_pct"] * 100, 2)+'%' : '' }</td>
                <td class="${ typeof market["30d"] !== "undefined" ? (parseFloat(market["30d"]["price_change_pct"]) < 0 ? 'text-danger' : 'text-success') : '' }">${typeof market["30d"] !== "undefined" ? roundNumber(market["30d"]["price_change_pct"] * 100, 2)+'%' : '' }</td>
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
@endsection
