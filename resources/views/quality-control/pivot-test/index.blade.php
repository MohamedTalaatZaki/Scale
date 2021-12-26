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
                        <a href="{{ route('pivot-test.index') }}">@lang('global.tested_trucks')</a>
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

                    <form action="{{route('pivot-test.index')}}" id="searchForm">

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group ">
                                    <label class="col-md-12 control-label">@lang('global.from_date')</label>
                                    <input type="text" class="form-control datepicker" data-date-format="yyyy-mm-dd" placeholder="{{trans('global.from_date')}}"
                                           name="from_date" value="{{request()->input('from_date')}}"
                                           autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group ">
                                    <label class="col-md-12 control-label">@lang('global.to_date')</label>
                                    <input type="text" class="form-control datepicker" data-date-format="yyyy-mm-dd" placeholder="{{trans('global.to_date')}}"
                                           name="to_date" value="{{request()->input('to_date')}}"
                                           autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group ">
                                    <label class="col-md-12 control-label">@lang('global.item_group')</label>
                                    <select class="form-control select2-single" name="item_group_id">
                                        <option value=""> &nbsp;</option>
                                        @foreach($groups as $group)
                                            <option value="{{ $group->id }}" {{ request()->input('item_group_id') == $group->id ? "selected" : "" }}>{{ $group->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group ">
                                    <label class="col-md-12 control-label">@lang('global.result')</label>
                                    <select class="form-control select2-single" name="result">
                                        <option value=""> &nbsp;</option>
                                            <option value="accepted" {{ request()->input('result') == 'accepted' ? "selected" : "" }}>@lang('global.accepted')</option>
                                            <option value="rejected" {{ request()->input('result') == 'rejected' ? "selected" : "" }}>@lang('global.rejected')</option>
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
                                            class="btn btn-primary btn-sm mt-3">@lang('global.search')
                                    </button>
                                    @if(!empty($sampleTestHeaders))
                                    <a href="{{ route('qc-pivot-rpt.index', $user) }}" target="_blank">
                                        <button type="button"
                                                class="btn btn-success btn-sm mt-3">@lang('global.print')</button>
                                    </a>
                                    @endif
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
                            <th>@lang('global.date')</th>
                            <th>@lang('global.time')</th>
                            <th>@lang('global.truck_plate')</th>
                            <th>@lang('global.decision')</th>
                            <th>Brix</th>
                            <th>Acidity</th>
                            <th>Ratio</th>
                            <th>pH</th>
                            <th>Mold Precense</th>
                            <th>Damaged</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($sampleTestHeaders as $header)
                            <tr>
                                <td>{{ ( ( $sampleTestHeaders->currentPage() - 1) * $sampleTestHeaders->perPage() ) + $loop->iteration }}</td>
                                <td>{{ $header->test_date }}</td>
                                <td>{{ $header->test_time }}</td>
                                <td>{{ $header->truck_plates }}</td>
                                <td>{{ $header->result }}</td>
                                <td>{{ $header->brix }}</td>
                                <td>{{ $header->acidity }}</td>
                                <td>{{ $header->ratio }}</td>
                                <td>{{ $header->ph }}</td>
                                <td>{{ $header->mold }}</td>
                                <td>{{ $header->damaged }}</td>
                                <td>
                                    <a href="{{ route('qc-analysis-rpt.index',['test_id'=>$header->id]) }}" class="btn btn-primary btn-sm" target="_blank">@lang('global.print')
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="12" class="text-center text-warning font-weight-bold">@lang('global.no_data')</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
    @if(!empty($sampleTestHeaders))
    <div class="row">
        <div class="col-12 list">
            {{ $sampleTestHeaders->appends(request()->query())->links() }}
        </div>
    </div>
    @endif
@endsection
