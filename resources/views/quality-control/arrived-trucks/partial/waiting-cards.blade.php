@for($i = 1 ; $i <= $truck->card_loop_count ; $i++)
    @php
        $plateName  =   $i == 1 ? 'tractor' : 'trailer';
    @endphp
    <div class="col-md-12" id="{{$truck->id}}" style="margin-top: 10px">
        <div class="card card-shadow">
            <div class="card-status bg-blue"></div>
            <div class="card-body card-custom-padding">
                <div class="row">
                    <table class="table card-table">
                        <thead>
                            <tr>
                                <th colspan="2"><i class="fa fa-{{ $i == 1 ? 'truck' : 'truck-pickup' }}"></i> @lang("global.truck_{$plateName}_#")
                                    {{ $i == 1  ? $truck->truck_plates_tractor : $truck->truck_plates_trailer }} </th>
                                <th> {{ $truck->itemGroup->name }} </th>

                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="3"><i class="fa fa-address-card"></i> {{ $truck->driver_name }}</td>
                            </tr>

                            <tr>
                                <td colspan="2"><i class="fa fa-phone"></i> {{ $truck->driver_mobile }}</td>
                                <td class="lab-btn" style="display: none">
                                    <a href="#" class="btn btn-warning btn-xs"><i class="fa fa-vials"></i></a>
                                </td>

                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <hr>
    </div>
@endfor
