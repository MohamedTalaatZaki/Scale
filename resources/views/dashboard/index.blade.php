@extends('layout.main')
@section('content')

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
        <div class="col-6 mb-4">
            <div class="card h-100 mb-4">
                <div class="card-body">
                    <h5 class="card-title">Filters</h5>
                    <form action="{{ route('home')}}" method="get">
                        @include('dashboard.filters.from-to-date')
                        @include('dashboard.filters.item-type')
                        @include('dashboard.filters.item-groups')
                        @include('dashboard.filters.suppliers')
                        <div class="input-group justify-content-center align-self-center">
                            <button type="submit" class="btn btn-success mr-5">@lang('global.search')</button>
                            <a href="{{ route('home') }}" class="btn btn-danger">@lang('global.reset')</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

    {{--    Doughnut Charts     --}}
    <div class="row">
        <div class="col-md-12 col-lg-12 mb-4">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Table</h5>
                    <div id="DataTables_Table_0_wrapper"
                         class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                        <div class="row view-filter">
                            <div class="col-sm-12">
                                <div class="float-left"></div>
                                <div class="float-right"></div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <table class="data-table data-table-standard responsive nowrap dataTable no-footer dtr-inline"
                               data-order="[[ 1, &quot;desc&quot; ]]" id="DataTables_Table_0" role="grid"
                               style="width: 635px;">
                            <thead>
                            <tr role="row">
                                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                    colspan="1" style="width: 217px;"
                                    aria-label="Name: activate to sort column ascending">
                                </th>
                                <th class="sorting_desc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                    colspan="1" style="width: 82px;" aria-sort="descending"
                                    aria-label="Sales: activate to sort column ascending">
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                    colspan="1" style="width: 86px;"
                                    aria-label="Stock: activate to sort column ascending">
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                    colspan="1" style="width: 126px;"
                                    aria-label="Category: activate to sort column ascending">
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr role="row" class="odd">
                                <td tabindex="0">
                                    <p class="list-item-heading"></p>
                                </td>
                                <td class="sorting_1">
                                    <p class="text-muted"></p>
                                </td>
                                <td>
                                    <p class="text-muted"></p>
                                </td>
                                <td>
                                    <p class="text-muted"></p>
                                </td>
                            </tr>
                            <tr role="row" class="even">
                                <td tabindex="0">
                                    <p class="list-item-heading"></p>
                                </td>
                                <td class="sorting_1">
                                    <p class="text-muted"></p>
                                </td>
                                <td>
                                    <p class="text-muted"></p>
                                </td>
                                <td>
                                    <p class="text-muted"></p>
                                </td>
                            </tr>
                            <tr role="row" class="odd">
                                <td tabindex="0">
                                    <p class="list-item-heading"></p>
                                </td>
                                <td class="sorting_1">
                                    <p class="text-muted"></p>
                                </td>
                                <td>
                                    <p class="text-muted"></p>
                                </td>
                                <td>
                                    <p class="text-muted"></p>
                                </td>
                            </tr>
                            <tr role="row" class="even">
                                <td tabindex="0">
                                    <p class="list-item-heading"></p>
                                </td>
                                <td class="sorting_1">
                                    <p class="text-muted"></p>
                                </td>
                                <td>
                                    <p class="text-muted"></p>
                                </td>
                                <td>
                                    <p class="text-muted"></p>
                                </td>
                            </tr>
                            <tr role="row" class="odd">
                                <td tabindex="0">
                                    <p class="list-item-heading"></p>
                                </td>
                                <td class="sorting_1">
                                    <p class="text-muted"></p>
                                </td>
                                <td>
                                    <p class="text-muted"></p>
                                </td>
                                <td>
                                    <p class="text-muted"></p>
                                </td>
                            </tr>
                            <tr role="row" class="even">
                                <td tabindex="0">
                                    <p class="list-item-heading"></p>
                                </td>
                                <td class="sorting_1">
                                    <p class="text-muted"></p>
                                </td>
                                <td>
                                    <p class="text-muted"></p>
                                </td>
                                <td>
                                    <p class="text-muted"></p>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-md-12 col-lg-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Raw Categories</h5>
                    <div class="dashboard-donut-chart chart">
                        <div class="chartjs-size-monitor"
                             style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;">
                            <div class="chartjs-size-monitor-expand"
                                 style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                <div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div>
                            </div>
                            <div class="chartjs-size-monitor-shrink"
                                 style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                <div style="position:absolute;width:200%;height:200%;left:0; top:0"></div>
                            </div>
                        </div>
                        <canvas id="categoryChartNoShadowtest" width="402" height="270" class="chartjs-render-monitor"
                                style="display: block; width: 402px; height: 270px;"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-lg-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Product Categories</h5>
                    <div class="dashboard-donut-chart chart">
                        <div class="chartjs-size-monitor"
                             style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;">
                            <div class="chartjs-size-monitor-expand"
                                 style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                <div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div>
                            </div>
                            <div class="chartjs-size-monitor-shrink"
                                 style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                <div style="position:absolute;width:200%;height:200%;left:0; top:0"></div>
                            </div>
                        </div>
                        <canvas id="categoryChartNoShadow" width="402" height="270" class="chartjs-render-monitor"
                                style="display: block; width: 402px; height: 270px;"></canvas>
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
                    <h5 class="mb-4">Items</h5>
                    <div class="row">
                        <div class="col-lg-12 mb-5">
                            <h6 class="mb-4">Tons</h6>
                            <div class="chart-container chart">
                                <canvas id="productChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('scripts')
    <script src="{{ asset('js/customCharts.js') }}"></script>
    <script>
        $().ready(function(){
            $(".datetimePicker").datetimepicker({
                theme:  '{{ Auth::user()->theme }}',
            });

            $('#ItemTypeFilter,#itemGroupFilter').on('change' , function (evt) {
                evt.preventDefault();
                let ItemTypeFilter = $('#ItemTypeFilter');
                let itemGroupFilter = $('#itemGroupFilter');
                let itemGroupValue = itemGroupFilter.val();
                $.ajax({
                    method : "post",
                    url : "{{ route('dashboard.suppliersItemGroup') }}",
                    data : {_token: "{{ csrf_token() }}" , filter_item_type : ItemTypeFilter.val() , filter_item_group: itemGroupFilter.val()},
                    success : (response) => {
                        let itemGroupFilter =   $('#itemGroupFilter');
                        let suppliersFilter =   $('#suppliersFilter');
                        if(response.suppliers)
                        {
                            itemGroupFilter.empty().append('<option label="&nbsp;">&nbsp;</option>');
                            suppliersFilter.empty().append('<option label="&nbsp;">&nbsp;</option>');
                            $.each(response.item_groups , function (index , group) {
                                let option  =   '<option value="'+group.id+'"> '+group.name+' </option>';
                                itemGroupFilter.append(option);
                            });

                            $.each(response.suppliers , function (index , supplier) {
                                let option  =   '<option value="'+supplier.id+'"> '+supplier.name+' </option>';
                                suppliersFilter.append(option);
                            })

                            itemGroupFilter.find('option[value="'+itemGroupValue+'"]').attr('selected' , true);
                        }
                    }
                })
            });

            if ("{{ request()->input('filter_item_type') }}" == 'raw')
            {
                let rawChart = initCharts('rawChart' , {
                    labels: ["@lang('global.sampled')" , "@lang('global.accepted')" , "@lang('global.rejected')"],
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
                let rawChart = initCharts('rawChart' , {
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

        });
    </script>
@endpush
