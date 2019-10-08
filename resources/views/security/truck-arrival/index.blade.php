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
                        <li class="breadcrumb-item " aria-current="page">@lang('global.index')</li>
                    @endisset
                </ol>
            </nav>
            <div class="separator mb-5"></div>
        </div>
    </div>

    @isset($truckArrival)
        @include('security.truck-arrival.partial.edit')
    @else
        @include('security.truck-arrival.partial.create')
    @endisset


    @if(!isset($truckArrival))
        <div class="row search-trucks" style="display: {{ $errors->count() > 0 ? 'none' : 'flex' }}">
            <div class="col-md-12">
                <div class="input-group">
                    <input class="form-control" placeholder="Search...">

                    <span class="input-group-btn">
                        <button class="btn btn-primary default" type="submit">
                            <i class="simple-icon-magnifier"></i>
                        </button>
                    </span>
                </div>
            </div>
        </div>
    @endif
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
                        @include('security.truck-arrival.partial.arrival')
                        @include('security.truck-arrival.partial.waiting')
                        @include('security.truck-arrival.partial.in-process')
                        @include('security.truck-arrival.partial.departures')

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $().ready(function () {

            $('.show-create-div,.reset-close').on('click', function () {
                $('.create-arrival-truck').toggle();
                $('.search-trucks').toggle();
            });

            $('.governorate_select').on('change' , function(evt){
                evt.preventDefault();
                let citySelect  =   $('.citySelect');
                let govId  =   $(this).val();
                $.ajax({
                    method: 'GET',
                    url:    "{{ route('getGovernorateCities') }}",
                    data:   { _token: "{{ csrf_token() }}" , id : govId},
                    success : (response)    =>  {
                        citySelect.empty();
                        let option = "<option value='' selected></option>";
                        citySelect.append(option);
                        $.each(response.cities , function (index , city) {
                            let option = "<option value='"+index+"'>"+ city +"</option>";
                            citySelect.append(option);
                        });
                        reInitSelect2("#citySelect");
                    }
                });

            });

            $('.citySelect').on('change' , function(evt){
                evt.preventDefault();
                let centerSelect  =   $('.centerSelect');
                let govId  =   $(this).val();
                $.ajax({
                    method: 'GET',
                    url:    "{{ route('getCityCenters') }}",
                    data:   { _token: "{{ csrf_token() }}" , id : govId},
                    success : (response)    =>  {
                        centerSelect.empty();
                        let option = "<option value='' selected></option>";
                        centerSelect.append(option);
                        $.each(response.centers , function (index , center) {
                            let option = "<option value='"+index+"'>"+ center +"</option>";
                            centerSelect.append(option);
                        });
                    }
                });
                reInitSelect2("#centerSelect");
            });

            $('.supplierSelect').on('change' , function(evt){
                evt.preventDefault();
                let itemsGroupSelect  =   $('.itemsGroupSelect');
                let supplier  =   $(this).val();
                $.ajax({
                    method: 'GET',
                    url:    "{{ route('getSupplierItemGroups') }}",
                    data:   { _token: "{{ csrf_token() }}" , id : supplier},
                    success : (response)    =>  {
                        itemsGroupSelect.empty();
                        let option = "<option value='' selected></option>";
                        itemsGroupSelect.append(option);
                        $.each(response.itemGroups , function (index , itemGroup) {
                            let option = "<option value='"+index+"'>"+ itemGroup +"</option>";
                            itemsGroupSelect.append(option);
                        });
                    }
                });
                reInitSelect2("#itemTypeSelect");
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
