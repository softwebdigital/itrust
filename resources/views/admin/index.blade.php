@extends('layouts.admin')

@section('title')
{{ __('Dashboard') }}
@endsection

{{--@section('breadcrumb')--}}
{{--    <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>--}}
{{--    <li class="breadcrumb-item active">Dashboard</li>--}}
{{--@endsection--}}


@section('content')
    <div class="row">
        <div class="col-xl-4 col-md-4">
            <!-- card -->
            <div class="card card-h-100">
                <!-- card body -->
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-6">
                            <span class="text-muted mb-3 lh-1 d-block text-truncate">Total Deposit</span>
                            <h4 class="mb-3">
                                $<span class="counter-value" data-target="{{ round($depositAmount, 2) }}">0</span>{{ $depositUnit }}
                            </h4>
                        </div>

                        <div class="col-6">
                            <div id="deposits" class="apex-charts mb-2"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-4">
            <!-- card -->
            <div class="card card-h-100">
                <!-- card body -->
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-6">
                            <span class="text-muted mb-3 lh-1 d-block text-truncate">Amount Invested</span>
                            <h4 class="mb-3">
                                $<span class="counter-value" data-target="{{ round($investedAmount, 2) }}">0</span>{{ $investedUnit }}
                            </h4>
                        </div>

                        <div class="col-6">
                            <div id="investments" class="apex-charts mb-2"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-4">
            <!-- card -->
            <div class="card card-h-100">
                <!-- card body -->
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-6">
                            <span class="text-muted mb-3 lh-1 d-block text-truncate">Total Payouts</span>
                            <h4 class="mb-3">
                                $<span class="counter-value" data-target="{{ round($payoutAmount, 2) }}">0</span>{{ $payoutUnit }}
                            </h4>
                        </div>

                        <div class="col-6">
                            <div id="payouts" class="apex-charts mb-2"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="card card-h-100">
                <!-- card body -->
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="apex-charts" id="live-chart"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body px-0 mx-auto">
                    <div id="total-balance" class="apex-charts"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script>
    let options = {
        series: [{data: {!! json_encode($depositData) !!}}],
        chart: {type: "line", height: 50, sparkline: {enabled: !0}},
        colors: ["#098738"],
        stroke: {curve: "smooth", width: 2},
        tooltip: {
            fixed: {enabled: !1}, x: {show: !1}, y: {
                title: {
                    formatter: function (r) {
                        return ""
                    }
                }
            }, marker: {show: !1}
        }
    }, chart = new ApexCharts(document.querySelector("#deposits"), options);
    chart.render();

    const inv = [];
    for (let i = 1; i <= {!! json_encode(now()->format('t')) !!}; i++) {
        inv.push(0);
    }

    options = {
        series: [{data: inv}],
        {{--series: [{data: {!! json_encode($data) !!}}],--}}
        chart: {type: "line", height: 50, sparkline: {enabled: !0}},
        colors: ["#5156be"],
        stroke: {curve: "smooth", width: 2},
        tooltip: {
            fixed: {enabled: !1}, x: {show: !1}, y: {
                title: {
                    formatter: function (r) {
                        return ""
                    }
                }
            }, marker: {show: !1}
        }
    }, chart = new ApexCharts(document.querySelector("#investments"), options);
    chart.render();

    options = {
        series: [{data: {!! json_encode($payoutData) !!}}],
        chart: {type: "line", height: 50, sparkline: {enabled: !0}},
        colors: ["#c70505"],
        stroke: {curve: "smooth", width: 2},
        tooltip: {
            fixed: {enabled: !1}, x: {show: !1}, y: {
                title: {
                    formatter: function (r) {
                        return ""
                    }
                }
            }, marker: {show: !1}
        }
    }, chart = new ApexCharts(document.querySelector("#payouts"), options);
    chart.render();

    (chart = new ApexCharts(document.querySelector("#live-chart"), {
        chart: {height: 350, type: "area", toolbar: {show: !1}},
        dataLabels: {enabled: !1},
        stroke: {curve: "smooth", width: 3},
        series: [
            {name: "Deposit", data: {!! json_encode($depositData) !!}},
            {name: "Investments", data: inv},
            {name: "Payouts", data: {!! json_encode($payoutData) !!}}
        ],
        colors: ['#098738', '#5156be', '#c70505'],
        xaxis: {
            type: "date",
            categories: {!! json_encode($days) !!}
        },
        grid: {borderColor: "#f1f1f1"},
        tooltip: {x: {format: "dd/MM"}}
    })).render();

    options = {
        series: [{!! json_encode($depositAmount) !!}, {!! json_encode($investedAmount) !!}, {!! json_encode($payoutAmount) !!}],
        chart: {width: 320, height: 320, type: "pie"},
        labels: ["Deposits", "Investments", "Payouts"],
        colors: ['#098738', '#5156be', '#c70505'],
        stroke: {width: 1},
        legend: {show: !0},
        responsive: [{breakpoint: 480, options: {chart: {width: 200}}}]
    };
    (chart = new ApexCharts(document.querySelector("#total-balance"), options)).render();
</script>
@endsection
