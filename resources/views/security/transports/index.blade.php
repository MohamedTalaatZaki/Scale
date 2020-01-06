@extends('layout.main')
@section('content')
    <div class="row">
        <div class="col-12">
            <h1>@lang('global.truck_arrival')</h1>
            <div class="text-zero top-right-button-container">
                @if(!isset($truckArrival))
                    @permission('transports.create')
                        <a href="javascript:void(0)" class="show-create-div">
                            <button type="button"
                                    class="btn btn-primary btn-sm top-right-button mr-1">@lang('global.create')</button>
                        </a>
                    @endpermission
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
                        <li class="nav-item w-20 text-center">
                            <a class="nav-link" data-active-link="arrival" id="first-tab_" data-toggle="tab" href="#firstFull" role="tab"
                               aria-controls="first" aria-selected="true">
                                @lang('global.arrival_trucks')
                                <span class="badge badge-success mx-2">{{ $arrivalTrucks->total() }}</span>
                            </a>
                        </li>
                        <li class="nav-item w-15 text-center">
                            <a class="nav-link" data-active-link="waiting"
                               id="second-tab_" data-toggle="tab" href="#secondFull" role="tab" aria-controls="second" aria-selected="false">
                                @lang('global.waiting_trucks')
                                <span class="badge badge-success mx-2">{{ $rawTrucks->total() + $scrapTrucks->total() + $finishTrucks->total() }}</span>
                            </a>
                        </li>
                        <li class="nav-item w-15 text-center">
                            <a class="nav-link" data-active-link="in_process" id="third-tab_" data-toggle="tab" data-item-type="in_process" href="#thirdFull" role="tab"
                               aria-controls="third" aria-selected="false">
                                @lang('global.in_process_trucks')
                                <span class="badge badge-success mx-2">{{ $inProcessTrucks->total() }}</span>
                            </a>
                        </li>
                        <li class="nav-item w-15 text-center">
                            <a class="nav-link" data-active-link="departures" id="fourth-tab_" data-toggle="tab" href="#fourthFull" role="tab"
                               aria-controls="fourth" aria-selected="false">
                                @lang('global.departures_trucks')
                                <span class="badge badge-success mx-2">{{ $departures->total() }}</span>
                            </a>
                        </li>
                        <li class="nav-item w-15 text-center">
                            <a class="nav-link" data-active-link="canceled" id="canceled-tab_" data-toggle="tab" href="#canceledFull" role="tab"
                               aria-controls="fourth" aria-selected="false">
                                @lang('global.canceled_trucks')
                                <span class="badge badge-success mx-2">{{ $canceled->total() }}</span>
                            </a>
                        </li>

                        <li class="nav-item w-15 text-center">
                            <a class="nav-link" data-active-link="rejected" id="rejected-tab_" data-toggle="tab" href="#rejectedFull" role="tab"
                               aria-controls="fourth" aria-selected="false">
                                @lang('global.rejected_trucks')
                                <span class="badge badge-success mx-2">{{ $rejected->total() }}</span>
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
                        @include('security.transports.partial.canceled')
                        @include('security.transports.partial.rejected')

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="driverBlockedModal" tabindex="-1" role="dialog" aria-labelledby="driverBlockedModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row bg-danger" >
                        <h1 style="color: white; padding: 5px ; margin: 0 auto">@lang('global.alert')</h1>
                    </div>
                    <hr/>
                    <div class="row text-center">
                        <h4 style=" margin: 0 auto">@lang('global.blocked_driver')</h4>
                    </div>
                    <div class="row text-center">
                        <h5 style=" top : 10px ; padding-top: 10px ;margin: 0 auto" class="blockReason"></h5>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('global.close')</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="cancelModal" tabindex="-1" role="dialog" aria-labelledby="cancelModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cancelModalLabel">@lang('global.cancel')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="post" id="cancelForm">
                    @csrf
                    <div class="modal-body">
                        <div class="row form-group">
                            <input type="hidden" name="transport_id" id="cancelTransportId">
                            <div class="col-md-12">
                                <label class="col-12 col-form-label">@lang('global.if_want_block_driver')</label>
                                <div class="col-12">
                                    <div class="custom-switch custom-switch-primary-inverse mb-2" style="padding-left: 0">
                                        <input class="custom-switch-input" id="block_driver" type="checkbox" value="1" name="block_driver">
                                        <label class="custom-switch-btn" for="block_driver"></label>
                                        <hr/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 blockDiv"  style="display: none">
                                <label>@lang('global.select_reason')</label>
                                <select class="form-control select2-single reasonId" name="reason_id" data-placeholder="@lang('global.select_reason')">
                                    <option value="" selected></option>
                                    @foreach($reasons as $reason)
                                        <option value="{{ $reason->id }}"> {{ $reason->name }} </option>
                                    @endforeach
                                </select>
                                <hr/>
                            </div>
                            <div class="col-md-12 blockDiv" style="display: none">
                                <label>@lang('global.note')</label>
                                <textarea class="form-control reasonNote" name="note" cols="12" rows="6"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">@lang('global.save')</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('global.close')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection
@push('scripts')
    <script src="{{ asset('js/axios.js') }}"></script>
    <script src="{{ asset('js/swal.js') }}"></script>
    <script>
        $().ready(function () {

            let activeLink  =  localStorage.getItem('active_tab');
            $('.nav-link[data-active-link="'+activeLink+'"]').addClass('active');
            $('[data-active-link-sub="'+activeLink+'"]').addClass('active show');

            if ("{{ Session::has('print') }}" == 1) {
             let transportId    =   "{{ Session::get('print') }}";
                var win = window.open('{{ route('printLabels') }}?id='+transportId, '_blank');
                if (win) {
                    win.focus();
                } else {
                    alert('Please allow popups for this website');
                }
            }
            let errors = "{{ $errors->count() }}";

            if(errors > 0) {
                govChange("{{ old('governorate_id') }}" , "{{ old('city_id') }}");
                supplierChange("{{ old('supplier_id') }}" , "{{ old('item_group_id') }}")
            }

            $('.show-create-div,.reset-close').on('click', function () {
                $('.create-arrival-truck').toggle();
                $('.submit-btn').show();
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

            $('.driver_national_id').on('keyup' , function (evt) {
                let nationalId  =   $(this).val();
                axios.post('{{ route('checkIfBlocked') }}' , { 'national_id' : nationalId })
                    .then( function (response) {
                        if(response.data) {
                            $('.submit-btn').hide();
                            $('.blockReason').text(response.data.block_reason);
                            $('#driverBlockedModal').modal('show');
                        } else {
                            $('.submit-btn').show();
                            $('.blockReason').text('');
                            $('#driverBlockedModal').modal('hide');
                        }
                    })
            });

            $('#cancelModal').on('show.bs.modal', function (event) {
                let id  =   $(event.relatedTarget).data('transport-id');
                let route   =   $(event.relatedTarget).data('route');
                let label   =   $(event.relatedTarget).data('label');
                $('#cancelModalLabel').text(label);
                $('#cancelTransportId').val(id);
                $('#cancelForm').prop('action' , route);
            });

            $('#block_driver').on('change' , function () {
                if ($(this).is(':checked')){
                    $('.reasonId').attr('required' , true);
                    $('.reasonId').val('');
                    $('.reasonNote').val('');
                    $('.blockDiv').show();
                } else {
                    $('.reasonId').attr('required' , false);
                    $('.blockDiv').hide();
                }
            });

            $('.nav-link').on('click' , function(evt) {
                let activeLink    =   $(this).data('active-link');
                localStorage.setItem('active_tab' , activeLink);
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
