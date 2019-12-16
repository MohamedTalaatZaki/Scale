<div class="form-row">
    <div class="form-group col-md-12">
        <label for="fromDateInput">@lang('global.item_type')</label>
        <select class="form-control ItemTypeFilter" name="filter_item_type">
            <option label="&nbsp;">&nbsp;</option>
            @foreach($item_types as $item_type)
                <option value="{{ $item_type->prefix }}" {{ request()->input('filter_item_type') == $item_type->prefix ? 'selected' : '' }}>
                    {{ $item_type->name }}
                </option>
            @endforeach
        </select>
    </div>
</div>
