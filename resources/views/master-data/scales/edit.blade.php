@extends('layout.main')
@section('content')

    <div class="row">
        <div class="col-12">
            <h1>@lang('global.scales')</h1>

            <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                <ol class="breadcrumb pt-0">
                    <li class="breadcrumb-item">
                        <span class="default-cursor">@lang('global.master_data')</span>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('scales.index') }}">@lang('global.scales')</a>
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
                        <h5 class="mb-4">@lang('global.edit_scale')</h5>
                    </div>
                    <form action="{{ route('scales.update' , ['id' => $scale->id]) }}" method="post">
                        @csrf
                        @method('put')
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>@lang('global.code') *</label>
                                <input type="text" class="form-control" name="code" value="{{ old('code' , $scale->code) }}" placeholder="@lang('global.code')" autocomplete="off" required>
                                @if($errors->has('code'))
                                    <div id="jQueryName-error" class="error" style="">{{ $errors->first('code') }}</div>
                                @endif
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPassword1">@lang('global.ip_address') *</label>
                                <input type="text" class="form-control" id="inputPassword1" name="ip_address" value="{{ old('ip_address' , $scale->ip_address) }}"
                                       placeholder="@lang('global.ip_address')" autocomplete="off" required>
                                @if($errors->has('ip_address'))
                                    <div id="jQueryName-error" class="error" style="">{{ $errors->first('ip_address') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>@lang('global.limit')</label>
                                <input type="number"
                                       class="form-control"
                                       name="limit"
                                       min="0"
                                       value="{{ old('limit' , $scale->limit) }}"
                                       placeholder="@lang('global.limit')"
                                       autocomplete="off"
                                       >
                                @if($errors->has('limit'))
                                    <div id="jQueryName-error" class="error" style="">{{ $errors->first('limit') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-6">
                                <label>@lang('global.scale_error')</label>
                                <input type="number"
                                       class="form-control"
                                       name="scale_error"
                                       value="{{ old('scale_error' , $scale->scale_error) }}"
                                       min="0"
                                       placeholder="@lang('global.scale_error')"
                                       autocomplete="off"
                                       >
                                @if($errors->has('scale_error'))
                                    <div id="jQueryName-error" class="error" style="">{{ $errors->first('scale_error') }}</div>
                                @endif
                            </div>

                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label>@lang('global.brand') *</label>
                                <input type="text" class="form-control" name="brand" value="{{ old('brand' , $scale->brand) }}" placeholder="@lang('global.brand')" autocomplete="off" required>
                                @if($errors->has('brand'))
                                    <div id="jQueryName-error" class="error" style="">{{ $errors->first('brand') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-4">
                                <label>@lang('global.model')</label>
                                <input type="text" class="form-control" name="model" value="{{ old('model' , $scale->model) }}" placeholder="@lang('global.model')" autocomplete="off">
                                @if($errors->has('model'))
                                    <div id="jQueryName-error" class="error" style="">{{ $errors->first('model') }}</div>
                                @endif
                            </div>


                            <div class="form-group col-md-4">
                                <label>@lang('global.tolerance')</label>
                                <input type="number" class="form-control" min="0" name="tolerance" value="{{ old('tolerance' , $scale->tolerance) }}" placeholder="@lang('global.tolerance')" autocomplete="off" required>
                                @if($errors->has('tolerance'))
                                    <div id="jQueryName-error" class="error" style="">{{ $errors->first('tolerance') }}</div>
                                @endif
                            </div>
                        </div>

                        <hr/>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label>@lang('global.com_port') *</label>
                                <input type="text" class="form-control" name="com_port" value="{{ old('com_port' , $scale->com_port) }}" placeholder="@lang('global.com_port')" autocomplete="off" required>
                                @if($errors->has('com_port'))
                                    <div id="jQueryName-error" class="error" style="">{{ $errors->first('com_port') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-4">
                                <label>@lang('global.baud_rate') *</label>
                                <select class="form-control select2-single" data-placeholder="Select Baud Rate" name="baud_rate" required>
                                    <option label="&nbsp;" value="">  </option>
                                    <option value="75" {{ old('baud_rate' , $scale->baud_rate) == '75' ? 'selected' : '' }}> 75 </option>
                                    <option value="110" {{ old('baud_rate' , $scale->baud_rate) == '110' ? 'selected' : '' }}> 110 </option>
                                    <option value="134" {{ old('baud_rate' , $scale->baud_rate) == '110' ? 'selected' : '' }}> 110 </option>
                                    <option value="150" {{ old('baud_rate' , $scale->baud_rate) == '150' ? 'selected' : '' }}> 134 </option>
                                    <option value="300" {{ old('baud_rate' , $scale->baud_rate) == '300' ? 'selected' : '' }}> 300 </option>
                                    <option value="600" {{ old('baud_rate' , $scale->baud_rate) == '600' ? 'selected' : '' }}> 600 </option>
                                    <option value="1200" {{ old('baud_rate' , $scale->baud_rate) == '1200' ? 'selected' : '' }}> 1200 </option>
                                    <option value="1800" {{ old('baud_rate' , $scale->baud_rate) == '1800' ? 'selected' : '' }}> 1800 </option>
                                    <option value="2400" {{ old('baud_rate' , $scale->baud_rate) == '2400' ? 'selected' : '' }}> 2400 </option>
                                    <option value="4800" {{ old('baud_rate' , $scale->baud_rate) == '4800' ? 'selected' : '' }}> 4800 </option>
                                    <option value="7200" {{ old('baud_rate' , $scale->baud_rate) == '7200' ? 'selected' : '' }}> 7200 </option>
                                    <option value="9600" {{ old('baud_rate' , $scale->baud_rate) == '9600' ? 'selected' : '' }}> 9600 </option>
                                    <option value="14400" {{ old('baud_rate' , $scale->baud_rate) == '14400' ? 'selected' : '' }}> 14400 </option>
                                    <option value="19200" {{ old('baud_rate' , $scale->baud_rate) == '19200' ? 'selected' : '' }}> 19200 </option>
                                    <option value="38400" {{ old('baud_rate' , $scale->baud_rate) == '38400' ? 'selected' : '' }}> 38400 </option>
                                    <option value="57600" {{ old('baud_rate' , $scale->baud_rate) == '57600' ? 'selected' : '' }}> 57600 </option>
                                    <option value="115200" {{ old('baud_rate' , $scale->baud_rate) == '115200' ? 'selected' : '' }}> 115200 </option>
                                    <option value="128000" {{ old('baud_rate' , $scale->baud_rate) == '128000' ? 'selected' : '' }}> 128000 </option>
                                </select>

                                @if($errors->has('baud_rate'))
                                    <div id="jQueryName-error" class="error" style="">{{ $errors->first('baud_rate') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-4">
                                <label>@lang('global.byte_size') *</label>
                                <select class="form-control select2-single" data-placeholder="Select Byte Size" name="byte_size" required>
                                    <option label="&nbsp;" value=""> </option>
                                    <option value="FIVEBITS" {{ old('byte_size' , $scale->byte_size) == 'FIVEBITS' ? 'selected' : '' }}> FIVE BITS </option>
                                    <option value="SIXBITS" {{ old('byte_size' , $scale->byte_size) == 'SIXBITS' ? 'selected' : '' }}> SIX BITS </option>
                                    <option value="SEVENBITS" {{ old('byte_size' , $scale->byte_size) == 'SEVENBITS' ? 'selected' : '' }}> SEVEN BITS </option>
                                    <option value="EIGHTBITS" {{ old('byte_size' , $scale->byte_size) == 'EIGHTBITS' ? 'selected' : '' }}> EIGHT BITS </option>
                                </select>
                                @if($errors->has('byte_size'))
                                    <div id="jQueryName-error" class="error" style="">{{ $errors->first('byte_size') }}</div>
                                @endif
                            </div>

                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label>@lang('global.parity') *</label>
                                <select class="form-control select2-single" data-placeholder="Select Parity" name="parity" required>
                                    <option label="&nbsp;" value=""> </option>
                                    <option value="PARITY_NONE" {{ old('parity' , $scale->parity) == 'PARITY_NONE' ? 'selected' : '' }}> PARITY NONE </option>
                                    <option value="PARITY_EVEN" {{ old('parity' , $scale->parity) == 'PARITY_EVEN' ? 'selected' : '' }}> PARITY EVEN </option>
                                    <option value="PARITY_MARK" {{ old('parity' , $scale->parity) == 'PARITY_MARK' ? 'selected' : '' }}> PARITY MARK </option>
                                    <option value="PARITY_SPACE" {{ old('parity' , $scale->parity) == 'PARITY_SPACE' ? 'selected' : '' }}> PARITY SPACE </option>
                                </select>

                                @if($errors->has('parity'))
                                    <div id="jQueryName-error" class="error" style="">{{ $errors->first('parity') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-4">
                                <label>@lang('global.stop_bits') *</label>
                                <select class="form-control select2-single" data-placeholder="Select Stop Bits" name="stop_bits" required>
                                    <option label="&nbsp;" value=""> </option>
                                    <option value="STOPBITS_ONE" {{ old('stop_bits' , $scale->stop_bits) == 'STOPBITS_ONE' ? 'selected' : '' }}> STOP BITS ONE </option>
                                    <option value="STOPBITS_TWO" {{ old('stop_bits' , $scale->stop_bits) == 'STOPBITS_TWO' ? 'selected' : '' }}> STOP BITS TWO </option>
                                </select>
                                @if($errors->has('stop_bits'))
                                    <div id="jQueryName-error" class="error" style="">{{ $errors->first('stop_bits') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-4">
                                <label>@lang('global.time_out')</label>
                                <input type="number" class="form-control" min="0" name="timeout" value="{{ old('timeout' , $scale->timeout) }}" placeholder="@lang('global.time_out')" autocomplete="off" required>
                                @if($errors->has('timeout'))
                                    <div id="jQueryName-error" class="error" style="">{{ $errors->first('timeout') }}</div>
                                @endif
                            </div>


                        </div>

                        <hr/>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="col-12 col-form-label">@lang('global.is_active')</label>
                                <div class="col-12">
                                    <div class="custom-switch custom-switch-primary-inverse mb-2" style="padding-left: 0">
                                        <input class="custom-switch-input" id="is_active" type="checkbox" value="1" name="is_active" {{ old('is_active') == '1' || is_null(old('is_active')) ? 'checked' : '' }}>
                                        <label class="custom-switch-btn" for="is_active"></label>
                                    </div>
                                    @if($errors->has('is_active'))
                                        <div id="jQueryName-error" class="error" style="">{{ $errors->first('is_active') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-md-12">
                            <div class="float-right">
                                <a href="{{ route('scales.index') }}">
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
