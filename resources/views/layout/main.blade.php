<!DOCTYPE html >
<html lang="en" dir="{{$page_dir}}">

<head>
    <meta charset="UTF-8">
    <title>@lang('global.juhayna')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="{{ asset('font/iconsmind-s/css/iconsminds.css') }}"/>
    <link rel="stylesheet" href="{{ asset('font/simple-line-icons/css/simple-line-icons.css') }}"/>

    <link rel="stylesheet" href="{{ asset('css/vendor/bootstrap.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/vendor/bootstrap.rtl.only.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/vendor/fullcalendar.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/vendor/dataTables.bootstrap4.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/vendor/datatables.responsive.bootstrap4.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/vendor/select2.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/vendor/select2-bootstrap.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/vendor/perfect-scrollbar.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/vendor/owl.carousel.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/vendor/bootstrap-stars.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/vendor/nouislider.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/vendor/bootstrap-datepicker3.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/vendor/component-custom-switch.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}"/>
    @if (Auth::check() && optional(Auth::user())->theme == 'light')
        <link rel="stylesheet" type="text/css" href="{{ asset('css/dore.light.orange.min.css') }}">
    @else
        <link rel="stylesheet" type="text/css" href="{{ asset('css/dore.dark.orange.min.css') }}">
    @endif
    <link rel="stylesheet" href="{{ asset('css/main.css') }}"/>
    <link rel="stylesheet" href="{{ asset('js/multi-select/css/multi-select.css') }}"/>

    <style>
        body, .table {
            color: #c0702f;
        }

        .form-control:disabled {
            background-color: transparent;
        }

        .default-cursor {
            cursor: default;
        }

        .rtl .custom-control-label::after, .rtl .custom-control-label::before {
            right: -25px;
        }
        .logo.ar{
           background:  url(../img/Picture2.png) no-repeat;
            background-size: contain;
            background-position: center center;
        }
        .logo.en{
            background: url(../img/logo_en.png) no-repeat;
            background-size: contain;
            background-position: center center;
        }
        .bg-readonly{
            background-color: transparent !important;
        }
        .qc-element-id{
            height: 2.2rem !important;
        }

        .sidebar-icon{
            font-size: 30px;
            margin-bottom: 10px;
        }
    </style>
    @stack('styles')
</head>

<body id="app-container"
      class="menu-default {{$page_dir}}  {{Route::currentRouteName() == 'home' ? 'menu-sub-hidden sub-hidden' : ''}}">
<nav class="navbar fixed-top">
    <div class="d-flex align-items-center navbar-left">
        <a href="#" class="menu-button d-none d-md-block">
            <svg class="main" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 9 17">
                <rect x="0.48" y="0.5" width="7" height="1"/>
                <rect x="0.48" y="7.5" width="7" height="1"/>
                <rect x="0.48" y="15.5" width="7" height="1"/>
            </svg>
            <svg class="sub" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17">
                <rect x="1.56" y="0.5" width="16" height="1"/>
                <rect x="1.56" y="7.5" width="16" height="1"/>
                <rect x="1.56" y="15.5" width="16" height="1"/>
            </svg>
        </a>

        <a href="#" class="menu-button-mobile d-xs-block d-sm-block d-md-none">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 26 17">
                <rect x="0.5" y="0.5" width="25" height="1"/>
                <rect x="0.5" y="7.5" width="25" height="1"/>
                <rect x="0.5" y="15.5" width="25" height="1"/>
            </svg>
        </a>

        <div class="search" data-search-path="Pages.Search.html?q=">
            {{--<input placeholder="Search...">--}}
            {{--<span class="search-icon">--}}
                    {{--<i class="simple-icon-magnifier"></i>--}}
                {{--</span>--}}
        </div>

    </div>


    <a class="navbar-logo" href="{{route('home')}}">
        <span class="logo {{App::getLocale()}} d-none d-xs-block"></span>
        <span class="logo-mobile d-block d-xs-none"></span>
    </a>

    <div class="navbar-right">
        <div class="header-icons d-inline-block align-middle">
            <div class="d-none d-md-inline-block align-text-bottom mr-3">
                <div class="custom-switch custom-switch-primary-inverse custom-switch-small pl-1"
                     data-toggle="tooltip" data-placement="left"
                     title="{{ optional(Auth::user())->theme == 'light' ? trans('global.dark') : trans('global.light') }}">
                    <input class="custom-switch-input" id="switchDark"
                           type="checkbox" {{ optional(Auth::user())->theme == 'light' ? "" : "checked" }}>
                    <label class="custom-switch-btn" for="switchDark"></label>
                </div>
            </div>

            <div class="position-relative d-inline-block">
                <button class="header-icon btn btn-empty" type="button" id="languageButton"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="simple-icon-bubbles"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right mt-3">
                    <a class="dropdown-item"
                       href="{{ route('change-lang' , ['lang' => 'ar']) }}">@lang('global.arabic')</a>
                    <a class="dropdown-item"
                       href="{{ route('change-lang' , ['lang' => 'en']) }}">@lang('global.english')</a>
                </div>
            </div>

            <div class="position-relative d-none d-sm-inline-block">
                <button class="header-icon btn btn-empty" type="button" id="iconMenuButton" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                    <i class="simple-icon-grid"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right mt-3  position-absolute" id="iconMenuDropdown">
{{--                    <a href="#" class="icon-menu-item">--}}
{{--                        <i class="iconsminds-equalizer d-block"></i>--}}
{{--                        <span>Settings</span>--}}
{{--                    </a>--}}

{{--                    <a href="#" class="icon-menu-item">--}}
{{--                        <i class="iconsminds-male-female d-block"></i>--}}
{{--                        <span>Users</span>--}}
{{--                    </a>--}}

{{--                    <a href="#" class="icon-menu-item">--}}
{{--                        <i class="iconsminds-puzzle d-block"></i>--}}
{{--                        <span>Components</span>--}}
{{--                    </a>--}}

{{--                    <a href="#" class="icon-menu-item">--}}
{{--                        <i class="iconsminds-bar-chart-4 d-block"></i>--}}
{{--                        <span>Profits</span>--}}
{{--                    </a>--}}

{{--                    <a href="#" class="icon-menu-item">--}}
{{--                        <i class="iconsminds-file d-block"></i>--}}
{{--                        <span>Surveys</span>--}}
{{--                    </a>--}}

{{--                    <a href="#" class="icon-menu-item">--}}
{{--                        <i class="iconsminds-suitcase d-block"></i>--}}
{{--                        <span>Tasks</span>--}}
{{--                    </a>--}}

                </div>
            </div>

            <div class="position-relative d-inline-block">
                <button class="header-icon btn btn-empty" type="button" id="notificationButton"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="simple-icon-bell"></i>
                    <span class="count">0</span>
                </button>
                <div class="dropdown-menu dropdown-menu-right mt-3 position-absolute" id="notificationDropdown">
                    <div class="scroll">
{{--                        <div class="d-flex flex-row mb-3 pb-3 border-bottom">--}}
{{--                            <a href="#">--}}
{{--                                <img src="{{ asset('img/profile-pic-l-2.jpg') }}" alt="Notification Image"--}}
{{--                                     class="img-thumbnail list-thumbnail xsmall border-0 rounded-circle"/>--}}
{{--                            </a>--}}
{{--                            <div class="pl-3">--}}
{{--                                <a href="#">--}}
{{--                                    <p class="font-weight-medium mb-1">Joisse Kaycee just sent a new comment!</p>--}}
{{--                                    <p class="text-muted mb-0 text-small">09.04.2018 - 12:45</p>--}}
{{--                                </a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="d-flex flex-row mb-3 pb-3 border-bottom">--}}
{{--                            <a href="#">--}}
{{--                                <img src="{{ asset('img/notification-thumb.jpg') }}" alt="Notification Image"--}}
{{--                                     class="img-thumbnail list-thumbnail xsmall border-0 rounded-circle"/>--}}
{{--                            </a>--}}
{{--                            <div class="pl-3">--}}
{{--                                <a href="#">--}}
{{--                                    <p class="font-weight-medium mb-1">1 item is out of stock!</p>--}}
{{--                                    <p class="text-muted mb-0 text-small">09.04.2018 - 12:45</p>--}}
{{--                                </a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="d-flex flex-row mb-3 pb-3 border-bottom">--}}
{{--                            <a href="#">--}}
{{--                                <img src="{{ asset('img/notification-thumb-2.jpg') }}" alt="Notification Image"--}}
{{--                                     class="img-thumbnail list-thumbnail xsmall border-0 rounded-circle"/>--}}
{{--                            </a>--}}
{{--                            <div class="pl-3">--}}
{{--                                <a href="#">--}}
{{--                                    <p class="font-weight-medium mb-1">New order received! It is total $147,20.</p>--}}
{{--                                    <p class="text-muted mb-0 text-small">09.04.2018 - 12:45</p>--}}
{{--                                </a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="d-flex flex-row mb-3 pb-3 ">--}}
{{--                            <a href="#">--}}
{{--                                <img src="{{ asset('img/notification-thumb-3.jpg') }}" alt="Notification Image"--}}
{{--                                     class="img-thumbnail list-thumbnail xsmall border-0 rounded-circle"/>--}}
{{--                            </a>--}}
{{--                            <div class="pl-3">--}}
{{--                                <a href="#">--}}
{{--                                    <p class="font-weight-medium mb-1">3 items just added to wish list by a user!--}}
{{--                                    </p>--}}
{{--                                    <p class="text-muted mb-0 text-small">09.04.2018 - 12:45</p>--}}
{{--                                </a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                    </div>
                </div>
            </div>

            <button class="header-icon btn btn-empty d-none d-sm-inline-block" type="button" id="fullScreenButton">
                <i class="simple-icon-size-fullscreen"></i>
                <i class="simple-icon-size-actual"></i>
            </button>

        </div>

        <div class="user d-inline-block">
            <button class="btn btn-empty p-0" type="button" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                <span class="name" style="color: #c0702f">{{ optional(Auth::user())->full_name }}</span>
                <span>
                        <img alt="Profile Picture" src="{{ optional(Auth::user())->avatar_url }}"/>
                    </span>
            </button>
            <form action="{{route('logout')}}" id="logout" method="post">@csrf</form>
            <div class="dropdown-menu dropdown-menu-right mt-3">
                <a class="dropdown-item" href="#" data-toggle="modal"
                   data-target="#account-info"> @lang('global.change_acc_info')</a>
                <a class="dropdown-item" href="javascript:void(0);"
                   onclick="document.getElementById('logout').submit()">@lang('global.logout')</a>
            </div>
        </div>
    </div>
</nav>
@if(Auth::check())
    @include('layout.sidebar')
@endif
<main>
    <div class="container-fluid">
        @yield('content')
    </div>
</main>

<div class="modal" id="account-info" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">@lang('global.change_acc_info')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('users.change-acc-info') }}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>@lang('global.full_name')</label>
                            <input type="text" class="form-control" name="full_name"
                                   value="{{ old('full_name' , optional(Auth::user())->full_name) }}"
                                   placeholder="@lang('global.full_name')" disabled>
                            @if($errors->has('full_name'))
                                <div id="jQueryName-error" class="error"
                                     style="">{{ $errors->first('full_name') }}</div>
                            @endif
                        </div>
                        <div class="form-group col-md-6">
                            <label>@lang('global.user_name')</label>
                            <input type="text" class="form-control" name="user_name"
                                   value="{{ old('user_name' , optional(Auth::user())->user_name) }}"
                                   placeholder="@lang('global.user_name')" disabled>
                            @if($errors->has('user_name'))
                                <div id="jQueryName-error" class="error"
                                     style="">{{ $errors->first('user_name') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="password">@lang('global.password')</label>
                            <input type="password" class="form-control" id="password" name="password"
                                   placeholder="@lang('global.password')">
                            @if($errors->has('password'))
                                <div id="jQueryName-error" class="error" style="">{{ $errors->first('password') }}</div>
                            @endif
                        </div>
                        <div class="form-group col-md-6">
                            <label for="password_confirmation">@lang('global.confirm_password')</label>
                            <input type="password" class="form-control" id="password_confirmation"
                                   name="password_confirmation"
                                   placeholder="@lang('global.confirm_password')">
                            @if($errors->has('password_confirmation'))
                                <div id="jQueryName-error" class="error"
                                     style="">{{ $errors->first('password_confirmation') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputState1">@lang('global.select_theme')</label>
                            <select id="inputState1" class="form-control" name="theme">
                                <option
                                    value="light" {{ old('theme' , optional(Auth::user())->theme) == 'light' ? 'selected' : '' }}>
                                    @lang('global.light')
                                </option>
                                <option
                                    value="dark" {{ old('theme' , optional(Auth::user())->theme) == 'dark' ? 'selected' : '' }}>
                                    @lang('global.dark')
                                </option>
                            </select>
                            @if($errors->has('theme'))
                                <div id="jQueryName-error" class="error" style="">{{ $errors->first('theme') }}</div>
                            @endif
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputState2">@lang('global.select_lang')</label>
                            <select id="inputState2" class="form-control" name="lang">
                                <option value="ar" {{ old('lang' , optional(Auth::user())->lang) == 'ar' ? 'selected' : '' }}>
                                    @lang('global.arabic')
                                </option>
                                <option value="en" {{ old('lang' , optional(Auth::user())->lang) == 'en' ? 'selected' : '' }}>
                                    @lang('global.english')
                                </option>
                            </select>
                            @if($errors->has('lang'))
                                <div id="jQueryName-error" class="error" style="">{{ $errors->first('lang') }}</div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">@lang('global.save')</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('global.close')</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="{{ asset('js/vendor/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('js/vendor/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('js/vendor/Chart.bundle.min.js') }}"></script>
<script src="{{ asset('js/vendor/chartjs-plugin-datalabels.js') }}"></script>
<script src="{{ asset('js/vendor/moment.min.js') }}"></script>
<script src="{{ asset('js/vendor/fullcalendar.min.js') }}"></script>
<script src="{{ asset('js/vendor/datatables.min.js') }}"></script>
<script src="{{ asset('js/vendor/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('js/vendor/owl.carousel.min.js') }}"></script>
<script src="{{ asset('js/vendor/progressbar.min.js') }}"></script>
<script src="{{ asset('js/vendor/jquery.barrating.min.js') }}"></script>
<script src="{{ asset('js/vendor/select2.full.js') }}"></script>
<script src="{{ asset('js/vendor/nouislider.min.js') }}"></script>
<script src="{{ asset('js/vendor/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('js/vendor/Sortable.js') }}"></script>
<script src="{{ asset('js/vendor/mousetrap.min.js') }}"></script>
<script src="{{ asset('js/dore.script.js') }}"></script>
<script src="{{ asset('js/scripts'.$page_dir.'.js') }}"></script>
<script src="{{ asset('js/notify.min.js') }}"></script>
<script src="{{ asset('js/multi-select/js/jquery.quicksearch.js') }}"></script>
<script src="{{ asset('js/multi-select/js/jquery.multi-select.js') }}"></script>
<script src="{{ asset('fontawesome/js/all.min.js') }}"></script>
<script src="{{ asset('js/jquery.repeater.js') }}"></script>

<script>
    $().ready(function () {

        let body    =   $('body');
        let notify = parseInt('{{ Session::has('notify') }}');
        let openAccountInfo = parseInt('{{ Session::has('openAccountInfo') }}');
        var isHome = !!'{{Route::currentRouteName() == 'home'}}';
        if(isHome){
            console.log(isHome);
            localStorage.setItem('sidebar','sidebar-dashboard');
        }
        $('.' + localStorage.getItem('sidebar')).closest('li').addClass('active');

        if (localStorage.getItem('hasSub') == '1') {
            $('.' + localStorage.getItem('sidebar-sub')).closest('li').addClass('active');
        }

        if (openAccountInfo) {
            $('#account-info').modal('show');
        }

        if (notify) {
            $.notify('{{ Session::get('notify') }}', {
                position: "right bottom",
                className: 'success',
                autoHideDelay: 9000
            });
        }
        $('.sidebar,.sidebar-sub').on('click', function (event) {
            let target, classes;
            let tagName = event.target.tagName;
            if (tagName !== 'A') {
                target = $(event.target).closest('a');
            } else {
                target = $(event.target);
            }
            classes = $(target).attr('class').split(' ');
            let hasSub = classes.find(function (elem) {
                return elem == "sidebar-sub";
            });
            localStorage.setItem('hasSub', hasSub ? '1' : '0');

            localStorage.setItem(classes[0], classes[1]);
        });

        $("#switchDark").on("change", function (event) {
            $.ajax({
                'method': 'get',
                'url': '{{ route('change-theme') }}',
                success: () => {
                    window.location.reload();
                }
            });
        });


        body.on( 'keypress' , '.onlyEn' ,function (e) {
            var regex = new RegExp("^[a-zA-Z0-9 ]+$");
            var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
            if (regex.test(str)) {
                return true;
            }

            e.preventDefault();
            return false;
        });

        body.on( 'keypress' , '.onlyAr' ,function (e) {
            var regex = /^([\u0600-\u06ff]|[\u0750-\u077f]|[\ufb50-\ufbc1]|[\ufbd3-\ufd3f]|[\ufd50-\ufd8f]|[\ufd92-\ufdc7]|[\ufe70-\ufefc]|[\ufdf0-\ufdfd]|[ ]|[0-9])*$/g;
            var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
            if (regex.test(str)) {
                return true;
            }

            e.preventDefault();
            return false;
        });

        body.on( 'keypress' , '.onlyNumbers' ,function (e) {
            var regex = /^([0-9])*$/g;
            var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
            if (regex.test(str)) {
                return true;
            }

            e.preventDefault();
            return false;
        });

        body.on( 'keypress' , '.noNumbers' ,function (e) {
            var regex = /^([0-9])*$/g;
            var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
            if (!regex.test(str)) {
                return true;
            }

            e.preventDefault();
            return false;
        });

        body.on( 'keypress' , '.limitInputLength' , function (evt) {
            let max = $(this).data('max-length') - 1;
            let len =   $(this).val().length;
            if(len > max ) {
                evt.preventDefault();
            }
        })

    });
</script>
@stack('scripts')

</body>

</html>
