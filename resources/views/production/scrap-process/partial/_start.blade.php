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
                            <td>{{ $detail->transport->arrival_time }}</td>
                            <td>
                                @permission('scrapStartProcess')
                                    <button type="button"
                                            data-toggle="modal"
                                            data-target="#startModal"
                                            data-detail-id="{{ $detail->id }}"
                                            data-supplier-id="{{ $detail->transport->supplier_id }}"
                                            data-item-group-id="{{ $detail->transport->item_group_id }}"
                                            class="btn btn-primary btn-sm mb-1">
                                        @lang('global.start')
                                    </button>
                                @endpermission
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

<div class="modal fade " id="startModal" tabindex="-1" role="dialog" aria-labelledby="startModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ route('scrapStartProcess') }}" method="post">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="startModalTitle">@lang('global.start_data')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <input id="detail_id" type="hidden" name="detail_id" value="">
                    <input id="supplier_id" type="hidden" name="supplier_id" value="">

                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="lineSelect">@lang('global.lines') *</label>
                            <select id="lineSelect"
                                    class="form-control select2-single lineSelect"
                                    data-placeholder="@lang('global.select_line')"
                                    name="line_id"
                                    required
                            >
                                <option value='' selected></option>
                                @foreach($lines as $line)
                                    <option value="{{ $line->id }}"> {{ $line->name }} </option>
                                @endforeach
                            </select>
                            @if($errors->has('item_group_id'))
                                <div class="error" style="">{{ $errors->first('item_group_id') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="itemsGroupSelect">@lang('global.item_group') *</label>
                            <select id="itemsGroupSelect"
                                    class="form-control select2-single itemsGroupSelect"
                                    data-placeholder="@lang('global.select_items_group')"
                                    name="item_group_id"
                                    required
                            >
                                <option value='' selected></option>
                            </select>
                            @if($errors->has('item_group_id'))
                                <div class="error" style="">{{ $errors->first('item_group_id') }}</div>
                            @endif
                        </div>
                        <div class="form-group col-md-6">
                            <label for="itemsSelect">@lang('global.items') *</label>
                            <select id="itemsSelect"
                                    class="form-control select2-single itemsSelect"
                                    data-placeholder="@lang('global.select_item')"
                                    name="item_id"
                                    required
                            >
                                <option value='' selected></option>
                            </select>
                            @if($errors->has('item_id'))
                                <div class="error" style="">{{ $errors->first('item_id') }}</div>
                            @endif
                        </div>
                    </div>
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
