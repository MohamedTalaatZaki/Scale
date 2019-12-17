<div class="form-row">
    <div class="form-group col-md-12">
        <label for="fromDateInput">@lang('global.supplier')</label>
        <select class="form-control select2-single" id="suppliersFilter">
            <option label="&nbsp;">&nbsp;</option>
            @foreach($suppliers as $supplier)
                <option value="{{ $supplier->id }}" {{ request()->input('filter_supplier_id') == $supplier->id ? "selected" : "" }}>
                    {{ $supplier->name }}
                </option>
            @endforeach
        </select>
    </div>
</div>
