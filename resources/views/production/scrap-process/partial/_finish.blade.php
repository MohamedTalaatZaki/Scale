<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h3 class="text-center">
                    @lang('global.waiting_to_finish')
{{--                    <br/>--}}
{{--                    <h3 class="scale-weight-text-elem text-center"></h3>--}}
                </h3>
                <table class="table">
                    <thead>
                    <tr>
                        <th>@lang('global.transport_number')</th>
                        <th>@lang('global.truck_plate')</th>
                        <th>@lang('global.supplier')</th>
                        <th>@lang('global.driver_name')</th>
                        <th>@lang('global.item_group')</th>
                        <th>@lang('global.first_weight')</th>
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
                            <td>{{ $detail->in_weight }} @lang('global.kg')</td>
                            <td>
                                @if(is_null($detail->out_weight_time))
                                    @permission('scrapFinishProcess')
                                        <a href="#"
                                           data-detail-id="{{ $detail->id }}"
                                           class="btn btn-success btn-sm mb-1 finishBtn">@lang('global.finish')</a>
                                    @endpermission
                                    @permission('scrapTransferLine')
                                        <a href="{{ route('scrapTransferLine' , ['detail_id' => $detail->id]) }}"
                                           class="btn btn-danger btn-sm mb-1">@lang('global.transfer')</a>
                                    @endpermission
                                @elseif($detail->canPrintAfterWeight())
                                    <a href="{{ route('scale-printout-rpt.index',['transport_id'=>$detail->transport_id]) }}" target="_blank" class="btn btn-danger btn-sm mb-1">@lang('global.print')</a>
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
