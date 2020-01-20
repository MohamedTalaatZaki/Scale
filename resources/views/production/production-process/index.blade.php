@extends('layout.main')
@section('content')

    <div class="row">
        <div class="col-12">
            <h1>@lang('global.raw_process')</h1>
            <div class="text-zero top-right-button-container">

            </div>
            <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                <ol class="breadcrumb pt-0">
                    <li class="breadcrumb-item">
                        <span class="default-cursor">@lang('global.production')</span>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('production-process.index') }}">@lang('global.raw_process')</a>
                    </li>
                </ol>
            </nav>
            <div class="separator mb-5"></div>
        </div>
    </div>
    @include('components._validation')

    @include('production.production-process.partial._start')
    @include('production.production-process.partial._finish')


@endsection
@push('scripts')
    <script src="{{ asset('js/swal.js') }}"></script>
    <script>
        $().ready(function(){
            $('body,#discount_percent').on('keyup' , function (evt) {
                let value = $('#discount_percent').val();
                if (value < 0 || value > 100)
                {
                    $('#discount_percent').val('');
                    $('#discount_percent').notify("{{ trans('global.discount_perc_required') }}" , 'error');
                }
            });

            $('#startModal').on('show.bs.modal' , function (event) {
                let detail_id   =   $(event.relatedTarget).data('detail-id');
                let supplier    =   $(event.relatedTarget).data('supplier-id');
                let itemGroupId =   $(event.relatedTarget).data('item-group-id');
                let itemsGroupSelect    =   $(this).find('.itemsGroupSelect');

                $(this).find('#detail_id').val(detail_id);
                $(this).find('#supplier_id').val(supplier);
                $('.day').val(moment().format('DD'));
                $('.month').val(moment().format('MM'));
                $('.year').val("0"+moment().format('YY'));

                $.ajax({
                    method: 'GET',
                    url:    "{{ route('getSupplierItemGroups') }}",
                    data:   { _token: "{{ csrf_token() }}" , id : supplier},
                    success : (response)    =>  {
                        itemsGroupSelect.empty();
                        let option = "<option value='' selected></option>";
                        itemsGroupSelect.append(option);
                        $.each(response.itemGroups , function (index , itemGroup) {
                            let option = "<option value='"+index+"'>"+ itemGroup +"</option>";
                            itemsGroupSelect.append(option);
                        });
                        reInitSelect2("#itemsGroupSelect");
                        itemsGroupSelect.val(itemGroupId).trigger('change');
                    }
                });

                $('.batchNumStr').trigger('keyup');
            });

            $('#itemsGroupSelect').on('change' , function(){
                let itemGroupId =   $(this).val();
                let supplierId  =   $('#supplier_id').val();
                let itemsSelect =   $('#itemsSelect');
                let itemId      =   $('#item_id').val();
                $.ajax({
                    method: 'post',
                    url: "{{ route('getSupplierItemByGroup') }}",
                    data:   {_token : "{{ csrf_token() }}" , itemGroupId : itemGroupId , supplierId : supplierId},
                    success : (response) => {
                        itemsSelect.empty();
                        let option = "<option value='' selected></option>";
                        itemsSelect.append(option);
                        $.each(response.items , function (index , item) {
                            let option = "<option value='"+index+"'>"+ item +"</option>";
                            itemsSelect.append(option);
                        });
                        reInitSelect2("#itemsSelect");
                    }
                })
            });

            $('.last_batch').on('click' , function () {
                $.ajax({
                    method  :   "post",
                    url   :   "{{ route('getLastBatch') }}",
                    data    :   {_token : "{{ csrf_token() }}"},
                    success :   (LastBatch)  =>  {
                        $('.batch_num').val(LastBatch);
                    }
                })
            });

            $('.batchNumStr').on('keyup' , function () {
                let number  =   '';
                $.each($('.batchNumStr') , function (index , elem) {
                    number += $(elem).val();
                });
                $('#batchNumberStr').text(number);
                $('#batch_number').val(number);
            });

            $('.finishBtn').on('click' , function () {
                let detailId    =   $(this).data('detail-id');
                Swal.fire({
                    title: "{{ trans('global.has_discount') }}",
                    html: "" +
                        "<input class='form-control' id='discount_percent' type='number' style='background-color: white;color: black;font-weight: bolder'>" +
                        "<br/>" +
                        "<h2>@lang('global.note')</h2><textarea id='finish_comment' class='form-control' style='background-color: white;color: black;font-weight: bolder'> </textarea>" +
                        "<br/> <div class='form-check'>\n" +
                        "<input type='checkbox' class='form-check-input' id='lineIsDelay' style='width:20px; height:20px;'>\n" +
                        "<label class='form-check-label'><span style='font-weight: bolder'>@lang('global.line_is_delay')</span></label>\n" +
                        "</div>",
                    showCancelButton: true,
                    confirmButtonText: '{{trans('global.save')}}',
                    cancelButtonText: '{{trans('global.cancel')}}',
                    showLoaderOnConfirm: true,
                    preConfirm: () => {
                        let discount = $('#discount_percent').val();
                        if (parseFloat(discount) >= 0) {
                          return true;
                        } else {
                            Swal.showValidationMessage("{{ trans('global.discount_perc_required') }}");
                        }
                    },
                    allowOutsideClick: () => !Swal.isLoading()
                }).then((result) => {
                    if (result.value) {
                        let discount       = $('#discount_percent').val();
                        let finish_comment = $('#finish_comment').val();
                        let lineIsDelay    = $('#lineIsDelay').is(':checked');

                        $.ajax({
                            url:    "{{ route('finishProcess') }}",
                            method: "post",
                            data: {_token: "{{ csrf_token() }}" ,
                                detail_id : detailId,
                                discount : discount,
                                finish_comment : finish_comment,
                                line_is_delay: + lineIsDelay
                            },
                            success:    ()  =>  {
                                $('#detail_'+detailId).remove();
                                Swal.fire(
                                    '{{ trans('global.production_done') }}',
                                    '',
                                    'success'
                                )
                            }
                        });
                    }
                });
            });
            function reInitSelect2(selector) {
                $(selector).select2('destroy');
                $(selector).select2({
                    theme: "bootstrap",
                    maximumSelectionSize: 6,
                    containerCssClass: ":all:"
                });
            }
        })
    </script>
@endpush
