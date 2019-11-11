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

        canvas {
            display: block;
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
                                    <canvas id="matrix">
                                    </canvas>
                                    <div class="scale-weight-text text-center">
                                        <p style="color: #0f0 ; font-size: 150px ; direction: ltr">000000.00 K.g</p>
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

<script>
    let vue = new Vue({
        el: "#vue-temp",
        data: {
            barcode: [],
            barcodeStr: "",
            scanned: false,
            transport: null,
            timeOut: null,
            timeOutOne: null,
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
                console.log(this.scanned , evt.keyCode , this.barcode , this.barcodeStr , this.transport);
            },
            test: function () {
                this.barcodeStr = "1573473184-5";
                this.scanned = true;
                this.checkBarcode();
            },
            checkBarcode: function () {
                axios.post("{{ route('checkBarcode') }}", {
                    transport_id: this.barcodeStr.split("-")[0],
                    detail_id: this.barcodeStr.split("-")[1],
                })
                    .then((response) => {
                        this.transport = response.data.transport;
                        if (this.transport.status !== "rejected") {
                            this.matrix();
                        }
                    })
                    .catch((error) => {
                        this.resetAll();
                        console.log(error);
                    })
                    .finally(() => {
                        this.scaleWeight();
                    });
            },
            resetAll: function () {
                this.transport = null;
                this.barcode = [];
                this.barcodeStr = "";
                this.scanned = false;
                clearTimeout(this.timeOut);
                clearTimeout(this.timeOutOne);
            },
            matrix: function () {
                var canvas = document.getElementById('matrix'),
                    ctx = canvas.getContext('2d');

                canvas.width = window.innerWidth;
                canvas.height = window.innerHeight;

                var letters = 'ABCDEFGHIJKLMNOPQRSTUVXYZABCDEFGHIJKLMNOPQRSTUVXYZABCDEFGHIJKLMNOPQRSTUVXYZABCDEFGHIJKLMNOPQRSTUVXYZABCDEFGHIJKLMNOPQRSTUVXYZABCDEFGHIJKLMNOPQRSTUVXYZ';
                letters = letters.split('');

                var fontSize = 10,
                    columns = canvas.width / fontSize;

                var drops = [];
                for (var i = 0; i < columns; i++) {
                    drops[i] = 1;
                }

                function draw() {
                    ctx.fillStyle = 'rgba(0, 0, 0, .1)';
                    ctx.fillRect(0, 0, canvas.width, canvas.height);
                    for (var i = 0; i < drops.length; i++) {
                        var text = letters[Math.floor(Math.random() * letters.length)];
                        ctx.fillStyle = '#0f0';
                        ctx.fillText(text, i * fontSize, drops[i] * fontSize);
                        drops[i]++;
                        if (drops[i] * fontSize > canvas.height && Math.random() > .95) {
                            drops[i] = 0;
                        }
                    }
                }

                setInterval(draw, 33);

            },
            scaleWeight: function () {
                this.timeOut = setTimeout(function () {
                    $('#matrix').fadeOut(1000);
                    $('.scale-weight-text').fadeIn(1000);
                }, 4000);
                this.timeOutOne =   setTimeout(() => {
                    this.resetAll();
                }, 15000);

            }

        },
        created() {
            window.addEventListener('keyup', this.keyUpEventFun);
        }
    });

</script>
</body>
</html>
