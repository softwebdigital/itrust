@extends('layouts.admin')

@section('head')
    {{ __('Copy Bot') }}
@endsection

@section('title')
    {{ __('Copy Bot') }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Copy Bot</li>
@endsection

@section('content')
    <div class="card-body">
        <div class="d-flex justify-content-end mb-3">
            <a href="{{ route('admin.bot.create') }}" type="button" class="btn btn-primary">Add Bots</a>
        </div>
        <div class="table-responsive" style="border-color: white;">
            <table id="datatable" class="table table-borderless table-striped table-responsive  nowrap w-100">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Creator</th>
                    <th>Rate</th>
                    <th>Yield</th>
                    <th>AUM(USDT)</th>
                    <th>Date Added</th>
                </tr>
                </thead>
                <tbody>
                @foreach($news as $info)
                    <tr>
                        <td>{{ $info->name }}</td>
                        <td>{{ $info->price }}</td>
                        <td><img src="{{ $info->image ? asset($info->image) : '' }}" width="50" alt=""></td>
                        <td>{{ $info->creator }}</td>
                        <td>{{ $info->rate }}</td>
                        <td>{{ $info->yield }}</td>
                        <td>{{ $info->aum }}</td>
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
                                    <a class="dropdown-item" href="{{ route('admin.bot.edit', $info->id) }}">Edit</a>
                                    <a class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#staticBackdrop-delete-{{ $info->id }}">Delete</a>
                                </div>
                            </div>
                        </td>
                    </tr>

                    <div class="modal fade" id="staticBackdrop-delete-{{ $info->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Confirm Bot Delete</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="{{ route('admin.bot.destroy', $info->id) }}" method="post">@csrf @method('DELETE')
                                    <div class="modal-body">
                                        <p>Are you sure you want to delete this bot?</p>
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
        
    </div>
@endsection
