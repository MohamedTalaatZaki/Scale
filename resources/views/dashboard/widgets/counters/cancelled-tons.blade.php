@isset($canceledCounters)
<a href="#" class="card" style="cursor: default">
    <div class="card-body text-center">
        <i class="iconsminds-trash-with-men"></i>
        <p class="card-text mb-0">@lang('global.cancelled')</p>
        <div class="container">
            <div class="row">
                <div class="col-xs-6 text-left" style="color: #c0702f">
                    Count : {{ $canceledCounters->count() }}
                </div>
                <div class="col-xs-6 text-right" style="color: #c0702f">
                    Tons : {{ $canceledCounters->sum('theoretical_weight') / 1000 }}
                </div>
            </div>
        </div>
    </div>
</a>
@endisset
