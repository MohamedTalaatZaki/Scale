@extends('layout.main')
@section('content')

    <div class="row">
        <div class="col-12">
            <h1>@lang('global.production_process')</h1>
            <div class="text-zero top-right-button-container">

            </div>
            <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                <ol class="breadcrumb pt-0">
                    <li class="breadcrumb-item">
                        <span class="default-cursor">@lang('global.production')</span>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('production-process.index') }}">@lang('global.production_process')</a>
                    </li>
                </ol>
            </nav>
            <div class="separator mb-5"></div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h3 class="text-center">@lang('global.waiting_to_start')</h3>
                    <table class="table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>@lang('global.governorate_name')</th>
                            <th>@lang('global.city_name')</th>
                            <th>@lang('global.en_name')</th>
                            <th>@lang('global.ar_name')</th>
                            <th>@lang('global.is_active')</th>
                            <th>@lang('global.actions')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($not_started_transport_details as $detail)
                            <tr>
                                <td>{{ $detail->transport->transport_number }}</td>
                                <td>{{ $detail->truck_plates }}</td>
                                <td>{{ $detail->transport->supplier->name }}</td>
                                <td>{{ $detail->transport->driver_name }}</td>
                                <td>{{ $detail->transport->itemGroup->name }}</td>
                                <td>{{ $detail->transport->theoretical_weight }}</td>
                                <td>{{ $detail->transport->arrival_time }}</td>
                                <td>
{{--                                    @permission('centers.edit')--}}
                                    <a href="#"
                                       class="btn btn-primary btn-sm mb-1">@lang('global.start')</a>
{{--                                    @endpermission--}}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-warning font-weight-bold">@lang('global.no_data')</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h3 class="text-center">@lang('global.waiting_to_finish')</h3>
                    <table class="table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>@lang('global.governorate_name')</th>
                            <th>@lang('global.city_name')</th>
                            <th>@lang('global.en_name')</th>
                            <th>@lang('global.ar_name')</th>
                            <th>@lang('global.is_active')</th>
                            <th>@lang('global.actions')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($not_started_transport_details as $detail)
                            <tr>
                                <td>{{ $detail->transport->transport_number }}</td>
                                <td>{{ $detail->truck_plates }}</td>
                                <td>{{ $detail->transport->supplier->name }}</td>
                                <td>{{ $detail->transport->driver_name }}</td>
                                <td>{{ $detail->transport->itemGroup->name }}</td>
                                <td>{{ $detail->transport->theoretical_weight }}</td>
                                <td>{{ $detail->transport->arrival_time }}</td>
                                <td>
                                    {{--                                    @permission('centers.edit')--}}
                                    <a href="#"
                                       class="btn btn-primary btn-sm mb-1">@lang('global.transfer')</a>
                                    <a href="#"
                                       class="btn btn-primary btn-sm mb-1">@lang('global.finish')</a>
                                    {{--                                    @endpermission--}}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-warning font-weight-bold">@lang('global.no_data')</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

@endsection
