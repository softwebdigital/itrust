@extends('layouts.admin')

@section('head')
    {{ __('News') }}
@endsection

@section('title')
    {{ ($edit ? 'Edit' : 'Add'). ' News' }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
    <li class="breadcrumb-item "><a href="{{ route('admin.news') }}">News</a></li>
    <li class="breadcrumb-item active">{{ $edit ? 'Edit' : 'Add' }}</li>
@endsection

@section('content')
<div class="mx-auto col-md-10">
    <form class="form">
        <div class="form-group mb-3">
            <label for="title" class="form-label">Title <strong class="text-danger">*</strong></label>
            <input type="text" name="title" id="title" class="form-control form-control-lg" value="{{ old('title') ?? $edit ? $news['title'] : '' }}">
        </div>
        <div class="form-group mb-3">
            <label for="heading" class="form-label">Heading </label>
            <input type="text" name="heading" id="heading" class="form-control form-control-lg" value="{{ old('heading') ?? $edit ? $news['heading'] : '' }}">
        </div>
        <div class="form-group mb-3">
            <label for="date" class="form-label">Date <strong class="text-danger">*</strong></label>
            <input type="date" name="date" id="date" class="form-control form-control-lg" value="{{ old('date') ? \Carbon\Carbon::make(old('date'))->format('Y-m-d') : ($edit ? \Carbon\Carbon::make($news['date'])->format('Y-m-d') : '') }}">
        </div>
        <div class="form-group mb-3">
            <label for="ckeditor-classic" class="form-label">Body <strong class="text-danger">*</strong></label>
            <textarea name="body" cols="30" rows="10" id="ckeditor-classic" class="form-control form-control-lg">{!! old('body') ?? $edit ? $news['body'] : '' !!}</textarea>
        </div>
        <div class="form-group mb-3">
            <label for="" class="form-label">Image </label>
            <input type="file" class="dropify" name="image" data-default-file="{{ $edit ? ($news['image'] ? asset($news['image']) : '') : '' }}" data-max-file="1" data-max-file-size="1M" />
        </div>
        <div class="d-flex justify-content-center mb-3">
            <button type="submit" class="btn btn-primary">{{ $edit ? 'Update' : 'Create' }}</button>
        </div>
    </form>
</div>
@endsection

@section('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css" integrity="sha512-In/+MILhf6UMDJU4ZhDL0R0fEpsp4D3Le23m6+ujDWXwl3whwpucJG1PEmI3B07nyJx+875ccs+yX2CqQJUxUw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('script')
<script src="{{ asset('assets/libs/@ckeditor/ckeditor5-build-classic/build/ckeditor.js') }}"></script>
<!-- init js -->
<script src="{{ asset('assets/js/pages/form-editor.init.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.js" integrity="sha512-hJsxoiLoVRkwHNvA5alz/GVA+eWtVxdQ48iy4sFRQLpDrBPn6BFZeUcW4R4kU+Rj2ljM9wHwekwVtsb0RY/46Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    $('.dropify').dropify({
        messages: {
            'default': '<p style="font-size: 18px">Drag and drop a file here or click</p>',
            'replace': '<p style="font-size: 18px">Drag and drop or click to replace</p>',
            'remove':  'Remove'
        }
    });
</script>
@endsection
