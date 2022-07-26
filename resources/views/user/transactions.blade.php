@extends('layouts.user')

@section('head')
    {{ __('Transactions') }}
@endsection

@section('title')
    {{ __('My Transactions') }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('user.index') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Transactions</li>
@endsection

@section('content')
    <div class="card-body">
        <div class="d-flex justify-content-end mb-4">
            <a class="btn btn-primary m-2" href="{{ URL::to('/transactions/pdf') }}">Generate Account History</a>
            <a class="btn btn-primary m-2" href="{{ URL::to('/invoice/pdf/statement') }}">Generate latest invoice</a>
        </div>
        <div class="table-responsive">
            <table id="datatable" class="table table-borderless table-striped table-responsive  nowrap w-100">
                <thead>
                <tr>
                    <th>Date</th>
                    <th>Type</th>
                    <th>Account Type</th>
                    <th>Amount</th>
                    <th>Method</th>
                    <th>Status</th>
                </tr>
                </thead>

                <tbody>
                @foreach($transactions as $transaction)
                    <tr>
                        <td>{{ \Carbon\Carbon::make($transaction->created_at)->format('Y/m/d') }}</td>
                        <td>{{ ucwords($transaction->type) }}</td>
                        <td>
                            @if($transaction->acct_type == 'offshore')
                            Offshore
                            @elseif($transaction->acct_type == 'basic_ira')
                            Basic IRA
                            @else
                            -----
                            @endif
                        </td>
                        <td>{{ $transaction->method == 'bank' ? '$'.number_format($transaction->amount, 2) : '$'.number_format($transaction->actual_amount, 2).' ('.round($transaction->amount, 8).'BTC)' }}</td>
                        <td>{{ $transaction->method ? ucwords($transaction->method) : '----' }}</td>
                        <td> <span class="badge
                                    {{ $transaction->status == 'pending' ? 'bg-warning' : '' }}
                            {{ $transaction->status == 'declined' ? 'bg-danger' : '' }}
                            {{ $transaction->status == 'approved' ? 'bg-success' : '' }}
                                ">{{ ucwords($transaction->status) }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $('#datatable').DataTable({
            "order": [
                [0, "desc"]
            ]
        });
    </script>
@endsection
