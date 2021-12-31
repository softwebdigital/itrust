@extends('layouts.admin')

@section('head')
    {{ __('Documents') }}
@endsection

@section('title')
    {{ __('Documents') }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Documents</li>
@endsection

@section('content')
    <div class="card-body">
        <div class="d-flex justify-content-end mb-3">
            <a href="javascript:void(0)" data-bs-toggle="modal" id="add-btn" data-bs-target="#staticBackdrop-add" type="button" class="btn btn-primary">Add Document</a>
        </div>
        <table id="datatable" class="table table-borderless table-responsive table-striped nowrap w-100">
            <thead>
            <tr>
                <th>User</th>
                <th>Title</th>
                <th>Description</th>
                <th>Type</th>
                <th>File</th>
                <th>Date Added</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($documents as $document)
                <tr>
                    <td>{{ $document->user->email }}</td>
                    <td>{{ strlen($document->title) > 20 ? substr($document->title, 0, 20).'...' : $document->title }}</td>
                    <td>{!! strlen($document->description) > 25 ? substr($document->description, 0, 25).'...' : $document->description !!}</td>
                    <td><span class="badge p-2 bg-soft-dark">{{ ucfirst($document->type) }}</td>
                    <td><a href="{{ asset($document->file) }}" target="_blank"><i class="icon-xl" data-feather="file"></i> {{ $document->filename }}</a></td>
                    <td>{{ \Carbon\Carbon::make($document->created_at)->format('Y/m/d') }}</td>
                    <td>
                        <div class="btn-group">
                            <button type="button" class="btn btn-dark btn-sm dropdown-toggle dropdown-toggle-split" id="dropdownMenuReference1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-reference="parent">
                                <span>Menu </span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down">
                                    <polyline points="6 9 12 15 18 9"></polyline>
                                </svg>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuReference1">
                                <a class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#staticBackdrop-view-{{ $document->id }}">View</a>
                                <a class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#staticBackdrop-edit-{{ $document->id }}" id="edit-btn">Edit</a>
                                <a class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#staticBackdrop-delete-{{ $document->id }}">Delete</a>
                            </div>
                        </div>
                    </td>
                </tr>
                <div class="modal fade" id="staticBackdrop-view-{{ $document->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Document Details</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="">Title</label>
                                    <input type="text" class="form-control-plaintext" value="{{ $document->title ?? '-----' }}">
                                </div>
                                <div class="form-group">
                                    <label for="">Description</label>
                                    <input type="text" class="form-control-plaintext" value="{!! $document->description ?? '-----' !!}">
                                </div>
                                <div class="form-group">
                                    <label for="">File</label>
                                    <div>
                                        <strong>Name: </strong> <a href="{{ asset($document->file) }}" target="_blank"><i class="icon-md" data-feather="file"></i>{{ $document->filename }} </a> <br>
                                        <strong>Size: </strong> {{ $document->filesize }}
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="staticBackdrop-edit-{{$document->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Add Document</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form method="post" action="{{ route('admin.documents.update', $document->id) }}" enctype="multipart/form-data">
                                @csrf @method("PUT")
                                <div class="modal-body">
                                    <div class="form-group mb-2">
                                        <label for="">User <span class="text-danger">*</span></label>
                                        <select name="user" id="" class="form-select @error('user') is-invalid @enderror">
                                            <option value="">Select User</option>
                                            @foreach($users as $user)
                                                <option value="{{ $user->id }}" {{ old('user') == $user->id || $document->user_id == $user->id ? 'selected' : '' }}>{{ $user->first_name.' '.$user->last_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('user') <strong class="text-danger" role="alert">{{ $message }}</strong> @enderror
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="">Type <span class="text-danger">*</span></label>
                                        <select name="type" id="" class="form-select @error('type') is-invalid @enderror">
                                            <option value="">Select Document Type</option>
                                            <option value="invoice" {{ old('type') == 'invoice' || $document->type == 'invoice' ? 'selected' : '' }}>Invoice</option>
                                            <option value="receipt" {{ old('type') == 'receipt' || $document->type == 'receipt' ? 'selected' : '' }}>Receipt</option>
                                        </select>
                                        @error('type') <strong class="text-danger" role="alert">{{ $message }}</strong> @enderror
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="">Title <span class="text-danger">*</span></label>
                                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{!! old('title') ?? $document->title !!}">
                                        @error('title') <strong class="text-danger" role="alert">{{ $message }}</strong> @enderror
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="">Description <span class="text-danger">*</span></label>
                                        <textarea name="description" id="" cols="30" rows="3" class="form-control @error('description') is-invalid @enderror">{!! old('description') ?? $document->description !!}</textarea>
                                        @error('description') <strong class="text-danger" role="alert">{{ $message }}</strong> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="">File </label>
                                        <input type="file" name="file" class="form-control @error('file') is-invalid @enderror" value="{{ $document->filename }}">
                                        @error('file') <strong class="text-danger" role="alert">{{ $message }}</strong> @enderror
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="staticBackdrop-delete-{{ $document->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Confirm Document Delete</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="{{ route('admin.documents.destroy', $document->id) }}" method="post">@csrf @method('DELETE')
                                <div class="modal-body">
                                    <p>Are you sure you want to delete this document?</p>
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

    <div class="modal fade" id="staticBackdrop-add" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Add Document</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="{{ route('admin.documents.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group mb-2">
                            <label for="">User <span class="text-danger">*</span></label>
                            <select name="user" id="" class="form-select @error('user') is-invalid @enderror">
                                <option value="">Select User</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ old('user') == $user->id ? 'selected' : '' }}>{{ $user->first_name.' '.$user->last_name }}</option>
                                @endforeach
                            </select>
                            @error('user') <strong class="text-danger" role="alert">{{ $message }}</strong> @enderror
                        </div>
                        <div class="form-group mb-2">
                            <label for="">Type <span class="text-danger">*</span></label>
                            <select name="type" id="" class="form-select @error('type') is-invalid @enderror">
                                <option value="">Select Document Type</option>
                                <option value="invoice" {{ old('type') == 'invoice' ? 'selected' : '' }}>Invoice</option>
                                <option value="receipt" {{ old('type') == 'receipt' ? 'selected' : '' }}>Receipt</option>
                            </select>
                            @error('type') <strong class="text-danger" role="alert">{{ $message }}</strong> @enderror
                        </div>
                        <div class="form-group mb-2">
                            <label for="">Title <span class="text-danger">*</span></label>
                            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{!! old('title') !!}">
                            @error('title') <strong class="text-danger" role="alert">{{ $message }}</strong> @enderror
                        </div>
                        <div class="form-group mb-2">
                            <label for="">Description <span class="text-danger">*</span></label>
                            <textarea name="description" id="" cols="30" rows="3" class="form-control @error('description') is-invalid @enderror">{!! old('description') !!}</textarea>
                            @error('description') <strong class="text-danger" role="alert">{{ $message }}</strong> @enderror
                        </div>
                        <div class="form-group">
                            <label for="">File <span class="text-danger">*</span></label>
                            <input type="file" name="file" class="form-control @error('file') is-invalid @enderror">
                            @error('file') <strong class="text-danger" role="alert">{{ $message }}</strong> @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        const validation = {{ json_encode(session('validation')) }};
        const editValidation = {{ json_encode(session('edit_validation')) }};
        if (validation) $('#add-btn').click()
        if (editValidation) $('#edit-btn').click()
    </script>
@endsection
