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

    <div style="display: none" class="row create-arrival-truck">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="driver_name">@lang('global.driver_name')</label>
                                <input type="text"
                                       class="form-control"
                                       id="driver_name"
                                       placeholder="@lang('global.driver_name')"
                                       name="driver_name" required>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="driver_license">@lang('global.driver_license')</label>
                                <input type="text"
                                       class="form-control"
                                       id="driver_license"
                                       placeholder="@lang('global.driver_license')"
                                       name="driver_license" required>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="driver_national_id">@lang('global.driver_national_id')</label>
                                <input type="text"
                                       class="form-control"
                                       id="driver_national_id"
                                       placeholder="@lang('global.driver_national_id')"
                                       name="driver_national_id" required>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="driver_mobile">@lang('global.driver_mobile')</label>
                                <input type="text"
                                       class="form-control"
                                       id="driver_mobile"
                                       placeholder="@lang('global.driver_mobile')"
                                       name="driver_mobile"
                                       min="0"
                                       minlength="11"
                                       maxlength="11"
                                       required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="supplier_name">@lang('global.supplier_name')</label>
                                <select id="supplier_name" class="form-control" name="supplier_id">
                                    <option selected="">@lang('global.select_supplier')</option>
                                    <option>...</option>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="governorate">@lang('global.governorate')</label>
                                <select id="governorate" class="form-control" name="governorate_id">
                                    <option selected="">@lang('global.select_governorate')</option>
                                    <option>...</option>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="city">@lang('global.city')</label>
                                <select id="city" class="form-control" name="city_id">
                                    <option selected="">@lang('global.select_city')</option>
                                    <option>...</option>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="center">@lang('global.center')</label>
                                <select id="center" class="form-control" name="supplier_id">
                                    <option selected="">@lang('global.select_center')</option>
                                    <option>...</option>
                                </select>
                            </div>
                        </div>


                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="truck_type">@lang('global.truck_type')</label>
                                <select id="truck_type" class="form-control" name="truck_type_id">
                                    <option selected="">@lang('global.select_truck_type')</option>
                                    <option>...</option>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="truck_plates_tractor">@lang('global.truck_plates_tractor')</label>
                                <input type="text"
                                       class="form-control"
                                       id="truck_plates_tractor"
                                       placeholder="@lang('global.truck_plates_tractor')"
                                       name="truck_plates_tractor"
                                       required>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="truck_plates_trailer">@lang('global.truck_plates_trailer')</label>
                                <input type="text"
                                       class="form-control"
                                       id="truck_plates_trailer"
                                       placeholder="@lang('global.truck_plates_trailer')"
                                       name="truck_plates_trailer"
                                >
                            </div>
                            <div class="form-group col-md-3">
                                <label for="item_type">@lang('global.item_type')</label>
                                <select id="item_type" class="form-control" name="item_type_id">
                                    <option selected="">@lang('global.select_item_type')</option>
                                    <option>...</option>
                                </select>
                            </div>
                        </div>
                        <div class="btn-group-sm float-{{app()->getLocale() == 'ar' ? 'left' : 'right'}}">
                            <button type="submit" class="btn btn-primary">@lang('global.save_print')</button>
                            <button type="reset" class="btn btn-danger">@lang('global.reset')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row search-trucks">
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
                            <a class="nav-link active" id="first-tab_" data-toggle="tab" href="#firstFull" role="tab" aria-controls="first" aria-selected="true">
                                @lang('global.arrival_truck')
                            </a>
                        </li>
                        <li class="nav-item w-25 text-center">
                            <a class="nav-link" id="second-tab_" data-toggle="tab" href="#secondFull" role="tab" aria-controls="second" aria-selected="false">
                                @lang('global.sampled_truck')
                            </a>
                        </li>
                        <li class="nav-item w-25 text-center">
                            <a class="nav-link" id="third-tab_" data-toggle="tab" href="#thirdFull" role="tab" aria-controls="third" aria-selected="false">
                                @lang('global.in_process_truck')
                            </a>
                        </li>
                        <li class="nav-item w-25 text-center">
                            <a class="nav-link" id="fourth-tab_" data-toggle="tab" href="#fourthFull" role="tab" aria-controls="fourth" aria-selected="false">
                                @lang('global.out_trucks')
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane fade active show" id="firstFull" role="tabpanel" aria-labelledby="first-tab_">
                            <h6 class="mb-4">@lang('global.arrival_truck')</h6>
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
        $().ready(function(){
            $('.show-create-div').on('click' , function () {
                $('.create-arrival-truck').toggle();
                $('.search-trucks').toggle();
            })
        });
    </script>
@endpush
