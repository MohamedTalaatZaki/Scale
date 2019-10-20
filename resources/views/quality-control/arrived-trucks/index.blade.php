@extends('layout.main')
@section('content')
    <div class="row">
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

    <div class="row">
        <div class="col-md-4">
            <div class="card main-card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-4">
                            @lang('global.waiting')
                        </div>
                        <div class="col-8" style="margin-top: -6px">
                            <input class="form-control form-control-sm" placeholder="search ....">
                        </div>
                    </div>
                    <hr>
                    <div id="waiting" class="cards-container scroll scroll-content nested-sortable">
                        @foreach([1,2,3,4,5] as $id)
                            @include('quality-control.arrived-trucks.partial.waiting-cards' , ['id' => "Waiting-{$id}"] )
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card main-card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-4">
                            @lang('global.sampled')
                        </div>
                        <div class="col-8" style="margin-top: -6px">
                            <input class="form-control form-control-sm" placeholder="search ....">
                        </div>
                    </div>
                    <hr>
                    <div id="sampled" class="cards-container scroll scroll-content nested-sortable">
                        @foreach([1,2,3] as $id)
                            @include('quality-control.arrived-trucks.partial.sampled-cards' , ['id' => "Sampled-{$id}"] )
                        @endforeach


                    </div>
                </div>

            </div>
        </div>
        <div class="col-md-4">
            <div class="card main-card-50">
                <div class="card-body">
                    <div class="row">
                        <div class="col-4">
                            @lang('global.accepted')
                        </div>
                        <div class="col-8" style="margin-top: -6px">
                            <input class="form-control form-control-sm" placeholder="search ....">
                        </div>
                    </div>
                    <hr>
                    <div class="scroll scroll-content-50">
                        @foreach([1,2,3,4,5,6,7,8,9] as $id)
                            @include('quality-control.arrived-trucks.partial.accepted-cards' , ['id' => "accepted-{$id}"] )
                        @endforeach
                    </div>


                </div>

            </div>
            <br/>
            <div class="card main-card-50">
                <div class="card-body">
                    <div class="row">
                        <div class="col-4">
                            @lang('global.rejected')
                        </div>
                        <div class="col-8" style="margin-top: -6px">
                            <input class="form-control form-control-sm" placeholder="search ....">
                        </div>
                    </div>
                    <hr>
                    <div class="scroll scroll-content-50">
                        @foreach([1] as $id)
                            @include('quality-control.arrived-trucks.partial.rejected-cards' , ['id' => "rejected-{$id}"] )
                        @endforeach
                    </div>


                </div>

            </div>
        </div>
    </div>

@endsection
@push('styles')
    <style>
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
            let mv = window.screen.height / 1.50;
            $('.main-card').css({'max-height': mv + 'px', 'min-height': mv + 'px'});
            $('.scroll-content').css({'max-height': (mv - 100) + 'px', 'min-height': (mv - 100) + 'px'});
            $('.main-card-50').css({'max-height': (mv - 15) / 2 + 'px', 'min-height': (mv - 15) / 2 + 'px'});
            $('.scroll-content-50').css({'max-height': ((mv / 2) - 100) + 'px', 'min-height': ((mv / 2) - 100) + 'px'});

            //Sortable
            var nestedSortables = [].slice.call(document.querySelectorAll('.nested-sortable'));

            for (var i = 0; i < nestedSortables.length; i++) {
                new Sortable(nestedSortables[i], {
                    group: 'nested',
                    animation: 150,
                    fallbackOnBody: true,
                    swapThreshold: 0.65,
                    ghostClass: 'blue-background',
                    onEnd: function (evt) {
                        let card        =   $(evt.item);
                        let status      =   card.closest('.cards-container').attr('id');
                        if( status === 'sampled' ){
                            card.find('.lab-btn').show();
                            card.find('.card-status').attr( 'class' , 'card-status bg-yellow');
                        } else if(status === 'waiting') {
                            card.find('.lab-btn').hide();
                            card.find('.card-status').attr( 'class' , 'card-status bg-blue');
                        }
                    },
                });
            }
        })
    </script>
@endpush
