<div class="col-md-12 {{ $type }}-card" id="{{$truck->id}}" data-type="{{ $type }}" data-order="{{ $truck->order }}" style="margin-top: 10px">
    <div class="card card-shadow">
        <div class="card-status bg-green"></div>
        <div class="card-body card-custom-padding">
            <div class="row">
                <table class="table card-table">
                    <thead>
                    <tr>
                        <th colspan="2">
                            <h3><i class="fa fa-truck"></i> <b>{{ $truck->truck_plates_tractor }}</b></h3> 
                        </th>
                        <th> {{ optional($truck->itemGroup)->name }} </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td colspan="3"> 
                            <h4><i class="fa fa-address-card"></i> {{ $truck->driver_name }}</h4></td>
                    </tr>
                    <tr>
                        <td colspan="2"> 
                            <h2><i class="fa fa-phone"></i> <b>{{ $truck->driver_mobile }}</b> </h2>
                        </td>
                        <td class="lab-btn" >
                            <h3 class="order-number" style="color: {{ $order == 1 ? "#28a745" : "#FF8E03" }}"># {{ $order }}</h3>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <hr>
</div>
