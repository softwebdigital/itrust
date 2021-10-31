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
<div>
    <table id="datatable" class="table table-borderless table-striped table-responsive nowrap w-100">
        <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Amount</th>
            <th>ROI</th>
            <th>Investment Date</th>
            <th></th>
        </tr>
        </thead>

        <tbody>
        @foreach($investments as $investment)
            <tr>
                <td>{{ $investment->user->full_name }}</td>
                <td>{{ $investment->user->email }}</td>
                <td>{{ $investment->amount }}</td>
                <td>{{ $investment->ROI }}</td>
                <td>{{ date('d/M/Y', strtotime($investment->created_at)) }}</td>
                <td>
                    <div class="btn-group">
                        <button type="button" class="btn btn-dark btn-sm dropdown-toggle dropdown-toggle-split" id="dropdownMenuReference1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-reference="parent">
                            <span>Menu </span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuReference1">
                                <a class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#staticBackdrop-roi-{{ $investment->id }}">Add ROI</a>
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
                                        <label class="input-group-text" for="amount">$</label>
                                        <input type="amount" step="any" class="form-control @error('amount') is-invalid @enderror"
                                            name="amount" value="{{ old('amount') }}" id="amount" placeholder="ROI">
                                    </div>
                                    @error('amount') <strong class="text-danger" role="alert">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-danger">Add</button>
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
