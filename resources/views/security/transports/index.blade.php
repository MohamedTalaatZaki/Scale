@extends('layout.main')
@section('content')
    <div class="row">
        <div class="col-12">
            <h1>@lang('global.truck_arrival')</h1>
            <div class="text-zero top-right-button-container">
                @if(!isset($truckArrival))
                    {{--                @permission('truck_arrival.create')--}}
                    <a href="javascript:void(0)" class="show-create-div">
                        <button type="button"
                                class="btn btn-primary btn-sm top-right-button mr-1">@lang('global.create')</button>
                    </a>
                    {{--                @endpermission--}}
                @endif
            </div>
            <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                <ol class="breadcrumb pt-0">
                    <li class="breadcrumb-item">
                        <span class="default-cursor">@lang('global.master_data')</span>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="javascript:void(0)" class="show-create-div">@lang('global.truck_arrival')</a>
                    </li>
                    @isset($truckArrival)
                        <li class="breadcrumb-item " aria-current="page">@lang('global.edit')</li>
                    @else
                        <li class="breadcrumb-item " aria-current="page">@lang('global.index') -- <b> @lang('global.trucks_help' , ['phone' => env('SUPPORT_NUMBER')]) </b></li>
                    @endisset
                </ol>
            </nav>
            <div class="separator mb-5"></div>
        </div>
    </div>

    @isset($truckArrival)
        @include('security.transports.partial.edit')
    @else
        @include('security.transports.partial.create')
    @endisset

{{--    @if(!isset($truckArrival))--}}
{{--        <div class="row search-trucks" style="display: {{ $errors->count() > 0 ? 'none' : 'flex' }}">--}}
{{--            <div class="col-md-12">--}}
{{--                <div class="input-group">--}}
{{--                    <input class="form-control" placeholder="Search...">--}}

{{--                    <span class="input-group-btn">--}}
{{--                        <button class="btn btn-primary default" type="submit">--}}
{{--                            <i class="simple-icon-magnifier"></i>--}}
{{--                        </button>--}}
{{--                    </span>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    @endif--}}
    <hr/>

    <div class="row">
        <div class="col-md-12 col-lg-12 col-12 mb-6">
            <div class="card">
                <div class="card-header pl-0 pr-0">
                    <ul class="nav nav-tabs card-header-tabs  ml-0 mr-0" role="tablist">
                        <li class="nav-item w-25 text-center">
                            <a class="nav-link {{ !request()->has('itemType') ? " active" : "" }}" id="first-tab_" data-toggle="tab" href="#firstFull" role="tab"
                               aria-controls="first" aria-selected="true">
                                @lang('global.arrival_trucks')
                            </a>
                        </li>
                        <li class="nav-item w-25 text-center">
                            <a class="nav-link {{ request()->has('itemType') ? " active" : "" }}" id="second-tab_" data-toggle="tab" href="#secondFull" role="tab"
                               aria-controls="second" aria-selected="false">
                                @lang('global.waiting_trucks')
                            </a>
                        </li>
                        <li class="nav-item w-25 text-center">
                            <a class="nav-link" id="third-tab_" data-toggle="tab" href="#thirdFull" role="tab"
                               aria-controls="third" aria-selected="false">
                                @lang('global.in_process_trucks')
                            </a>
                        </li>
                        <li class="nav-item w-25 text-center">
                            <a class="nav-link" id="fourth-tab_" data-toggle="tab" href="#fourthFull" role="tab"
                               aria-controls="fourth" aria-selected="false">
                                @lang('global.departures_trucks')
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        @include('security.transports.partial.arrival')
                        @include('security.transports.partial.waiting')
                        @include('security.transports.partial.in-process')
                        @include('security.transports.partial.departures')

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $().ready(function () {

            let errors = "{{ $errors->count() }}";

            if(errors > 0) {
                govChange("{{ old('governorate_id') }}" , "{{ old('city_id') }}");
                supplierChange("{{ old('supplier_id') }}" , "{{ old('item_group_id') }}")
            }

            $('.show-create-div,.reset-close').on('click', function () {
                $('.create-arrival-truck').toggle();
                $('.search-trucks').toggle();
            });

            $('.governorate_select').on('change' , function(evt){
                evt.preventDefault();
                govChange($(this).val());
            });

            $('.citySelect').on('change' , function(evt){
                evt.preventDefault();
                cityChange($(this).val());
            });

            $('.supplierSelect').on('change' , function(evt){
                evt.preventDefault();
                supplierChange($(this).val());
            });

            $('#itemTypeSelect').on('change' , function (evt) {
                evt.preventDefault();
                let itemType    =   $(this).find('option:selected').data('prefix');
                if (itemType === 'raw') {
                    $('.itemTypeExtra').show();
                    $('.itemsGroupSelect').prop('required' , true);
                    $('.theoreticalWeight').prop('required' , true);
                } else {
                    $('.itemTypeExtra').hide();
                    $('.itemsGroupSelect').prop('required' , false);
                    $('.theoreticalWeight').prop('required' , false);
                }
            });

            function govChange(govId , cityId = 0) {
                let citySelect  =   $('.citySelect');
                $.ajax({
                    method: 'GET',
                    url:    "{{ route('getGovernorateCities') }}",
                    data:   { _token: "{{ csrf_token() }}" , id : govId},
                    success : (response)    =>  {
                        citySelect.empty();
                        let option = "<option value='' selected></option>";
                        citySelect.append(option);
                        $.each(response.cities , function (index , city) {
                            let option = "<option value='"+index+"' " + ( cityId == index ? 'selected' : '') +">"+ city +"</option>";
                            citySelect.append(option);
                        });
                        reInitSelect2("#citySelect");
                        if(cityId > 0) {
                            cityChange(cityId , "{{ old('center_id' , 0) }}")
                        }
                    }
                });
            }

            function cityChange(cityId , centerId = 0) {
                let centerSelect  =   $('.centerSelect');
                $.ajax({
                    method: 'GET',
                    url:    "{{ route('getCityCenters') }}",
                    data:   { _token: "{{ csrf_token() }}" , id : cityId},
                    success : (response)    =>  {
                        centerSelect.empty();
                        let option = "<option value='' selected></option>";
                        centerSelect.append(option);
                        $.each(response.centers , function (index , center) {
                            let option = "<option value='"+index+"' "+ (centerId == index ? 'selected' : '') +">"+ center +"</option>";
                            centerSelect.append(option);
                        });
                    }
                });
                reInitSelect2("#centerSelect");
            }

            function supplierChange(supplier , itemId = 0) {
                let itemsGroupSelect  =   $('.itemsGroupSelect');
                $.ajax({
                    method: 'GET',
                    url:    "{{ route('getSupplierItemGroups') }}",
                    data:   { _token: "{{ csrf_token() }}" , id : supplier},
                    success : (response)    =>  {
                        itemsGroupSelect.empty();
                        let option = "<option value='' selected></option>";
                        itemsGroupSelect.append(option);
                        $.each(response.itemGroups , function (index , itemGroup) {
                            let option = "<option value='"+index+"' "+ (itemId == index ? 'selected' : '')+">"+ itemGroup +"</option>";
                            itemsGroupSelect.append(option);
                        });
                        reInitSelect2("#itemsGroupSelect");
                    }
                });
            }

            function reInitSelect2(selector) {
                $(selector).select2('destroy');
                $(selector).select2({
                    theme: "bootstrap",
                    maximumSelectionSize: 6,
                    containerCssClass: ":all:"
                });
            }

        });
    </script>
@endpush
