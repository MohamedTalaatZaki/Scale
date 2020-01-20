@isset($acceptedCounters)
    @if(request()->input('filter_item_type') == 'raw')
        <a href="#" class="card" style="cursor: default">
            <div class="card-body text-center">
                <i class="iconsminds-check"></i>
                <p class="card-text mb-0">@lang('global.accepted')</p>
                <div class="container">
                    <div class="row">
                        <div class="col-xs-6 text-left" style="color: #c0702f">
                            Count : {{ $acceptedCounters->count() }}
                        </div>
                        <div class="col-xs-6 text-right" style="color: #c0702f">
                            Tons : {{ $acceptedCounters->sum('theoretical_weight') / 1000 }}
                        </div>
                    </div>
                </div>
            </div>
        </a>
    @endif
@endisset
