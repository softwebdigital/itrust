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
    <div class="card-body">
        <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
            <thead>
            <tr>
                <th></th>
                <th>User</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Date Deposited</th>
                <th>Date Reviewed</th>
                <th></th>
                <th></th>
            </tr>
            </thead>

            <tbody>
            <tr>
                <td>1</td>
                <td>Deedee</td>
                <td>$10,000</td>
                <td>Approved</td>
                <td>2013/08/11</td>
                <td>2013/08/11</td>
                <td><i class="icon-md" data-feather="check"></i></td>
                <td><i class="icon-md" data-feather="x"></i></td>
            </tr>
            <tr>
                <td>2</td>
                <td>Deedee</td>
                <td>$10,000</td>
                <td>Approved</td>
                <td>2013/08/11</td>
                <td>2013/08/11</td>
                <td><i class="icon-md" data-feather="check"></i></td>
                <td><i class="icon-md" data-feather="x"></i></td>
            </tr>
            <tr>
                <td>3</td>
                <td>Deedee</td>
                <td>$10,000</td>
                <td>Approved</td>
                <td>2013/08/11</td>
                <td>2013/08/11</td>
                <td><i class="icon-md" data-feather="check"></i></td>
                <td><i class="icon-md" data-feather="x"></i></td>
            </tr>
            <tr>
                <td>4</td>
                <td>Deedee</td>
                <td>$10,000</td>
                <td>Approved</td>
                <td>2013/08/11</td>
                <td>2013/08/11</td>
                <td><i class="icon-md" data-feather="check"></i></td>
                <td><i class="icon-md" data-feather="x"></i></td>
            </tr>
            <tr>
                <td>5</td>
                <td>Deedee</td>
                <td>$10,000</td>
                <td>Approved</td>
                <td>2013/08/11</td>
                <td>2013/08/11</td>
                <td><i class="icon-md" data-feather="check"></i></td>
                <td><i class="icon-md" data-feather="x"></i></td>
            </tr>
            </tbody>
        </table>

    </div>
@endsection

@section('script')
    <script>
        // $('#datatable').DataTable()
    </script>
@endsection
