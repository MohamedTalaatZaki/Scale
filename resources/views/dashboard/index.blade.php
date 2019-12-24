@extends('layout.main')
@section('content')
    <form action="{{ route('home')}}" method="get">
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

            {{--    Counters And Table     --}}
            <div class="col-lg-6 col-xl-6">

                <div class="icon-cards-row">
                    <div class="owl-container">
                        <div class="owl-carousel dashboard-numbers">
                            @include('dashboard.widgets.counters.arrived-tons')
                            @include('dashboard.widgets.counters.waiting-tons')
                            @include('dashboard.widgets.counters.sampled-tons')
                            @include('dashboard.widgets.counters.inprocess-tons')
                            @include('dashboard.widgets.counters.departed-tons')
                            @include('dashboard.widgets.counters.accepted-tons')
                            @include('dashboard.widgets.counters.rejected-tons')
                            @include('dashboard.widgets.counters.cancelled-tons')
                        </div>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">@lang('global.qc_result')</h5>
                        <div class="dashboard-donut-chart chart">
                            <canvas id="rawChart" width="402" height="270" class="chartjs-render-monitor"
                                    style="display: block; width: 402px; height: 270px;"></canvas>
                        </div>
                    </div>
                </div>

            </div>

            {{--    Filter     --}}
            <div class="col-lg-6 col-md-12 col-ms-12 mb-4">
                <div class="card h-100 mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Filters</h5>

                        @include('dashboard.filters.from-to-date')
                        @include('dashboard.filters.item-type')
                        @include('dashboard.filters.item-groups')
                        @include('dashboard.filters.suppliers')
                        <div class="input-group justify-content-center align-self-center">
                            <button type="submit" class="btn btn-success mr-5">@lang('global.search')</button>
                            <a href="{{ route('home') }}" class="btn btn-danger">@lang('global.reset')</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="row">

            <div class="col-md-12 col-lg-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">@lang('global.suppliers')</h5>
                        <div class="dashboard-donut-chart chart">
                            <canvas id="topSuppliersChart" width="402" height="270" class="chartjs-render-monitor"
                                    style="display: block; width: 402px; height: 270px;"></canvas>
                            <input type="hidden" data-data="{{ $topSuppliers }}" id="topSuppliers">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-lg-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">@lang('global.lines_weight')</h5>
                        <div class="dashboard-donut-chart chart">
                            <canvas id="linesWeightChart" width="402" height="270" class="chartjs-render-monitor"
                                    style="display: block; width: 402px; height: 270px;"></canvas>
                            <input type="hidden" data-data="{{ $linesWeight }}" id="linesWeight">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{--    Doughnut Charts     --}}
        <div class="row">
            <div class="col-md-12 col-lg-12 mb-4">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">@lang('global.transport_lines')
                            ( {{ $transportLines->count() }} @lang('global.from') {{ $transportLines->total() }} )
                            @lang('global.total_weight') = <span style="color: green">{{ $transportLinesWeight }} @lang('global.kilogram')</span>

                        </h5>
                        <div id="DataTables_Table_0_wrapper"
                             class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                            <div class="row view-filter">
                                <div class="col-sm-12">
                                    <div class="float-left"></div>
                                    <div class="float-right"></div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <table class="table responsive">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>@lang('global.truck_plate')</th>
                                    <th>@lang('global.item_group')</th>
                                    <th>@lang('global.lines')</th>
                                    <th>@lang('global.batch_number')</th>
                                    <th>@lang('global.supplier_name')</th>
                                    <th>@lang('global.weight')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($transportLines as $line)
                                    <tr role="row" class="{{$loop->iteration % 2 > 0 ? "odd" : "even" }}">
                                        <td>
                                            {{ $loop->iteration }}
                                        </td>
                                        <td>
                                            {{ optional($line->transportDetail)->truck_plates }}
                                        </td>
                                        <td>
                                            {{ optional(optional($line->transportDetail)->ItemGroup)->name }}
                                        </td>
                                        <td>
                                            {{ optional($line->line)->name }}
                                        </td>
                                        <td>
                                            {{ $line->batch_number }}
                                        </td>
                                        <td>
                                            {{ optional(optional(optional($line->transportDetail)->transport)->supplier)->name }}
                                        </td>
                                        <td>
                                            {{ $line->weight }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td>No Data</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="text-center m-0 m-auto">
                                {{ $transportLines->appends(request()->query())->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        {{--    Bar Charts     --}}
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="mb-4">@lang('global.qc')</h5>
                        <div class="row">
                            <div class="col-5">
                                <div class="form-group">
                                    <select class="form-control select2-single" name="filter_batch_number">
                                        <option label="&nbsp;"></option>
                                        @foreach($transportLines->groupBy('batch_number') as $key => $line)
                                            <option value="{{ $key }}" {{ request()->input('filter_batch_number') == $key? "selected" : "" }}>
                                                {{ $key }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-5">
                                <div class="form-group">
                                    <select class="form-control select2-single" name="filter_qc_element">
                                        <option label="&nbsp;"></option>
                                        @foreach($qcElements as $element)
                                            <option value="{{ $element->en_name }}" {{ request()->input('filter_qc_element') == $element->en_name ? "selected" : "" }}>
                                                {{ $element->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-block btn-sm"><i
                                            class="fa fa-calculator"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 mb-5">
                                <h6 class="mb-4">@lang('global.degree')</h6>
                                <div class="chart-container chart">
                                    <canvas id="qcResultsChart"></canvas>
                                    <input type="hidden"
                                           data-labels="{{ $qcResultsLabels }}"
                                           data-data="{{ $qcResultsData }}"
                                           id="qcResults">
                                </div>
                            </div>
                        </div>
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
            $(".datetimePicker").datetimepicker({
                theme: '{{ Auth::user()->theme }}',
                format : 'Y-m-d h:m'
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

            if ("{{ request()->input('filter_item_type') }}" == 'raw') {
                let rawChart = initCharts('rawChart', {
                    labels: ["@lang('global.sampled')", "@lang('global.accepted')", "@lang('global.rejected')"],
                    datasets: [
                        {
                            label: "",
                            borderColor: [themeColor1, '#28a745', '#dc3545'],
                            backgroundColor: [
                                themeColor1_10,
                                themeColor2_10,
                                themeColor3_10
                            ],
                            borderWidth: 2,
                            data: ["{{ $sampledCounters->count() }}", "{{$acceptedCounters->count()}}", "{{ $rejectedCounters->count() }}"]
                        }
                    ]
                });
            } else {
                let rawChart = initCharts('rawChart', {
                    labels: ["@lang('global.accepted')"],
                    datasets: [
                        {
                            label: "",
                            borderColor: ['#28a745'],
                            backgroundColor: [
                                themeColor1_10,
                            ],
                            borderWidth: 2,
                            data: ["{{ $waitingCounters->count() }}"]
                        }
                    ]
                });
            }

            //topSuppliers
            let supplier_border_color = [themeColor1, themeColor2, themeColor3, themeColor4];
            let supplier_labels = [];
            let supplier_data = [];
            let topSuppliers = $('#topSuppliers').data('data');
            $.each(topSuppliers, function (supplier, weight) {
                supplier_labels.push(supplier);
                supplier_data.push(weight);
            });

            let supplierChart = initCharts('topSuppliersChart', {
                labels: supplier_labels,
                datasets: [
                    {
                        label: "",
                        borderColor: supplier_border_color,
                        backgroundColor: [
                            themeColor1_10,
                            themeColor2_10,
                            themeColor4_10,
                            themeColor3_10
                        ],
                        borderWidth: 2,
                        data: supplier_data
                    }
                ]
            });

            //linesWeight

            let linesWeight_border_color = [themeColor1, themeColor2, themeColor3, themeColor4];
            let linesWeight_labels = [];
            let linesWeight_data = [];
            let linesWeight = $('#linesWeight').data('data');
            $.each(linesWeight, function (line, weight) {
                linesWeight_labels.push(line);
                linesWeight_data.push(weight);
            });

            let linesWeightChart = initCharts('linesWeightChart', {
                labels: linesWeight_labels,
                datasets: [
                    {
                        label: "",
                        borderColor: linesWeight_border_color,
                        backgroundColor: [
                            themeColor1_10,
                            themeColor2_10,
                            themeColor4_10,
                            themeColor3_10
                        ],
                        borderWidth: 2,
                        data: linesWeight_data
                    }
                ]
            });


            //
            let productChart = document.getElementById('qcResultsChart');
            let labels       =  $('#qcResults').data('labels');
            let data         =  $('#qcResults').data('data');
            console.log(labels , data)
            new Chart(productChart, {
                type: "line",
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        xAxes: [
                            {
                                ticks: {
                                    autoSkip: false,
                                    maxRotation: 90,
                                    minRotation: 90
                                },
                                gridLines: {
                                    display: false
                                }
                            }
                        ]
                    },
                    legend: {
                        position: "bottom",
                        labels: {
                            padding: 30,
                            usePointStyle: true,
                            fontSize: 12
                        }
                    },
                    tooltips: chartTooltip
                },
                data: {
                    labels: labels,
                    datasets: [
                        {
                            label: "{{ request()->input('filter_qc_element') }}",
                            borderColor: themeColor2,
                            backgroundColor: themeColor2_10,
                            data: data,
                            borderWidth: 2
                        }
                    ]
                }
            });

        });
    </script>
@endpush
