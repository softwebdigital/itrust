@extends('layouts.user')

@section('head')
    {{ __('Transactions') }}
@endsection

@section('title')
    {{ __('My Transactions') }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('user.index') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Transactions</li>
@endsection

@section('content')
    <div class="card-body">
        <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
            <thead>
            <tr>
                <th></th>
                <th>Amount</th>
                <th>Status</th>
                <th>type</th>
                <th>Date</th>
            </tr>
            </thead>

            <tbody>
            <tr>
                <td>1</td>
                <td>$10,000</td>
                <td>Pending</td>
                <td>Deposit</td>
                <td>2013/08/11</td>
            </tr>
            <tr>
                <td>2</td>
                <td>$10,000</td>
                <td>Pending</td>
                <td>Deposit</td>
                <td>2009/07/07</td>
            </tr>
            <tr>
                <td>3</td>
                <td>$10,000</td>
                <td>Pending</td>
                <td>Deposit</td>
                <td>2012/04/09</td>
            </tr>
            <tr>
                <td>4</td>
                <td>$10,000</td>
                <td>Pending</td>
                <td>Deposit</td>
                <td>2010/01/04</td>
            </tr>
            <tr>
                <td>5</td>
                <td>$10,000</td>
                <td>Pending</td>
                <td>Deposit</td>
                <td>2012/06/01</td>
            </tr>
            <tr>
                <td>6</td>
                <td>$10,000</td>
                <td>Pending</td>
                <td>Deposit</td>
                <td>2013/02/01</td>
            </tr>
            <tr>
                <td>7</td>
                <td>$10,000</td>
                <td>Pending</td>
                <td>Deposit</td>
                <td>2011/12/06</td>
            </tr>
            <tr>
                <td>8</td>
                <td>$10,000</td>
                <td>Pending</td>
                <td>Deposit</td>
                <td>2011/03/21</td>
            </tr>
            <tr>
                <td>9</td>
                <td>$10,000</td>
                <td>Pending</td>
                <td>Deposit</td>
                <td>2009/02/27</td>
            </tr>
            <tr>
                <td>10</td>
                <td>$10,000</td>
                <td>Pending</td>
                <td>Deposit</td>
                <td>2010/07/14</td>
            </tr>
            <tr>
                <td>11</td>
                <td>$10,000</td>
                <td>Pending</td>
                <td>Deposit</td>
                <td>2008/11/13</td>
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
