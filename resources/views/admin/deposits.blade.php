@extends('layouts.admin')

@section('head')
    {{ __('Deposits') }}
@endsection

@section('title')
    {{ __('Deposits') }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Deposits</li>
@endsection

@section('content')
<div class="modal fade" id="staticBackdrop-add" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Add Deposit</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
                <div class="modal-body">
                        <form class="form" method="post" enctype="multipart/form-data" action="{{ route('admin.users.addtransaction', 'deposit') }}">
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
                                    <option value="btc" {{ old('method') == 'btc' ? 'selected' : '' }}>BTC</option>
                                    <option value="eth" {{ old('method') == 'eth' ? 'selected' : '' }}>ETH</option>
                                    <option value="usdt_trc20" {{ old('method') == 'usdt_trc20' ? 'selected' : '' }}>USDT (TRC20)</option>
                                    <option value="usdt_erc20" {{ old('method') == 'usdt_erc20' ? 'selected' : '' }}>USDT (ERC20)</option>
                                    <!-- <option value="usdt_eth" {{ old('method') == 'usdt_eth' ? 'selected' : '' }}>USDT (ETH)</option> -->
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
        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#staticBackdrop-add" class="btn btn-primary">Add Deposit</a>
    </div>
    <div class="table" style="overflow-x: auto; border-color: white;">
        <table id="datatable" class="table table-borderless table-striped nowrap">
            <thead>
            <tr>
                <th>Date Deposited</th>
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
            @foreach($deposits as $deposit)
                <tr>
                    <td>{{ \Carbon\Carbon::make($deposit->created_at)->format('Y/m/d') }}</td>
                    @if($deposit->user)
                        <td>{{ $deposit->user->username }}</td>
                    @else
                        <td>( Deleted User )</td>
                    @endif
                    <!-- <td>{{ $deposit->method == 'bank' ? '$' .number_format($deposit->amount, 2) : round($deposit->amount, 8).' BTC' }}</td> -->
                    <td>{{ '$' .number_format($deposit->actual_amount, 2) }} {{ $deposit->method == 'bitcoin' ? ' (' . round($deposit->amount, 8) .' BTC)' : '' }}</td>
                    <td>{{ ucwords($deposit->method) }}</td>
                    <td>
                        @if($deposit->acct_type == 'offshore')
                        Offshore
                        @elseif($deposit->acct_type == 'basic_ira')
                        Basic IRA
                        @endif
                    </td>
                    <td> <span class="badge
                                {{ $deposit->status == 'pending' ? 'bg-warning' : '' }}
                                {{ $deposit->status == 'declined' || $deposit->status == 'cancelled' ? 'bg-danger' : '' }}
                                {{ $deposit->status == 'approved' ? 'bg-success' : '' }}
                            ">{{ ucwords($deposit->status) }}</td>

                    <td>{{ $deposit->status != 'pending' ? \Carbon\Carbon::make($deposit->updated_at)->format('Y/m/d') : '-----' }}</td>
                    <td>

                        <div class="btn-group">
                            <button type="button" class="btn btn-dark btn-sm dropdown-toggle dropdown-toggle-split" id="dropdownMenuReference1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-reference="parent">
                                <span>Menu </span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down">
                                    <polyline points="6 9 12 15 18 9"></polyline>
                                </svg>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuReference1">
                                @if($deposit->status == 'pending')
                                    <a class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#staticBackdrop-approve-{{ $deposit->id }}">Approve</a>
                                    <a class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#staticBackdrop-decline-{{ $deposit->id }}">Decline</a>
                                @endif
                                <a class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#staticBackdrop-edit-{{ $deposit->id }}">Edit</a>
                                <a class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#staticBackdrop-delete-{{ $deposit->id }}">Delete</a>
                            </div>
                        </div>
                    </td>
                    <td></td>
                </tr>
                <div class="modal fade" id="staticBackdrop-approve-{{ $deposit->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content bg-white">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Confirm Approval</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="{{ route('admin.deposits.action', [$deposit->id, 'approved']) }}" method="post">@csrf @method('PUT')
                                <div class="modal-body">
                                    <p>Are you sure you want to approve this deposit?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Approve</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="staticBackdrop-decline-{{ $deposit->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content bg-white">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Confirm Decline</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="{{ route('admin.deposits.action', [$deposit->id, 'declined']) }}" method="post">@csrf @method('PUT')
                                <div class="modal-body">
                                    <p>Are you sure you want to decline this deposit?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-danger">Decline</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="staticBackdrop-delete-{{ $deposit->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content bg-white">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Confirm Delete</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="{{ route('admin.deposits.action', [$deposit->id, 'delete']) }}" method="post">@csrf @method('PUT')
                                <div class="modal-body">
                                    <p>Are you sure you want to delete this deposit?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="staticBackdrop-edit-{{$deposit->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content bg-white">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Edit Deposit</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form class="form" method="post" enctype="multipart/form-data" action="{{ route('admin.transactions.edit', [$deposit->id, 'deposit']) }}">
                                <div class="modal-body">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group mb-3">
                                        <label for="">User <span class="text-danger">*</span></label>
                                        <select class="form-select @error('user') is-invalid @enderror" name="user" id="user">
                                            <option value="">Select User</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}" {{ old('user') ==  $user->id  ? 'selected' :
                                                    ($user->id == $deposit->user_id ? 'selected' : '') }}>{{ $user->username }}</option>
                                            @endforeach
                                        </select>
                                        @error('user') <strong class="text-danger" role="alert">{{ $message }}</strong> @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="">Amount <span class="text-danger">*</span></label>
                                        <input type="number" step="any" class="form-control @error('amount') is-invalid @enderror"
                                               name="amount" value="{{ old('amount') ?? $deposit['actual_amount'] }}" id="amount" placeholder="Amount Invested">
                                        @error('amount') <strong class="text-danger" role="alert">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="">Method <span class="text-danger">*</span></label>
                                        <select class="form-select @error('method') is-invalid @enderror" name="method" id="user">
                                            <option value="">Select Method</option>
                                            <option @if(old('method') == 'bank') selected @elseif($deposit['method'] == 'bank') selected @endif value="bank">Bank Deposit</option>
                                            <option value="btc" {{ old('method') == 'btc' ? 'selected' : '' }}>BTC</option>
                                            <option value="eth" {{ old('method') == 'eth' ? 'selected' : '' }}>ETH</option>
                                            <option value="usdt_trc20" {{ old('method') == 'usdt_trc20' ? 'selected' : '' }}>USDT (TRC20)</option>
                                            <option value="usdt_erc20" {{ old('method') == 'usdt_erc20' ? 'selected' : '' }}>USDT (ERC20)</option>
                                            <!-- <option value="usdt_eth" {{ old('method') == 'usdt_eth' ? 'selected' : '' }}>USDT (ETH)</option> -->
                                        </select>
                                        @error('method') <strong class="text-danger" role="alert">{{ $message }}</strong> @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="">Account <span class="text-danger">*</span></label>
                                        <select class="form-select @error('account') is-invalid @enderror" name="account" id="user">
                                            <option value="">Select Account</option>
                                            <option @if(old('account') == 'basic_ira') selected @elseif($deposit['acct_type'] == 'basic_ira') selected @endif value="basic_ira">Basic IRA </option>
                                            <option @if(old('account') == 'offshore') selected @elseif($deposit['acct_type'] == 'offshore') selected @endif value="offshore"> Offshore Account </option>
                                        </select>
                                        @error('account') <strong class="text-danger" role="alert">{{ $message }}</strong> @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="">Date <span class="text-danger">*</span></label>
                                        <input type="date" step="any" class="form-control required @error('date') is-invalid @enderror"
                                               name="date" value="{{ old('date') ?? \Carbon\Carbon::make($deposit['created_at'])->format('Y-m-d') }}" id="amount" placeholder="Date">
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
