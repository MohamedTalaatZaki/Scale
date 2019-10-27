@extends('layout.main')
@section('content')

    <div class="row">
        <div class="col-12">
            <h1>@lang('global.qc_elements')</h1>

            <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                <ol class="breadcrumb pt-0">
                    <li class="breadcrumb-item">
                        <span class="default-cursor">@lang('global.master_data')</span>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('qc-elements.index') }}">@lang('global.qc_elements')</a>
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
                        <h5 class="mb-4">@lang('global.edit_qc_elements')</h5>
                    </div>


                    <form action="{{ route('qc-elements.update' , ['id'   =>  $element->id]) }}" method="post">
                        @csrf
                        @method('put')

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>@lang('global.en_name') *</label>
                                <input type="text" class="form-control onlyEn" name="en_name" value="{{ old('en_name' , $element->en_name) }}" placeholder="@lang('global.en_name')" autocomplete="off" required>
                                @if($errors->has('en_name'))
                                    <div id="jQueryName-error" class="error" style="">{{ $errors->first('en_name') }}</div>
                                @endif
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPassword1">@lang('global.ar_name') *</label>
                                <input type="text" class="form-control onlyAr"  name="ar_name" value="{{ old('ar_name' , $element->ar_name) }}"
                                       placeholder="@lang('global.ar_name')" autocomplete="off" required>
                                @if($errors->has('ar_name'))
                                    <div id="jQueryName-error" class="error" style="">{{ $errors->first('ar_name') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="item_group_id">@lang('global.test_type') *</label>
                                <select id="item_group_id" class="form-control select2-single" data-placeholder="@lang('global.test_type')" name="test_type" required>
                                    <option label="&nbsp;" value="">&nbsp; @lang('global.test_type')</option>
                                    <option value="visual" {{ old("test_type" , $element->test_type) == 'visual' ? "selected" : '' }}>@lang('global.visual')</option>
                                    <option value="chemical" {{ old("test_type" , $element->test_type) == 'chemical' ? "selected" : '' }}>@lang('global.chemical')</option>
                                </select>
                                @if($errors->has('test_type'))
                                    <div id="jQueryName-error" class="error" style="">{{ $errors->first('test_type') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-6">
                                <label for="item_group_id">@lang('global.element_type') *</label>
                                <select id="item_group_id" class="form-control select2-single" data-placeholder="@lang('global.element_type')" name="element_type" required>
                                    <option label="&nbsp;" value="">&nbsp; @lang('global.element_type')</option>
                                    <option value="range" {{ old("element_type" , $element->element_type) == 'range' ? "selected" : '' }}>@lang('global.range')</option>
                                    <option value="question" {{ old("element_type" , $element->element_type) == 'question' ? "selected" : '' }}>@lang('global.question')</option>
                                </select>
                                @if($errors->has('element_type'))
                                    <div id="jQueryName-error" class="error" style="">{{ $errors->first('element_type') }}</div>
                                @endif
                            </div>

                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputPassword1">@lang('global.element_unit') *</label>
                                <input type="text" class="form-control onlyEn"  name="element_unit" value="{{ old('element_unit' , $element->element_unit) }}"
                                       placeholder="@lang('global.element_unit')" autocomplete="off" required>
                                @if($errors->has('element_unit'))
                                    <div id="jQueryName-error" class="error" style="">{{ $errors->first('element_unit') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <div class="float-right">
                                <a href="{{ route('qc-elements.index') }}">
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
