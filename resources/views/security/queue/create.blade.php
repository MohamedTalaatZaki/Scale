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

    <div class="row content">
        <div class="col-md-4">
            <div class="card main-card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <h3><i class="fas fa-apple-alt"></i> @lang('global.raw')</h3>
                        </div>
                    </div>
                    <hr>
                    <div id="raw" class="cards-container scroll scroll-content">
                        @foreach($raw as $truck)
                            @include('security.queue.card' , ['truck' => $truck, 'order'   =>  $loop->iteration , 'type'    =>  'raw'] )
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
                    <div id="scrap" class="cards-container scroll scroll-content">
                        @foreach($scrap as $truck)
                            @include('security.queue.card' , ['truck' => $truck , 'order'   =>  $loop->iteration, 'type'    =>  'scrap'] )
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
                    <div id="finish" class="cards-container scroll scroll-content">
                        @foreach($finish as $truck)
                            @include('security.queue.card' , ['truck' => $truck, 'order'   =>  $loop->iteration, 'type'    =>  'finish'] )
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

        .green-to-red > div > .bg-green{
            background-color: #dc3545 !important;
        }
    </style>
@endpush

@push('scripts')
    <script>
        $().ready(function () {
            let mv = window.screen.height / 1.4;
            $('.main-card').css({'max-height': mv + 'px', 'min-height': mv + 'px'});
            $('.scroll-content').css({'max-height': (mv - 100) + 'px', 'min-height': (mv - 100) + 'px'});
            $('.main-card-50').css({'max-height': (mv - 15) / 2 + 'px', 'min-height': (mv - 15) / 2 + 'px'});
            $('.scroll-content-50').css({'max-height': ((mv / 2) - 100) + 'px', 'min-height': ((mv / 2) - 100) + 'px'});

            let raw     =   document.getElementById('raw');
            let scrap   =   document.getElementById('scrap');
            let finish  =   document.getElementById('finish');

            Sortable.create( raw , {
                multiDrag: true,
                scroll: true,
                bubbleScroll: true,
                forceFallback: true,
                selectedClass: "green-to-red",
                animation: 150,
                onUpdate: function (evt) {
                    afterChangeCardPos(evt);
                },
            });

            Sortable.create( scrap , {
                multiDrag: true,
                scroll: true,
                bubbleScroll: true,
                forceFallback: true,
                selectedClass: "green-to-red",
                animation: 150,
                onUpdate: function (evt) {
                    afterChangeCardPos(evt);
                },
            });

            Sortable.create( finish , {
                multiDrag: true,
                scroll: true,
                bubbleScroll: true,
                forceFallback: true,
                selectedClass: "green-to-red",
                animation: 150,
                onUpdate: function (evt) {
                    afterChangeCardPos(evt);
                },
            });

            let afterChangeCardPos  =   (evt)  =>  {
                let cardType    = $(evt.item).data('type');
                let ids         = [];
                $('.'+cardType+'-card').each(function(index , elem) {
                    let color = index === 0 ? "#28a745" : "#FF8E03" ;
                    $(elem).find('.order-number').text('# '+ (index+1) ).css('color' , color);
                    ids.push($(elem).attr('id'));
                });
                $.ajax({
                    method  : "POST",
                    url     : "{{ route('reorder-trucks-queue') }}",
                    data    : { _token : "{{ csrf_token() }}" , ids : ids , type : cardType}
                })
            }
        });
    </script>
@endpush
