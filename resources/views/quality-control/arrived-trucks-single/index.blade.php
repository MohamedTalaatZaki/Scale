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
                        <a href="javascript:void(0)" class="show-create-div">@lang('global.qc')</a>
                    </li>
                    <li class="breadcrumb-item " aria-current="page">@lang('global.index')</li>
                </ol>
            </nav>
            <div class="separator mb-5"></div>
        </div>
    </div>
        <div class="icon-cards-row" >
            <div class="owl-container">
                <div class="owl-carousel dashboard-numbers">
                    <a href="#waiting" class="card" style="cursor: default">
                        <div class="card-body text-center">
                            <i class="iconsminds-check"></i>
                            <p class="card-text mb-0">@lang('global.waiting')</p><h3>{{ $arrived->count() }}</h3>
                        </div>
                    </a>

                    <a href="#sampled" class="card" style="cursor: default">
                        <div class="card-body text-center">
                            <i class="iconsminds-check"></i>
                            <p class="card-text mb-0">@lang('global.sampled')</p><h3>{{ $sampled->count() }}</h3>
                        </div>
                    </a>

                    <a href="#accepted" class="card" style="cursor: default">
                        <div class="card-body text-center">
                            <i class="iconsminds-check"></i>
                            <p class="card-text mb-0">@lang('global.accepted')</p><h3>{{ $accepted->count() }}</h3>
                        </div>
                    </a>

                    <a href="#rejected" class="card" style="cursor: default">
                        <div class="card-body text-center">
                            <i class="iconsminds-check"></i>
                            <p class="card-text mb-0">@lang('global.rejected')</p><h3>{{ $rejected->count() }}</h3>
                        </div>
                    </a>

                </div>
            </div>
        </div>
    <hr>

    <h2>@lang('global.waiting')</h2>
    <div id="waiting" class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>@lang('global.transport_#')</th>
                                <th>@lang('global.qc_test_name')</th>
                                <th>@lang('global.truck_plate')</th>
                                <th>@lang('global.driver_name')</th>
                                <th>@lang('global.driver_mobile')</th>
                                <th>@lang('global.arrival_time')</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i_arrived = 1; @endphp
                            @forelse($arrived as $truck)
                                @foreach($truck->arrivedDetails as $detail)
                                    <tr>
                                        <td>{{$i_arrived}}</td>
                                        <td>{{$truck->transport_number.'-'.$detail->id}}</td>
                                        <td>{{ $truck->itemGroup->name }}</td>
                                        <td><i class="fa fa-{{ $detail->is_trailer ? 'truck-pickup' : 'truck' }}">
                                            </i> @lang("global.truck_{$detail->plate_name}_#")
                                            <span class="cardTruckPlates"> : {{ $detail->truck_plates }}</span>
                                        </td>
                                        <td>{{ $truck->driver_name }}</td>
                                        <td>{{ $truck->driver_mobile }}</td>
                                        <td>{{$truck->arrival_time}}</td>
                                        <td>
                                            @if($i_arrived == 1)
                                                <form action="{{route('arrived-trucks-single.update',['id'=>$detail->id])}}" method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="text" name="status" value="sampled" hidden>
                                                    <button class="btn btn-primary btn-sm">
                                                        @lang('global.pull_sample')
                                                    </button>
                                                </form>
                                            @else
                                                <button class="btn btn-primary btn-sm" disabled>
                                                    @lang('global.pull_sample')
                                                </button>
                                            @endif
                                        </td>
                                        @php $i_arrived++; @endphp
                                    </tr>
                                @endforeach
                            @empty
                                <td></td>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
    <hr>
    <h2> @lang('global.sampled')</h2>
    <div id="sampled" class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>@lang('global.transport_#')</th>
                            <th>@lang('global.qc_test_name')</th>
                            <th>@lang('global.truck_plate')</th>
                            <th>@lang('global.driver_name')</th>
                            <th>@lang('global.driver_mobile')</th>
                            <th>@lang('global.arrival_time')</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @php $i_sampled = 1; @endphp

                        @forelse($sampled as $truck)
                            @foreach($truck->sampledDetails as $detail)
                                <tr>
                                    <td>{{$i_sampled}}</td>
                                    <td>{{$truck->transport_number.'-'.$detail->id}}</td>
                                    <td>{{ $truck->itemGroup->name }}</td>
                                    <td><i class="fa fa-{{ $detail->is_trailer ? 'truck-pickup' : 'truck' }}">
                                        </i> @lang("global.truck_{$detail->plate_name}_#")
                                        <span class="cardTruckPlates"> : {{ $detail->truck_plates }}</span>
                                    </td>
                                    <td>{{ $truck->driver_name }}</td>
                                    <td>{{ $truck->driver_mobile }}</td>
                                    <td>{{$truck->arrival_time}}</td>
                                    <td class="lab-btn">
                                        @if($i_sampled == 1)
                                            <a href="{{ route('samples-test.create' , ['transport_detail_id' => $detail->id, 'single'=>1]) }}" class="btn btn-warning btn-xs"><i class="fa fa-vials"></i></a>
                                            <a href="{{route('qc-label-rpt.index',['transport_detail_id' => $detail->id])}}" class="btn btn-primary btn-xs" target="_blank"><i class="fa fa-print"></i></a>
                                        @else
                                            <button class="btn btn-warning btn-xs" disabled><i class="fa fa-vials"></i></button>
                                            <button class="btn btn-primary btn-xs" disabled><i class="fa fa-print"></i></button>
                                        @endif
                                    </td>
                                    @php $i_sampled++; @endphp
                                </tr>
                            @endforeach
                        @empty
                            <td></td>
                        @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
    <hr>
    <h2>@lang('global.accepted')</h2>
    <div id="accepted" class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>@lang('global.transport_#')</th>
                            <th>@lang('global.qc_test_name')</th>
                            <th>@lang('global.truck_plate')</th>
                            <th>@lang('global.driver_name')</th>
                            <th>@lang('global.driver_mobile')</th>
                            <th>@lang('global.arrival_time')</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @php $i_accepted = 1; @endphp

                        @forelse($accepted as $truck)
                            @foreach($truck->acceptedDetails as $detail)
                                <tr>
                                    <td>{{$i_accepted}}</td>
                                    <td>{{$truck->transport_number.'-'.$detail->id}}</td>
                                    <td>{{ $truck->itemGroup->name }}</td>
                                    <td><i class="fa fa-{{ $detail->is_trailer ? 'truck-pickup' : 'truck' }}">
                                        </i> @lang("global.truck_{$detail->plate_name}_#")
                                        <span class="cardTruckPlates"> : {{ $detail->truck_plates }}</span>
                                    </td>
                                    <td>{{ $truck->driver_name }}</td>
                                    <td>{{ $truck->driver_mobile }}</td>
                                    <td>{{$truck->arrival_time}}</td>
                                    <td class="lab-btn">
                                        <a href="{{ route('qc-analysis-rpt.index',['test_id'=>$detail->sampleTestHeader->last()->id]) }}" class="btn btn-primary btn-sm" target="_blank">
                                            <i class="fa fa-print"></i> @lang('global.print')
                                        </a>
                                    </td>
                                    @php $i_accepted++; @endphp
                                </tr>
                            @endforeach
                        @empty
                            <td></td>
                        @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
    <hr>
    <h2>@lang('global.rejected')</h2>
    <div id="rejected" class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>@lang('global.transport_#')</th>
                            <th>@lang('global.qc_test_name')</th>
                            <th>@lang('global.truck_plate')</th>
                            <th>@lang('global.driver_name')</th>
                            <th>@lang('global.driver_mobile')</th>
                            <th>@lang('global.arrival_time')</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @php $i_rejected = 1; @endphp

                        @forelse($rejected as $truck)
                            @foreach($truck->rejectedDetails as $detail)
                                <tr>
                                    <td>{{$i_rejected}}</td>
                                    <td>{{$truck->transport_number.'-'.$detail->id}}</td>
                                    <td>{{ $truck->itemGroup->name }}</td>
                                    <td><i class="fa fa-{{ $detail->is_trailer ? 'truck-pickup' : 'truck' }}">
                                        </i> @lang("global.truck_{$detail->plate_name}_#")
                                        <span class="cardTruckPlates"> : {{ $detail->truck_plates }}</span>
                                    </td>
                                    <td>{{ $truck->driver_name }}</td>
                                    <td>{{ $truck->driver_mobile }}</td>
                                    <td>{{$truck->arrival_time}}</td>
                                    <td class="lab-btn">
                                        <a href="{{ route('qc-analysis-rpt.index',['test_id'=>$detail->sampleTestHeader->last()->id]) }}" class="btn btn-primary btn-sm" target="_blank">
                                            <i class="fa fa-print"></i> @lang('global.print')
                                        </a>
                                    </td>
                                    @php $i_rejected++; @endphp
                                </tr>
                            @endforeach
                        @empty
                            <td></td>
                        @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

@endsection

