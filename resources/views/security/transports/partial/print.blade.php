<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Print</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="{{ asset('css/vendor/bootstrap.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/vendor/bootstrap.rtl.only.min.css') }}"/>
    <style>
        #print{
            display: none;
        }

        @media print {
            *{
                font-weight: bold;
                background: transparent !important;
                color: #000000 !important;
                box-shadow: none !important;
                text-shadow: none !important;
            }
            .choose-box ,.header{
                display: none !important;
                margin: 0 !important;
                padding: 0 !important;
            }
            #print{
                display: block !important;
                position: relative;
                left: 20px;
                right: 20px;
                width: 9.75cm !important;
            }
            .bcTarget{
                margin: 0 auto;
            }
            @page {
                margin: 0;
                size: 10cm 10cm;
            }
        }
    </style>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body class="hold-transition">

<div id="print">
{{--<div >--}}
    <div class="text-center">
        <img src="{{ asset('img/Picture2.png') }}">
        <br>
    </div>
    @foreach($transport->details as $truck)
        <div class="row">
            <table class="table table-bordered table-condensed" style="direction: rtl">
            <tbody>
            @if($loop->iteration == 1)
                <tr>
                    <td colspan="2">
                        <div class="bcTarget" data-barcode="{{ $transport->transport_number . "-" . $truck->id }}"></div>
                        <div class="row" style="text-align: center ">
                            <span  style="margin: 0 auto ">{{ $transport->transport_number . "-" . $truck->id }}</span>
                        </div>
                    </td>
                </tr>
            @endif
            <tr class="text-center">
                <td colspan="2" class="text-center">**** <b>@lang("global.truck_{$truck->plate_name}")</b> ****</td>
            </tr>
            <tr class="text-center">
                <td>@lang('global.driver_name')</td>
                <th>{{ $transport->driver_name }}</th>
            </tr>
            <tr class="text-center">
                <td>@lang('global.transport_number')</td>
                <th>{{ $transport->transport_number }}</th>
            </tr>
            <tr class="text-center">
                <td>@lang('global.truck_plate')</td>
                <th>{{ $truck->truck_plates }}</th>
            </tr>
            @if(isItemTypeRaw($transport->item_type_id))
                <tr class="text-center">
                    <td>@lang('global.item_group')</td>
                    <th>{{ $transport->itemGroup->name }}</th>
                </tr>
            @endif
            <tr class="text-center">
                <td>@lang('global.supplier')</td>
                <th>{{ $transport->supplier->name }}</th>
            </tr>
            <tr class="text-center">
                <td>@lang('global.arrival_time')</td>
                <th>{{ $transport->arrival_time }}</th>
            </tr>
            @if($loop->iteration == 2)
            <tr>
                <td colspan="2">
                    <div class="bcTarget" data-barcode="{{ $transport->transport_number . "-" . $truck->id }}"></div>
                    <div class="row" style="text-align: center ">
                        <span  style="margin: 0 auto ">{{ $transport->transport_number . "-" . $truck->id }}</span>
                    </div>
                </td>
            </tr>
            @endif
            </tbody>
        </table>
        </div>
        <h4>======================</h4>
    @endforeach

</div>

<script src="{{ asset('js/vendor/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('js/vendor/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('js/jquery-barcode.min.js') }}"></script>
<script>
    $().ready(function () {
        console.log(chrome);
        $(".bcTarget").each(function(index , elem){
            let barcode =   $(elem).data('barcode').toString();
            $(elem).barcode( barcode , "code128" , {barWidth : 2 , output: 'bmp'});
        });
        window.print();
        window.onafterprint  = function () {
            window.close();
        };
    })
</script>
</body>
</html>
