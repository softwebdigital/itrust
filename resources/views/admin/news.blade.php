@extends('layouts.admin')

@section('head')
    {{ __('News') }}
@endsection

@section('title')
    {{ __('News') }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">News</li>
@endsection

@section('content')
    <div class="card-body">
        <div class="d-flex justify-content-end mb-3">
            <a href="{{ route('admin.news.add') }}" type="button" class="btn btn-primary">Add News</a>
        </div>
        <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
            <thead>
            <tr>
                <th>Title</th>
                <th>Heading</th>
                <th>Body</th>
                <th>Date Range</th>
                <th>Date Added</th>
                <th></th>
                <th></th>
            </tr>
            </thead>

            <tbody>
            <tr>
                <td>new news</td>
                <td>headline</td>
                <td>ghehda eeghde edged egddced ceghde cegc c</td>
                <td>2013/08/11</td>
                <td>2013/08/11</td>
                <td><i class="icon-md" data-feather="check"></i></td>
                <td><i class="icon-md" data-feather="x"></i></td>
            </tr>
            <tr>
                <td>new news</td>
                <td>headline</td>
                <td>ghehda eeghde edged egddced ceghde cegc c</td>
                <td>2013/08/11</td>
                <td>2013/08/11</td>
                <td><i class="icon-md" data-feather="check"></i></td>
                <td><i class="icon-md" data-feather="x"></i></td>
            </tr>
            </tbody>
        </table>
    </div>
@endsection
