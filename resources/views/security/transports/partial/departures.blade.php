<div class="tab-pane fade"  data-active-link-sub="departure" id="fourthFull" role="tabpanel" aria-labelledby="fourth-tab_">
    <h6 class="mb-4">@lang('global.departures_trucks')</h6>
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
            <th>@lang('global.departure_at')</th>
        </tr>
        </thead>
        <tbody>
        @forelse($departures as $truck)
            <tr>
                <td>{{ ( ( $departures->currentPage() - 1) * $departures->perPage() ) + $loop->iteration }}</td>
                <td>{{ $truck->transport_number }}</td>
                <td>{{ $truck->driver_name }}</td>
                <td>{{ $truck->supplier->name }}</td>
                <td>{{ $truck->driver_mobile }}</td>
                <td>{{ $truck->truck_plates_tractor }}</td>
                <td>{{ $truck->arrival_time }}</td>
                <td>{{ optional($truck->departure_time)->diffForHumans() }}</td>
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
            {{ $departures->appends(request()->query())->links() }}
        </div>
    </div>
</div>
