@extends('layout.main')
@section('content')
    <div class="row">
        <div class="col-12">
            <h1>@lang('global.truck_arrival')</h1>
            <div class="text-zero top-right-button-container">
                {{--                @permission('truck_arrival.create')--}}
                <a href="javascript:void(0)" class="show-create-div">
                    <button type="button"
                            class="btn btn-primary btn-sm top-right-button mr-1">@lang('global.create')</button>
                </a>
                {{--                @endpermission--}}
            </div>
            <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                <ol class="breadcrumb pt-0">
                    <li class="breadcrumb-item">
                        <span class="default-cursor">@lang('global.master_data')</span>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="javascript:void(0)" class="show-create-div">@lang('global.truck_arrival')</a>
                    </li>
                    <li class="breadcrumb-item " aria-current="page">@lang('global.index')</li>
                </ol>
            </nav>
            <div class="separator mb-5"></div>
        </div>
    </div>
    <form action="{{ route('trucks-arrival.store') }}" method="post">
        @csrf
        <div style="display: {{ $errors->count() > 0 ? 'flex' : 'none' }}" class="row create-arrival-truck">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h6>@lang('global.driver_information')</h6>
                        <hr>
                        <div class="form-group col-md-12">
                            <label for="driver_name">@lang('global.driver_name')</label>
                            <input type="text"
                                   class="form-control"
                                   id="driver_name"
                                   placeholder="@lang('global.driver_name')"
                                   name="driver_name"
                                   value="{{ old('driver_name') }}"
                                   autocomplete="off"
                                   required>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="driver_license">@lang('global.driver_license')</label>
                            <input type="text"
                                   class="form-control"
                                   id="driver_license"
                                   placeholder="@lang('global.driver_license')"
                                   value="{{ old('driver_license') }}"
                                   name="driver_license"
                                   autocomplete="off"
                                   required>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="driver_national_id">@lang('global.driver_national_id')</label>
                            <input type="text"
                                   class="form-control"
                                   id="driver_national_id"
                                   placeholder="@lang('global.driver_national_id')"
                                   value="{{ old('driver_national_id') }}"
                                   name="driver_national_id"
                                   autocomplete="off"
                                   required>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="driver_mobile">@lang('global.driver_mobile')</label>
                            <input type="text"
                                   class="form-control"
                                   id="driver_mobile"
                                   placeholder="@lang('global.driver_mobile')"
                                   name="driver_mobile"
                                   min="0"
                                   minlength="11"
                                   maxlength="11"
                                   value="{{ old('driver_mobile') }}"
                                   autocomplete="off"
                                   required>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h6>@lang('global.supplier_information')</h6>
                        <hr>
                        <div class="form-group col-md-12">
                            <label for="supplier_name">@lang('global.supplier_name')</label>
                            <select id="supplier_name" class="form-control select2-single" name="supplier_id" required>
                                <option label="&nbsp;"> @lang('global.select_supplier')</option>
                                @foreach($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}" {{ old('supplier_id') == $supplier->id ? "selected" : '' }}>
                                        {{ $supplier->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="governorate">@lang('global.governorate')</label>
                            <select id="governorate_select" class="form-control select2-single" data-placeholder="@lang('global.select_governorate')" name="governorate_id" required>
                                @foreach($governorates as $governorate)
                                    <option value="{{ $governorate->id }}" {{ old('governorate_id') == $governorate->id ? "selected" : '' }}>
                                        {{ $governorate->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="city">@lang('global.city')</label>
                            <select id="citySelect" class="form-control select2-single" data-placeholder="@lang('global.select_city')" name="city_id" required>
                            </select>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="center">@lang('global.center')</label>
                            <select id="centerSelect" class="form-control select2-single" data-placeholder="@lang('global.select_center')" name="center_id">
                                <option value="" label="&nbsp;"> @lang('global.select_center')</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h6>@lang('global.truck_information')</h6>
                        <hr>
                        <div class="form-group col-md-12">
                            <label for="truck_type">@lang('global.truck_type')</label>
                            <select id="truck_type" class="form-control select2-single" name="truck_type_id" required>
                                <option label="&nbsp;"> @lang('global.select_truck_type')</option>
                                @foreach($truck_types as $truck_type)
                                    <option value="{{ $truck_type->id }}" {{ old('truck_type_id') == $truck_type->id ? "selected" : '' }}>
                                        {{ $truck_type->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="truck_plates_tractor">@lang('global.truck_plates_tractor')</label>
                            <input type="text"
                                   class="form-control"
                                   id="truck_plates_tractor"
                                   placeholder="@lang('global.truck_plates_tractor')"
                                   name="truck_plates_tractor"
                                   value="{{ old('truck_plates_tractor') }}"
                                   autocomplete="off"
                                   required>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="truck_plates_trailer">@lang('global.truck_plates_trailer')</label>
                            <input type="text"
                                   class="form-control"
                                   id="truck_plates_trailer"
                                   placeholder="@lang('global.truck_plates_trailer')"
                                   value="{{ old('truck_plates_trailer') }}"
                                   name="truck_plates_trailer"
                                   autocomplete="off"
                            >
                        </div>
                        <div class="form-group col-md-12">
                            <label for="itemTypeSelect">@lang('global.item_type')</label>
                            <select id="itemTypeSelect" class="form-control select2-single" name="item_type_id" required>
                                <option label="&nbsp;"> @lang('global.select_item_type')</option>
                                @foreach($item_types as $item_type)
                                    <option value="{{ $item_type->id }}"
                                            data-prefix="{{$item_type->prefix}}"
                                        {{ old('item_type_id') == $item_type->id ? "selected" : '' }}>
                                        {{ $item_type->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div id="itemTypeExtra" style="display: none">
                            <div class="form-group col-md-12">
                                <label for="itemsGroupSelect">@lang('global.item_group')</label>
                                <select id="itemsGroupSelect" class="form-control select2-single" name="item_group_id" required>
                                    <option label="&nbsp;"> @lang('global.select_items_group')</option>
                                    @foreach($items_groups as $items_group)
                                        <option value="{{ $items_group->id }}" {{ old('item_group_id') == $items_group->id ? "selected" : '' }}>
                                            {{ $items_group->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-md-12">
                                <label for="theoreticalWeight">@lang('global.theoretical_weight')</label>
                                <input type="number"
                                       min="0"
                                       step="0.01"
                                       class="form-control"
                                       id="theoreticalWeight"
                                       placeholder="@lang('global.theoretical_weight')"
                                       value="{{ old('theoretical_weight') }}"
                                       name="theoretical_weight"
                                       autocomplete="off"
                                >
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12 mt-3">
                <div class="btn-group-sm text-center text-black-50">
                    <button type="submit" class="btn btn-primary">@lang('global.save_print')</button>
                    <button type="reset" class="btn btn-danger reset-close">@lang('global.reset_close')</button>
                </div>
            </div>

        </div>
    </form>


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

    <hr/>

    <div class="row">
        <div class="col-md-12 col-lg-12 col-12 mb-6">
            <div class="card">
                <div class="card-header pl-0 pr-0">
                    <ul class="nav nav-tabs card-header-tabs  ml-0 mr-0" role="tablist">
                        <li class="nav-item w-25 text-center">
                            <a class="nav-link active" id="first-tab_" data-toggle="tab" href="#firstFull" role="tab"
                               aria-controls="first" aria-selected="true">
                                @lang('global.arrival_trucks')
                            </a>
                        </li>
                        <li class="nav-item w-25 text-center">
                            <a class="nav-link" id="second-tab_" data-toggle="tab" href="#secondFull" role="tab"
                               aria-controls="second" aria-selected="false">
                                @lang('global.sampled_trucks')
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
                                @lang('global.out_trucks')
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane fade active show" id="firstFull" role="tabpanel"
                             aria-labelledby="first-tab_">
                            <h6 class="mb-4">@lang('global.arrival_trucks')</h6>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>@lang('global.transport_number')</th>
                                    <th>@lang('global.driver_name')</th>
                                    <th>@lang('global.supplier_name')</th>
                                    <th>@lang('global.mobile')</th>
                                    <th>@lang('global.truck_tractor_trailer')</th>
                                    <th>@lang('global.arrival_time')</th>
                                    <th>@lang('global.waiting_time')</th>
                                    <th>@lang('global.actions')</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td colspan="7"
                                        class="text-center text-warning font-weight-bold">@lang('global.no_data')</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="secondFull" role="tabpanel" aria-labelledby="second-tab_">
                            <h6 class="mb-4">@lang('global.sampled_truck')</h6>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>@lang('global.transport_number')</th>
                                    <th>@lang('global.driver_name')</th>
                                    <th>@lang('global.supplier_name')</th>
                                    <th>@lang('global.mobile')</th>
                                    <th>@lang('global.truck_tractor_trailer')</th>
                                    <th>@lang('global.arrival_time')</th>
                                    <th>@lang('global.waiting_time')</th>
                                    <th>@lang('global.actions')</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td colspan="7"
                                        class="text-center text-warning font-weight-bold">@lang('global.no_data')</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="thirdFull" role="tabpanel" aria-labelledby="third-tab_">
                            <h6 class="mb-4">@lang('global.in_process_truck')</h6>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>@lang('global.transport_number')</th>
                                    <th>@lang('global.driver_name')</th>
                                    <th>@lang('global.supplier_name')</th>
                                    <th>@lang('global.mobile')</th>
                                    <th>@lang('global.truck_tractor_trailer')</th>
                                    <th>@lang('global.arrival_time')</th>
                                    <th>@lang('global.waiting_time')</th>
                                    <th>@lang('global.actions')</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td colspan="7"
                                        class="text-center text-warning font-weight-bold">@lang('global.no_data')</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="fourthFull" role="tabpanel" aria-labelledby="fourth-tab_">
                            <h6 class="mb-4">@lang('global.out_trucks')</h6>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>@lang('global.transport_number')</th>
                                    <th>@lang('global.driver_name')</th>
                                    <th>@lang('global.supplier_name')</th>
                                    <th>@lang('global.mobile')</th>
                                    <th>@lang('global.truck_tractor_trailer')</th>
                                    <th>@lang('global.arrival_time')</th>
                                    <th>@lang('global.waiting_time')</th>
                                    <th>@lang('global.actions')</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td colspan="7"
                                        class="text-center text-warning font-weight-bold">@lang('global.no_data')</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
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

            $('#governorate_select').on('change' , function(evt){
                evt.preventDefault();
                let citySelect  =   $('#citySelect');
                let govId  =   $(this).val();
                $.ajax({
                    method: 'GET',
                    url:    "{{ route('getGovernorateCities') }}",
                    data:   { _token: "{{ csrf_token() }}" , id : govId},
                    success : (response)    =>  {
                        citySelect.empty();
                        let option = "<option label='&nbsp;'> @lang('global.select_city')</option>";
                        citySelect.append(option);
                        $.each(response.cities , function (index , city) {
                            let option = "<option value='"+index+"'>"+ city +"</option>";
                            citySelect.append(option);
                        });
                    }
                })
            });

            $('#citySelect').on('change' , function(evt){
                evt.preventDefault();
                let centerSelect  =   $('#centerSelect');
                let govId  =   $(this).val();
                $.ajax({
                    method: 'GET',
                    url:    "{{ route('getCityCenters') }}",
                    data:   { _token: "{{ csrf_token() }}" , id : govId},
                    success : (response)    =>  {
                        centerSelect.empty();
                        $.each(response.centers , function (index , center) {
                            let option = "<option value='"+index+"'>"+ center +"</option>";
                            centerSelect.append(option);
                        });
                    }
                })
            });

            $('#itemTypeSelect').on('change' , function (evt) {
                evt.preventDefault();
                let itemType    =   $(this).find('option:selected').data('prefix');
                if (itemType === 'raw') {
                    $('#itemTypeExtra').show();
                    $('#itemsGroupSelect').prop('required' , true);
                    $('#theoreticalWeight').prop('required' , true);
                } else {
                    $('#itemTypeExtra').hide();
                    $('#itemsGroupSelect').prop('required' , false);
                    $('#theoreticalWeight').prop('required' , false);
                }
            });

        });
    </script>
@endpush
