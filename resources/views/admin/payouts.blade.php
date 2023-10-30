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
<div class="modal fade" id="staticBackdrop-add" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Add Payout</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="form" method="post" enctype="multipart/form-data" action="{{ route('admin.users.addtransaction', 'payout') }}">
                <div class="modal-body">
                    @csrf
                    @method('POST')
                    <div class="form-group mb-3">
                        <label for="">User <span class="text-danger">*</span></label>
                        <select class="form-select @error('user') is-invalid @enderror" name="user" id="user">
                            <option value="">Select User</option>
                            @foreach ($users as $user)
                            <option value="{{ $user->id }}" {{ old('user') ==  $user->id  ? 'selected' : '' }}>{{ $user->username }}</option>
                            @endforeach
                        </select>
                        @error('user') <strong class="text-danger" role="alert">{{ $message }}</strong> @enderror
                    </div>
                    <div class="form-group mb-3">
                            <label for="">Amount <span class="text-danger">*</span></label>
                            <input type="amount" step="any" class="form-control @error('amount') is-invalid @enderror"
                                name="amount" value="{{ old('amount') }}" id="amount" placeholder="Amount Invested">
                        @error('amount') <strong class="text-danger" role="alert">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Method <span class="text-danger">*</span></label>
                        <select class="form-select @error('method') is-invalid @enderror" name="method" id="user">
                            <option value="">Select Method</option>
                            <option @if(old('method') == 'bank') selected @endif value="bank">Bank Deposit</option>
                            <option @if(old('method') == 'bitcoin') selected @endif value="bitcoin">Bitcoin</option>
                        </select>
                        @error('method') <strong class="text-danger" role="alert">{{ $message }}</strong> @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Account <span class="text-danger">*</span></label>
                        <select class="form-select @error('account') is-invalid @enderror" name="account" id="user">
                            <option value="">Select Account</option>
                            <option @if(old('account') == 'basic_ira') selected @endif value="basic_ira">Basic IRA </option>
                            <option @if(old('account') == 'offshore') selected @endif value="offshore"> Offshore Account </option>
                        </select>
                        @error('account') <strong class="text-danger" role="alert">{{ $message }}</strong> @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Date <span class="text-danger">*</span></label>
                        <input type="date" step="any" class="form-control required @error('date') is-invalid @enderror"
                            name="date" value="{{ old('date') }}" id="amount" placeholder="Date">
                    @error('date') <strong class="text-danger" role="alert">{{ $message }}</strong>
                    @enderror
                </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>
            </form>
        </div>
    </div>
</div>
    <div class="card-body">
        <div class="d-flex justify-content-end mb-3">
            {{-- <a href="{{ route('admin.inv.create') }}" type="button" c>Add Investment</a> --}}
            <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#staticBackdrop-add" class="btn btn-primary">Add Payout</a>
        </div>
        <div class="table-responsive" style="border-color: white;">
            <table id="datatable" class="table table-borderless table-striped table-responsive  nowrap w-100">
                <thead>
                <tr>
                    <th>Date Requested</th>
                    <th>User</th>
                    <th>Amount</th>
                    <th>Method</th>
                    <th>Account</th>
                    <th>Status</th>
                    <th>Date Reviewed</th>
                    <th></th>
                </tr>
                </thead>

                <tbody>
                @foreach($payouts as $payout)
                    <tr>
                        <td>{{ \Carbon\Carbon::make($payout->created_at)->format('Y/m/d') }}</td>
                        @if($payout->user)
                            <td>{{ $payout->user->username }}</td>
                        @else
                            <td>( Deleted User )</td>
                        @endif
                        <td>${{ number_format($payout->actual_amount, 2) }}</td>
                        <td>{{ ucwords($payout->method) }}</td>
                        <td>
                            @if($payout->acct_type == 'offshore')
                            Offshore
                            @elseif($payout->acct_type == 'basic_ira')
                            Basic IRA
                            @else
                            -----
                            @endif
                        </td>
                        <td> <span class="badge p-2
                                    {{ $payout->status == 'pending' ? 'bg-warning' : '' }}
                            {{ $payout->status == 'declined' || $payout->status == 'cancelled' ? 'bg-danger' : '' }}
                            {{ $payout->status == 'approved' ? 'bg-success' : '' }}
                            {{ $payout->status == 'cancelled' ? 'bg-danger' : '' }}
                                {{ $payout->status == 'progress' ? 'bg-secondary' : '' }}
                                ">{{ ucwords($payout->status) }}</td>

                        <td>{{ $payout->status != 'pending' ? \Carbon\Carbon::make($payout->updated_at)->format('Y/m/d') : '-----' }}</td>
                        <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-dark btn-sm dropdown-toggle dropdown-toggle-split" id="dropdownMenuReference1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-reference="parent">
                                    <span>Menu </span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down">
                                        <polyline points="6 9 12 15 18 9"></polyline>
                                    </svg>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuReference1">
                                    @if($payout->status == 'pending' || $payout->status == 'progress')
                                        <a class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#staticBackdrop-view-{{ $payout->id }}">View</a>
                                        <a class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#staticBackdrop-approve-{{ $payout->id }}">Approve</a>
                                        <a class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#staticBackdrop-decline-{{ $payout->id }}">Decline</a>
                                        <a class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#staticBackdrop-progress-{{ $payout->id }}">Progress</a>
                                    @endif
                                    <a class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#staticBackdrop-edit-{{ $payout->id }}">Edit</a>
                                    <a class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#staticBackdrop-delete-{{ $payout->id }}">Delete</a>
                                </div>
                            </div>
                        </td>
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

                    <div class="modal fade" id="staticBackdrop-delete-{{ $payout->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Confirm Delete</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="{{ route('admin.payouts.action', [$payout->id, 'delete']) }}" method="post">@csrf @method('PUT')
                                    <div class="modal-body">
                                        <p>Are you sure you want to delete this payout?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="staticBackdrop-progress-{{ $payout->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Confirm Progress</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="{{ route('admin.transaction.progress', [$payout->id, 'progress']) }}" method="post">@csrf @method('PUT')
                                    <div class="modal-body">
                                        <p>Are you sure you want to mark payout as progress?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="staticBackdrop-view-{{ $payout->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Payout Preview</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">

                                    @if($payout->method == 'bank')
                                    <div class="form-group">
                                        <label for="">Amount</label>
                                        <input type="text" class="form-control-plaintext" value="${{ $payout->amount ?? '-----' }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Bank Name</label>
                                        <input type="text" class="form-control-plaintext" value="{{ $payout->bank_name ?? '-----' }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Account Name</label>
                                        <input type="text" class="form-control-plaintext" value="{{ $payout->acct_name ?? '-----' }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Account Number</label>
                                        <input type="text" class="form-control-plaintext" value="{{ $payout->acct_no ?? '-----' }}">
                                    </div>
                                    @else
                                    <div class="form-group">
                                        <label for="">Amount</label>
                                        <input type="text" class="form-control-plaintext" value="{{ $payout->amount.'($'.$payout->actual_amount.')' ?? '-----' }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="">BTC Wallet</label>
                                        <input type="text" class="form-control-plaintext" value="{{ $payout->btc_wallet ?? '-----' }}">
                                    </div>
                                    @endif
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="staticBackdrop-edit-{{ $payout->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Add Payout</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form class="form" method="post" enctype="multipart/form-data" action="{{ route('admin.transactions.edit', [$payout->id, 'payout']) }}">
                                    <div class="modal-body">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group mb-3">
                                            <label for="">User <span class="text-danger">*</span></label>
                                            <select class="form-select @error('user') is-invalid @enderror" name="user" id="user">
                                                <option value="">Select User</option>
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}" {{ old('user') ==  $user->id  ? 'selected' :
                                                        ($payout->user_id == $user->id ? 'selected' : '') }}>{{ $user->username }}</option>
                                                @endforeach
                                            </select>
                                            @error('user') <strong class="text-danger" role="alert">{{ $message }}</strong> @enderror
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="">Amount <span class="text-danger">*</span></label>
                                            <input type="number" step="any" class="form-control @error('amount') is-invalid @enderror"
                                                name="amount" value="{{ old('amount') ?? $payout['amount'] }}" id="amount" placeholder="Amount Invested">
                                            @error('amount') <strong class="text-danger" role="alert">{{ $message }}</strong>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="">Method <span class="text-danger">*</span></label>
                                            <select class="form-select @error('method') is-invalid @enderror" name="method" id="user">
                                                <option value="">Select Method</option>
                                                <option @if(old('method') == 'bank') selected @elseif($payout['method'] == 'bank') selected @endif value="bank">Bank Deposit</option>
                                                <option @if(old('method') == 'bitcoin') selected @elseif($payout['method'] == 'bitcoin') selected @endif value="bitcoin">Bitcoin</option>
                                            </select>
                                            @error('method') <strong class="text-danger" role="alert">{{ $message }}</strong> @enderror
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="">Account <span class="text-danger">*</span></label>
                                            <select class="form-select @error('account') is-invalid @enderror" name="account" id="user">
                                                <option value="">Select Account</option>
                                                <option @if(old('account') == 'basic_ira') selected @elseif($payout['acct_type'] == 'basic_ira') selected @endif value="basic_ira">Basic IRA </option>
                                                <option @if(old('account') == 'offshore') selected @elseif($payout['acct_type'] == 'offshore') selected @endif value="offshore"> Offshore Account </option>
                                            </select>
                                            @error('account') <strong class="text-danger" role="alert">{{ $message }}</strong> @enderror
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="">Date <span class="text-danger">*</span></label>
                                            <input type="date" step="any" class="form-control required @error('date') is-invalid @enderror"
                                                name="date" value="{{ old('date') ?? \Carbon\Carbon::make($payout['created_at'])->format('Y-m-d') }}" id="amount" placeholder="Date">
                                            @error('date') <strong class="text-danger" role="alert">{{ $message }}</strong>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </form>
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
            "order": [[ 0, "desc" ]]
        });
    </script>
    <script>
        if (error)
        $(window).on('load', function() {
        $('#staticBackdrop-add').modal('show');
    });
    </script>
@endsection
