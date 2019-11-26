@extends('layout.main')
@section('content')

    <div class="row">
        <div class="col-12">
            <h1>@lang('global.qc_test_headers')</h1>

            <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                <ol class="breadcrumb pt-0">
                    <li class="breadcrumb-item">
                        <span class="default-cursor">@lang('global.master_data')</span>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('qc-test-headers.index') }}">@lang('global.qc_test_headers')</a>
                    </li>
                    <li class="breadcrumb-item " aria-current="page">@lang('global.edit')</li>
                </ol>
            </nav>
            <div class="separator mb-5"></div>
        </div>
    </div>

    <br />
    <br />
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div>
                        <h5 class="mb-4">@lang('global.edit_qc_test')</h5>
                    </div>


                    <form action="{{ route('qc-test-headers.update' , ['id' => $qcTest->id]) }}" class="repeater" method="post">
                        @csrf
                        @method('put')

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>@lang('global.en_name') *</label>
                                <input type="text" class="form-control onlyEn" name="en_name" value="{{ old('en_name' , $qcTest->en_name) }}" placeholder="@lang('global.en_name')" autocomplete="off" required>
                                @if($errors->has('en_name'))
                                    <div id="jQueryName-error" class="error" style="">{{ $errors->first('en_name') }}</div>
                                @endif
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPassword1">@lang('global.ar_name') *</label>
                                <input type="text" class="form-control onlyAr"  name="ar_name" value="{{ old('ar_name' , $qcTest->ar_name) }}"
                                       placeholder="@lang('global.ar_name')" autocomplete="off" required>
                                @if($errors->has('ar_name'))
                                    <div id="jQueryName-error" class="error" style="">{{ $errors->first('ar_name') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="item_group_id">@lang('global.item_group') *</label>
                                <select id="item_group_id" class="form-control select2-single" data-placeholder="@lang('global.item_group')" name="item_group_id" required>
                                    <option label="&nbsp;" value="">&nbsp; @lang('global.item_group')</option>
                                    @foreach($groups as $group)
                                        <option
                                            value="{{ $group->id }}"
                                            {{ old('item_group_id' , $qcTest->item_group_id) == $group->id ? 'selected' : '' }}>
                                            {{ $group->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @if($errors->has('item_group_id'))
                                    <div id="jQueryName-error" class="error" style="">{{ $errors->first('item_group_id') }}</div>
                                @endif
                            </div>
                            <div class="form-group col-md-6">
                                <label class="col-12 col-form-label">@lang('global.is_active')</label>
                                <div class="col-12">
                                    <div class="custom-switch custom-switch-primary-inverse mb-2" style="padding-left: 0">
                                        <input class="custom-switch-input" id="is_active" type="checkbox" value="1" name="is_active" {{ old('is_active' , $qcTest->is_active) == '0' ? '' : 'checked' }}>
                                        <label class="custom-switch-btn" for="is_active"></label>
                                    </div>
                                    @if($errors->has('is_active'))
                                        <div id="jQueryName-error" class="error" style="">{{ $errors->first('is_active') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <hr/>

                        <table class="table">
                            <thead>
                            <tr>
                                <th style="width: 16%">@lang('global.element_name')</th>
                                <th style="width: 11%">@lang('global.test_type')</th>
                                <th style="width: 10%">@lang('global.element_type')</th>
                                <th style="width: 12%">@lang('global.expected_result')</th>
                                <th style="width: 10%">@lang('global.min_range')</th>
                                <th style="width: 10%">@lang('global.max_range')</th>
                                <th style="width: 10%">@lang('global.element_unit')</th>
                                <th style="width: 5%">@lang('global.actions')</th>
                            </tr>
                            </thead>
                            <tbody data-repeater-list="details">
                            @if(count(old('details' , $qcTest->details->toArray())) > 0)
                                @foreach(old('details' , $qcTest->details->toArray()) as $key => $row)
                                    <tr data-repeater-item>
                                        <td>
                                            <input value="{{ $row['id'] }}" type="hidden" name="id">
                                            <select
                                                class="form-control select2-single qc-element-id"
                                                name="details[0][qc_element_id]" required>
                                                <option label="&nbsp;">&nbsp; </option>
                                                @foreach($elements as $element)
                                                    <option value="{{ $element->id }}"
                                                            data-test-type="{{ $element->test_type }}"
                                                            data-element-type="{{ $element->element_type }}"
                                                            data-element-unit="{{ $element->element_unit }}"
                                                        {{ old("details.$key.qc_element_id" , $row['qc_element_id']) == $element->id ? "selected" : "" }}>
                                                        {{ $element->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @if($errors->has("details.$key.qc_element_id"))
                                                <span id="jQueryName-error" class="error"
                                                      style="">{{ $errors->first("details.$key.qc_element_id") }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <input type="text"
                                                   class="form-control form-control-sm bg-readonly test-type"
                                                   name="details[0][test_type]"
                                                   value="{{ old("details.$key.test_type" , qcRowElement($row)['test_type']) }}"
                                                   readonly>
                                        </td>
                                        <td>
                                            <input type="text"
                                                   class="form-control form-control-sm bg-readonly element-type"
                                                   name="details[0][element_type]"
                                                   value="{{ old("details.$key.element_type" , qcRowElement($row)['element_type']) }}"
                                                   readonly>
                                        </td>
                                        <td>
                                            <select
                                                class="form-control form-control-sm expected_result"
                                                name="details[0][expected_result]"
                                                style="display: {{ old("details.$key.element_type" , qcRowElement($row)['element_type']) == "question"? "" : "none" }}"
                                                {{ old("details.$key.element_type" , qcRowElement($row)['element_type']) == "question" ? "required" : '' }}>
                                                <option value="" selected>@lang('global.expected_result')</option>
                                                <option value="1" {{ old("details.$key.expected_result" , $row['expected_result']) == 1 ? "selected" : ""}}>@lang('global.yes')</option>
                                                <option value="0" {{ old("details.$key.expected_result" , $row['expected_result']) == 0 ? "selected" : ""}}>@lang('global.no')</option>
                                            </select>
                                            @if($errors->has("details.$key.expected_result"))
                                                <span id="jQueryName-error" class="error"
                                                      style="">{{ $errors->first("details.$key.expected_result") }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <input type="number" class="form-control form-control-sm min_range range"
                                                   name="details[0][min_range]" style="display: {{ old("details.$key.element_type" , qcRowElement($row)['element_type']) == "range"? "" : "none" }}"
                                                   value="{{ old("details.$key.min_range" , $row['min_range']) }}" placeholder="@lang('global.min_range')"
                                                   autocomplete="off"
                                                   {{ old("details.$key.element_type" , qcRowElement($row)['element_type']) == "range" ? "required" : '' }}
                                            >
                                            @if($errors->has("details.$key.min_range"))
                                                <span id="jQueryName-error" class="error"
                                                      style="">{{ $errors->first("details.$key.min_range") }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <input type="number" class="form-control form-control-sm max_range range"
                                                   name="details[0][max_range]" style="display: {{ old("details.$key.element_type" , qcRowElement($row)['element_type']) == "range"? "" : "none" }}"
                                                   value="{{ old("details.$key.max_range" , $row['max_range']) }}" placeholder="@lang('global.max_range')"
                                                   autocomplete="off"
                                                {{ old("details.$key.element_type" , qcRowElement($row)['element_type']) == "range" ? "required" : '' }}
                                            >
                                            @if($errors->has('max_range'))
                                                <span id="jQueryName-error" class="error"
                                                      style="">{{ $errors->first("details.$key.max_range") }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <input type="text"
                                                   class="form-control form-control-sm bg-readonly element-unit"
                                                   name="details[0][element_unit]"
                                                   value="{{ old("details.$key.element_unit" , qcRowElement($row)['element_unit']) }}"
                                                   readonly>
                                        </td>
                                        <td>
                                            <div class="btn-group btn-group-sm" role="group">
                                                <button type="button" class="btn btn-xs new-row"
                                                        style="background: none ; border: 0 ; margin-right: -20px"
                                                        data-repeater-create>
                                                    <i class="fas fa-plus-circle text-primary"
                                                       style="font-size: 25px ; font-weight: bolder"></i>
                                                </button>
                                                <button type="button" class="btn btn-xs"
                                                        style="background: none ; border: 0" data-repeater-delete>
                                                    <i class="fas fa-minus-circle text-danger"
                                                       style="font-size: 25px ; font-weight: bolder"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr data-repeater-item>
                                    <td>
                                        <input value="0" type="hidden" name="id">
                                        <select
                                            class="form-control select2-single qc-element-id"
                                            name="details[0][qc_element_id]" required>
                                            <option label="&nbsp;">&nbsp; </option>
                                            @foreach($elements as $element)
                                                <option value="{{ $element->id }}"
                                                        data-test-type="{{ $element->test_type }}"
                                                        data-element-type="{{ $element->element_type }}"
                                                        data-element-unit="{{ $element->element_unit }}"
                                                    {{ old('qc_element_id' , $element->qc_element_id) == $element->id ? "selected" : "" }}>
                                                    {{ $element->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('expected_result'))
                                            <span id="jQueryName-error" class="error"
                                                  style="">{{ $errors->first('expected_result') }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <input type="text" class="form-control form-control-sm bg-readonly test-type" name="details[0][test_type]" readonly>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control form-control-sm bg-readonly element-type" name="details[0][element_type]" readonly>
                                    </td>
                                    <td>
                                        <select
                                            class="form-control form-control-sm expected_result"
                                            name="details[0][expected_result]" style="display: none">
                                            <option value="">@lang('global.expected_result')</option>
                                            <option value="1">@lang('global.yes')</option>
                                            <option value="0">@lang('global.no')</option>
                                        </select>
                                        @if($errors->has('expected_result'))
                                            <span id="jQueryName-error" class="error"
                                                  style="">{{ $errors->first('expected_result') }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <input type="number" class="form-control form-control-sm min_range range"
                                               name="details[0][min_range]" style="display: none"
                                               value="{{ old('min_range') }}" placeholder="@lang('global.min_range')"
                                               autocomplete="off">
                                        @if($errors->has('min_range'))
                                            <span id="jQueryName-error" class="error"
                                                  style="">{{ $errors->first('min_range') }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <input type="number" class="form-control form-control-sm max_range range"
                                               name="details[0][max_range]" style="display: none"
                                               value="{{ old('max_range') }}" placeholder="@lang('global.max_range')"
                                               autocomplete="off">
                                        @if($errors->has('max_range'))
                                            <span id="jQueryName-error" class="error"
                                                  style="">{{ $errors->first('max_range') }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <input type="text" class="form-control form-control-sm bg-readonly element-unit" name="details[0][element_unit]" readonly>
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-sm" role="group">
                                            <button type="button" class="btn btn-xs new-row"
                                                    style="background: none ; border: 0 ; margin-right: -20px"
                                                    data-repeater-create>
                                                <i class="fas fa-plus-circle text-primary"
                                                   style="font-size: 25px ; font-weight: bolder"></i>
                                            </button>
                                            <button type="button" class="btn btn-xs"
                                                    style="background: none ; border: 0" data-repeater-delete>
                                                <i class="fas fa-minus-circle text-danger"
                                                   style="font-size: 25px ; font-weight: bolder"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endif
                            </tbody>
                        </table>

                        <div class="form-group col-md-12">
                            <div class="float-right">
                                <a href="{{ route('qc-test-headers.index') }}">
                                    <button type="button" class="btn btn-danger btn-sm mt-3">@lang('global.cancel')</button>
                                </a>
                                <button type="submit" class="btn btn-primary btn-sm mt-3">@lang('global.save')</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('scripts')
    <script>
        $().ready(function() {
            'use strict';

            let body = $('body');
            let hasOldValue =   "{{ !is_null(old('details')) }}";
            let values  =   [];

            setTimeout( function () {
                handleSelect2Values();
            } , 200);

            $('.repeater').repeater({
                isFirstItemUndeletable: true,

                show: function () {
                    $(this).find('.expected_result').hide().prop('required' , false).val('');
                    $(this).find('.min_range').hide().prop('required' , false).val('');
                    $(this).find('.max_range').hide().prop('required' , false).val('');
                    $(this).find('.element_unit').hide().prop('required' , false).val('');
                    $(this).find('.new-row').addClass('add-row');
                    $(this).find('.new-row').removeClass('new-row');
                    $(this).find('.qc-element-id').val("").trigger('change');
                    $(this).show();
                    reInitSelect2($(this).find('.qc-element-id'));
                }
            });
            body.on('click' , '.add-row' , function (evt) {
                $('.new-row:first').click();
            });


            body.on('change' , '.range' , function (evt) {
                evt.preventDefault();
                let tr = $(this).closest('tr');
                let minElem = tr.find('.min_range');
                let maxElem = tr.find('.max_range');
                let min = parseFloat(minElem.val());
                let max = parseFloat(maxElem.val());
                if(min >= max) {
                    $.notify("@lang('global.min_max_error')" , {position: 'bottom center'});
                    $(this).val('');
                }
            });

            body.on('change' , '.qc-element-id' , function (evt) {
                evt.preventDefault();
                let selectedOption  =   $(this).find('option:selected');
                let tr          =   $(this).closest('tr');
                let testType    =   selectedOption.data('test-type');
                let elementType =   selectedOption.data('element-type');
                let elementUnit =   selectedOption.data('element-unit');


                tr.find('.test-type').val(testType);
                tr.find('.element-type').val(elementType);
                tr.find('.element-unit').val(elementUnit);

                if (elementType === 'range') {
                    tr.find('.expected_result').hide().prop('required' , false).val('');
                    tr.find('.min_range').show().prop('required' , true).val('');
                    tr.find('.max_range').show().prop('required' , true).val('');
                    tr.find('.element-unit').show().prop('required' , true);
                } else if(elementType === 'question') {
                    tr.find('.expected_result').show().prop('required' , true).val('');
                    tr.find('.min_range').hide().prop('required' , false).val('');
                    tr.find('.max_range').hide().prop('required' , false).val('');
                    tr.find('.element-unit').hide().prop('required' , false).val('');
                } else {
                    tr.find('.expected_result').hide().prop('required' , true).val('');
                    tr.find('.min_range').hide().prop('required' , false).val('');
                    tr.find('.max_range').hide().prop('required' , false).val('');
                    tr.find('.element-unit').hide().prop('required' , false).val('');
                }
                handleSelect2Values();
            });

            let handleSelect2Values = () => {
                values  =   body.find('select.qc-element-id').find(':selected').map(function(){
                    if ($(this).val() > 0) {
                        return $(this).val();
                    }
                }).toArray();
                body.find('select.qc-element-id').each(function(index , elem){
                    $(elem).find('option').each(function(optionIndex , option){
                        if (jQuery.inArray($(option).val() , values) !== -1)
                        {
                            $(option).attr('disabled' , true);
                        } else {
                            $(option).attr('disabled' , false);
                        }
                    });
                    $(elem).find('option:selected').attr('disabled' , false);
                    reInitSelect2(elem)
                });
            };

            function reInitSelect2(selector) {
                $(selector).select2();
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
