@isset($rejectedCounters)
    @if(request()->input('filter_item_type') == 'raw')
        <a href="#" class="card" style="cursor: default">
            <div class="card-body text-center">
                <i class="iconsminds-close"></i>
                <p class="card-text mb-0">@lang('global.rejected')</p>
                <div class="container">
                    <div class="row">
                        <div class="col-xs-6 text-left" style="color: #c0702f">
                            Count : {{ $rejectedCounters->count() }}
                        </div>
                        <div class="col-xs-6 text-right" style="color: #c0702f">
                            Tons : {{ $rejectedCounters->sum('theoretical_weight') / 1000 }}
                        </div>
                    </div>
                </div>
            </div>
        </a>
    @endif
@endisset
