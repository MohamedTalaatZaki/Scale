<!DOCTYPE html>
<html lang="en" class="show-spinner-background">

<head>
    <meta charset="UTF-8">
    <title>@lang('global.juhayna')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="{{ asset('font/iconsmind-s/css/iconsminds.css') }}" />
    <link rel="stylesheet" href="{{ asset('font/simple-line-icons/css/simple-line-icons.css') }}" />

    <link rel="stylesheet" href="{{ asset('css/vendor/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/vendor/bootstrap.rtl.only.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/vendor/fullcalendar.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/vendor/dataTables.bootstrap4.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/vendor/datatables.responsive.bootstrap4.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/vendor/select2.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/vendor/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/vendor/owl.carousel.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/vendor/bootstrap-stars.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/vendor/nouislider.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/vendor/bootstrap-datepicker3.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/vendor/component-custom-switch.min.css') }}" />
    @if (Auth::check() && Auth::user()->theme == 'light')
        <link rel="stylesheet" type="text/css" href="{{ asset('css/dore.light.orange.min.css') }}">
    @else
        <link rel="stylesheet" type="text/css" href="{{ asset('css/dore.dark.orange.min.css') }}">
    @endif
    <link rel="stylesheet" href="{{ asset('css/main.css') }}" />
    <style>
        body,.table{
            color: #c0702f;
        }
    </style>
    @stack('styles')
</head>

<body id="app-container" class="menu-default show-spinner show-spinner-background">
<nav class="navbar fixed-top">
    <div class="d-flex align-items-center navbar-left">
        <a href="#" class="menu-button d-none d-md-block">
            <svg class="main" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 9 17">
                <rect x="0.48" y="0.5" width="7" height="1" />
                <rect x="0.48" y="7.5" width="7" height="1" />
                <rect x="0.48" y="15.5" width="7" height="1" />
            </svg>
            <svg class="sub" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17">
                <rect x="1.56" y="0.5" width="16" height="1" />
                <rect x="1.56" y="7.5" width="16" height="1" />
                <rect x="1.56" y="15.5" width="16" height="1" />
            </svg>
        </a>

        <a href="#" class="menu-button-mobile d-xs-block d-sm-block d-md-none">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 26 17">
                <rect x="0.5" y="0.5" width="25" height="1" />
                <rect x="0.5" y="7.5" width="25" height="1" />
                <rect x="0.5" y="15.5" width="25" height="1" />
            </svg>
        </a>

        <div class="search" data-search-path="Pages.Search.html?q=">
            <input placeholder="Search...">
            <span class="search-icon">
                    <i class="simple-icon-magnifier"></i>
                </span>
        </div>

    </div>


    <a class="navbar-logo" href="#">
        <span class="logo d-none d-xs-block"></span>
        <span class="logo-mobile d-block d-xs-none"></span>
    </a>

    <div class="navbar-right">
        <div class="header-icons d-inline-block align-middle">
            <div class="d-none d-md-inline-block align-text-bottom mr-3">
                <div class="custom-switch custom-switch-primary-inverse custom-switch-small pl-1"
                     data-toggle="tooltip" data-placement="left" title="Dark Mode">
                    <input class="custom-switch-input" id="switchDark" type="checkbox" {{ Auth::user()->theme == 'light' ? "" : "checked" }}>
                    <label class="custom-switch-btn" for="switchDark"></label>
                </div>
            </div>

            <div class="position-relative d-inline-block">
                <button class="header-icon btn btn-empty" type="button" id="languageButton"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="simple-icon-bubbles"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right mt-3">
                    <a class="dropdown-item" href="#">Arabic</a>
                    <a class="dropdown-item" href="#">English</a>
                </div>
            </div>

            <div class="position-relative d-none d-sm-inline-block">
                <button class="header-icon btn btn-empty" type="button" id="iconMenuButton" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                    <i class="simple-icon-grid"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right mt-3  position-absolute" id="iconMenuDropdown">
                    <a href="#" class="icon-menu-item">
                        <i class="iconsminds-equalizer d-block"></i>
                        <span>Settings</span>
                    </a>

                    <a href="#" class="icon-menu-item">
                        <i class="iconsminds-male-female d-block"></i>
                        <span>Users</span>
                    </a>

                    <a href="#" class="icon-menu-item">
                        <i class="iconsminds-puzzle d-block"></i>
                        <span>Components</span>
                    </a>

                    <a href="#" class="icon-menu-item">
                        <i class="iconsminds-bar-chart-4 d-block"></i>
                        <span>Profits</span>
                    </a>

                    <a href="#" class="icon-menu-item">
                        <i class="iconsminds-file d-block"></i>
                        <span>Surveys</span>
                    </a>

                    <a href="#" class="icon-menu-item">
                        <i class="iconsminds-suitcase d-block"></i>
                        <span>Tasks</span>
                    </a>

                </div>
            </div>

            <div class="position-relative d-inline-block">
                <button class="header-icon btn btn-empty" type="button" id="notificationButton"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="simple-icon-bell"></i>
                    <span class="count">3</span>
                </button>
                <div class="dropdown-menu dropdown-menu-right mt-3 position-absolute" id="notificationDropdown">
                    <div class="scroll">
                        <div class="d-flex flex-row mb-3 pb-3 border-bottom">
                            <a href="#">
                                <img src="{{ asset('img/profile-pic-l-2.jpg') }}" alt="Notification Image"
                                     class="img-thumbnail list-thumbnail xsmall border-0 rounded-circle" />
                            </a>
                            <div class="pl-3">
                                <a href="#">
                                    <p class="font-weight-medium mb-1">Joisse Kaycee just sent a new comment!</p>
                                    <p class="text-muted mb-0 text-small">09.04.2018 - 12:45</p>
                                </a>
                            </div>
                        </div>
                        <div class="d-flex flex-row mb-3 pb-3 border-bottom">
                            <a href="#">
                                <img src="{{ asset('img/notification-thumb.jpg') }}" alt="Notification Image"
                                     class="img-thumbnail list-thumbnail xsmall border-0 rounded-circle" />
                            </a>
                            <div class="pl-3">
                                <a href="#">
                                    <p class="font-weight-medium mb-1">1 item is out of stock!</p>
                                    <p class="text-muted mb-0 text-small">09.04.2018 - 12:45</p>
                                </a>
                            </div>
                        </div>
                        <div class="d-flex flex-row mb-3 pb-3 border-bottom">
                            <a href="#">
                                <img src="{{ asset('img/notification-thumb-2.jpg') }}" alt="Notification Image"
                                     class="img-thumbnail list-thumbnail xsmall border-0 rounded-circle" />
                            </a>
                            <div class="pl-3">
                                <a href="#">
                                    <p class="font-weight-medium mb-1">New order received! It is total $147,20.</p>
                                    <p class="text-muted mb-0 text-small">09.04.2018 - 12:45</p>
                                </a>
                            </div>
                        </div>
                        <div class="d-flex flex-row mb-3 pb-3 ">
                            <a href="#">
                                <img src="{{ asset('img/notification-thumb-3.jpg') }}" alt="Notification Image"
                                     class="img-thumbnail list-thumbnail xsmall border-0 rounded-circle" />
                            </a>
                            <div class="pl-3">
                                <a href="#">
                                    <p class="font-weight-medium mb-1">3 items just added to wish list by a user!
                                    </p>
                                    <p class="text-muted mb-0 text-small">09.04.2018 - 12:45</p>
                                </a>
                            </div>
                        </div>
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
                <span class="name">Sarah Kortney</span>
                <span>
                        <img alt="Profile Picture" src="{{ asset('img/profile-pic-l.jpg') }}" />
                    </span>
            </button>

            <div class="dropdown-menu dropdown-menu-right mt-3">
                <a class="dropdown-item" href="#">Account</a>
                <a class="dropdown-item" href="#">Features</a>
                <a class="dropdown-item" href="#">History</a>
                <a class="dropdown-item" href="#">Support</a>
                <a class="dropdown-item" href="{{ route('logout') }}">@lang('global.logout')</a>
            </div>
        </div>
    </div>
</nav>

@include('layout.sidebar')

<main>
    <div class="container-fluid">
        @yield('content')
    </div>
</main>


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
<script src="{{ asset('js/scripts.js') }}"></script>

<script>
    $().ready(function () {

        $("#switchDark").on("change", function (event) {
            $.ajax({
                'method' : 'get',
                'url'    : '{{ route('change-theme') }}',
                success  :   () => {
                    window.location.reload();
                }
            });
        });
    });
</script>
@stack('scripts')

</body>

</html>
