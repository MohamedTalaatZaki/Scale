<form action="{{ route('transports.store') }}" method="post">
    @csrf
    <div style="display: {{ $errors->count() > 0 ? 'flex' : 'none' }}" class="row create-arrival-truck">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h6>@lang('global.driver_information') *</h6>
                    <hr>
                    <div class="form-group col-md-12">
                        <label for="driver_national_id">@lang('global.driver_national_id') *</label>
                        <input type="text"
                               class="form-control driver_national_id"
                               id="driver_national_id"
                               placeholder="@lang('global.driver_national_id')"
                               value="{{ old('driver_national_id') }}"
                               name="driver_national_id"
                               autocomplete="off"
                               required>
                        @if($errors->has('driver_national_id'))
                            <div class="error" style="">{{ $errors->first('driver_national_id') }}</div>
                        @endif
                    </div>
                    <div class="form-group col-md-12">
                        <label for="driver_name">@lang('global.driver_name')</label>
                        <input type="text"
                               class="form-control noNumbers"
                               id="driver_name"
                               placeholder="@lang('global.driver_name')"
                               name="driver_name"
                               value="{{ old('driver_name') }}"
                               autocomplete="off"
                               required>
                        @if($errors->has('driver_name'))
                            <div class="error" style="">{{ $errors->first('driver_name') }}</div>
                        @endif
                    </div>
                    <div class="form-group col-md-12">
                        <label for="driver_license">@lang('global.driver_license') *</label>
                        <input type="text"
                               class="form-control"
                               id="driver_license"
                               placeholder="@lang('global.driver_license')"
                               value="{{ old('driver_license') }}"
                               name="driver_license"
                               autocomplete="off"
                               required>
                        @if($errors->has('driver_license'))
                            <div class="error" style="">{{ $errors->first('driver_license') }}</div>
                        @endif
                    </div>
                    <div class="form-group col-md-12">
                        <label for="driver_mobile">@lang('global.driver_mobile') *</label>
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
                        @if($errors->has('driver_mobile'))
                            <div class="error" style="">{{ $errors->first('driver_mobile') }}</div>
                        @endif
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
                        <label for="supplier_name">@lang('global.supplier_name') *</label>
                        <select id="supplierSelect" class="form-control select2-single supplierSelect" data-placeholder="@lang('global.select_supplier')" name="supplier_id" required>
                            <option value="" selected></option>
                            @foreach($suppliers as $supplier)
                                <option value="{{ $supplier->id }}" {{ old('supplier_id') == $supplier->id ? "selected" : '' }}>
                                    {{ $supplier->name }}
                                </option>
                            @endforeach
                        </select>
                        @if($errors->has('supplier_id'))
                            <div class="error" style="">{{ $errors->first('supplier_id') }}</div>
                        @endif
                    </div>
                    <div class="form-group col-md-12">
                        <label for="governorate">@lang('global.governorate') *</label>
                        <select id="governorate_select" class="form-control select2-single governorate_select" data-placeholder="@lang('global.select_governorate')" name="governorate_id" required>
                            <option value="" selected></option>
                            @foreach($governorates as $governorate)
                                <option value="{{ $governorate->id }}" {{ old('governorate_id') == $governorate->id ? "selected" : '' }}>
                                    {{ $governorate->name }}
                                </option>
                            @endforeach
                        </select>
                        @if($errors->has('governorate_id'))
                            <div class="error" style="">{{ $errors->first('governorate_id') }}</div>
                        @endif
                    </div>
                    <div class="form-group col-md-12">
                        <label for="city">@lang('global.city') *</label>
                        <select id="citySelect" class="form-control select2-single citySelect" data-placeholder="@lang('global.select_city')" name="city_id" required>
                        </select>
                        @if($errors->has('city_id'))
                            <div class="error" style="">{{ $errors->first('city_id') }}</div>
                        @endif
                    </div>
                    <div class="form-group col-md-12">
                        <label for="center">@lang('global.center')</label>
                        <select id="centerSelect" class="form-control select2-single centerSelect" data-placeholder="@lang('global.select_center')" name="center_id">
                        </select>
                        @if($errors->has('center_id'))
                            <div class="error" style="">{{ $errors->first('center_id') }}</div>
                        @endif
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
                        <label for="truck_type">@lang('global.truck_type') *</label>
                        <select id="truck_type" class="form-control select2-single" data-placeholder="@lang('global.select_truck_type')" name="truck_type_id" required>
                            <option value="" selected></option>
                            @foreach($truck_types as $truck_type)
                                <option value="{{ $truck_type->id }}" {{ old('truck_type_id') == $truck_type->id ? "selected" : '' }}>
                                    {{ $truck_type->name }}
                                </option>
                            @endforeach
                        </select>
                        @if($errors->has('truck_type_id'))
                            <div class="error" style="">{{ $errors->first('truck_type_id') }}</div>
                        @endif
                    </div>
                    <div class="form-group col-md-12">
                        <label for="truck_plates_tractor">@lang('global.truck_plates_tractor') *</label>
                        <input type="text"
                               class="form-control"
                               id="truck_plates_tractor"
                               placeholder="@lang('global.truck_plates_tractor')"
                               name="truck_plates_tractor"
                               value="{{ old('truck_plates_tractor') }}"
                               autocomplete="off"
                               required>
                        @if($errors->has('truck_plates_tractor'))
                            <div class="error" style="">{{ $errors->first('truck_plates_tractor') }}</div>
                        @endif
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
                        @if($errors->has('truck_plates_trailer'))
                            <div class="error" style="">{{ $errors->first('truck_plates_trailer') }}</div>
                        @endif
                    </div>
                    <div class="form-group col-md-12">
                        <label for="itemTypeSelect">@lang('global.item_type') *</label>
                        <select id="itemTypeSelect" class="form-control select2-single itemTypeSelect" data-placeholder="@lang('global.select_item_type')" name="item_type_id" required>
                            <option value="" selected></option>
                            @foreach($item_types as $item_type)
                                <option value="{{ $item_type->id }}"
                                        data-prefix="{{$item_type->prefix}}"
                                    {{ old('item_type_id') == $item_type->id ? "selected" : '' }}>
                                    {{ $item_type->name }}
                                </option>
                            @endforeach
                        </select>
                        @if($errors->has('item_type_id'))
                            <div class="error" style="">{{ $errors->first('item_type_id') }}</div>
                        @endif
                    </div>
                    <div class="itemTypeExtra" style="display: {{ isItemTypeRaw(old('item_type_id')) ? 'block' : 'none' }}">
                        <div class="form-group col-md-12">
                            <label for="itemsGroupSelect">@lang('global.item_group') *</label>
                            <select id="itemsGroupSelect"
                                    class="form-control select2-single itemsGroupSelect"
                                    data-placeholder="@lang('global.select_items_group')"
                                    name="item_group_id"
                                    {{ isItemTypeRaw(old('item_type_id')) ? 'required' : '' }}
                            >
                                <option value='' selected></option>
                            </select>
                            @if($errors->has('item_group_id'))
                                <div class="error" style="">{{ $errors->first('item_group_id') }}</div>
                            @endif
                        </div>

                        <div class="form-group col-md-12">
                            <label for="theoreticalWeight">@lang('global.theoretical_weight') *</label>
                            <input type="number"
                                   min="0"
                                   step="0.01"
                                   class="form-control theoreticalWeight onlyNumbers"
                                   id="theoreticalWeight"
                                   placeholder="@lang('global.theoretical_weight')"
                                   value="{{ old('theoretical_weight') }}"
                                   name="theoretical_weight"
                                   autocomplete="off"
                                   {{ isItemTypeRaw(old('item_type_id')) ? 'required' : '' }}
                            >
                            @if($errors->has('theoretical_weight'))
                                <div class="error" style="">{{ $errors->first('theoretical_weight') }}</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12 mt-3">
            <div class="btn-group-sm text-center text-black-50">
                <button type="submit" class="btn btn-primary submit-btn">@lang('global.save_print')</button>
                <button type="reset" class="btn btn-danger reset-close">@lang('global.reset_close')</button>
            </div>
        </div>

    </div>
</form>
