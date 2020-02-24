<div class="form-row">
    <div class="form-group col-md-12">
        <label for="fromDateInput">@lang('global.item_group')</label>
        <select class="form-control select2-single" name="filter_item_group" id="itemGroupFilter">
            <option label="&nbsp;">&nbsp;</option>
            @foreach($item_groups as $item_group)
                <option value="{{ $item_group->id }}"
                    {{ request()->input('filter_item_group') == $item_group->id ? "selected" : "" }}>
                    {{ $item_group->name }}
                </option>
            @endforeach
        </select>
    </div>
</div>
