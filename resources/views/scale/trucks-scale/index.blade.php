<!DOCTYPE html >
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>@lang('global.juhayna')</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="{{ asset('font/iconsmind-s/css/iconsminds.css') }}"/>
    <link rel="stylesheet" href="{{ asset('font/simple-line-icons/css/simple-line-icons.css') }}"/>

    <link rel="stylesheet" href="{{ asset('css/vendor/bootstrap.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/vendor/bootstrap.rtl.only.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/trucks-scale.css') }}"/>

    <style>
        .rejected {
            padding: 20px;
            background-color: darkred;
            color: white;
            text-align: center;
        }

        .scale-content {
            margin-top: 10px;
            width: 100%;
            height: 245px;
            background-color: black;
        }

        .swal-wide{
            width: 50% !important;
        }
        .swal2-timer-progress-bar {
            background-color: brown !important;
        }
    </style>
</head>
<body>
<div id="vue-temp">
    <div class="vertical-center" v-if="transport">
        <div class="container">
            <div class="trucks-scale transport">
                <div class="trucks-scale__wrp swiper-wrapper">
                    <div class="trucks-scale__item swiper-slide">
                        <div class="trucks-scale__content" style="width: 95%">
                            <div class="row">
                                <table class="table table-bordered table-dark">
                                    <tbody>
                                    <tr class="text-center">
                                        <td colspan="3">@{{ transport.ar_plate_name }}</td>
                                    </tr>
                                    <tr class="text-center">
                                        <td>@lang('global.transport_number')</td>
                                        <td colspan="2">@{{ transport.transport.transport_number }}</td>
                                    </tr>
                                    <tr class="text-center">
                                        <td>@lang('global.driver_name')</td>
                                        <td colspan="2">@{{ transport.transport.driver_name }}</td>
                                    </tr>
                                    <tr class="text-center">
                                        <td>@lang('global.truck_plate')</td>
                                        <td colspan="2">@{{ transport.truck_plates }}</td>
                                    </tr>
                                    <tr class="text-center">
                                        <td>@lang('global.driver_mobile')</td>
                                        <td colspan="2">@{{ transport.transport.driver_mobile }}</td>
                                    </tr>
                                    <tr class="text-center">
                                        <td>@lang('global.status')</td>
                                        <td colspan="2">@{{ transport.readable_status }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row" v-if="transport.status == 'waiting' || transport.status == 'accepted' ">
                                <div class="scale-content" style="overflow: hidden">
                                    <div class="scale-weight-text text-center">
                                        <p class="scale-weight-text-elem" style="color: #0f0 ; font-size: 150px ; direction: ltr">000000 K.g</p>
                                    </div>

                                </div>
                            </div>
                            <div class="row rejected text-center" v-if="transport.status === 'rejected'">
                                <h2 style="margin: 0 auto"> @{{ transport.readable_status }} </h2>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="vertical-center" v-else="transport">

        <div class="container">
            <div class="trucks-scale">
                <div class="trucks-scale__wrp swiper-wrapper">
                    <div class="trucks-scale__item swiper-slide">
                        <div class="trucks-scale__img">

                            <img src="{{ asset("img/barcode.gif") }}" alt="">
                        </div>
                        <div class="trucks-scale__content">
                            <div class="row text-center trucks-scale__title">
                                <h2> برجاء تمرير الورقة لقراءة الكود</h2>
                            </div>

                            <div class="row text-center">
                                <input class="form-control form-control-lg border-danger"
                                       v-model="barcodeStr"
                                       style="text-align: center ; font-weight: bolder"
                                       placeholder="بأنتظار تمرير الورقة لقراءة الكود"
                                       readonly>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/vendor/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('js/vendor/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset("/js/vuejs-d.js") }}"></script>
<script src="{{ asset('js/axios.js') }}"></script>
<script src="{{ asset('js/swal.js') }}"></script>

<script>
    let vue = new Vue({
        el: "#vue-temp",
        data: {
            barcode: [],
            barcodeStr: "",
            scanned: false,
            transport: null,
            websocket: null,
            weightValidAfterCount : 2,
            weight: 0,
            correctWeightCount: 0,
            isCorrect: false,
        },
        methods: {
            keyUpEventFun: function (evt) {
                if (evt.keyCode === 107) {
                    this.test();
                } else {
                    if (!this.scanned && evt.keyCode !== 13) {
                        this.barcode.push(evt.key);
                    } else if (evt.keyCode === 13 && this.barcodeStr === "" && this.transport === null) {
                        this.barcodeStr = this.barcode.join("");
                        this.scanned = true;
                        this.checkBarcode();
                    } else if(this.scanned && this.transport)
                    {
                        this.resetAll();
                    }
                }
            },
            test: function () {
                this.barcodeStr = "1573473184-5";
                this.scanned = true;
                this.checkBarcode();
            },
            checkBarcode: function () {
                swal.close();
                axios.post("{{ route('checkBarcode') }}", {
                    transport_id: this.barcodeStr.split("-")[0],
                    detail_id: this.barcodeStr.split("-")[1],
                }).then((response) => {
                        if (response.data.transport && response.data.transport.weight > 0)
                        {
                            Swal.fire({
                                icon: 'error',
                                title: 'تم وزن الشاحنة مسبقا',
                                text: "الوزنة السابقة لل"+ response.data.transport.ar_plate_name + " كانت " + response.data.transport.weight + " كيلو",
                                timer: 10000,
                                showCancelButton: false,
                                showConfirmButton: false,
                                timerProgressBar: true
                            });
                            this.resetAll();
                        } else if (response.data.transport && response.data.transport.status === "rejected") {

                            Swal.fire({
                                icon: 'error',
                                title: "".concat('تم رفض ال' , response.data.transport.ar_plate_name , ' من المعمل'),
                                timer: 10000,
                                showCancelButton: false,
                                showConfirmButton: false,
                                timerProgressBar: true
                            });
                            this.resetAll();
                        }else {
                            this.transport = response.data.transport;
                        }

                    })
                    .catch((error) => {
                        this.resetAll();
                    })
                    .finally(() => {
                        if(this.transport && this.transport.weight === 0)
                            this.scaleWeight();
                    });
            },
            resetAll: function () {
                this.transport = null;
                this.barcode = [];
                this.barcodeStr = "";
                this.scanned = false;
                this.weight = 0;
                this.correctWeightCount = 0;
                this.isCorrect = false;
            },
            scaleWeight: function () {
                this.wsInit();
            },
            saveScaleWeight : function() {
                axios.post("{{ route("trucks-scale.weight") }}" , {
                    transport_id: this.transport.transport.id,
                    transport_detail_id :   this.transport.id,
                    weight  :   this.weight
                }).then(response => {
                    console.log(response.data , response.data.nextTruck);
                    if(response.data.nextTruck) {
                        Swal.fire({
                            icon: 'success',
                            title: 'تم الوزن بنجاح',
                            text: "".concat('برجاء وضع ال' , response.data.transport.ar_plate_name , ' على الميزان ووضع الكود الخاص بها على القارئ'),
                            timer: 30000,
                            customClass: 'swal-wide',
                            showCancelButton: false,
                            showConfirmButton: false,
                            timerProgressBar: true
                        }).then(()=>{
                            this.resetAll();
                        });
                    }
                })
            },
            wsInit  :   function() {
                this.websocket = new WebSocket("ws://localhost:8500/");
                this.websocket.onopen = (evt) => { this.wsOnOpen(evt) };
                this.websocket.onclose = (evt) => { this.wsOnClose(evt) };
                this.websocket.onmessage = (evt) => { this.wsOnMessage(evt) };
                this.websocket.onerror = (evt) => { this.wsOnError(evt) };
            },
            wsOnOpen : function(evt) {
                $('.scale-weight-text').fadeIn(1000);
            },
            wsOnClose : function(evt) {},
            wsOnMessage : function(evt) {
                let input = $('.scale-weight-text-elem');
                if(this.isNumeric(evt.data) && evt.data > 400 && evt.data === this.weight && this.correctWeightCount < this.weightValidAfterCount) {
                    this.correctWeightCount +=1
                } else if(this.isNumeric(evt.data) && evt.data > 400 && evt.data !== this.weight && this.correctWeightCount < this.weightValidAfterCount)
                {
                    this.weight =    evt.data;
                    this.correctWeightCount = 0;
                    input.css('color' , 'red');
                    input.text(evt.data + " K.g");
                } else if(this.correctWeightCount >= this.weightValidAfterCount) {
                    input.css('color' , '#0f0');
                    input.text(this.weight + " K.g");
                    this.websocket.close();
                    this.saveScaleWeight()
                } else {
                    input.css('color' , 'red');
                    input.text(evt.data + " K.g");
                }
                console.log(evt.data);
            },
            wsOnError : function(evt) {},
            isNumeric : function (number) {
                return !isNaN(parseFloat(number)) && isFinite(number);
            }
        },
        created() {
            window.addEventListener('keyup', this.keyUpEventFun);
        }
    });

</script>
</body>
</html>
