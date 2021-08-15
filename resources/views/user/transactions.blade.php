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
        <table id="datatable" class="table table-borderless table-striped table-responsive  nowrap w-100">
            <thead>
            <tr>
                <th>Amount</th>
                <th>Method</th>
                <th>Status</th>
                <th>type</th>
                <th>Date</th>
            </tr>
            </thead>

            <tbody>
            @foreach($transactions as $transaction)
                <tr>
                    <td>{{ $transaction->method == 'bank' ? '$'.number_format($transaction->amount, 2) : round($transaction->amount, 8).' BTC' }}</td>
                    <td>{{ $transaction->method ? ucwords($transaction->method) : '----' }}</td>
                    <td> <span class="badge
                                {{ $transaction->status == 'pending' ? 'bg-warning' : '' }}
                        {{ $transaction->status == 'declined' ? 'bg-danger' : '' }}
                        {{ $transaction->status == 'approved' ? 'bg-success' : '' }}
                            ">{{ ucwords($transaction->status) }}</td>
                    <td>{{ ucwords($transaction->type) }}</td>
                    <td>{{ \Carbon\Carbon::make($transaction->created_at)->format('Y/m/d') }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

    </div>
@endsection

@section('script')
    <script>
        // $('#datatable').DataTable()
    </script>
@endsection
