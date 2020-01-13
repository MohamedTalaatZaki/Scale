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
                        <tr id="detail_{{ $detail->id }}">
                            <td>{{ $detail->transport->transport_number }}</td>
                            <td>{{ $detail->truck_plates }}</td>
                            <td>{{ $detail->transport->supplier->name }}</td>
                            <td>{{ $detail->transport->driver_name }}</td>
                            <td>{{ $detail->itemGroup->name }}</td>
                            <td>{{ $detail->transport->theoretical_weight }}</td>
                            <td>{{ $detail->transport->arrival_time }}</td>
                            <td>
                                @if(is_null($detail->out_weight_time))
                                    @permission('finishProcess')
                                        <a href="#"
                                           data-detail-id="{{ $detail->id }}"
                                           class="btn btn-success btn-sm mb-1 finishBtn">@lang('global.finish')</a>
                                    @endpermission
                                    @permission('transferLine')
                                        <a href="{{ route('transferLine' , ['detail_id' => $detail->id]) }}"
                                           class="btn btn-danger btn-sm mb-1">@lang('global.transfer')</a>
                                    @endpermission
                                @else
                                    <a href="{{ route('scale-printout-rpt.index',['transport_id'=>$detail->transport_id]) }}"  target="_blank" class="btn btn-danger btn-sm mb-1">@lang('global.print')</a>
                                @endif
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
