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
    <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
        <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Approval</th>
            <th>Date Joined</th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
        </thead>

        <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{ $user->full_name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->phone }}</td>
                <td>{{ 'Approved' }}</td>
                <td>{{ date('d/M/Y', strtotime($user->created_at)) }}</td>
                <td><a href="{{ route('admin.users.show', $user->id) }}"><i class="icon-md" data-feather="eye"></i></a></td>
                <td><i class="icon-md" data-feather="check"></i></td>
                <td><i class="icon-md" data-feather="x"></i></td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
