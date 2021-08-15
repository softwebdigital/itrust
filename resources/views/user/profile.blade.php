@extends('layouts.user')

@section('head')
    {{ __('Profile') }}
@endsection

@section('title')
    {{ __('Profile') }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('user.index') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Profile</li>
@endsection


@section('content')
<div class="row">
    <div class="col-xl-8 col-md-8">
        <div class="card card-h-100">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Personal Information</h4>
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('user.profile.update') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="name"> First Name</label>
                                <input type="text" id="name" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') ?? $user->first_name }}">
                                @error('first_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="name"> Last Name</label>
                                <input type="text" id="name" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') ?? $user->last_name }}">
                                @error('last_name')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="email"> Email</label>
                                <input type="text" id="email" class="form-control" name="email" readonly value="{{ $user->email }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="username"> Username</label>
                                <input type="text" id="username" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') ?? $user->username }}">
                                @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="photo"> Photo</label>
                        <input type="file" id="photo" class="form-control @error('photo') is-invalid @enderror" name="photo">
                        @error('photo')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary w-md">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-md-4">
        <div class="card card-h-100">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Password Update</h4>
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('user.password.update') }}">
                    @csrf
                    <div class="mb-3">
                        <div class="d-flex align-items-start">
                            <div class="flex-grow-1">
                                <label class="form-label" for="old-password">Old Password</label>
                            </div>
                        </div>
                        <div class="input-group">
                            <input type="password" id="old-password" autocomplete="current-password" class="form-control @error('old_password') is-invalid @enderror" name="old_password" placeholder="">
                            <button class="btn btn-light shadow-none ms-0" type="button" id="old-password-btn"><i class="mdi mdi-eye-outline"></i></button>
                            @error('old_password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex align-items-start">
                            <div class="flex-grow-1">
                                <label class="form-label" for="new-password">New Password</label>
                            </div>
                        </div>
                        <div class="input-group">
                            <input type="password" id="new-password" autocomplete="new-password" class="form-control @error('new_password') is-invalid @enderror" name="new_password" placeholder="">
                            <button class="btn btn-light shadow-none ms-0" type="button" id="new-password-btn"><i class="mdi mdi-eye-outline"></i></button>
                            @error('new_password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex align-items-start">
                            <div class="flex-grow-1">
                                <label class="form-label" for="confirm-password">Confirm Password</label>
                            </div>
                        </div>

                        <div class="input-group">
                            <input type="password" class="form-control" autocomplete="new-password" id="confirm-password" name="new_password_confirmation" placeholder="">
                            <button class="btn btn-light shadow-none ms-0" type="button" id="confirm-password-btn"><i class="mdi mdi-eye-outline"></i></button>
                        </div>
                    </div>
                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary w-md">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade confirmModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <div class="mb-3">
                        <i class="bx bx-check-circle display-4 text-success"></i>
                    </div>
                    <h5>Confirm Save Changes</h5>
                </div>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-light w-md" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary w-md" data-bs-dismiss="modal"
                        onclick="nextTab()">Save changes</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script src="{{ asset('assets/libs/twitter-bootstrap-wizard/jquery.bootstrap.wizard.min.js') }}"></script>
    <script src="{{ asset('assets/libs/twitter-bootstrap-wizard/prettify.js') }}"></script>
    <script src="{{ asset('assets/libs/choices.js/public/assets/scripts/choices.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/form-wizard.init.js') }}"></script>
    <script>
        $("#old-password-btn").on("click",function(){0<$(this).siblings("input").length&&("password"==$(this).siblings("input").attr("type")?$(this).siblings("input").attr("type","input"):$(this).siblings("input").attr("type","password"))});
        $("#new-password-btn").on("click",function(){0<$(this).siblings("input").length&&("password"==$(this).siblings("input").attr("type")?$(this).siblings("input").attr("type","input"):$(this).siblings("input").attr("type","password"))});
        $("#confirm-password-btn").on("click",function(){0<$(this).siblings("input").length&&("password"==$(this).siblings("input").attr("type")?$(this).siblings("input").attr("type","input"):$(this).siblings("input").attr("type","password"))});

        let e = document.querySelectorAll("[data-trigger]");
        for (let i = 0; i < e.length; ++i) {
            let a = e[i];
            new Choices(a, {
                placeholderValue: "",
                searchPlaceholderValue: "Search..."
            })
        }

        function verifyAccount() {
            const bank = $('#bank')
            const name = $('#account-name')
            const number = $('#account-number')

            if (bank.val() !== "Select Bank" && number.val().length === 10) {
                const banks = {!! json_encode($banks) !!}
                const code = banks.find(cur => cur.name === bank.val()).code
                $.ajax({
                    url: `https://api.paystack.co/bank/resolve?account_number=${number.val()}&bank_code=${code}`,
                    type: 'GET',
                    dataType: 'json',
                    beforeSend: function(request) {
                        request.setRequestHeader("Authorization", "Bearer {{ env('PAYSTACK_SECRET_KEY') }}");
                        $('#verifying').removeClass('d-none')
                        $('#verified-success').addClass('d-none')
                        $('#verified-failed').addClass('d-none')
                        number.attr('readonly', true)
                    },
                    success: function (res) {
                        number.attr('readonly', false)
                        $('#verifying').addClass('d-none')
                        if (res['status']) {
                            name.val(res['data']['account_name'])
                            $('#verified-success').removeClass('d-none')
                        }
                    },
                    error: function (res) {
                        number.attr('readonly', false)
                        $('#verifying').addClass('d-none')
                        if (res.status === 422) $('#verified-failed').removeClass('d-none');
                        else $('#verified-failed').html(res['responseJSON']['message']).addClass('d-none')
                    }
                })
            } else {
                //
            }
        }
    </script>
@endsection
