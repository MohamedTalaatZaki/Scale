<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>@lang('login.juhayna_login')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="{{ asset('font/iconsmind-s/css/iconsminds.css') }}" />
    <link rel="stylesheet" href="{{ asset('font/simple-line-icons/css/simple-line-icons.css') }}" />

    <link rel="stylesheet" href="{{ asset('css/vendor/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/vendor/bootstrap.rtl.only.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/vendor/bootstrap-float-label.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/main.css') }}" />
</head>

<body class="background show-spinner">
<div class="fixed-background"></div>
<main>
    <div class="container">
        <div class="row h-100">
            <div class="col-12 col-md-6 mx-auto my-auto">
                <div class="card auth-card">

                    <div class="form-side" style="width: 100% ; padding: 35px !important;">
                        <a href="#" style="display: block;cursor: default">
                            <span class="logo-single"></span>
                        </a>
                        @include('components._validation')
                        <h6 class="mb-4">@lang('login.juhayna_login')</h6>
                        <form action="{{ route('login') }}" method="post">
                            @csrf
                            <label class="form-group has-float-label mb-4">
                                <input class="form-control" name="user_name" required autofocus/>
                                <span>@lang('login.name')</span>
                            </label>

                            <label class="form-group has-float-label mb-4">
                                <input class="form-control" type="password" name="password" placeholder="" required/>
                                <span>@lang('login.password')</span>
                            </label>
                            <div class="d-flex justify-content-between align-items-center">
{{--                                <a href="#">@lang('login.forget_password')?</a>--}}
                                <button
                                    class="btn btn-primary btn-lg btn-shadow"
                                    style="background-color: #db5d0b ; margin: 0 auto"
                                    type="submit">@lang('login.sign_in')</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<script src="{{ asset('js/vendor/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('js/vendor/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('js/dore.script.js') }}"></script>
<script src="{{ asset('js/login.js') }}"></script>
<script>
    $().ready(function () {
        localStorage.setItem('sidebar' , 'sidebar-dashboard');
        localStorage.setItem('hasSub' , '0');
        setTimeout(function () {
            $("body").removeClass("show-spinner");
        }, 3000);
    })
</script>
</body>

</html>
