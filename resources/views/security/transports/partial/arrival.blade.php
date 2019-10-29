<div class="tab-pane fade {{ !request()->has('itemType') ? " active show" : "" }}" id="firstFull" role="tabpanel"
     aria-labelledby="first-tab_">
    <h6 class="mb-4">@lang('global.arrival_trucks')</h6>
    <table class="table">
        <thead>
        <tr>
            <th>#</th>
            <th>@lang('global.transport_number')</th>
            <th>@lang('global.driver_name')</th>
            <th>@lang('global.supplier_name')</th>
            <th>@lang('global.mobile')</th>
            <th>@lang('global.truck_plates_tractor')</th>
            <th>@lang('global.arrival_time')</th>
            <th>@lang('global.waiting_time')</th>
            <th>@lang('global.actions')</th>
        </tr>
        </thead>
        <tbody>
        @forelse($arrivalTrucks as $truck)
            <tr>
                <td>{{ ( ( $arrivalTrucks->currentPage() - 1) * $arrivalTrucks->perPage() ) + $loop->iteration }}</td>
                <td>{{ $truck->transport_number }}</td>
                <td>{{ $truck->driver_name }}</td>
                <td>{{ $truck->supplier->name }}</td>
                <td>{{ $truck->driver_mobile }}</td>
                <td>{{ $truck->truck_plates_tractor }}</td>
                <td>{{ $truck->arrival_time }}</td>
                <td>{{ $truck->arrival_time->diffForHumans() }}</td>
                <td>
                    @permission('transports.edit')
                    @if($truck->status == 'arrived')
                        <a href="{{ route('transports.edit' , ['id' => $truck->id]) }}"
                           class="btn btn-primary btn-sm mb-1">@lang('global.edit')</a>
                    @endif
                    @endpermission
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7"
                    class="text-center text-warning font-weight-bold">@lang('global.no_data')</td>
            </tr>
        @endforelse
        </tbody>
    </table>

    <div class="row">
        <div class="col-12 list">
            {{ $arrivalTrucks->appends(request()->query())->links() }}
        </div>
    </div>
</div>
