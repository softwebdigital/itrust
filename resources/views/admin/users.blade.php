@extends('layouts.admin')

@section('head')
    {{ 'Users' }}
@endsection

@section('title')
    {{ 'Users' }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Users</li>
@endsection

@section('content')
<div>
    <table id="datatable" class="table table-borderless table-striped table-responsive nowrap w-100">
        <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Approval</th>
            <th>Date Joined</th>
            <th></th>
        </tr>
        </thead>

        <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{ $user->full_name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->phone }}</td>
                <td> <span class="badge
                    {{ $user->status == 'pending' ? 'bg-warning' : '' }}
                    {{ $user->status == 'declined' ? 'bg-danger' : '' }}
                    {{ $user->status == 'approved' ? 'bg-success' : '' }}
                    {{ $user->status == 'suspended' ? 'bg-dark' : '' }}
                        ">{{ ucwords($user->status) }}</td>
                <td>{{ date('d/M/Y', strtotime($user->created_at)) }}</td>
                <td>
                    <div class="btn-group">
                        <button type="button" class="btn btn-dark btn-sm dropdown-toggle dropdown-toggle-split" id="dropdownMenuReference1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-reference="parent">
                            <span>Menu </span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuReference1">
                            <a class="dropdown-item" href="{{ route('admin.users.show', $user->id) }}">View User</a>
                            @if($user->isWaitingApproval())
                            @if($user->btc_wallet != '')
                            <a class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#staticBackdrop-approve-{{ $user->id }}">Approve User</a>
                            @else
                            <a class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#staticBackdrop-approvewithWallet-{{ $user->id }}">Approve User</a>
                            @endif
                                <a class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#staticBackdrop-decline-{{ $user->id }}">Decline User</a>
                            @endif
                            @if($user->isDeclined())
                                <a class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#staticBackdrop-approve-{{ $user->id }}">Approve User</a>
                            @endif
                            @if($user->isSuspended())
                                <a class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#staticBackdrop-approve-{{ $user->id }}">Unsuspend User</a>
                            @endif
                            @if($user->status == 'approved')
                                <a class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#staticBackdrop-suspend-{{ $user->id }}">Suspend User</a>
                                <a class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#staticBackdrop-invest-{{ $user->id }}">Invest</a>
                            @endif
                        </div>
                    </div>
                </td>
            </tr>

            <div class="modal fade" id="staticBackdrop-approve-{{ $user->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Confirm Approval</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('admin.users.account', [$user->id, 'approved']) }}" method="post">@csrf @method('PUT')
                            <div class="modal-body">
                                <p>Are you sure you want to approve this user?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Approve</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="staticBackdrop-approvewithWallet-{{ $user->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Confirm Approval</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('admin.users.accountBtcWallet', [$user->id, 'approved']) }}" method="post">@csrf @method('PUT')
                            <div class="modal-body">
                                <div class="form-group">
                                    <div class="input-group mb-3">
                                        <label class="input-group-text" for="btc_wallet">₿</label>
                                        <input type="text" step="any" class="form-control @error('btc_wallet') is-invalid @enderror"
                                            name="btc_wallet" value="{{ old('btc_wallet') }}" id="btc_wallet" placeholder="BTC Wallet">
                                    </div>
                                    @error('btc_wallet') <strong class="text-danger" role="alert">{{ $message }}</strong>
                                    @enderror
                                </div>
                                <p>Are you sure you want to approve this user?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Approve</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="staticBackdrop-decline-{{ $user->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Confirm Decline</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('admin.users.account', [$user->id, 'declined']) }}" method="post">@csrf @method('PUT')
                            <div class="modal-body">
                                <p>Are you sure you want to decline this user approval?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-danger">Decline</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="staticBackdrop-suspend-{{ $user->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Confirm Suspension</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('admin.users.account', [$user->id, 'suspended']) }}" method="post">@csrf @method('PUT')
                            <div class="modal-body">
                                <p>Are you sure you want to suspend this user?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-danger">Suspend</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="staticBackdrop-invest-{{ $user->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Invest for users</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('admin.users.invest', $user->id) }}" method="post">
                            @csrf
                            @method('POST')
                            <div class="modal-body">
                                <div class="form-group">
                                    <div class="input-group mb-3">
                                        <label class="input-group-text" for="amount">$</label>
                                        <input type="amount" step="any" class="form-control @error('amount') is-invalid @enderror"
                                            name="amount" value="{{ old('amount') }}" id="amount" placeholder="Amount">
                                    </div>
                                    @error('amount') <strong class="text-danger" role="alert">{{ $message }}</strong>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="type">Product :</label>
                                    <select class="form-select @error('type') is-invalid @enderror" name="type" id="type"
                                        onchange="showMethodwithdraw(this)">
                                        <option value="">Select Product Type</option>
                                        <option value="stocks_and_funds" {{ old('type') == 'stocks_and_funds' ? 'selected' : '' }}>Stocks and Funds
                                        </option>
                                        <option value="crypto" {{ old('type') == 'crypto' ? 'selected' : '' }}>Crypto</option>
                                        <option value="gold" {{ old('type') == 'gold' ? 'selected' : '' }}>Gold</option>
                                        <option value="cash_management" {{ old('type') == 'cash_management' ? 'selected' : '' }}>Cash Management</option>
                                        <option value="options" {{ old('type') == 'options' ? 'selected' : '' }}>Options</option>
                                    </select>
                                    @error('type') <strong class="text-danger" role="alert">{{ $message }}</strong> @enderror
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-danger">Invest</button>
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
        $('#datatable').DataTable()
    </script>
@endsection
