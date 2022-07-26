@extends('layouts.admin')

@section('head')
    {{ __('Blog') }}
@endsection

@section('title')
    {{ ($edit ? 'Edit' : 'Add'). ' Blog' }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
    <li class="breadcrumb-item "><a href="{{ route('admin.blog') }}">Blog</a></li>
    <li class="breadcrumb-item active">{{ $edit ? 'Edit' : 'Add' }}</li>
@endsection

@section('content')
<div class="mx-auto col-md-10">
{{--    <form class="form" method="post" enctype="multipart/form-data" action="#">--}}
    <form class="form" method="post" enctype="multipart/form-data" action="{{ $edit ? route('admin.blog.update', $blog->id) : route('admin.blog.store') }}">
        @csrf
        <div class="form-group mb-3">
            <label for="title" class="form-label">Title <strong class="text-danger">*</strong></label>
            <input type="text" name="title" id="title" class="form-control form-control-lg @error('title') is-invalid @enderror" value="{{ old('title') ?? ($edit ? $blog['title'] : '') }}">
            @error('title')<strong class="text-danger" role="alert">{{ $message }}</strong>@enderror
            <div class="text-danger" role="alert" id="title-err"></div>
        </div>
        <div class="form-group mb-3">
            <label for="heading" class="form-label">Heading </label>
            <input type="text" name="heading" id="heading" class="form-control form-control-lg" value="{{ old('heading') ?? ($edit ? $blog['heading'] : '') }}">
            <div class="text-danger" role="alert" id="heading-err"></div>
        </div>
         <div class="row">
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label for="date" class="form-label">Date <strong class="text-danger">*</strong></label>
                    <input name="date" id="date" type="datetime-local" class="form-control form-control-lg @error('date') is-invalid @enderror"
                           value="{{ old('date') ? \Carbon\Carbon::make(old('date'))->format('Y-m-d').'T'.\Carbon\Carbon::make(old('date'))->format('H:i:s') : ($edit ? \Carbon\Carbon::make($blog['created_at'])->format('Y-m-d').'T'.\Carbon\Carbon::make($blog['created_at'])->format('H:i:s') : '') }}">
                    @error('date') <strong class="text-danger" role="alert">{{ $message }}</strong> @enderror
                    <div class="text-danger" role="alert" id="date-err"></div>
                </div>
            </div>
{{--            <div class="col-md-6">--}}
{{--                <div class="form-group mb-3">--}}
{{--                    <label for="url" class="form-label">Url/Link <strong class="text-danger">*</strong></label>--}}
{{--                    <input type="text" name="url" id="url" class="form-control form-control-lg @error('url') is-invalid @enderror" value="{{ old('url') ?? ($edit ? $blog['url'] : '') }}">--}}
{{--                    @error('url') <strong class="text-danger" role="alert">{{ $message }}</strong> @enderror--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>
        <div class="form-group mb-3">
            <label for="category" class="form-label">Category </label>
            <select class="form-select @error('category') is-invalid @enderror" name="category" id="category">
                <option value="">Select category</option>
                @if($edit)
                    @foreach ($blog_categories as $category)

                        <option value="{{ $category->category }}" {{ $blog->category == $category->category ? 'selected' : '' }}>{{ $category->category }}</option>
                    @endforeach
                @else
                    @foreach ($blog_categories as $category)
                        <option value="{{ $category->category }}" {{ old('category') == $category->category ? 'selected' : '' }}>{{ $category->category }}</option>
                    @endforeach
                @endif
            </select>
            @error('category') <strong class="text-danger" role="alert">{{ $message }}</strong> @enderror
            <div class="text-danger" role="alert" id="category-err"></div>
        </div>
        <div class="form-group mb-3">
            <label for="summernote" class="form-label">Body <strong class="text-danger">*</strong></label>
            <textarea name="body" cols="30" rows="10" id="summernote" class="form-control form-control-lg @error('body') is-invalid @enderror">{!! old('body') ?? ($edit ? $blog['body'] : '') !!}</textarea>
            @error('body') <strong class="text-danger" role="alert">{{ $message }}</strong> @enderror
            <div class="text-danger" role="alert" id="body-err"></div>
        </div>
        <div class="form-group mb-3">
            <label for="" class="form-label">Image </label>
            <input type="file" class="dropify" name="image" data-allowed-file-extensions="jpg png jpeg" data-default-file="{{ $edit ? ($blog['image'] ? asset($blog['image']) : '') : '' }}" data-max-file="1" data-max-file-size="1M" />
            @error('image') <strong class="text-danger" role="alert">{{ $message }}</strong> @enderror
            <div class="text-danger" role="alert" id="image-err"></div>
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
<!-- init js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.js" integrity="sha512-hJsxoiLoVRkwHNvA5alz/GVA+eWtVxdQ48iy4sFRQLpDrBPn6BFZeUcW4R4kU+Rj2ljM9wHwekwVtsb0RY/46Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

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
        imageUploadURL: '/api/image/upload',
        // imageUploadURL: 'image_upload.php',
        imageUploadParams: {
            id: 'my_editor'
        }
    })


    function uploadBlog() {
        const title = $('input[name="title"]')
        const titleError = $('#title-err')
        const titleVal = title.val()
        const heading = $('input[name="heading"]')
        const headingError = $('#heading-err')
        const headingVal = heading.val()
        const date = $('input[name="date"]')
        const dateError = $('#date-err')
        const dateVal = date.val()
        const category = $('select[name="category"]')
        const categoryError = $('#category-err')
        const categoryVal = category.val()
        const body = $('textarea[name="body"]')
        const bodyError = $('#body-err')
        const bodyVal = body.val()
        const image = $('input.dropify')[0].files
        // const imageError = $('#image-err')

        if (titleVal === '')
            appendError(title, titleError)
        if (headingVal === '')
            appendError(heading, headingError)
        if (dateVal === '')
            appendError(date, dateError)
        if (categoryVal === '')
            appendError(category, categoryError)
        if (bodyVal === '')
            appendError(body, bodyError)

        const formData = new FormData();
        formData.append('title', titleVal)
        formData.append('heading', headingVal)
        formData.append('date', dateVal)
        formData.append('category', categoryVal)
        formData.append('body', JSON.stringify(bodyVal))
        if (image.length > 0)
            formData.append('image', image[0]);
        else formData.append('image', '')

        if (titleVal && headingVal && dateVal && categoryVal && bodyVal)
            $.ajax({
                type: "POST",
                enctype: 'multipart/form-data',
                url: `{{ $edit ? route('admin.blog.update', $blog->id) : route('admin.blog.store') }}`,
                headers: {'X-CSRF-Token': '{{ csrf_token() }}'},
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                beforeSend: function () {
                    title.removeClass('is-invalid')
                    heading.removeClass('is-invalid')
                    date.removeClass('is-invalid')
                    category.removeClass('is-invalid')
                    body.removeClass('is-invalid')

                    titleError.html('')
                    headingError.html('')
                    dateError.html('')
                    categoryError.html('')
                    bodyError.html('')
                },
                success: function (res) {
                    alertify.success(res['msg']);
                    setTimeout(() => location.href = '{{ route('admin.blog') }}', 2000);
                },
                error: function (res) {
                    const data = res['responseJSON']
                    const errors = data['errors']
                    if (res['status'] === 422) {
                        if (errors['title'])
                            appendError(title, titleError, errors['title'])
                        if (errors['heading'])
                            appendError(heading, headingError, errors['heading'])
                        if (errors['date'])
                            appendError(date, dateError, errors['date'])
                        if (errors['category'])
                            appendError(category, categoryError, errors['category'])
                        if (errors['body'])
                            appendError(body, bodyError, errors['body'])

                        alertify.error(data['msg'])
                    } else {
                        alertify.error('An error occurred, Try again.')
                    }
                }
            })
    }

    function appendError(field, errField, error = 'This field is required') {
        field.addClass('is-invalid')
        errField.html(`<strong>${error}</strong>`)
    }
</script>
@endsection
