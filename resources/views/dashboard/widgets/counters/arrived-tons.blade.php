@isset($arrivedCounters)
    @if(request()->input('filter_item_type') == 'raw')
        <a href="#" class="card">
            <div class="card-body text-center">
                <i class="iconsminds-clock"></i>
                <p class="card-text mb-0">@lang('global.arrived')</p>
                <div class="container">
                    <div class="row">
                        <div class="col-xs-6 text-left" style="color: #c0702f">
                            Count : {{ $arrivedCounters->count() }}
                        </div>
                        <div class="col-xs-6 text-right" style="color: #c0702f">
                            Tons : {{ $arrivedCounters->sum('theoretical_weight') / 1000 }}
                        </div>
                    </div>
                </div>
            </div>
        </a>
    @endif
@endisset
