@extends('layout.main')
@section('content')
    <div class="row content" style="display: none">
        <div class="col-12">
            <h1>@lang('global.arrived_trucks')</h1>
            <div class="text-zero top-right-button-container">
            </div>
            <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                <ol class="breadcrumb pt-0">
                    <li class="breadcrumb-item">
                        <span class="default-cursor">@lang('global.master_data')</span>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="javascript:void(0)" class="show-create-div">@lang('global.qc')</a>
                    </li>
                    <li class="breadcrumb-item " aria-current="page">@lang('global.index')</li>
                </ol>
            </nav>
            <div class="separator mb-5"></div>
        </div>
    </div>

    <div class="row content" style="display: none">
        <div class="col-md-4">
            <div class="card main-card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <h3><i class="fas fa-apple-alt"></i> @lang('global.raw')</h3>
                        </div>
                    </div>
                    <hr>
                    <div id="arrived" class="cards-container scroll scroll-content nested-sortable">
                        @foreach($raw as $truck)
                            @include('security.queue.card' , ['truck' => $truck, 'order'   =>  $loop->iteration] )
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card main-card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <h3><i class="fa fa-trash"></i> @lang('global.scrap')</h3>
                        </div>
                    </div>
                    <hr>
                    <div id="sampled" class="cards-container scroll scroll-content nested-sortable">
                        @foreach($scrap as $truck)
                            @include('security.queue.card' , ['truck' => $truck , 'order'   =>  $loop->iteration] )
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
        <div class="col-md-4">
            <div class="card main-card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <h3><i class="fa fa-cocktail"></i> @lang('global.finish')</h3>
                        </div>
                    </div>
                    <hr>
                    <div id="sampled" class="cards-container scroll scroll-content nested-sortable">
                        @foreach($finish as $truck)
                            @include('security.queue.card' , ['truck' => $truck, 'order'   =>  $loop->iteration] )
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
@push('styles')
    <style>
        .navbar{
            display: none;
        }

        .menu{
            display: none;
        }
        .default-transition{
            margin-left: 60px !important;
            margin-top: 20px !important;
            margin-right: 60px !important;
            margin-bottom: 40px !important;
        }
        .blue-background .card{
            border: 1px solid #0e78c0;
        }
        .card-shadow{
            border: 1px solid #c0702f;
            border-radius: 0 !important;
        }

        .card-body {
            overflow: hidden;
        }

        .card-custom-padding {
            padding: 0 1.75rem 5px 1.75rem !important;
        }

        .card-table {
            margin-bottom: 0 !important;
        }

        .card-status {
            height: 100%;
            width: 10px;
            position: absolute;
        }

        .bg-blue {
            background-color: #007bff;
        }

        .bg-yellow {
            background-color: #ffc107;
        }

        .bg-green {
            background-color: #28a745;
        }

        .bg-red {
            background-color: #dc3545;
        }
    </style>
@endpush

@push('scripts')
    <script>
        $().ready(function () {
            let mv = window.screen.height / 1.10;
            $('.main-card').css({'max-height': mv + 'px', 'min-height': mv + 'px'});
            $('.scroll-content').css({'max-height': (mv - 100) + 'px', 'min-height': (mv - 100) + 'px'});
            $('.main-card-50').css({'max-height': (mv - 15) / 2 + 'px', 'min-height': (mv - 15) / 2 + 'px'});
            $('.scroll-content-50').css({'max-height': ((mv / 2) - 100) + 'px', 'min-height': ((mv / 2) - 100) + 'px'});

            setTimeout(function () {
                $('.content').show();
            } , 1000);
            setTimeout(function () {
                window.location.reload();
            }, 25000)

        })
    </script>
@endpush
