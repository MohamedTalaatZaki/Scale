@extends('layout.main')
@section('content')

    <div class="row">
        <div class="col-12">
            <h1>@lang('global.sample_test')</h1>

            <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                <ol class="breadcrumb pt-0">
                    <li class="breadcrumb-item">
                        <span class="default-cursor">@lang('global.qc')</span>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('samples-test.index') }}">@lang('global.sample_test')</a>
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
                        <h5 class="mb-4">@lang('global.sample_test')</h5>
                    </div>


                    <form action="{{ route('samples-test.store') }}" method="post">
                        @csrf

                        <div class="form-row">

                            <div class="form-group col-md-3">
                                <label>@lang("global.truck_{$transport_detail->plate_name}_#") </label>
                                <input type="text" class="form-control text-center" value="{{ $transport_detail->truck_plates }}" disabled>

                            </div>

                            <div class="form-group col-md-3">
                                <label>@lang('global.item_group')</label>
                                <input type="text" class="form-control text-center" value="{{ optional($transport_detail->testableType)->name }}" disabled>
                            </div>

                            <div class="form-group col-md-3">
                                <label>@lang('global.driver_name')</label>
                                <input type="text" class="form-control text-center" value="{{ optional($transport_detail->transport)->driver_name }}" disabled>
                            </div>

                            <div class="form-group col-md-3">
                                <label>@lang('global.driver_mobile')</label>
                                <input type="text" class="form-control text-center" value="{{ optional($transport_detail->transport)->driver_mobile }}" disabled>
                            </div>
                        </div>

                        <hr/>
                        <div class="form-group row result-div" style="display: none">
                            <div class="col-4"></div>
                            <div class="col-4 bg-dark" style="border-radius: 30px;">
                                <h3 style="margin: 10px;display: none" class="final-accepted text-center text-success"> Accepted </h3>
                                <h3 style="margin: 10px;display: none" class="final-rejected text-center text-danger"> Rejected </h3>
                            </div>
                            <div class="col-4"></div>

                        </div>
                        <table class="table">
                            <thead>
                            <tr>
                                <th style="width: 20%">@lang('global.element_name')</th>
                                <th style="width: 20%">@lang('global.test_type')</th>
                                <th style="width: 20%">@lang('global.sample_range')</th>
                                <th style="width: 20%">@lang('global.element_unit')</th>
                                <th style="width: 10%"></th>
                            </tr>
                            </thead>
                            <tbody data-repeater-list="details">
                                @if(optional(optional(optional($transport_detail->testableType)->qcTestHeader)->details)->count() > 0)
                                    @foreach(optional(optional($transport_detail->testableType)->qcTestHeader)->details->sortByDesc('element.element_type') as $key => $row)
                                        <tr data-repeater-item>
                                            <td>
                                                <input type="text"
                                                       class="form-control form-control-sm bg-readonly test-type"
                                                       name="details[{{ $key }}][element_name]"
                                                       value="{{ $row->element->name }}"
                                                       readonly>
                                            </td>
                                            <td>
                                                <input type="text"
                                                       class="form-control form-control-sm bg-readonly test-type"
                                                       name="details[{{ $key }}][test_type]"
                                                       value="{{ old("details.$key.test_type" , $row['element']['test_type']) }}"
                                                       readonly>
                                            </td>
                                            @if($row->element->element_type == 'question')
                                                <td>
                                                    <select
                                                        class="form-control form-control-sm expected_result" name="details[{{ $key }}][expected_result]" data-expected="{{ $row->expected_result }}">
                                                        <option value="" selected>@lang('global.result')</option>
                                                        <option value="1" {{ old("details.$key.expected_result") === 1 ? "selected" : ""}}>@lang('global.yes')</option>
                                                        <option value="0" {{ old("details.$key.expected_result") === 0 ? "selected" : ""}}>@lang('global.no')</option>
                                                    </select>
                                                    @if($errors->has("details.$key.expected_result"))
                                                        <span id="jQueryName-error" class="error"
                                                              style="">{{ $errors->first("details.$key.expected_result") }}</span>
                                                    @endif
                                                </td>
                                            @else
                                                <td>
                                                    <input type="number" class="form-control form-control-sm sample_range"
                                                           name="details[{{ $key }}][sample_range]" style="display: {{ old("details.$key.element_type" , $row['element']['element_type']) == "range"? "" : "none" }}"
                                                           value="{{ old("details.$key.sample_range") }}" placeholder="@lang('global.sample_range')"
                                                           data-min="{{ $row->min_range }}"
                                                           data-max="{{ $row->max_range }}"
                                                           autocomplete="off">
                                                    @if($errors->has("details.$key.sample_range"))
                                                        <span id="jQueryName-error" class="error"
                                                              style="">{{ $errors->first("details.$key.sample_range") }}</span>
                                                    @endif
                                                </td>
                                            @endif
                                            <td>
                                                <input type="text"
                                                       class="form-control form-control-sm bg-readonly element-unit"
                                                       name="details[{{ $key }}][element_unit]"
                                                       value="{{ old("details.$key.element_unit" , $row['element']['element_unit']) }}"
                                                       style="display: {{ old("details.$key.element_type" , $row['element']['element_type']) == "range"? "" : "none" }}"
                                                       readonly>
                                            </td>
                                            <td>
                                                <div>
                                                    <input type="hidden" value="-1" class="result">
                                                    <a class="accepted" style="display: none"><i class="fas fa-check-circle text-success"></i></a>
                                                    <a class="rejected" style="display: none"><i class="fas fa-times-circle text-danger"></i> </a>
                                                    ( {{ $row->getExpectedResult() }} )
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
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
@push('scripts')
    <script>
        $().ready(function () {
            let detailsCount    =   parseInt("{{ optional(optional(optional($transport_detail->testableType)->qcTestHeader)->details)->count() }}");
            let finalResult     =   -1;
            $('.expected_result').on('change' , function () {
                let value    =   $(this).find('option:selected').val();
                let expected =   $(this).data('expected');
                let tr       =   $(this).closest('tr');

                if(value == expected) {
                    tr.find('.accepted').show();
                    tr.find('.rejected').hide();
                } else {
                    tr.find('.accepted').hide();
                    tr.find('.rejected').show();
                }

                if (value === "") {tr.find('.result').val(-1);}

                overAllResult();
            });

            $('.sample_range').on('change' , function () {
                let value   =   $(this).val();
                let min     =   $(this).data('min');
                let max     =   $(this).data('max');
                let tr      =   $(this).closest('tr');
                if( value >= min && value <= max ) {
                    tr.find('.accepted').show();
                    tr.find('.rejected').hide();
                    tr.find('.result').val(1);
                } else {
                    tr.find('.accepted').hide();
                    tr.find('.rejected').show();
                    tr.find('.result').val(0);
                }

                if (value === "") {tr.find('.result').val(-1);}

                overAllResult();
            });

            overAllResult   =   () => {
                let resultValues  =   $('.result').map(function(index ,elem){
                    let val =   $(elem).val();
                    if (val > -1 ) {
                        return parseInt(val);
                    }
                }).toArray();
                console.log(resultValues.length === detailsCount , resultValues , resultValues.length , detailsCount);
                if(resultValues.length === detailsCount) {
                    finalResult =   resultValues.reduce( (a,b) => a * b );
                    console.log(finalResult);
                    if( finalResult > 0 ) {
                        $('.result-div').show();
                        $('.final-accepted').show();
                        $('.final-rejected').hide();
                    } else if (finalResult === 0) {
                        $('.result-div').show();
                        $('.final-rejected').show();
                        $('.final-accepted').hide();
                    } else {
                        $('.result-div').hide();
                        $('.final-accepted').hide();
                        $('.final-rejected').hide();
                    }
                } else {
                    finalResult =   -1;
                }
            }


        })
    </script>
@endpush
