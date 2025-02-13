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
                    <th>Account</th>
                    <th>Investment</th>
                    <th>Asset</th>
                    <th>ROI</th>
                    <th>Leverage</th>
                    <th>S/L</th>
                    <th>T/P</th>
                    <th>Date</th>
                    <th>Status</th>
                </tr>
                </thead>

                <tbody>
               @foreach($investments as $investment)
                   <tr>
                       <td>
                            @if($investment->acct_type == 'offshore')
                                Offshore
                            @elseif($investment->acct_type == 'basic_ira')
                                Basic IRA
                            @else
                                -----
                            @endif
                       </td>
                       <td>
                            <h5>{{ $symbol->symbol }}{{ number_format($investment->amount, 2) }}</h5>
                            <p>{{ ucwords(str_replace('_', ' ', $investment->asset_type)) }}</p>
                       </td>
                       <td>
                            {{ ucwords(str_replace('_', ' ', $investment->type)) }}
                            @if($investment->asset_type == 'stocks')
                                <span class="px-3"><i class="fas fa-arrow-up text-success"></i></span>
                            @else
                                <span class="px-3"><i class="fas fa-arrow-down text-danger"></i></span>
                            @endif
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
                            <p class="@if($percentage < 0) text-danger @else text-success @endif"> @if($percentage > 0) + @endif
                                {{ number_format($percentage) }} %</p>
                        </td>
                       <td>
                            {{ ucwords($investment->leverage) }}X
                       </td>
                       <td>
                            {{ ucwords($investment->stop_loss) }}
                       </td>
                       <td>
                            {{ ucwords($investment->take_profit) }}
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
