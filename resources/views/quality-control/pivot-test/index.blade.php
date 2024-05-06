@extends('layout.main')
@section('content')

    <div class="row">
        <div class="col-12">
        @include('components._validation')
            <h1>@lang('global.tested_trucks')</h1>
            <div class="text-zero top-right-button-container">
            </div>
            <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                <ol class="breadcrumb pt-0">
                    <li class="breadcrumb-item">
                        <span class="default-cursor">@lang('global.qc')</span>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('pivot-test.index') }}">@lang('global.results_detail')</a>
                    </li>
                </ol>
            </nav>
            <div class="separator mb-5"></div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">@lang('global.export')</h4>

                    <form action="{{route('exportTestedTruckExcel')}}" id="searchForm">

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group ">
                                    <label class="col-md-12 control-label">@lang('global.from_date')</label>
                                    <input type="text"  required class="form-control datepicker" data-date-format="yyyy-mm-dd" placeholder="{{trans('global.from_date')}}"
                                           name="from_date" value="{{request()->input('from_date')}}"
                                           autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group ">
                                    <label class="col-md-12 control-label">@lang('global.to_date')</label>
                                    <input type="text" required class="form-control datepicker" data-date-format="yyyy-mm-dd" placeholder="{{trans('global.to_date')}}"
                                           name="to_date" value="{{request()->input('to_date')}}"
                                           autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group ">
                                    <label class="col-md-12 control-label">@lang('global.item_group')</label>
                                    <select required class="form-control select2-single" name="item_group_id">
                                        <option value=""> &nbsp;</option>
                                        @foreach($groups as $group)
                                            <option value="{{ $group->id }}" {{ request()->input('item_group_id') == $group->id ? "selected" : "" }}>{{ $group->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                          
                        </div>

                        <div class="row">
                            <div class="form-group col-md-12">
                                <div class="text-center">
                                    <a href="{{ route('pivot-test.index') }}">
                                        <button type="button"
                                                class="btn btn-danger btn-sm mt-3">@lang('global.clear_filters')</button>
                                    </a>

                                   
                                        <button type="submit"
                                                class="btn btn-success btn-sm mt-3">@lang('global.export')</button>
                                    
                                </div>

                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <br/>

@endsection
