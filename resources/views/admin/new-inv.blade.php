@extends('layouts.admin')

@section('head')
    {{ __('Add Investment') }}
@endsection

{{-- @section('title')
    {{ ($edit ? 'Edit' : 'Add'). ' News' }}
@endsection --}}

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
    <li class="breadcrumb-item "><a href="{{ route('admin.news') }}">Investment</a></li>
    <li class="breadcrumb-item active">Add</li>
@endsection

@section('content')
<div class="mx-auto col-md-10">
    <form class="form" method="post" enctype="multipart/form-data" action="{{ route('admin.users.newInvest') }}">
        @csrf
        @method('POST')
        <div class="form-group mb-3">
            <label for="user">User :</label>
            <select class="form-select @error('user') is-invalid @enderror" name="user" id="user">
                <option value="">Select User</option>
                @foreach ($users as $user)
                <option value="{{ $user->id }}" {{ old('user') ==  $user->id  ? 'selected' : '' }}>{{ $user->username }}</option>
                @endforeach
            </select>
            @error('user') <strong class="text-danger" role="alert">{{ $message }}</strong> @enderror
        </div>
        <div class="form-group">
            <div class="input-group mb-3">
                {{-- <label class="input-group-text" for="amount">$</label> --}}
                <input type="amount" step="any" class="form-control @error('amount') is-invalid @enderror"
                    name="amount" value="{{ old('amount') }}" id="amount" placeholder="Amount Invested">
            </div>
            @error('amount') <strong class="text-danger" role="alert">{{ $message }}</strong>
            @enderror
        </div>
        <div class="form-group">
            <div class="input-group mb-3">
                {{-- <label for="amount">ROI</label> --}}
                <input type="amount" step="any" class="form-control @error('ROI') is-invalid @enderror"
                    name="ROI" value="{{ old('ROI') }}" id="ROI" placeholder="ROI">
            </div>
            @error('ROI') <strong class="text-danger" role="alert">{{ $message }}</strong>
            @enderror
        </div>
        <div class="form-group mb-3">
            <label for="status">Status :</label>
            <select class="form-select @error('status') is-invalid @enderror" name="status" id="user">
                <option value="">Select Status</option>
                <option value="open">Open</option>
                <option value="closed">Closed</option>
            </select>
            @error('status') <strong class="text-danger" role="alert">{{ $message }}</strong> @enderror
        </div>
        {{-- <div class="form-group mb-3">
            <label>Status :</label>
            <select class="form-select @error('status') is-invalid @enderror" name="status" id="status">
                <option value="open" {{ old('status') == 'open' ? 'selected' : '' }}>Open</option>
                <option value="closed" {{ old('status') == 'closed' ? 'selected' : '' }}>Closed</option>
            </select>
            @error('status') <strong class="text-danger" role="alert">{{ $message }}</strong> @enderror
        </div> --}}
        <div class="form-group mb-3">
            <label for="type">Product :</label>
            <select class="form-select @error('type') is-invalid @enderror" name="type" id="type">
                <option value="">Select Product Type</option>
                <option value="stocks_and_funds" {{ old('type') == 'stocks_and_funds' ? 'selected' : '' }}>Stocks and Funds
                </option>
                <option value="crypto" {{ old('type') == 'crypto' ? 'selected' : '' }}>Crypto</option>
                <option value="gold" {{ old('type') == 'gold' ? 'selected' : '' }}>Gold</option>
                <option value="cash_management" {{ old('type') == 'cash_management' ? 'selected' : '' }}>Cash Management</option>
                <option value="options" {{ old('type') == 'options' ? 'selected' : '' }}>Options</option>
            </select>
            @error('type') <strong class="text-danger" role="alert">{{ $message }}</strong> @enderror
        </div>
        <div class="d-flex justify-content-center mb-3">
            <button type="submit" class="btn btn-primary">Add</button>
        </div>
    </form>
</div>
@endsection

@section('style')
{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css" integrity="sha512-In/+MILhf6UMDJU4ZhDL0R0fEpsp4D3Le23m6+ujDWXwl3whwpucJG1PEmI3B07nyJx+875ccs+yX2CqQJUxUw==" crossorigin="anonymous" referrerpolicy="no-referrer" /> --}}
@endsection

@section('script')
{{-- <script src="{{ asset('assets/libs/@ckeditor/ckeditor5-build-classic/build/ckeditor.js') }}"></script> --}}
<!-- init js -->
{{-- <script src="{{ asset('assets/js/pages/form-editor.init.js') }}"></script> --}}
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.js" integrity="sha512-hJsxoiLoVRkwHNvA5alz/GVA+eWtVxdQ48iy4sFRQLpDrBPn6BFZeUcW4R4kU+Rj2ljM9wHwekwVtsb0RY/46Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}

@endsection
