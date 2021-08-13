@extends('layouts.admin')

@section('head')
    {{ __('Transactions') }}
@endsection

@section('title')
    {{ __('Transactions') }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Transactions</li>
@endsection

@section('content')
    <div class="card-body">
        <table id="datatable" class="table table-borderless table-striped dt-responsive  nowrap w-100">
            <thead>
            <tr>
                <th>User</th>
                <th>Amount</th>
                <th>Status</th>
                <th>type</th>
                <th>Date</th>
            </tr>
            </thead>

            <tbody>
            @foreach($transactions as $transaction)
                <tr>
                    <td>{{ $transaction->user->username }}</td>
                    <td>{{ $transaction->method == 'bank' ? '$'.number_format($transaction->amount, 2) : round($transaction->amount, 8).' BTC' }}</td>
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
