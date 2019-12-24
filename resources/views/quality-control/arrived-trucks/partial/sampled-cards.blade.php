@foreach($truck->sampledDetails as $detail)
<div class="col-md-12 sampledCardHeader" id="{{$detail->id}}" style="margin-top: 10px">
    <div class="card card-shadow">
        <div class="card-status bg-yellow"></div>
        <div class="card-body card-custom-padding">
            <div class="row">
                <table class="table card-table">
                    <thead>
                    <tr>
                        <th colspan="2"><i class="fa fa-{{ $detail->is_trailer ? 'truck-pickup' : 'truck' }}"></i> @lang("global.truck_{$detail->plate_name}_#")
                            <span class="cardTruckPlates">{{ $detail->truck_plates }}</span> </th>
                        <th> <span class="cardItemGroup">{{ $truck->itemGroup->name }}</span> </th>

                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td colspan="3"><i class="fa fa-address-card"></i> <span class="cardDriverName">{{ $truck->driver_name }}</span> </td>
                    </tr>

                    <tr>
                        <td colspan="2"><i class="fa fa-phone"></i> <span class="cardDriverMobile">{{ $truck->driver_mobile }}</span> </td>
                        <td class="lab-btn">
                            <a href="{{ route('samples-test.create' , ['transport_detail_id' => $detail->id]) }}" class="btn btn-warning btn-xs"><i class="fa fa-vials"></i></a>
                            <a href="{{route('qc-label-rpt.index', ['transport_detail_id' => $detail->id])}}" class="btn btn-primary btn-xs"><i class="fa fa-print"></i></a>
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
