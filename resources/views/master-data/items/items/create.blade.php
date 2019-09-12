@extends('layout.main')
@section('content')

    <div class="row">
        <div class="col-12">
            <h1>@lang('global.items')</h1>

            <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                <ol class="breadcrumb pt-0">
                    <li class="breadcrumb-item">
                        <span class="default-cursor">@lang('global.master_data')</span>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('items.index') }}">@lang('global.items')</a>
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
                        <h5 class="mb-4">@lang('global.create_item')</h5>
                    </div>


                    <form action="{{ route('items.store') }}" method="post">
                        @csrf

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>@lang('global.en_name') *</label>
                                <input type="text" class="form-control" name="en_name" value="{{ old('en_name') }}" placeholder="@lang('global.en_name')" autocomplete="off" required>
                                @if($errors->has('en_name'))
                                    <div id="jQueryName-error" class="error" style="">{{ $errors->first('en_name') }}</div>
                                @endif
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPassword1">@lang('global.ar_name') *</label>
                                <input type="text" class="form-control" id="inputPassword1" name="ar_name" value="{{ old('ar_name') }}"
                                       placeholder="@lang('global.ar_name')" autocomplete="off" required>
                                @if($errors->has('ar_name'))
                                    <div id="jQueryName-error" class="error" style="">{{ $errors->first('ar_name') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="item_group_id">@lang('global.item_group') *</label>
                                <select id="item_group_id" class="form-control select2-single" name="item_group_id">
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
                                <label for="item_type_id">@lang('global.item_type') *</label>
                                <select id="item_type_id" class="form-control select2-single" name="item_type_id">
                                    <option label="&nbsp;" value="">&nbsp; @lang('global.item_type')</option>
                                    @foreach($types as $type)
                                        <option
                                            value="{{ $type->id }}"
                                            {{ old('item_type_id') == $group->id ? 'selected' : '' }}>
                                            {{ $type->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @if($errors->has('item_type_id'))
                                    <div id="jQueryName-error" class="error" style="">{{ $errors->first('item_type_id') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>@lang('global.sap_code') *</label>
                                <input type="text" class="form-control" name="sap_code" value="{{ old('sap_code') }}" placeholder="@lang('global.sap_code')" autocomplete="off" required>
                                @if($errors->has('sap_code'))
                                    <div id="jQueryName-error" class="error" style="">{{ $errors->first('sap_code') }}</div>
                                @endif
                            </div>
                            <div class="form-group col-md-6">
                                <label class="col-12 col-form-label">@lang('global.is_active')</label>
                                <div class="col-12">
                                    <div class="custom-switch custom-switch-primary-inverse mb-2" style="padding-left: 0">
                                        <input class="custom-switch-input" id="is_active" type="checkbox" value="1" name="is_active" {{ old('is_active') == '1' ? 'checked' : '' }}>
                                        <label class="custom-switch-btn" for="is_active"></label>
                                    </div>
                                    @if($errors->has('is_active'))
                                        <div id="jQueryName-error" class="error" style="">{{ $errors->first('is_active') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="description">@lang('global.description')</label>
                                <textarea id="description" rows="6" name="description" class="form-control">{{ old('description') }}</textarea>
                                @if($errors->has('description'))
                                    <div id="jQueryName-error" class="error" style="">{{ $errors->first('description') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group col-md-12">
                            <div class="float-right">
                                <a href="{{ route('items.index') }}">
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
