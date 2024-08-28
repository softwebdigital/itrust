@extends('layouts.user')

@section('head')
    {{ __('Trading History') }}
@endsection

@section('title')
    {{ __('Trading History') }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('user.index') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Trading History</li>
@endsection
@section('style')
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.1.0/css/buttons.dataTables.min.css">
@endsection

@php
    $user = \App\Models\User::find(auth()->id());
    $symbol = \App\Models\Currency::where('id', $user->currency_id)->first();
@endphp

@section('content')
    <div class="card-body">
        <div class="d-flex justify-content-end mb-4">
        </div>
        <div class="table-responsive">
            <table id="datatable" class="table table-borderless table-responsive  nowrap w-100">
                <thead>
                <tr>
                    <th>Copy Bots</th>
                    <th>Investment</th>
                    <th>ROI</th>
                    <th>Account</th>
                    <th>Date</th>
                    <th>Status</th>
                </tr>
                </thead>

                <tbody>
               @foreach($investments as $investment)
                   <tr>
                       <td>
                       @if($investment->copyBot)
                            <div class="col">
                                <img src="{{ $investment->copyBot->image }}" alt="" width="50" class="rounded-circle">
                            </div>
                        @elseif($investment->type == 'Cryptocurrencies')
                            <div class="col">
                                <img src="https://itrustinvestment.com/img/bots/170457095116.png" alt="" width="50" class="rounded-circle">
                            </div>
                        @elseif($investment->type == 'stocks')
                            <div class="col">
                                <img src="https://www.itrustinvestment.com/img/bots/1701947098355_2021-06-22-14-19-40.png" alt="" width="50" class="rounded-circle">
                            </div>
                        @else 
                            <div class="col">
                                <img src="https://www.itrustinvestment.com/img/bots/1687558439CCAC78C9-717D-4CE9-AB03-88C2814C6A65.jpeg" alt="" width="50" class="rounded-circle">
                            </div>
                        @endif

                       </td>
                       <td>
                            <h5>{{ $symbol->symbol }}{{ number_format($investment->amount, 2) }}</h5>
                            <p>{{ ucwords(str_replace('_', ' ', $investment->type)) }}</p>
                       </td>
                        <td>
                            @php
                                $investmentAmount = $investment->amount;
                                $roi = $investment->ROI;
                                if ($investmentAmount != 0) {
                                    $percentage = ($roi / $investmentAmount) * 100;
                                } else {
                                    $percentage = 0;
                                }
                            @endphp
                            <h5>{{ $symbol->symbol }}{{ number_format($investment->ROI, 2) }}</h5>
                            <p class="text-success">+{{ number_format($percentage) }} %</p>
                        </td>
                       <td>
                            @if($investment->acct_type == 'offshore')
                            Offshore
                            @elseif($investment->acct_type == 'basic_ira')
                            Basic IRA
                            @else
                            -----
                            @endif
                        </td>
                        
                        <td>{{ \Carbon\Carbon::make($investment->created_at)->format('Y/m/d') }}</td>
                       <td> <span class="badge p-2
                               {{ $investment->status == 'open' ? 'bg-dark text-success' : '' }}
                               {{ $investment->status == 'closed' ? 'bg-dark text-danger' : '' }}
                           ">{{ ucwords($investment->status) }}</td>
                   </tr>
               @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('script')
    <script>
        // $('#datatable').DataTable()

        $('#datatable').DataTable({
            "order": [
                [0, "desc"]
            ]
        });
    </script>
@endsection
