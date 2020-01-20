@isset($inProcessCounters)
<a href="#" class="card" style="cursor: default">
    <div class="card-body text-center">
        <i class="iconsminds-loading"></i>
        <p class="card-text mb-0">@lang('global.in_process')</p>
        <div class="container">
            <div class="row">
                <div class="col-xs-6 text-left" style="color: #c0702f">
                    Count : {{ $inProcessCounters->count() }}
                </div>
                <div class="col-xs-6 text-right" style="color: #c0702f">
                    Tons : {{ $inProcessCounters->sum('theoretical_weight') / 1000 }}
                </div>
            </div>
        </div>
    </div>
</a>
@endisset
