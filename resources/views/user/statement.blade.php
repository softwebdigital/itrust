@extends('layouts.user')

@section('head')
    {{ __('Statement') }}
@endsection

@section('title')
    {{ __('My Statement') }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('user.index') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Statement</li>
@endsection

@section('content')
    <div class="card-body">
        <table id="datatable" class="table table-borderless table-striped table-responsive  nowrap w-100">
            <thead>
            <tr>
                <th>Date</th>
                <th>Type</th>
                <th>Amount</th>
                <th>Status</th>
            </tr>
            </thead>

            <tbody>
           @foreach($investments as $investment)
               <tr>
                   <td>{{ \Carbon\Carbon::make($investment->created_at)->format('Y/m/d') }}</td>
                   <td>{{ ucwords(str_replace('_', ' ', $investment->type)) }}</td>
                   <td>{{ $investment->type == 'stocks_and_funds' ? '$'.number_format($investment->amount, 2) : round($investment->amount, 8).' BTC' }}</td>
                   <td> <span class="badge p-2
                           {{ $investment->status == 'open' ? 'bg-success' : '' }}
                           {{ $investment->status == 'closed' ? 'bg-danger' : '' }}
                       ">{{ ucwords($investment->status) }}</td>
               </tr>
           @endforeach
            {{-- <tr>
                <td>2021/09/08</td>
                <td>Crypto</td>
                <td>0.05788292 BTC</td>
                <td><span class="badge p-2 bg-success">Opened</span></td>
            </tr>
            <tr>
                <td>2021/09/08</td>
                <td>Crypto</td>
                <td>0.05788292 BTC</td>
                <td><span class="badge p-2 bg-success">Opened</span></td>
            </tr>
            <tr>
                <td>2021/09/08</td>
                <td>Crypto</td>
                <td>0.05788292 BTC</td>
                <td><span class="badge p-2 bg-success">Opened</span></td>
            </tr>
            <tr>
                <td>2021/09/08</td>
                <td>Stock</td>
                <td>$2,000.00</td>
                <td><span class="badge p-2 bg-danger">Closed</span></td>
            </tr>
            <tr>
                <td>2021/09/08</td>
                <td>Crypto</td>
                <td>0.05788292 BTC</td>
                <td><span class="badge p-2 bg-success">Opened</span></td>
            </tr>
            <tr>
                <td>2021/09/08</td>
                <td>Crypto</td>
                <td>0.05788292 BTC</td>
                <td><span class="badge p-2 bg-danger">Closed</span></td>
            </tr>
            <tr>
                <td>2021/09/08</td>
                <td>Stock</td>
                <td>$20,000.00</td>
                <td><span class="badge p-2 bg-success">Opened</span></td>
            </tr> --}}
            </tbody>
        </table>

    </div>
@endsection

@section('script')
    <script>
        $('#datatable').DataTable()
    </script>
@endsection
