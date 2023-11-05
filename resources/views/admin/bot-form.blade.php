@extends('layouts.admin')

@section('head')
    {{ __('Bot') }}
@endsection

@section('title')
    {{ ($edit ? 'Edit' : 'Add'). ' Bot '  }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
    <li class="breadcrumb-item "><a href="{{ route('admin.blog') }}">Bot</a></li>
    <li class="breadcrumb-item active">{{ $edit ? 'Edit' : 'Add' }}</li>
@endsection

@section('content')
<div class="mx-auto col-md-10">
    <form class="form" method="post" enctype="multipart/form-data" action="{{ $edit ? route('admin.bot.update', $bot->id) : route('admin.bot.store') }}">
        @csrf
        <div class="form-group mb-3">
            <label for="name" class="form-label">Name <strong class="text-danger">*</strong></label>
            <input type="text" name="name" id="name" class="form-control form-control-lg @error('name') is-invalid @enderror" value="{{ old('name') ?? ($edit ? $bot['name'] : '') }}">
            @error('name')<strong class="text-danger" role="alert">{{ $message }}</strong>@enderror
            <div class="text-danger" role="alert" id="name-err"></div>
        </div>

        <div class="form-group mb-3">
            <label for="price" class="form-label">Price </label>
            <input type="text" name="price" id="price" class="form-control form-control-lg" value="{{ old('price') ?? ($edit ? $bot['price'] : '') }}">
            <div class="text-danger" role="alert" id="price-err"></div>
        </div>

        <div class="form-group mb-3">
            <label for="creator" class="form-label">Creator </label>
            <input type="text" name="creator" id="creator" class="form-control form-control-lg" value="{{ old('creator') ?? ($edit ? $bot['creator'] : '') }}">
            <div class="text-danger" role="alert" id="creator-err"></div>
        </div>

        <div class="form-group mb-3">
            <label for="yield" class="form-label">30D Yield </label>
            <input type="text" name="yield" id="yield" class="form-control form-control-lg" value="{{ old('yield') ?? ($edit ? $bot['yield'] : '') }}">
            <div class="text-danger" role="alert" id="yield-err"></div>
        </div>

        <div class="form-group mb-3">
            <label for="rate" class="form-label">Win Rate </label>
            <input type="text" name="rate" id="rate" class="form-control form-control-lg" value="{{ old('rate') ?? ($edit ? $bot['rate'] : '') }}">
            <div class="text-danger" role="alert" id="rate-err"></div>
        </div>

        <div class="form-group mb-3">
            <label for="aum" class="form-label">AUM (USDT) </label>
            <input type="text" name="aum" id="aum" class="form-control form-control-lg" value="{{ old('aum') ?? ($edit ? $bot['aum'] : '') }}">
            <div class="text-danger" role="alert" id="aum-err"></div>
        </div>

        <div class="form-group mb-3">
            <label for="" class="form-label">Image </label>
            <input type="file" class="dropify" name="image" data-allowed-file-extensions="jpg png jpeg" data-default-file="{{ $edit ? ($bot['image'] ? asset($bot['image']) : '') : '' }}" data-max-file="1" data-max-file-size="1M" />
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
        const name = $('input[name="name"]')
        const nameError = $('#name-err')
        const nameVal = name.val()
        const price = $('input[name="price"]')
        const priceError = $('#price-err')
        const priceVal = price.val()
        
        const image = $('input.dropify')[0].files
        // const imageError = $('#image-err')

        if (nameVal === '')
            appendError(name, nameError)
        if (priceVal === '')
            appendError(price, priceError)
       

        const formData = new FormData();
        formData.append('name', nameVal)
        formData.append('price', priceVal)
        if (image.length > 0)
            formData.append('image', image[0]);
        else formData.append('image', '')

        if (nameVal && priceVal && dateVal && categoryVal && bodyVal)
            $.ajax({
                type: "POST",
                enctype: 'multipart/form-data',
                url: `{{ $edit ? route('admin.bot.update', $bot->id) : route('admin.bot.store') }}`,
                headers: {'X-CSRF-Token': '{{ csrf_token() }}'},
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                beforeSend: function () {
                    name.removeClass('is-invalid')
                    price.removeClass('is-invalid')

                    nameError.html('')
                    priceError.html('')
                },
                success: function (res) {
                    alertify.success(res['msg']);
                    setTimeout(() => location.href = '{{ route('admin.blog') }}', 2000);
                },
                error: function (res) {
                    const data = res['responseJSON']
                    const errors = data['errors']
                    if (res['status'] === 422) {
                        if (errors['name'])
                            appendError(name, nameError, errors['name'])
                        if (errors['price'])
                            appendError(price, priceError, errors['price'])

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
