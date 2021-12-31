@extends('layouts.admin')

@section('head')
    {{ 'investments' }}
@endsection

@section('title')
    {{ 'investments' }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">investments</li>
@endsection

@section('content')
<div style="min-height: 500px">
    <div class="d-flex justify-content-end mb-3">
        {{-- <a href="{{ route('admin.inv.create') }}" type="button" c>Add Investment</a> --}}
        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#staticBackdrop-add" class="btn btn-primary">Add Investment</a>
    </div>
    <table id="datatable" class="table table-borderless table-striped table-responsive nowrap">
        <thead>
            <tr>
                <th>Investment Date</th>
            <th>Name</th>
            <th>Email</th>
            <th>Amount</th>
            <th>ROI</th>
            <th>Asset</th>
            <th>Account</th>
            <th>Status</th>

            <th></th>
        </tr>
        </thead>

        <tbody>
        @foreach($investments as $investment)
            <tr>
                <td>{{ date('d/M/Y', strtotime($investment->created_at)) }}</td>
                <td>{{ $investment->user->full_name }}</td>
                <td>{{ $investment->user->email }}</td>
                <td>{{ number_format($investment->amount, 2) }}</td>
                <td>{{ number_format($investment->ROI, 2) }}</td>
                <td>{{ ucwords(str_replace('_', ' ', $investment->type)) }}</td>
                <td>
                    @if($investment->acct_type == 'offshore')
                    Offshore
                    @elseif($investment->acct_type == 'basic_ira')
                    Basic IRA
                    @endif
                </td>
                <td> <span class="badge
                    {{ $investment->status == 'closed' ? 'bg-danger' : '' }}
                    {{ $investment->status == 'open' ? 'bg-success' : '' }}
                        ">{{ ucwords($investment->status) }}</td>

                <td>
                    <div class="btn-group">
                        <button type="button" class="btn btn-dark btn-sm dropdown-toggle dropdown-toggle-split" id="dropdownMenuReference1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-reference="parent">
                            <span>Open </span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuReference1">
                                <a class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#staticBackdrop-roi-{{ $investment->id }}">Edit</a>
                                <a class="dropdown-item" href="{{ route('admin.investments.updatestatus', [$investment->id, 'closed']) }}">Make Closed</a>
                                <a class="dropdown-item" href="{{ route('admin.investments.updatestatus', [$investment->id, 'open']) }}">Make Open</a>
                                <a class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#staticBackdrop-delete-{{ $investment->id }}">Delete</a>
                        </div>
                    </div>
                </td>
            </tr>

            <div class="modal fade" id="staticBackdrop-roi-{{ $investment->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Invest for investments</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('admin.investments.addroi', $investment->id) }}" method="post">
                            @csrf
                            @method('POST')
                            <div class="modal-body">
                                <div class="form-group">
                                    <div class="input-group mb-3">
                                        <label class="input-group-text" for="investment">$</label>
                                        <input type="number" step="any" class="form-control @error('investment') is-invalid @enderror"
                                            name="investment" value="{{ $investment->amount }}" id="investment" placeholder="ROI">
                                    </div>
                                    @error('investment') <strong class="text-danger" role="alert">{{ $message }}</strong>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <div class="input-group mb-3">
                                        <label class="input-group-text" for="amount">ROI</label>
                                        <input type="number" step="any" class="form-control @error('amount') is-invalid @enderror"
                                            name="amount" value="{{ $investment->ROI }}" id="amount" placeholder="ROI">
                                    </div>
                                    @error('amount') <strong class="text-danger" role="alert">{{ $message }}</strong>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="date">Date <span class="text-danger">*</span></label>
                                    <input type="date" step="any" class="form-control required @error('date') is-invalid @enderror"
                                           name="date" value="{{ old('date') ?? \Carbon\Carbon::make($investment['created_at'])->format('Y-m-d') }}" id="date" placeholder="Date">
                                    @error('date') <strong class="text-danger" role="alert">{{ $message }}</strong>
                                    @enderror
                                </div>

                                {{-- <div class="form-group">
                                    <div class="input-group mb-3">
                                        <select class="form-select @error('status') is-invalid @enderror" name="status" style="display:block !important;">
                                            <option value="">Select Status</option>
                                            <option value="open" {{ $investment->status == 'open' ? 'selected' : '' }}>Open</option>
                                            <option value="closed" {{ $investment->status == 'closed' ? 'selected' : '' }}>Closed</option>
                                        </select>
                                    </div>
                                    @error('status') <strong class="text-danger" role="alert">{{ $message }}</strong> @enderror
                                </div> --}}
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-danger">Add</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="staticBackdrop-delete-{{ $investment->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Confirm Approval</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('admin.investments.delete', $investment->id) }}" method="post">@csrf @method('POST')
                            <div class="modal-body">
                                <p>Are you sure you want to delete this investment?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
        </tbody>
    </table>
</div>
<div class="modal fade" id="staticBackdrop-add" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Add Investment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="form" method="post" enctype="multipart/form-data" action="{{ route('admin.users.newInvest') }}">
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
                            <label for="">ROI <span class="text-danger">*</span></label>
                            <input type="amount" step="any" class="form-control @error('ROI') is-invalid @enderror"
                                name="ROI" value="{{ old('ROI') }}" id="ROI" placeholder="ROI">
                        @error('ROI') <strong class="text-danger" role="alert">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Status <span class="text-danger">*</span></label>
                        <select class="form-select @error('status') is-invalid @enderror" name="status" id="user">
                            <option value="">Select Status</option>
                            <option value="open">Open</option>
                            <option value="closed">Closed</option>
                        </select>
                        @error('status') <strong class="text-danger" role="alert">{{ $message }}</strong> @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Product <span class="text-danger">*</span></label>
                        <select class="form-select @error('type') is-invalid @enderror" name="type" id="type">
                            <option value="">Select Product Type</option>
                            <option value="stocks" {{ old('type') == 'stocks' ? 'selected' : '' }}>Stocks</option>
                            <option value="Bonds(Fixed Income)" {{ old('type') == 'Bonds(Fixed Income)' ? 'selected' : '' }}>Bonds(Fixed Income)</option>
                            <option value="Properties" {{ old('type') == 'Properties' ? 'selected' : '' }}>Properties</option>
                            <option value="Cryptocurrencies" {{ old('type') == 'Cryptocurrencies' ? 'selected' : '' }}>Cryptocurrencies</option>
                            <option value="ETF’S" {{ old('type') == 'ETF’S' ? 'selected' : '' }}>ETF’S</option>
                            <option value="gold" {{ old('type') == 'gold' ? 'selected' : '' }}>Gold</option>
                            <option value="NFT’S" {{ old('type') == 'NFT’S' ? 'selected' : '' }}>NFT’S</option>
                            <option value="Options" {{ old('type') == 'Options' ? 'selected' : '' }}>Options</option>
                        </select>
                        @error('type') <strong class="text-danger" role="alert">{{ $message }}</strong> @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="acct_type">Account :</label>
                        <select class="form-select @error('acct_type') is-invalid @enderror" name="acct_type"
                            id="acct_type">
                            <option value="">Select Account</option>
                            <option value="basic_ira">Basic IRA (current account)</option>
                            <option value="offshore"> Offshore Account </option>
                        </select>
                        @error('acct_type') <strong class="text-danger"
                            role="alert">{{ $message }}</strong> @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="date">Date <span class="text-danger">*</span></label>
                        <input type="date" step="any" class="form-control required @error('date') is-invalid @enderror"
                               name="date" value="{{ old('date') ?? now()->format('Y-m-d') }}" id="date" placeholder="Date">
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
@endsection

@section('script')
    <script>
        $('#datatable').DataTable({
            "order": [[ 0, "desc" ]]
        })
    </script>
@endsection
