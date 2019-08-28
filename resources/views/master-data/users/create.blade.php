@extends('layout.main')
@section('content')

    <div class="row">
        <div class="col-12">
            <h1>@lang('global.users')</h1>

            <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                <ol class="breadcrumb pt-0">
                    <li class="breadcrumb-item">
                        <a href="#">@lang('global.master_data')</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="#">@lang('global.users')</a>
                    </li>
                    <li class="breadcrumb-item " aria-current="page">@lang('global.create')</li>
                </ol>
            </nav>
            <div class="separator mb-5"></div>
        </div>
    </div>

    <br />
    <br />
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">

                    <div>
                        <h5 class="mb-4">@lang('global.create_user')</h5>
                        <div>
                            <a href="#" class="user-img">
                                <img id="user-img" src="{{ asset('img/profile-pic-l-4.jpg') }}"
                                     style="left: 95%!important;top: -55px!important;max-height: 114px;max-width: 114px"
                                     class="img-thumbnail card-img social-profile-img" />
                            </a>
                        </div>
                    </div>


                    <form action="{{ route('users.create') }}" method="post">
                        @csrf

                        <div class="form-row">
                            <input type="file" class="select-img" name="avatar" onchange="readURL(this)" style="display: none">
                            <div class="form-group col-md-4">
                                <label>@lang('global.full_name')</label>
                                <input type="text" class="form-control" name="full_name" placeholder="@lang('global.full_name')" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputPassword1">@lang('global.user_name')</label>
                                <input type="text" class="form-control" id="inputPassword1"
                                       placeholder="@lang('global.user_name')" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputPassword2">@lang('global.email')</label>
                                <input type="email" class="form-control" id="inputPassword2"
                                       placeholder="@lang('global.email')">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label>@lang('global.employee_code')</label>
                                <input type="number" class="form-control" name="employee_code" placeholder="@lang('global.employee_code')" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputPassword3">@lang('global.password')</label>
                                <input type="password" class="form-control" id="inputPassword3"
                                       placeholder="@lang('global.password')">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputPassword5">@lang('global.confirm_password')</label>
                                <input type="password" class="form-control" id="inputPassword5"
                                       placeholder="@lang('global.confirm_password')">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="inputState1">@lang('global.select_theme')</label>
                                <select id="inputState1" class="form-control" name="theme">
                                    <option value="light" selected>@lang('global.light')</option>
                                    <option value="dark" >@lang('global.dark')</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputState2">@lang('global.select_lang')</label>
                                <select id="inputState2" class="form-control" name="lang">
                                    <option value="ar" selected>@lang('global.arabic')</option>
                                    <option value="en" >@lang('global.english')</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputState3">@lang('global.select_role')</label>
                                <select id="inputState3" class="form-control" name="role_id">
                                    <option value="" selected>@lang('global.select_role')</option>
                                    <option value="" ></option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row mb-1">
                            <label class="col-12 col-form-label">@lang('global.is_active')</label>
                            <div class="col-12">
                                <div class="custom-switch custom-switch-primary-inverse mb-2" style="padding-left: 0">
                                    <input class="custom-switch-input" id="switch3" type="checkbox" name="is_active" checked>
                                    <label class="custom-switch-btn" for="switch3"></label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <div class="float-right">
                                <a href="{{ route('users.index') }}">
                                    <button type="button" class="btn btn-danger btn-sm mt-3">@lang('global.cancel')</button>
                                </a>
                                <button type="submit" class="btn btn-primary btn-sm mt-3">@lang('global.save')</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('scripts')
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#user-img').attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
        $().ready(function () {
            $('.user-img').on('click' , function () {
                $('.select-img').click();
            });
        })
    </script>
@endpush
