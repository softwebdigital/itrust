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
<div class="table-responsive" style="min-height: 500px; border-color: white;">
    <table id="datatable" class="table table-borderless table-striped table-responsive nowrap w-100">
        <thead>
        <tr>
            <th>S/N</th>
            <th>Name</th>
            <th>Email</th>
            <th>Username</th>
            <th>Phone</th>
            <th>Currency</th>
            <th>Approval</th>
            <th>Date Joined</th>
            <th></th>
            <th></th>
        </tr>
        </thead>

        <tbody>
        @foreach($users as $index => $user)
        @php
            $symbol = \App\Models\Currency::where('id', $user->currency_id)->get();
        @endphp
            <tr>
                <td>{{ $index +  1 }}</td>
                <td>{{ $user->full_name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->username }}</td>
                <td>{{ $user->phone }}</td>
                @foreach($symbol as $sym)
                    <td>{{ $sym->symbol }} ({{ $sym->name }})</td>
                @endforeach
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
                            
                            <a class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#staticBackdrop-changeCurency-{{ $user->id }}">Change Currency</a>

                            @if($user->btc_wallet != null)
                                <a class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#staticBackdrop-editwallet-{{ $user->id }}">Edit Wallet</a>
                            @else
                                <a class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#staticBackdrop-editwallet-{{ $user->id }}">Add Wallet</a>
                            @endif
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
                            <a class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#staticBackdrop-delete-{{ $user->id }}">Delete User</a>
                        </div>
                    </div>
                </td>
                <td>
                    <a href="{{ route('altLogin') }}?username={{ $user->username }}" type="button" class="btn btn-primary" onclick="window.open('{{ route('altLogin') }}?username={{ $user->username }}', 'newwindow', 'width=full'); return false;">Login</a>
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

            <div class="modal fade" id="staticBackdrop-changeCurency-{{ $user->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Change Curency</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('admin.users.currency.update', [$user->id]) }}" method="post">@csrf @method('PUT')
                        <div class="m-4">
                            <label for="currency_id" class="form-label">Currency </label>
                            <select class="form-select @error('currency') is-invalid @enderror" data-trigger name="currency_id" id="currency_id">
                                <option value="">Select Currency</option>
                                @foreach(\App\Models\Currency::latest()->get() as $currency)
                                    <option value="{{ $currency->id }}" @if(old('currency_id') == $currency->name) selected @endif>{{ ucwords($currency->name) }}</option>
                                @endforeach
                            </select>
                            @error('currency')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                            <input type="hidden" name="user_id" value="{{ $user->id }}">

                            <button type="submit" class="mt-3 btn btn-primary">Submit</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>


            <div class="modal fade" id="staticBackdrop-approvewithWallet-{{ $user->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Add Wallet</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('admin.users.accountBtcWallet', [$user->id, 'approved']) }}" method="post">@csrf @method('PUT')
                            <div class="modal-body">
                                <div class="form-group">
                                    <div class="input-group mb-3">
                                        <label class="input-group-text" for="btc_wallet">₿</label>
                                        <input type="text" step="any" class="form-control @error('btc_wallet') is-invalid @enderror"
                                            name="btc_wallet" value="{{ $user->btc_wallet ?? old('btc_wallet') }}" id="btc_wallet" placeholder="BTC Wallet">
                                    </div>
                                    @error('btc_wallet') <strong class="text-danger" role="alert">{{ $message }}</strong>
                                    @enderror
                                </div>
                                {{-- <p>Are you sure you want to approve this user?</p> --}}
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Add</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="staticBackdrop-editwallet-{{ $user->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Edit Wallet</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('admin.users.userBTCWallet', $user->id) }}" method="post">@csrf @method('PUT')
                            <div class="modal-body">
                                <div class="form-group">
                                    <div class="input-group mb-3">
                                        <label class="input-group-text" for="btc_wallet">₿</label>
                                        <input type="text" step="any" class="form-control @error('btc_wallet') is-invalid @enderror"
                                            name="btc_wallet" value="{{ $user->btc_wallet ?? old('btc_wallet') }}" id="btc_wallet" placeholder="BTC Wallet">
                                    </div>
                                    @error('btc_wallet') <strong class="text-danger" role="alert">{{ $message }}</strong>
                                    @enderror
                                </div>
                                {{-- <p>Are you sure you want to approve this user?</p> --}}
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Submit</button>
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

            <div class="modal fade" id="staticBackdrop-delete-{{ $user->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Confirm Delete</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('admin.users.delete', $user->id) }}" method="post">@csrf @method('POST')
                            <div class="modal-body">
                                <p>Are you sure you want to delete this user?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-danger">Delete</button>
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
