@extends('layouts.admin')

@section('head')
    {{ 'Fund Requests' }}
@endsection

@section('title')
    {{ 'Fund Requests' }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
    <li class="breadcrumb-item">Fund</li>
    <li class="breadcrumb-item active">Request</li>
@endsection

@section('content')
<div class="table-responsive" style="min-height: 500px; border-color: white;">
    <table id="datatable" class="table table-borderless table-striped table-responsive nowrap w-100">
        <thead>
        <tr>
            <th>S/N</th>
            <th>User</th>
            <th>Account</th>
            <th>Amount</th>
            <th>Code</th>
            <th>Reason</th>
            <th>Status</th>
            <th>Date</th>
            <th></th>
        </tr>
        </thead>

        <tbody>
        @foreach($funds as $index => $fund)
            @php 
                $user = App\Models\User::find($fund->user_id);
            @endphp
            <tr>
                <td>{{ $index +  1 }}</td>
                <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                <td>{{ $fund->account }}</td>
                <td>{{ $fund->amount }}</td>
                <td>
                    @if($fund->code)
                        {{ $fund->code }}
                    @endif
                </td>
                <td>{{ Str::limit($fund->reason, 95) }}</td>
                <td> <span class="badge
                    {{ $fund->status == 'pending' ? 'bg-warning' : '' }}
                    {{ $fund->status == 'cancelled' ? 'bg-danger' : '' }}
                    {{ $fund->status == 'approved' ? 'bg-success' : '' }}
                    {{ $fund->status == 'suspended' ? 'bg-dark' : '' }}
                        ">{{ ucwords($fund->status) }}</td>
                <td>{{ date('d/M/Y', strtotime($fund->created_at)) }}</td>
                <td>
                    <div class="btn-group">
                        <button type="button" class="btn btn-dark btn-sm dropdown-toggle dropdown-toggle-split" id="dropdownMenuReference1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-reference="parent">
                            <span>Menu </span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuReference1">
                            @if($fund->status == 'pending')
                            <a class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#staticBackdrop-approveStatus-{{ $fund->id }}">Approve</a>

                            <a class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#staticBackdrop-declineStatus-{{ $fund->id }}">Decline</a>
                            @endif
                        </div>
                    </div>
                </td>
            </tr>

            <div class="modal fade" id="staticBackdrop-approveStatus-{{ $fund->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Confirm Approval</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('admin.funds.update', [$fund->id, 'approved']) }}" method="post">@csrf @method('PUT')
                            <div class="modal-body">
                                <p>Are you sure you want to approve this request?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success">Approve</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="staticBackdrop-declineStatus-{{ $fund->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Confirm Declination</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('admin.funds.update', [$fund->id, 'cancelled']) }}" method="post">@csrf @method('PUT')
                            <div class="modal-body">
                                <p>Are you sure you want to decline this request?</p>
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
        $('#datatable').DataTable()
    </script>
@endsection
