@foreach($truck->sampledDetails as $detail)
<div class="col-md-12" id="{{$detail->id}}" style="margin-top: 10px">
    <div class="card card-shadow">
        <div class="card-status bg-yellow"></div>
        <div class="card-body card-custom-padding">
            <div class="row">
                <table class="table card-table">
                    <thead>
                    <tr>
                        <th colspan="2"><i class="fa fa-{{ $detail->is_trailer ? 'truck-pickup' : 'truck' }}"></i> @lang("global.truck_{$detail->plate_name}_#")
                            {{ $detail->truck_plates }} </th>
                        <th> {{ $truck->itemGroup->name }} </th>

                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td colspan="3"><i class="fa fa-address-card"></i> {{ $truck->driver_name }}</td>
                    </tr>

                    <tr>
                        <td colspan="2"><i class="fa fa-phone"></i> {{ $truck->driver_mobile }}</td>
                        <td class="lab-btn">
                            <a href="{{ route('samples-test.create' , ['transport_detail_id' => $detail->id]) }}" class="btn btn-warning btn-xs"><i class="fa fa-vials"></i></a>
                        </td>

                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
    <hr>
</div>
@endforeach
