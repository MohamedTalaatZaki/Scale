@extends('layout.main')
@section('content')

    <div class="row">
        <div class="col-12">
            <h1>@lang('global.tested_trucks')</h1>
            <div class="text-zero top-right-button-container">
            </div>
            <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                <ol class="breadcrumb pt-0">
                    <li class="breadcrumb-item">
                        <span class="default-cursor">@lang('global.qc')</span>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('samples-test.index') }}">@lang('global.tested_trucks')</a>
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
                    <h4 class="card-title">@lang('global.search')</h4>

                    <form action="{{route('samples-test.index')}}" id="searchForm">

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group ">
                                    <label class="col-md-12 control-label">@lang('global.truck_plate')</label>
                                    <input type="text" class="form-control onlyAr" placeholder="{{trans('global.truck_plate')}}"
                                           name="truck_plates" value="{{request()->input('truck_plates')}}"
                                           autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group ">
                                    <label class="col-md-12 control-label">@lang('global.supplier')</label>
                                    <select class="form-control select2-single" name="supplier_id">
                                        <option value="&nbsp;"> &nbsp;</option>
                                        @foreach($suppliers as $suppler)
                                            <option value="{{ $suppler->id }}" {{ request()->input('supplier_id') == $suppler->id ? "selected" : "" }}>{{ $suppler->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group ">
                                    <label class="col-md-12 control-label">@lang('global.qc_test_name')</label>
                                    <select class="form-control select2-single" name="qc_test_id">
                                        <option value="&nbsp;"> &nbsp;</option>
                                        @foreach($qc_tests as $qc_test)
                                            <option value="{{ $qc_test->id }}" {{ request()->input('qc_test_id') == $qc_test->id ? "selected" : "" }}>{{ $qc_test->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group ">
                                    <label class="col-md-12 control-label">@lang('global.created_by')</label>
                                    <select class="form-control select2-single" name="user_id">
                                        <option value="&nbsp;"> &nbsp;</option>
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}" {{ request()->input('user_id') == $user->id ? "selected" : "" }}>{{ $user->full_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group ">
                                    <label class="col-md-12 control-label">@lang('global.from_date')</label>
                                    <input type="text" class="form-control datepicker" data-date-format="yyyy-mm-dd" placeholder="{{trans('global.from_date')}}"
                                           name="from_date" value="{{request()->input('from_date')}}"
                                           autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group ">
                                    <label class="col-md-12 control-label">@lang('global.to_date')</label>
                                    <input type="text" class="form-control datepicker" data-date-format="yyyy-mm-dd" placeholder="{{trans('global.to_date')}}"
                                           name="to_date" value="{{request()->input('to_date')}}"
                                           autocomplete="off">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-12">
                                <div class="text-center">
                                    <a href="{{ route('samples-test.index') }}">
                                        <button type="button"
                                                class="btn btn-danger btn-sm mt-3">@lang('global.clear_filters')</button>
                                    </a>
                                    <button type="submit"
                                            class="btn btn-primary btn-sm mt-3">@lang('global.search')</button>
                                </div>

                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <br/>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    @include('components._validation')
                    <table class="table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>@lang('global.truck_plate')</th>
                            <th>@lang('global.driver_name')</th>
                            <th>@lang('global.driver_mobile')</th>
                            <th>@lang('global.supplier_name')</th>
                            <th>@lang('global.qc_test_name')</th>
                            <th>@lang('global.result')</th>
                            <th>@lang('global.created_by')</th>
                            <th>@lang('global.created_at')</th>
                            <th>@lang('global.is_retest')</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($sampleTestHeaders as $header)
                            <tr>
                                <td>{{ ( ( $sampleTestHeaders->currentPage() - 1) * $sampleTestHeaders->perPage() ) + $loop->iteration }}</td>
                                <td>{{ $header->transportDetail->truck_plates }}</td>
                                <td>{{ $header->transportDetail->transport->driver_name }}</td>
                                <td>{{ $header->transportDetail->transport->driver_mobile }}</td>
                                <td>{{ $header->transportDetail->transport->supplier->name }}</td>
                                <td>{{ optional($header->qcTestHeader)->name }}</td>
                                <td>{{ trans("global.{$header->result}") }}</td>
                                <td>{{ $header->createdBy->full_name }}</td>
                                <td>{{ $header->created_at }}</td>
                                <td><i class="simple-icon-{{ $header->test_type == 'r' ? 'check' : 'close' }}"></i></td>
                                <td>
                                    <a href="{{ route('qc-analysis-rpt.index',['test_id'=>$header->id]) }}" class="btn btn-primary btn-sm" target="_blank">@lang('global.print')
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-warning font-weight-bold">@lang('global.no_data')</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 list">
            {{ $sampleTestHeaders->appends(request()->query())->links() }}
        </div>
    </div>
@endsection
