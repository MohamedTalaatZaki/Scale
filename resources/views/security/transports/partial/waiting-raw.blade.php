<table class="table">
    <thead>
    <tr>
        <th>#</th>
        <th>@lang('global.transport_number')</th>
        <th>@lang('global.driver_name')</th>
        <th>@lang('global.supplier_name')</th>
        <th>@lang('global.mobile')</th>
        <th>@lang('global.truck_tractor_trailer')</th>
        <th>@lang('global.arrival_time')</th>
        <th>@lang('global.waiting_time')</th>
        <th>@lang('global.actions')</th>
    </tr>
    </thead>
    <tbody>
    @forelse($rawTrucks as $truck)
        <tr>
            <td>{{ ( ( $rawTrucks->currentPage() - 1) * $rawTrucks->perPage() ) + $loop->iteration }}</td>
            <td>{{ $truck->transport_number }}</td>
            <td>{{ $truck->driver_name }}</td>
            <td>{{ $truck->supplier->name }}</td>
            <td>{{ $truck->driver_mobile }}</td>
            <td>{{ $truck->truck_plates_tractor }}</td>
            <td>{{ $truck->arrival_time }}</td>
            <td>{{ $truck->arrival_time->diffForHumans() }}</td>
            <td>
                @permission('transports.check_in')
                    <a href="{{ route('transports.inProcess' , ['id' => $truck->id]) }}"
                       class="btn btn-primary btn-sm mb-1">@lang('global.check_in')</a>
                @endpermission
                @permission('transports.cancel')
                <a href="{{ route('transports.cancel' , ['id' => $truck->id]) }}"
                   class="btn btn-primary btn-sm mb-1">@lang('global.cancel')</a>
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

    <div class="row">
        <div class="col-12 list">
            {{ $rawTrucks->appends(request()->query())->links() }}
        </div>
    </div>
</table>
