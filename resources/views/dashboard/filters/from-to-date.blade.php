<div class="form-row">
    <div class="form-group col-md-6">
        <label for="fromDateInput">@lang('global.from_date')</label>
        <input type="text"
               class="form-control start_date"
               id="fromDateInput"
               value="{{ request()->input('filter_from_date') }}"
               name="filter_from_date"
               placeholder="@lang('global.from_date')"
               autocomplete="off"
        >
    </div>
    <div class="form-group col-md-6">
        <label for="toDateInput">@lang('global.to_date')</label>
        <input type="text"
               value="{{ request()->input('filter_to_date') }}"
               name="filter_to_date"
               class="form-control end_date"
               id="toDateInput"
               placeholder="@lang('global.to_date')"
               autocomplete="off"
        >
    </div>
</div>
