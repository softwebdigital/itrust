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
            <a class="btn btn-primary m-2" href="{{ URL::to('/statements/pdf') }}">Generate Account statement</a>
{{--            <a class="btn btn-primary m-2" href="{{ URL::to('/invoice/pdf/statement') }}">Generate latest invoice</a>--}}
        </div>
        <div class="table-responsive">
            <table id="datatable" class="table table-borderless table-striped table-responsive  nowrap w-100">
                <thead>
                <tr>
                    <th>Date</th>
                    <th>Account</th>
                    <th>Amount</th>
                    <th>ROI</th>
                    <th>Type</th>
                    <th>Status</th>
                </tr>
                </thead>

                <tbody>
               @foreach($investments as $investment)
                   <tr>
                       <td>{{ \Carbon\Carbon::make($investment->created_at)->format('Y/m/d') }}</td>
                       <td>
                        @if($investment->acct_type == 'offshore')
                        Offshore
                        @elseif($investment->acct_type == 'basic_ira')
                        Basic IRA
                        @else
                        -----
                        @endif
                    </td>
                    <td>{{ $symbol->symbol }}{{ number_format($investment->amount, 2) }}</td>
                    <td>{{ $symbol->symbol }}{{ number_format($investment->ROI, 2) }}</td>
                       <td>{{ ucwords(str_replace('_', ' ', $investment->type)) }}</td>
                       <td> <span class="badge p-2
                               {{ $investment->status == 'open' ? 'bg-success' : '' }}
                               {{ $investment->status == 'closed' ? 'bg-danger' : '' }}
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
