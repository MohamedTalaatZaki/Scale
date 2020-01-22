<div id="scaleView">
    <div id="scaleViewHeader">
        <i class="far fa-hand-paper" style="float: right"></i>
        <div class="text-center scale-weight-text-elem"></div>
    </div>

</div>

@push('styles')
    <style>
        @font-face {
            font-family: DS-DIGI;
            src: url("{{ asset('font/digitalFont/DS-DIGI.TTF') }}");
        }
        #scaleView {
            @if(app()->getLocale() == 'en')
                right: 4%;
            @else
                left: 4%;
            @endif
            position: absolute;
            z-index: 999999;
            background-color: #232323;
            border: 3px solid #7e7a7c;
            text-align: center;
            width: 300px;
            height: 80px;
        }

        #scaleViewHeader {
            padding: 10px;
            cursor: move;
            z-index: 10;
            background-color: #232323;
            color: #fff;
        }
        .scale-weight-text-elem{
            font-family: DS-DIGI;
            font-size: 35px;
            font-weight: bold;
            color: greenyellow;
            letter-spacing: 10px;
        }
    </style>
@endpush

@push('scripts')
    <script src="{{ asset('js/scaleView.js') }}"></script>
    <script>
        $().ready(function() {
            dragElement(document.getElementById("scaleView"));
            wsInit("{{ env('SCALE_AGENT_IP' , 'ws://127.0.0.1:8500/') }}");
        });
    </script>
@endpush
