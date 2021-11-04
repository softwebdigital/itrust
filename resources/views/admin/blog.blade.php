@extends('layouts.admin')

@section('head')
    {{ __('Blog') }}
@endsection

@section('title')
    {{ __('Blog') }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Blog</li>
@endsection

@section('content')
    <div class="card-body">
        <div class="d-flex justify-content-end mb-3">
            <a href="{{ route('admin.blog.create') }}" type="button" class="btn btn-primary">Add blog post</a>
        </div>
        <table id="datatable" class="table table-borderless table-striped table-responsive  nowrap w-100">
            <thead>
            <tr>
                <th>Title</th>
                <th>Category</th>
                <th>Body</th>
                <th>Image</th>
                <th>Date Added</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($news as $info)
                <tr>
                    <td>{{ $info->title }}</td>
                    <td>{{ $info->category }}</td>
                    <td>{!! strlen($info->body) > 30 ? substr($info->body, 0, 30).'...' : $info->body !!}</td>
                    <td><img src="{{ $info->image ? asset($info->image) : '' }}" width="50" alt=""></td>
                    {{-- <td>{{ \Carbon\Carbon::make($info->date_range)->shortAbsoluteDiffForHumans() }}</td> --}}
                    <td>{{ \Carbon\Carbon::make($info->created_at)->format('Y/m/d') }}</td>
                    <td>
                        <div class="btn-group">
                            <button type="button" class="btn btn-dark btn-sm dropdown-toggle dropdown-toggle-split" id="dropdownMenuReference1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-reference="parent">
                                <span>Menu </span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down">
                                    <polyline points="6 9 12 15 18 9"></polyline>
                                </svg>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuReference1">
                                <a class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#staticBackdrop-view-{{ $info->id }}">View</a>
                                <a class="dropdown-item" href="{{ route('admin.blog.edit', $info->id) }}">Edit</a>
                                <a class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#staticBackdrop-delete-{{ $info->id }}">Delete</a>
                            </div>
                        </div>
                    </td>
                </tr>
                <div class="modal fade" id="staticBackdrop-view-{{ $info->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Blog Preview</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="">Title</label>
                                    <input type="text" class="form-control-plaintext" value="{{ $info->title ?? '-----' }}">
                                </div>
                                <div class="form-group">
                                    <label for="">Category</label>
                                    <input type="text" class="form-control-plaintext" value="{{ $info->category ?? '-----' }}">
                                </div>
                                <div class="form-group">
                                    <label for="">Heading</label>
                                    <input type="text" class="form-control-plaintext" value="{{ $info->heading ?? '-----' }}">
                                </div>


                                {{-- <div class="form-group">
                                    <label for="">Url</label>
                                    <input type="text" class="form-control-plaintext" value="{{ $info->url ?? '-----' }}">
                                </div> --}}
                                {{-- <div class="form-group">
                                    <label for="">Date</label>
                                    <input type="datetime-local" class="form-control-plaintext" value="{{ \Carbon\Carbon::make($info->date_range)->format('Y-m-d').'T'.\Carbon\Carbon::make($info->date_range)->format('H:i:s') }}">
                                </div> --}}
                                <div class="form-group">
                                    <label for="">Body</label>
                                    <textarea name="" id="" cols="30" rows="3" class="form-control-plaintext">{!! $info->body ?? '-----' !!}</textarea>
                                </div>
                                <div class="form-group text-center mx-auto">
                                    <img src="{{ asset($info->image ?? '') }}" alt="" height="140">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="staticBackdrop-delete-{{ $info->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Confirm Blog Delete</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="{{ route('admin.blog.destroy', $info->id) }}" method="post">@csrf @method('DELETE')
                                <div class="modal-body">
                                    <p>Are you sure you want to delete this Blog?</p>
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
