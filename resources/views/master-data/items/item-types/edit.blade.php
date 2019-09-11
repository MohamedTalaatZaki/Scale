@extends('layout.main')
@section('content')

    <div class="row">
        <div class="col-12">
            <h1>@lang('global.item_types')</h1>

            <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                <ol class="breadcrumb pt-0">
                    <li class="breadcrumb-item">
                        <a href="#" class="default-cursor">@lang('global.master_data')</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('item-types.index') }}">@lang('global.item_types')</a>
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
                        <h5 class="mb-4">@lang('global.edit_item_types')</h5>
                    </div>

                    <form action="{{ route('item-types.update' , ['id' => $item_type->id ]) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>@lang('global.en_name') *</label>
                                <input type="text" class="form-control" name="en_name" value="{{ old('en_name' , $item_type->en_name) }}" placeholder="@lang('global.en_name')" autocomplete="off" required>
                                @if($errors->has('en_name'))
                                    <div id="jQueryName-error" class="error" style="">{{ $errors->first('en_name') }}</div>
                                @endif
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPassword1">@lang('global.ar_name') *</label>
                                <input type="text" class="form-control" id="inputPassword1" name="ar_name" value="{{ old('ar_name' , $item_type->ar_name) }}"
                                       placeholder="@lang('global.ar_name')" autocomplete="off" required>
                                @if($errors->has('ar_name'))
                                    <div id="jQueryName-error" class="error" style="">{{ $errors->first('ar_name') }}</div>
                                @endif
                            </div>
                            <div class="form-group row mb-1">
                                <label class="col-12 col-form-label">@lang('global.is_testable') </label>
                                <div class="col-12">
                                    <div class="custom-switch custom-switch-primary-inverse mb-2" style="padding-left: 0">
                                        <input class="custom-switch-input" id="testable" type="checkbox" value="1" name="testable" {{ old('testable' , $item_type->testable) == '1' ? 'checked' : '' }}>
                                        <label class="custom-switch-btn" for="testable"></label>
                                    </div>
                                    @if($errors->has('testable'))
                                        <div id="jQueryName-error" class="error" style="">{{ $errors->first('testable') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <div class="float-right">
                                <a href="{{ route('item-types.index') }}">
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
