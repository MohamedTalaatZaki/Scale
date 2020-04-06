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

                    @include('components._validation')
                    <form action="{{ route('samples-test.store') }}" method="post" id="sampleTest">
                        @csrf

                        <input name="check_permission" id="check_permission" type="hidden" value="0">
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
                                <input type="hidden" name="transport_detail_id" value="{{ $transport_detail->id }}">
                                <input type="hidden" name="single" value="{{env('SINGLE_QC')}}">
                                <input type="hidden" name="qc_test_header_id" value="{{ optional(optional($transport_detail->testableType)->qcTestHeader)->id }}">
                                <input type="hidden" name="result" class="final_result" value="">
                                <textarea name="reason" class="final_reason" style="display: none"></textarea>
                                <h3 style="margin: 10px;display: none" class="final-accepted text-center text-success"> @lang('global.accepted') </h3>
                                <h3 style="margin: 10px;display: none" class="final-rejected text-center text-danger"> @lang('global.rejected') </h3>
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
                                        <tr>
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
                                                        class="form-control form-control-sm expected_result result-input"
                                                        name="details[{{ $key }}][sampled_expected_result]"
                                                        data-expected="{{ $row->expected_result }}"
                                                        required
                                                    >
                                                        <option value="" selected>@lang('global.result')</option>
                                                        <option value="1" {{ old("details.$key.sampled_expected_result" , -1) == 1 ? "selected" : ""}}>@lang('global.yes')</option>
                                                        <option value="0" {{ old("details.$key.sampled_expected_result" , -1) == 0 ? "selected" : ""}}>@lang('global.no')</option>
                                                    </select>
                                                    <div style="position: absolute">
                                                        <div class="notify-error"></div>
                                                    </div>
                                                    @if($errors->has("details.$key.expected_result"))
                                                        <span id="jQueryName-error" class="error"
                                                              style="">{{ $errors->first("details.$key.expected_result") }}</span>
                                                    @endif
                                                </td>
                                            @else
                                                <td>
                                                    <input type="number" class="form-control form-control-sm sample_range result-input"
                                                           name="details[{{ $key }}][sampled_range]" style="display: {{ old("details.$key.element_type" , $row['element']['element_type']) == "range"? "" : "none" }}"
                                                           value="{{ old("details.$key.sampled_range") }}" placeholder="@lang('global.sample_range')"
                                                           data-min="{{ $row->min_range }}"
                                                           data-max="{{ $row->max_range }}"
                                                           step="0.0001"
                                                           autocomplete="off"
                                                           required
                                                    >
                                                    <div style="position: absolute">
                                                        <div class="notify-error"></div>
                                                    </div>
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
                                                    <a class="accepted" style="display: none"><i class="fas fa-check-circle text-success"></i></a>
                                                    <a class="rejected" style="display: none"><i class="fas fa-times-circle text-danger"></i> </a>
                                                    ( {{ $row->getExpectedResult() }} )

                                                    <input name="details[{{ $key }}][qc_test_detail_id]" value="{{ $row->id }}" type="hidden">
                                                    <input name="details[{{ $key }}][element_type]" value="{{ optional(optional($row)->element)->element_type }}" type="hidden">
                                                    <input name="details[{{ $key }}][expected_result]" value="{{ optional($row)->expected_result }}" type="hidden">
                                                    <input name="details[{{ $key }}][min_range]" value="{{ optional($row)->min_range }}" type="hidden">
                                                    <input name="details[{{ $key }}][max_range]" value="{{ optional($row)->max_range }}" type="hidden">
                                                    <input name="details[{{ $key }}][element_unit]" value="{{ optional(optional($row)->element)->element_unit }}" type="hidden">
                                                    <input value="-1" class="result" type="hidden" disabled>
                                                    <input name="details[{{ $key }}][result]" value="" class="final-result" type="hidden">

                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                        <hr/>
                        <div class="form-group col-md-12">
                            <div class="text-center">
                                <button class="btn btn-danger mr-5 btn-rejected resultSwal" data-type-result="rejected" data-type="@lang('global.rejected')" data-result="0" style="display: none">@lang('global.rejected')</button>
                                <button class="btn btn-success mr-5 resultSwal" data-type-result="accepted" data-type="@lang('global.accepted')" data-result="1">@lang('global.accepted')</button>
                            </div>
                        </div>
                        <hr/>
                        <div class="form-group col-md-12">
                            <div class="float-right">
                                <a href="{{ route('arrived-trucks.index') }}">
                                    <button type="button" class="btn btn-primary mt-3">@lang('global.cancel')</button>
                                </a>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('scripts')
    <script src="{{ asset('js/sweetalert.js') }}" type="text/javascript"></script>
    <script>
        $().ready(function () {
            let detailsCount    =   parseInt("{{ optional(optional(optional($transport_detail->testableType)->qcTestHeader)->details)->count() }}");
            let finalResult     =   -1;

            if (parseInt("{{ count(old()) }}") > 1)
            {
                setTimeout(()=>{
                    $('.expected_result').trigger('change');
                    $('.sample_range').trigger('keyup');
                } , 1000);
            }

            $('.resultSwal').on('click' , function (evt) {
                evt.preventDefault();

                let swalText    =   $(this).data('type');
                let selected    =   $(this).data('type-result');
                let btnResult   =   parseInt($(this).data('result'));
                let canAcceptRejected = parseInt("{{ Entrust::can('samples-test.acceptRejected') }}");

                if ( !checkResults() )
                {
                    return false;
                }

                if (finalResult > -1) {

                    Swal.fire({
                        title: swalText,
                        text: "@lang('global.are_you_sure')",
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: '@lang('global.save')',
                        cancelButtonText: '@lang('global.cancel')',
                        reverseButtons: true,
                    }).then((result) => {
                        if (result.value && btnResult !== finalResult ) {
                            if (canAcceptRejected === 1)
                            {
                                Swal.fire({
                                    text: '@lang('global.error_expected_result')',
                                    input: 'textarea',
                                    inputAttributes: {
                                        autocapitalize: 'off',
                                        required: true,
                                        id:"reason",
                                    },
                                    inputValidator: (value) => {
                                        if (!value) {
                                            return '@lang('global.write_something')'
                                        }
                                    },
                                    preConfirm: function() {
                                        return new Promise((resolve, reject) => {
                                            resolve({
                                                reason: $('textarea#reason').val(),
                                            });
                                        });
                                    },
                                    showCancelButton: true,
                                    confirmButtonColor: '#3085d6',
                                    cancelButtonColor: '#d33',
                                    confirmButtonText: '@lang('global.save')',
                                    reverseButtons: true,
                                }).then(function (data) {
                                    if(data.value) {
                                        setFinalResultAndSubmit(selected , data.value.reason, true);
                                    }
                                });
                            } else {
                                Swal.fire({
                                    title: "@lang('global.cannot_accept_rejected')",
                                    confirmButtonText: "@lang('global.cancel')",
                                    confirmButtonColor: '#d33',
                                    showCancelButton: false,
                                    reverseButtons: true,
                                });
                            }

                        } else if (result.value && btnResult === finalResult) {
                            setFinalResultAndSubmit(selected);
                        }
                    });

                }
            });

            const setFinalResultAndSubmit  =   (result = "" , reason = "" , checkPermission = false)    =>  {
                $('.final_result').val(result);
                $('.final_reason').val(reason);
                $('#check_permission').val(+ checkPermission);

                $('#sampleTest').submit();
            };

            const checkResults    =   () => {
                let defaultValue    =   true;
                $('.result-input').each(function (index , elem) {
                    if($(elem).val() === "") {
                        defaultValue = false;
                        $(elem).closest('td').find('.notify-error').notify("@lang('global.required')" , 'error');
                    }
                });
                return defaultValue;
            };

            $('.expected_result').on('change' , function () {
                let value    =   $(this).find('option:selected').val();
                let expected =   $(this).data('expected');
                let tr       =   $(this).closest('tr');

                if(value == expected) {
                    tr.find('.accepted').show();
                    tr.find('.rejected').hide();
                    tr.find('.result').val(1);
                    tr.find('.final-result').val('accepted');
                } else {
                    tr.find('.accepted').hide();
                    tr.find('.rejected').show();
                    tr.find('.result').val(0);
                    tr.find('.final-result').val('rejected');
                }

                if (value === "") {
                    tr.find('.accepted').hide();
                    tr.find('.rejected').hide();
                    tr.find('.result').val(-1);
                    tr.find('.final-result').val('');
                }

                overAllResult();
            });

            $('.sample_range').on('keyup' , function () {
                let value   =   parseFloat($(this).val());
                let min     =   parseFloat($(this).data('min'));
                let max     =   parseFloat($(this).data('max'));
                let tr      =   $(this).closest('tr');
                // console.log(value , min , max);
                // console.log(value >= min && value <= max);
                if( value >= min && value <= max ) {
                    tr.find('.accepted').show();
                    tr.find('.rejected').hide();
                    tr.find('.result').val(1);
                    tr.find('.final-result').val('accepted');
                } else {
                    tr.find('.accepted').hide();
                    tr.find('.rejected').show();
                    tr.find('.result').val(0);
                    tr.find('.final-result').val('rejected');
                }

                if (value === "") {
                    tr.find('.accepted').hide();
                    tr.find('.rejected').hide();
                    tr.find('.result').val(-1);
                    tr.find('.final-result').val('');
                }

                overAllResult();
            });

            const overAllResult   =   () => {
                let resultDiv   =   $('.result-div');
                let rejected    =   $('.final-rejected');
                let accepted    =   $('.final-accepted');
                let rejectedBtn =   $('.btn-rejected');
                let resultValues  =   $('.result').map(function(index ,elem){
                    let val =   $(elem).val();
                    if (val > -1 ) {
                        return parseInt(val);
                    }
                }).toArray();

                if(resultValues.length === detailsCount) {
                    finalResult =   resultValues.reduce( (a,b) => a * b );

                    if( finalResult > 0 ) {
                        resultDiv.show();
                        accepted.show();
                        rejected.hide();
                        rejectedBtn.hide();
                    } else if (finalResult === 0) {
                        resultDiv.show();
                        rejected.show();
                        accepted.hide();
                        rejectedBtn.show();
                    } else {
                        resultDiv.hide();
                        accepted.hide();
                        rejected.hide();
                        rejectedBtn.hide();
                    }
                } else {
                    resultDiv.hide();
                    accepted.hide();
                    rejected.hide();
                    rejectedBtn.hide();
                    finalResult =   -1;
                }
            }

        })
    </script>
@endpush
