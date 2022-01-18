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
    <form class="form" method="post" enctype="multipart/form-data" action="{{ $edit ? route('admin.news.update', $news->id) : route('admin.news.store') }}">
        @csrf
        @if($edit) @method('PUT') @endif
        <div class="form-group mb-3">
            <label for="title" class="form-label">Title <strong class="text-danger">*</strong></label>
            <input type="text" name="title" id="title" class="form-control form-control-lg @error('title') is-invalid @enderror" value="{{ old('title') ?? ($edit ? $news['title'] : '') }}">
            @error('title') <strong class="text-danger" role="alert">{{ $message }}</strong> @enderror
        </div>
        <div class="form-group mb-3">
            <label for="heading" class="form-label">Heading </label>
            <input type="text" name="heading" id="heading" class="form-control form-control-lg" value="{{ old('heading') ?? ($edit ? $news['heading'] : '') }}">
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label for="date" class="form-label">Date <strong class="text-danger">*</strong></label>
                    <input name="date" id="date" type="datetime-local" class="form-control form-control-lg @error('date') is-invalid @enderror" value="{{ old('date') ? \Carbon\Carbon::make(old('date'))->format('Y-m-d').'T'.\Carbon\Carbon::make(old('date'))->format('H:i:s') : ($edit ? \Carbon\Carbon::make($news['date_range'])->format('Y-m-d').'T'.\Carbon\Carbon::make($news['date_range'])->format('H:i:s') : '') }}">
                    @error('date') <strong class="text-danger" role="alert">{{ $message }}</strong> @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label for="url" class="form-label">Url/Link <strong class="text-danger">*</strong></label>
                    <input type="text" name="url" id="url" class="form-control form-control-lg @error('url') is-invalid @enderror" value="{{ old('url') ?? ($edit ? $news['url'] : '') }}">
                    @error('url') <strong class="text-danger" role="alert">{{ $message }}</strong> @enderror
                </div>
            </div>
        </div>
        <div class="form-group mb-3">
            <label for="summernote" class="form-label">Body <strong class="text-danger">*</strong></label>
            <textarea name="body" cols="30" rows="10" id="summernote" class="form-control form-control-lg @error('body') is-invalid @enderror">{!! old('body') ?? ($edit ? $news['body'] : '') !!}</textarea>
            @error('body') <strong class="text-danger" role="alert">{{ $message }}</strong> @enderror
        </div>
        <div class="form-group mb-3">
            <label for="" class="form-label">Image </label>
            <input type="file" class="dropify" name="image" data-allowed-file-extensions="jpg png jpeg" data-default-file="{{ $edit ? ($news['image'] ? asset($news['image']) : '') : '' }}" data-max-file="1" data-max-file-size="1M" />
            @error('image') <strong class="text-danger" role="alert">{{ $message }}</strong> @enderror
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.js" integrity="sha512-hJsxoiLoVRkwHNvA5alz/GVA+eWtVxdQ48iy4sFRQLpDrBPn6BFZeUcW4R4kU+Rj2ljM9wHwekwVtsb0RY/46Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    // CKEDITOR.replace( 'editor' )
</script>
<script>

    $('.dropify').dropify({
        messages: {
            'default': '<p style="font-size: 18px">Drag and drop a file here or click</p>',
            'replace': '<p style="font-size: 18px">Drag and drop or click to replace</p>',
            'remove':  'Remove'
        }
    });
    // $('#summernote').summernote();
    new FroalaEditor('textarea#summernote', {
        // Set the image upload URL.
        imageUploadURL: '/api/image/upload2',
        // imageUploadURL: 'image_upload.php',
        imageUploadParams: {
            id: 'my_editor'
        }
    })
</script>
@endsection
