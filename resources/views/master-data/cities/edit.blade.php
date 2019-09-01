@extends('layout.main')
@section('content')

    <div class="row">
        <div class="col-12">
            <h1>@lang('global.governorates')</h1>

            <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                <ol class="breadcrumb pt-0">
                    <li class="breadcrumb-item">
                        <a href="#">@lang('global.master_data')</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="#">@lang('global.cities')</a>
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
                        <h5 class="mb-4">@lang('global.edit_city')</h5>
                    </div>


                    <form action="{{ route('cities.update' , ['id' => $city->id ]) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label>@lang('global.select_gov')</label>
                                <select class="form-control" name="gov_id" required>
                                    <option value="">@lang('global.select_gov')</option>
                                    @foreach($governorates as $gov)
                                        <option value="{{ $gov->id }}" {{ old('gov_id' , $city->gov_id) == $gov->id ? 'selected' : '' }}> {{ $gov->name }} </option>
                                    @endforeach
                                </select>
                                @if($errors->has('gov_id'))
                                    <div id="jQueryName-error" class="error" style="">{{ $errors->first('gov_id') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>@lang('global.en_name')</label>
                                <input type="text" class="form-control" name="en_name" value="{{ old('en_name' , $city->en_name) }}" placeholder="@lang('global.en_name')" required>
                                @if($errors->has('en_name'))
                                    <div id="jQueryName-error" class="error" style="">{{ $errors->first('en_name') }}</div>
                                @endif
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPassword1">@lang('global.ar_name')</label>
                                <input type="text" class="form-control" id="inputPassword1" name="ar_name" value="{{ old('ar_name' , $city->ar_name) }}"
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
                                    <input class="custom-switch-input" id="switch3" type="checkbox" value="1" name="is_active" {{ old('is_active'  , $city->is_active) == '1' ? 'checked' : '' }}>
                                    <label class="custom-switch-btn" for="switch3"></label>
                                </div>
                                @if($errors->has('is_active'))
                                    <div id="jQueryName-error" class="error" style="">{{ $errors->first('is_active') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <div class="float-right">
                                <a href="{{ route('cities.index') }}">
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
