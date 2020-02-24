@extends('layout.main')
@section('content')

    <form action="{{ route('managerHome')}}" method="get">
        <div class="row">
            {{--    Header Text     --}}
            <div class="col-12">
                <h1>@lang('global.dashboard')</h1>
                <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                    <ol class="breadcrumb pt-0">
                        <li class="breadcrumb-item">
                            <a href="#" class="default-cursor"></a>
                        </li>
                    </ol>
                </nav>
                <div class="separator mb-5"></div>
            </div>

            <div class="col-md-6 col-lg-6 col-sm-12 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">@lang('global.current_line_group')</h5>

                        <div class="scroll dashboard-logs">

                            <table class="table table-sm table-borderless">

                                <tbody>
                                @foreach($lines as $line)
                                    <tr>
                                        <td>
                                            <span class="log-indicator border-theme-1 align-middle"></span>
                                        </td>
                                        <td>
                                            <span class="font-weight-medium">{{ $line->name }}</span>
                                        </td>
                                        <td class="text-right">
                                            <span class="text-semi-muted">{{ $line->group_name }}</span>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            {{--    Filter     --}}
            <div class="col-lg-6 col-md-6 col-ms-12 mb-4">
                <div class="card h-100 mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Filters</h5>

                        @include('dashboard.filters.from-to-date')
                        @include('dashboard.filters.item-type')
                        @include('dashboard.filters.item-groups')

                        <div class="input-group justify-content-center align-self-center">
                            <button type="submit" class="btn btn-success mr-5">@lang('global.search')</button>
                            <a href="{{ route('managerHome') }}" class="btn btn-danger">@lang('global.reset')</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-12 col-sm-12 mb-4">
                <div class="card dashboard-progress">
                    <div class="position-absolute card-top-buttons">

                    </div>

                    <div class="card-body">
                        <h5 class="card-title">@lang('global.production')</h5>
                        <div class="mb-4">
                            <p class="mb-2">
                                <span>@lang('global.total_weight')</span>
                                <span class="float-right text-muted">{{ $weightLines->sum('weight') / 1000 }} @lang('global.tons')</span>
                            </p>
                            <p class="mb-2">
                                <span>@lang('global.purchases')</span>
                                <span class="float-right text-muted">{{ $total_trucks }} </span>
                            </p>
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="0"
                                     aria-valuemax="100"></div>
                            </div>
                        </div>
                        @foreach($weightLines as $lineName => $line)
                            <div class="mb-4">
                                <p class="mb-2">{{ $lineName }}
                                    <span class="float-right text-muted">{{ $line->weight / 1000 }} @lang('global.tons')</span>
                                </p>
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" aria-valuenow="{{ $line->percentage }}" aria-valuemin="0"
                                         aria-valuemax="100"></div>
                                </div>
                            </div>
                        @endforeach

                    </div>

                </div>
            </div>


        </div>


    </form>
@endsection
@push('scripts')
    <script src="{{ asset('js/customCharts.js') }}"></script>
    <script>
        $().ready(function () {
            $(".start_date").datetimepicker({
                theme: '{{ Auth::user()->theme }}',
                format : 'Y-m-d h:m',
                onChangeDateTime: function (evt) {
                    $('#toDateInput').val('');
                }
            });

            $(".end_date").datetimepicker({
                theme: '{{ Auth::user()->theme }}',
                format : 'Y-m-d h:m',
                onShow:function( ct ){
                    this.setOptions({
                        minDate:jQuery('#fromDateInput').val()
                    })
                },
            });

            $('#ItemTypeFilter,#itemGroupFilter').on('change', function (evt) {
                evt.preventDefault();
                let ItemTypeFilter = $('#ItemTypeFilter');
                let itemGroupFilter = $('#itemGroupFilter');
                let itemGroupValue = itemGroupFilter.val();
                $.ajax({
                    method: "post",
                    url: "{{ route('dashboard.suppliersItemGroup') }}",
                    data: {
                        _token: "{{ csrf_token() }}",
                        filter_item_type: ItemTypeFilter.val(),
                        filter_item_group: itemGroupFilter.val()
                    },
                    success: (response) => {
                        let itemGroupFilter = $('#itemGroupFilter');
                        let suppliersFilter = $('#suppliersFilter');
                        if (response.suppliers) {
                            itemGroupFilter.empty().append('<option label="&nbsp;">&nbsp;</option>');
                            suppliersFilter.empty().append('<option label="&nbsp;">&nbsp;</option>');
                            $.each(response.item_groups, function (index, group) {
                                let option = '<option value="' + group.id + '"> ' + group.name + ' </option>';
                                itemGroupFilter.append(option);
                            });

                            $.each(response.suppliers, function (index, supplier) {
                                let option = '<option value="' + supplier.id + '"> ' + supplier.name + ' </option>';
                                suppliersFilter.append(option);
                            })

                            itemGroupFilter.find('option[value="' + itemGroupValue + '"]').attr('selected', true);
                        }
                    }
                })
            });
        });
    </script>
@endpush
