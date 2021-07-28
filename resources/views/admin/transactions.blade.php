@extends('layouts.admin')

@section('head')
    {{ __('Transactions') }}
@endsection

@section('title')
    {{ __('Transactions') }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Transactions</li>
@endsection

@section('content')
    <div class="card-body">
        <div class="table-rep-plugin">
            <div class="table-responsive mb-0" data-pattern="priority-columns">
                <table id="tech-companies-1" class="table table-striped">
                    <thead>
                    <tr>
                        <th></th>
                        <th>User</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>type</th>
                        <th>Date</th>
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>

                    <tbody>
                    <tr>
                        <td>1</td>
                        <td>Deedee</td>
                        <td>$10,000</td>
                        <td>Pending</td>
                        <td>Withdrawal</td>
                        <td>2013/08/11</td>
                        <td><i class="icon-md" data-feather="check"></i></td>
                        <td><i class="icon-md" data-feather="x"></i></td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Deedee</td>
                        <td>$10,000</td>
                        <td>Pending</td>
                        <td>Deposit</td>
                        <td>2013/08/11</td>
                        <td><i class="icon-md" data-feather="check"></i></td>
                        <td><i class="icon-md" data-feather="x"></i></td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Deedee</td>
                        <td>$10,000</td>
                        <td>Pending</td>
                        <td>Deposit</td>
                        <td>2013/08/11</td>
                        <td><i class="icon-md" data-feather="check"></i></td>
                        <td><i class="icon-md" data-feather="x"></i></td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Deedee</td>
                        <td>$10,000</td>
                        <td>Pending</td>
                        <td>Deposit</td>
                        <td>2013/08/11</td>
                        <td><i class="icon-md" data-feather="check"></i></td>
                        <td><i class="icon-md" data-feather="x"></i></td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>Deedee</td>
                        <td>$10,000</td>
                        <td>Pending</td>
                        <td>Deposit</td>
                        <td>2013/08/11</td>
                        <td><i class="icon-md" data-feather="check"></i></td>
                        <td><i class="icon-md" data-feather="x"></i></td>
                    </tr>
                    <tr>
                        <td>6</td>
                        <td>Deedee</td>
                        <td>$10,000</td>
                        <td>Pending</td>
                        <td>Deposit</td>
                        <td>2013/08/11</td>
                        <td><i class="icon-md" data-feather="check"></i></td>
                        <td><i class="icon-md" data-feather="x"></i></td>
                    </tr>
                    <tr>
                        <td>7</td>
                        <td>Deedee</td>
                        <td>$10,000</td>
                        <td>Pending</td>
                        <td>Deposit</td>
                        <td>2013/08/11</td>
                        <td><i class="icon-md" data-feather="check"></i></td>
                        <td><i class="icon-md" data-feather="x"></i></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $('#datatable').DataTable()
    </script>
@endsection
