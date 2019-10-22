<div class="tab-pane fade {{ request()->has('itemType') ? " active show" : "" }}" id="secondFull" role="tabpanel" aria-labelledby="second-tab_">
    <div class="row">
        <div class="col-6">
            <h6 class="mb-4">@lang('global.waiting_trucks')</h6>
        </div>
        <div class="col-6 mb-4">
            <div class="btn-group btn-group-toggle float-right">
                <a href="{{ route('transports.index' , ['itemType' => 'raw']) }}"
                   class="btn btn-primary {{ request()->input('itemType') == 'raw' || !request()->has('itemType') ? 'active' : '' }}"  style="color: white">@lang('global.raw')</a>

                <a href="{{ route('transports.index' , ['itemType' => 'scrap']) }}"
                   class="btn btn-primary {{ request()->input('itemType') == 'scrap' ? 'active' : '' }}" style="color: white">@lang('global.scrap')</a>

                <a href="{{ route('transports.index' , ['itemType' => 'finish']) }}"
                   class="btn btn-primary {{ request()->input('itemType') == 'finish' ? 'active' : '' }}" style="color: white">@lang('global.finish')</a>
            </div>
        </div>
    </div>

    @if(request()->input('itemType' , 'raw') == 'raw' )
        @include("security.transports.partial.waiting-raw")
    @endif
    @if(request()->input('itemType') == 'scrap' )
        @include("security.transports.partial.waiting-scrap")
    @endif
    @if(request()->input('itemType') == 'finish' )
        @include('security.transports.partial.waiting-finish')
    @endif

</div>
