@extends('layout.main')
@section('content')

    <div class="row">
        <div class="col-12">
            <h1>@lang('global.centers')</h1>

            <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                <ol class="breadcrumb pt-0">
                    <li class="breadcrumb-item">
                        <span class="default-cursor">@lang('global.master_data')</span>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('centers.index') }}">@lang('global.centers')</a>
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
                        <h5 class="mb-4">@lang('global.create_center')</h5>
                    </div>


                    <form action="{{ route('centers.store') }}" method="post">
                        @csrf

                        <div class="form-row">

                            <div class="form-group col-md-12">
                                <label>@lang('global.select_city') *</label>
                                <select class="form-control select2-single" name="city_id" required>
                                    <option label="&nbsp;" value="">&nbsp; @lang('global.select_city') </option>
                                    @foreach($governorates as $gov)
                                        <optgroup label="{{ $gov->name }}">
                                            @foreach($gov->cities as $city)
                                                <option value="{{ $city->id }}" {{ old('city_id') == $city->id? "selected" : '' }}> {{ $city->name }}</option>
                                            @endforeach
                                        </optgroup>
                                    @endforeach
                                </select>
                                @if($errors->has('city_id'))
                                    <div id="jQueryName-error" class="error" style="">{{ $errors->first('city_id') }}</div>
                                @endif
                            </div>

                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>@lang('global.en_name') *</label>
                                <input type="text" class="form-control onlyEn" name="en_name" value="{{ old('en_name') }}" placeholder="@lang('global.en_name')" required>
                                @if($errors->has('en_name'))
                                    <div id="jQueryName-error" class="error" style="">{{ $errors->first('en_name') }}</div>
                                @endif
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPassword1">@lang('global.ar_name') *</label>
                                <input type="text" class="form-control onlyAr" id="inputPassword1" name="ar_name" value="{{ old('ar_name') }}"
                                       placeholder="@lang('global.ar_name')" required>
                                @if($errors->has('ar_name'))
                                    <div id="jQueryName-error" class="error" style="">{{ $errors->first('ar_name') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-1">
                            <label class="col-12 col-form-label">@lang('global.is_active')</label>
                            <div class="col-12">
                                <div class="custom-switch custom-switch-primary-inverse mb-2" style="padding-left: 0">
                                    <input class="custom-switch-input" id="switch3" type="checkbox" value="1" name="is_active" {{ old('is_active' , '1') == '1' ? 'checked' : '' }}>
                                    <label class="custom-switch-btn" for="switch3"></label>
                                </div>
                                @if($errors->has('is_active'))
                                    <div id="jQueryName-error" class="error" style="">{{ $errors->first('is_active') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <div class="float-right">
                                <a href="{{ route('centers.index') }}">
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
