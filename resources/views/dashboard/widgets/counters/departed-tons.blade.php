@isset($departureCounters)
<a href="#" class="card">
    <div class="card-body text-center">
        <i class="iconsminds-clock"></i>
        <p class="card-text mb-0">@lang('global.departed')</p>
        <div class="container">
            <div class="row">
                <div class="col-xs-6 text-left" style="color: #c0702f">
                    Count : {{ $departureCounters->count() }}
                </div>
                <div class="col-xs-6 text-right" style="color: #c0702f">
                    Tons : {{ $departureCounters->sum('weight_difference') / 1000 }}
                </div>
            </div>
        </div>
    </div>
</a>
@endisset
