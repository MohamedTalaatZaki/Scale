<div class="tab-pane fade" id="canceledFull" role="tabpanel" aria-labelledby="canceled-tab_">
    <h6 class="mb-4">@lang('global.canceled_trucks')</h6>
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
        </tr>
        </thead>
        <tbody>
        @forelse($canceled as $truck)
            <tr>
                <td>{{ ( ( $canceled->currentPage() - 1) * $canceled->perPage() ) + $loop->iteration }}</td>
                <td>{{ $truck->transport_number }}</td>
                <td>{{ $truck->driver_name }}</td>
                <td>{{ $truck->supplier->name }}</td>
                <td>{{ $truck->driver_mobile }}</td>
                <td>{{ $truck->truck_plates_tractor }}</td>
                <td>{{ $truck->arrival_time }}</td>
                <td>{{ $truck->arrival_time->diffForHumans() }}</td>
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
            {{ $canceled->appends(request()->query())->links() }}
        </div>
    </div>
</div>
