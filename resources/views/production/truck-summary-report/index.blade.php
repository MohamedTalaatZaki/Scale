@extends('layout.main')
@section('content')

    <div class="row">
        <div class="col-12">
            <h1>@lang('global.truck_summary_report')</h1>
            <div class="text-zero top-right-button-container">
{{--                @permission('truck_summary.create')--}}
{{--                <a href="{{ route('truck_summary.create') }}">--}}
{{--                    <button type="button"--}}
{{--                            class="btn btn-primary btn-sm top-right-button mr-1">@lang('global.create')</button>--}}
{{--                </a>--}}
{{--                @endpermission--}}
            </div>
            <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                <ol class="breadcrumb pt-0">
                    <li class="breadcrumb-item">
                        <span class="default-cursor">@lang('global.master_data')</span>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('truck-summary-report.index') }}">@lang('global.truck_summary_report')</a>
                    </li>
                </ol>
            </nav>
            <div class="separator mb-5"></div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    @include('components._validation')
                    <form action="{{ route('truck-summary-report.index') }}" method="get">
                        <div class="row">
                        <div class="form-group col-2">
                            <label>Supplier Name</label>
                            <select class="select2-single form-control" name="supplier_id">
                                <option label=""></option>
                                @foreach($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}"
                                        {{ request()->input('supplier_id') == $supplier->id ? "selected" : ""}}
                                    >
                                        {{ $supplier->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-2">
                            <label>From Date</label>
                            <input class="form-control datepicker" value="{{ request()->input('from_date') }}" placeholder="From Date" name="from_date" required>
                        </div>
                        <div class="form-group col-2">
                            <label>To Date</label>
                            <input class="form-control datepicker" value="{{ request()->input('to_date') }}" placeholder="To Date" name="to_date" required>
                        </div>
                        <div class="form-group col-2">
                            <label>Item Name</label>
                            <select class="select2-single form-control" name="item_group_id">
                                <option label=""></option>
                                @foreach($items as $item)
                                    <option value="{{ $item->id }}"
                                        {{ request()->input('item_id') == $item->id ? "selected" : ""}}
                                    > {{ $item->name }} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-3">
                            <button type="submit" class="btn btn-primary mt-4"> <i class="fa fa-search"></i></button>
                            <a href="{{ route('truck-summary-report.index') }}" class="btn btn-danger mt-4"> <i class="fas fa-sync"></i></a>
                            @if($print)
                            <a href="{{ route('truck-summary-rpt.index', $link) }}" target="_blank">
                                <button type="button" class="btn btn-success mt-4"><i class="fas fa-print"></i></button>
                            </a>
                            @endif
                        </div>
                    </div>
                    </form>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>@lang('global.transport_number')</th>
                                <th>@lang('global.supplier_name')</th>
                                <th>@lang('global.truck_plates')</th>
                                <th>@lang('global.item_name')</th>
                                <th>@lang('global.in_weight')</th>
                                <th>@lang('global.out_weight')</th>
                                <th>@lang('global.discount')</th>
                                <th>@lang('global.disc_weight')</th>
                                <th>@lang('global.Net_weight_af_disc')</th>
                                <th>@lang('global.actions')</th>
                            </tr>
                            <tr style="background-color: rgba(0,123,255,0.25)">
                                <th colspan="5">  </th>
                                <th> {{ $total->sum('in_weight') }} </th>
                                <th> {{ $total->sum('out_weight') }} </th>
                                <th> - </th>
                                <th> {{ $total->sum('disc_weight') }} </th>
                                <th> {{ $total->sum('Net_weight_af_disc') }} </th>
                                <th></th>
                            </tr>

                        </thead>
                        <tbody>
                        @forelse($trucks as $truck)
                            {{--{{ dd($truck) }}--}}
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $truck->transport_number }}</td>
                                <td>{{ $truck->supplier_name }}</td>
                                <td>{{ $truck->full_truck_plates }}</td>
                                <td>{{ $truck->item_name }}</td>
                                <td>{{ $truck->in_weight }}</td>
                                <td>{{ $truck->out_weight }}</td>
                                <td>{{ $truck->discount }}</td>
                                <td>{{ number_format( $truck->disc_weight , 3)  }}</td>
                                <td>{{ number_format($truck->Net_weight_af_disc , 3) }}</td>
                                <td>
                                    @if($truck->out_weight > 0)
                                        <a href="{{ route('scale-printout-rpt.index',['transport_id'=>$truck->transport_id]) }}"
                                           class="btn btn-primary btn-sm" target="_blank">@lang('global.print')
                                       </a>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-warning font-weight-bold">@lang('global.no_data')</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>


@endsection