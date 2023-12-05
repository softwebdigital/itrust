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

@php
    $user = \App\Models\User::find(auth()->id());
    $symbol = \App\Models\Currency::where('id', $user->currency_id)->first();
@endphp

@section('content')
    <div class="card-body">
        <div class="d-flex justify-content-end mb-4">
            <a class="btn btn-primary m-2" href="{{ URL::to('/transactions/pdf') }}">Generate Account History</a>
{{--            <a class="btn btn-primary m-2" href="{{ URL::to('/invoice/pdf/statement') }}">Generate latest invoice</a>--}}
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
                    <th>Action</th>
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
                        <td>{{ $transaction->method == 'bank' ? $symbol->symbol.number_format($transaction->amount, 2) : $symbol->symbol.number_format($transaction->actual_amount, 2).' ('.round($transaction->amount, 8).'BTC)' }}</td>
                        <!-- <td>{{ $transaction->method ? ucwords($transaction->method) : '----' }}</td> -->
                        <td>{{ $transaction->method == 'bitcoin' ? 'Cryptocurrency' : ucwords($transaction->method) }}</td>
                        <td> <span class="badge

                            {{ $transaction->status == 'pending' ? 'bg-warning' : '' }}
                            {{ $transaction->status == 'declined' ? 'bg-danger' : '' }}
                                    {{ $transaction->status == 'pending' ? 'bg-warning' : '' }}
                            {{ $transaction->status == 'declined' || $transaction->status == 'cancelled' ? 'bg-danger' : '' }}
                            {{ $transaction->status == 'approved' ? 'bg-success' : '' }}
                            {{ $transaction->status == 'cancelled' ? 'bg-danger' : '' }}
                            {{ $transaction->status == 'progress' ? 'bg-secondary' : '' }}
                                ">{{ ucwords($transaction->status) }}</td>
                        
                        @if($transaction->type == 'payout')   
                        <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-dark btn-sm dropdown-toggle dropdown-toggle-split" id="dropdownMenuReference1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-reference="parent">
                                    <span>Menu </span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down">
                                        <polyline points="6 9 12 15 18 9"></polyline>
                                    </svg>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuReference1">
                                    <a class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#staticBackdrop-view-{{ $transaction->id }}">View Payout</a>
                                    @if($transaction->status == 'pending') 
                                        <a class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#staticBackdrop-cancel-{{ $transaction->id }}">Cancel Payout</a>
                                    @endif
                                </div>
                            </div>
                        </td>
                        @endif
                    </tr>
                    <div class="modal fade" id="staticBackdrop-cancel-{{ $transaction->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Confirm Cancellation</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="{{ route('user.transaction.cancel', [$transaction->id, 'cancelled']) }}" method="post">@csrf @method('PUT')
                                    <div class="modal-body">
                                        <p>Are you sure you want to Cancel this payout?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Approve</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="staticBackdrop-view-{{ $transaction->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Payout Preview</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">

                                    @if($transaction->method == 'bank')
                                    <div class="form-group">
                                        <label for="">Amount</label>
                                        <input type="text" class="form-control-plaintext" value="${{ $transaction->amount ?? '-----' }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Bank Name</label>
                                        <input type="text" class="form-control-plaintext" value="{{ $transaction->bank_name ?? '-----' }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Account Name</label>
                                        <input type="text" class="form-control-plaintext" value="{{ $transaction->acct_name ?? '-----' }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Account Number</label>
                                        <input type="text" class="form-control-plaintext" value="{{ $transaction->acct_no ?? '-----' }}">
                                    </div>
                                    @else
                                    <div class="form-group">
                                        <label for="">Amount</label>
                                        <input type="text" class="form-control-plaintext" value="{{ $transaction->amount.'($'.$transaction->actual_amount.')' ?? '-----' }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="">BTC Wallet</label>
                                        <input type="text" class="form-control-plaintext" value="{{ $transaction->btc_wallet ?? '-----' }}">
                                    </div>
                                    @endif
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
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
