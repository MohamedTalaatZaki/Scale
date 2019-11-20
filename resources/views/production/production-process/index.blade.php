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
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="text-center">@lang('global.waiting_to_start')</h3>
                    <table class="table">
                        <thead>
                        <tr>
                            <th>@lang('global.transport_number')</th>
                            <th>@lang('global.truck_plate')</th>
                            <th>@lang('global.supplier')</th>
                            <th>@lang('global.driver_name')</th>
                            <th>@lang('global.item_group')</th>
                            <th>@lang('global.theoretical_weight')</th>
                            <th>@lang('global.arrival_time')</th>
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
                                    <button type="button"
                                            data-toggle="modal"
                                            data-target="#startModal"
                                            class="btn btn-primary btn-sm mb-1">
                                        @lang('global.start')
                                    </button>
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
    <hr>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="text-center">@lang('global.waiting_to_finish')</h3>
                    <table class="table">
                        <thead>
                        <tr>
                            <th>@lang('global.transport_number')</th>
                            <th>@lang('global.truck_plate')</th>
                            <th>@lang('global.supplier')</th>
                            <th>@lang('global.driver_name')</th>
                            <th>@lang('global.item_group')</th>
                            <th>@lang('global.theoretical_weight')</th>
                            <th>@lang('global.arrival_time')</th>
                            <th>@lang('global.actions')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($started_transport_details as $detail)
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

    <div class="modal fade " id="startModal" tabindex="-1" role="dialog" aria-labelledby="startModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <h5 class="modal-title" id="startModalTitle">@lang('global.start_data')</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <hr>
                        <div class="row btn-group-sm float-right mb-2">
                            <button type="button" class="btn btn-secondary mr-1" data-dismiss="modal">@lang('global.close')</button>
                            <button type="submit" class="btn btn-primary">@lang('global.save')</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
