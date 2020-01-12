<div class="tab-pane fade" data-active-link-sub="waiting" id="secondFull" role="tabpanel" aria-labelledby="second-tab_">
    <div class="row">
        <div class="col-6">
            <h6 class="mb-4">@lang('global.waiting_trucks')</h6>
        </div>
        <div class="col-6 mb-4">
            <div class="btn-group btn-group-toggle float-right">
                <a href="{{ route('transports.index' , ['raw_page' => '1']) }}"
                   class="btn btn-primary {{ request()->has('raw_page') ? 'active' : '' }}"  style="color: white">
                    @lang('global.raw')
                    <span class="badge badge-success mx-2">{{ $rawTrucks->total() }}</span>
                </a>

                <a href="{{ route('transports.index' , ['scrap_page' => '1']) }}"
                   class="btn btn-primary {{ request()->has('scrap_page') ? 'active' : '' }}" style="color: white">
                    @lang('global.scrap')
                    <span class="badge badge-success mx-2">{{ $scrapTrucks->total() }}</span>
                </a>

                <a href="{{ route('transports.index' , ['finish_page' => '1']) }}"
                   class="btn btn-primary {{ request()->has('finish_page') ? 'active' : '' }}" style="color: white">
                    @lang('global.finish')
                    <span class="badge badge-success mx-2">{{ $finishTrucks->total() }}</span>
                </a>
            </div>
        </div>
    </div>

    @if(request()->has('raw_page'))
        @include("security.transports.partial.waiting-raw")
    @elseif(request()->has('scrap_page') )
        @include("security.transports.partial.waiting-scrap")
    @elseif(request()->has('finish_page') )
        @include('security.transports.partial.waiting-finish')
    @else
        @include("security.transports.partial.waiting-raw")
    @endif

</div>
