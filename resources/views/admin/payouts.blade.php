@extends('layouts.admin')

@section('head')
    {{ __('Payouts') }}
@endsection

@section('title')
    {{ __('Payouts') }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Payouts</li>
@endsection

@section('content')
    <div class="card-body">
        <table id="datatable" class="table table-borderless table-striped table-responsive  nowrap w-100">
            <thead>
            <tr>
                <th>User</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Date Deposited</th>
                <th>Date Reviewed</th>
                <th></th>
            </tr>
            </thead>

            <tbody>
            @foreach($payouts as $payout)
                <tr>
                    <td>{{ $payout->user->username }}</td>
                    <td>${{ number_format($payout->actual_amount, 2) }}</td>
                    <td> <span class="badge p-2
                                {{ $payout->status == 'pending' ? 'bg-warning' : '' }}
                        {{ $payout->status == 'declined' ? 'bg-danger' : '' }}
                        {{ $payout->status == 'approved' ? 'bg-success' : '' }}
                            ">{{ ucwords($payout->status) }}</td>
                    <td>{{ \Carbon\Carbon::make($payout->created_at)->format('Y/m/d') }}</td>
                    <td>{{ $payout->status != 'pending' ? \Carbon\Carbon::make($payout->updated_at)->format('Y/m/d') : '-----' }}</td>
                    @if($payout->status == 'pending')
                        <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-dark btn-sm dropdown-toggle dropdown-toggle-split" id="dropdownMenuReference1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-reference="parent">
                                    <span>Menu </span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down">
                                        <polyline points="6 9 12 15 18 9"></polyline>
                                    </svg>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuReference1">
                                    <a class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#staticBackdrop-approve-{{ $payout->id }}">Approve</a>
                                    <a class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#staticBackdrop-decline-{{ $payout->id }}">Decline</a>
                                </div>
                            </div>
                        </td>
                    @endif
                </tr>
                <div class="modal fade" id="staticBackdrop-approve-{{ $payout->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Confirm Approval</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="{{ route('admin.payouts.action', [$payout->id, 'approved']) }}" method="post">@csrf @method('PUT')
                                <div class="modal-body">
                                    <p>Are you sure you want to approve this payout?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Approve</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="staticBackdrop-decline-{{ $payout->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Confirm Decline</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="{{ route('admin.payouts.action', [$payout->id, 'declined']) }}" method="post">@csrf @method('PUT')
                                <div class="modal-body">
                                    <p>Are you sure you want to decline this payout?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-danger">Decline</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
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
