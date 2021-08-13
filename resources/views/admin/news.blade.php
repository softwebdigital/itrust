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
            <a href="{{ route('admin.news.create') }}" type="button" class="btn btn-primary">Add News</a>
        </div>
        <table id="datatable" class="table table-borderless table-striped dt-responsive  nowrap w-100">
            <thead>
            <tr>
                <th>Title</th>
                <th>Heading</th>
                <th>Body</th>
                <th>Image</th>
                <th>Date Range</th>
                <th>Date Added</th>
                <th></th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($news as $info)
                <tr>
                    <td>{{ $info->title }}</td>
                    <td>{{ $info->heading }}</td>
                    <td>{!! $info->body !!}</td>
                    <td><img src="{{ $info->image ? asset($info->image) : '' }}" alt=""></td>
                    <td>{{ $info->date_range }}</td>

                </tr>
                <div class="modal fade" id="staticBackdrop-delete-{{ $info->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Confirm News Delete</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="{{ route('admin.news.destroy', $info->id) }}" method="post">@csrf @method('DELETE')
                                <div class="modal-body">
                                    <p>Are you sure you want to delete this news?</p>
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
@endsection
