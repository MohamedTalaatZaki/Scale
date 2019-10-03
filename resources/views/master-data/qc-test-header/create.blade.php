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
                    <li class="breadcrumb-item " aria-current="page">@lang('global.create')</li>
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
                        <h5 class="mb-4">@lang('global.create_qc_test')</h5>
                    </div>


                    <form action="{{ route('qc-test-headers.store') }}" class="repeater" method="post">
                        @csrf

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>@lang('global.en_name') *</label>
                                <input type="text" class="form-control onlyEn" name="en_name" value="{{ old('en_name') }}" placeholder="@lang('global.en_name')" autocomplete="off" required>
                                @if($errors->has('en_name'))
                                    <div id="jQueryName-error" class="error" style="">{{ $errors->first('en_name') }}</div>
                                @endif
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPassword1">@lang('global.ar_name') *</label>
                                <input type="text" class="form-control onlyAr"  name="ar_name" value="{{ old('ar_name') }}"
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
                                            {{ old('item_group_id') == $group->id ? 'selected' : '' }}>
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
                                        <input class="custom-switch-input" id="is_active" type="checkbox" value="1" name="is_active" {{ old('is_active') == '0' ? '' : 'checked' }}>
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
                                    <th style="width: 16%">@lang('global.en_name')</th>
                                    <th style="width: 16%">@lang('global.ar_name')</th>
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
                                @if(!is_null(old('details')))
                                    @foreach(old('details') as $key => $row)
                                        <tr data-repeater-item>
                                            <td>
                                                <input type="text" class="form-control onlyEn form-control-sm"
                                                       name="details[{{$key}}][en_name]"
                                                       value="{{ old("details.$key.en_name") }}"
                                                       placeholder="@lang('global.en_name')" autocomplete="off" required>
                                                @if($errors->has("details.$key.en_name"))
                                                    <span id="jQueryName-error" class="error" style="">{{ $errors->first("details.$key.en_name") }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <input type="text" class="form-control onlyAr form-control-sm"
                                                       name="details[{{$key}}][ar_name]"
                                                       value="{{ old("details.$key.ar_name") }}"
                                                       placeholder="@lang('global.ar_name')" autocomplete="off" required>
                                                @if($errors->has("details.$key.en_name"))
                                                    <span id="jQueryName-error" class="error" style="">{{ $errors->first("details.$key.en_name") }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <select  class="form-control form-control-sm" name="details[{{$key}}][test_type]" required>
                                                    <option value="">@lang('global.test_type')</option>
                                                    <option value="visual" {{ old("details.$key.test_type") == 'visual' ? "selected" : '' }}>@lang('global.visual')</option>
                                                    <option value="chemical" {{ old("details.$key.test_type") == 'chemical' ? "selected" : '' }}>@lang('global.chemical')</option>
                                                </select>
                                                @if($errors->has("details.$key.test_type"))
                                                    <span id="jQueryName-error" class="error" style="">{{ $errors->first("details.$key.test_type") }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <select  class="form-control form-control-sm element_type" name="details[{{$key}}][element_type]" required>
                                                    <option value="">@lang('global.element_type')</option>
                                                    <option value="range" {{ old("details.$key.element_type") == 'range' ? "selected" : '' }}>@lang('global.range')</option>
                                                    <option value="question" {{ old("details.$key.element_type") == 'question' ? "selected" : '' }}>@lang('global.question')</option>
                                                </select>
                                                @if($errors->has("details.$key.element_type"))
                                                    <span id="jQueryName-error" class="error" style="">{{ $errors->first("details.$key.element_type") }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <select id="expected_result" class="form-control form-control-sm expected_result"
                                                        name="details[{{$key}}][expected_result]"
                                                        style="display: {{ $row['element_type'] == '' || $row['element_type'] == 'range' ? 'none' : 'block'}}"
                                                        {{$row['element_type'] == 'range' ? '' : 'required'}}>
                                                    <option value="">@lang('global.expected_result')</option>
                                                    <option value="1" {{ old("details.$key.expected_result") == '1' ? "selected" : '' }}>@lang('global.yes')</option>
                                                    <option value="0" {{ old("details.$key.expected_result") == '0' ? "selected" : '' }}>@lang('global.no')</option>
                                                </select>
                                                @if($errors->has("details.$key.expected_result"))
                                                    <span id="jQueryName-error" class="error" style="">{{ $errors->first("details.$key.expected_result") }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <input type="number" class="form-control form-control-sm min_range range" name="details[{{$key}}][min_range]"
                                                       style="display: {{$row['element_type'] == 'range' ? 'block' : 'none'}}"
                                                       {{$row['element_type'] == 'range' ? 'required' : ''}}

                                                       value="{{ old("details.$key.min_range") }}" placeholder="@lang('global.min_range')" autocomplete="off">
                                                @if($errors->has("details.$key.min_range"))
                                                    <span id="jQueryName-error" class="error" style="">{{ $errors->first("details.$key.min_range") }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <input type="number" class="form-control form-control-sm max_range range" name="details[{{$key}}][max_range]" style="display: {{$row['element_type'] == 'range' ? 'block' : 'none'}}" {{$row['element_type'] == 'range' ? 'required' : ''}}
                                                       value="{{ old("details.$key.max_range") }}" placeholder="@lang('global.max_range')" autocomplete="off">
                                                @if($errors->has("details.$key.max_range"))
                                                    <span id="jQueryName-error" class="error" style="">{{ $errors->first("details.$key.max_range") }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <input type="text" class="form-control form-control-sm element_unit"  name="details[{{$key}}][element_unit]" style="display: {{$row['element_type'] == 'range' ? 'block' : 'none'}}" {{$row['element_type'] == 'range' ? 'required' : ''}}
                                                       value="{{ old("details.$key.element_unit") }}" placeholder="@lang('global.element_unit')" autocomplete="off">
                                                @if($errors->has("details.$key.element_unit"))
                                                    <span id="jQueryName-error" class="error" style="">{{ $errors->first("details.$key.element_unit") }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="btn-group btn-group-sm" role="group">
                                                    <button type="button" class="btn btn-xs new-row" style="background: none ; border: 0 ; margin-right: -20px" data-repeater-create>
                                                        <i class="fas fa-plus-circle text-primary" style="font-size: 25px ; font-weight: bolder"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-xs" style="background: none ; border: 0" data-repeater-delete>
                                                        <i class="fas fa-minus-circle text-danger" style="font-size: 25px ; font-weight: bolder"></i>
                                                    </button>
                                                </div>
                                            </td>
                                    </tr>
                                    @endforeach
                                    @else
                                        <tr data-repeater-item>
                                        <td>
                                            <input type="text" class="form-control onlyEn form-control-sm" name="details[0][en_name]" value="{{ old('en_name') }}"
                                                   placeholder="@lang('global.en_name')" autocomplete="off" required>
                                            @if($errors->has('en_name'))
                                                <span id="jQueryName-error" class="error" style="">{{ $errors->first('en_name') }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <input type="text" class="form-control onlyAr form-control-sm"  name="details[0][ar_name]" value="{{ old('ar_name') }}"
                                                   placeholder="@lang('global.ar_name')" autocomplete="off" required>
                                            @if($errors->has('ar_name'))
                                                <span id="jQueryName-error" class="error" style="">{{ $errors->first('ar_name') }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <select  class="form-control form-control-sm" name="details[0][test_type]" required>
                                                <option value="">@lang('global.test_type')</option>
                                                <option value="visual">@lang('global.visual')</option>
                                                <option value="chemical">@lang('global.chemical')</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select  class="form-control form-control-sm element_type" name="details[0][element_type]" required>
                                                <option value="">@lang('global.element_type')</option>
                                                <option value="range">@lang('global.range')</option>
                                                <option value="question">@lang('global.question')</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select id="expected_result" class="form-control form-control-sm expected_result" name="details[0][expected_result]" style="display: none">
                                                <option value="">@lang('global.expected_result')</option>
                                                <option value="1">@lang('global.yes')</option>
                                                <option value="0">@lang('global.no')</option>
                                            </select>
                                            @if($errors->has('expected_result'))
                                                <span id="jQueryName-error" class="error" style="">{{ $errors->first('expected_result') }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <input type="number" class="form-control form-control-sm min_range range" name="details[0][min_range]" style="display: none"
                                                   value="{{ old('min_range') }}" placeholder="@lang('global.min_range')" autocomplete="off">
                                            @if($errors->has('min_range'))
                                                <span id="jQueryName-error" class="error" style="">{{ $errors->first('min_range') }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <input type="number" class="form-control form-control-sm max_range range" name="details[0][max_range]" style="display: none"
                                                   value="{{ old('max_range') }}" placeholder="@lang('global.max_range')" autocomplete="off">
                                            @if($errors->has('max_range'))
                                                <span id="jQueryName-error" class="error" style="">{{ $errors->first('max_range') }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <input type="text" class="form-control form-control-sm element_unit"  name="details[0][element_unit]" style="display: none"
                                                   value="{{ old('element_unit') }}" placeholder="@lang('global.element_unit')" autocomplete="off">
                                            @if($errors->has('element_unit'))
                                                <span id="jQueryName-error" class="error" style="">{{ $errors->first('element_unit') }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group btn-group-sm" role="group">
                                                <button type="button" class="btn btn-xs new-row" style="background: none ; border: 0 ; margin-right: -20px" data-repeater-create>
                                                    <i class="fas fa-plus-circle text-primary" style="font-size: 25px ; font-weight: bolder"></i>
                                                </button>
                                                <button type="button" class="btn btn-xs" style="background: none ; border: 0" data-repeater-delete>
                                                    <i class="fas fa-minus-circle text-danger" style="font-size: 25px ; font-weight: bolder"></i>
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
@push("styles")
    <style>
        .invalid-tooltip::after, .valid-tooltip::after, span.error::after {
            content: "";
            position: absolute;
            top: -4px;
            left: -2.5px;
            margin-left: 50%;
            width: 10px;
            height: 5px;
            border-bottom: solid 5px #232223;
            border-left: solid 5px transparent;
            border-right: solid 5px transparent;
        }
        .invalid-tooltip::before, .valid-tooltip::before, span.error::before {
            content: "";
            position: absolute;
            top: -5px;
            left: -2.5px;
            margin-left: 50%;
            width: 10px;
            height: 5px;
            border-bottom: solid 5px #c0702f;
            border-left: solid 5px transparent;
            border-right: solid 5px transparent;
        }
        .invalid-tooltip, .valid-tooltip, span.error {
            border-radius: .1rem;
            padding: .5rem 1rem;
            font-size: .76rem;
            color: #969696;
            background: #232223;
            border: 1px solid #c0702f;
            text-align: center;
            width: unset!important;
            position: absolute;
            z-index: 4;
            margin-top: -.5rem;
            /*left: 50%;*/
            /*transform: translateX(-50%);*/
            transform: translateX(0) translateY(15px);
            line-height: 1.5;
            box-shadow: 0 1px 15px rgba(0,0,0,.1), 0 1px 8px rgba(0,0,0,.1);
        }
        .rounded .invalid-tooltip, .rounded .valid-tooltip, .rounded span.error {
            border-radius: 10px;
        }
    </style>
@endpush
@push('scripts')
    <script>
        $().ready(function() {
            'use strict';

            let body = $('body');

            $('.repeater').repeater({
                isFirstItemUndeletable: true,

                show: function () {
                    $(this).find('.new-row').addClass('add-row');
                    $(this).find('.new-row').removeClass('new-row');
                    $(this).show();
                }
            });
            body.on('click' , '.add-row' , function (evt) {
                $('.new-row:first').click();
            });

            body.on('change' , '.element_type' , function (evt) {
                evt.preventDefault();
                let tr = $(this).closest('tr');
                if ($(this).val() === 'range')
                {
                    tr.find('.expected_result').hide().prop('required' , false).val('');
                    tr.find('.min_range').show().prop('required' , true).val('');
                    tr.find('.max_range').show().prop('required' , true).val('');
                    tr.find('.element_unit').show().prop('required' , true).val('');
                } else {
                    tr.find('.expected_result').show().prop('required' , true).val('');
                    tr.find('.min_range').hide().prop('required' , false).val('');
                    tr.find('.max_range').hide().prop('required' , false).val('');
                    tr.find('.element_unit').hide().prop('required' , false).val('');
                }
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
            })
        });
    </script>
@endpush
