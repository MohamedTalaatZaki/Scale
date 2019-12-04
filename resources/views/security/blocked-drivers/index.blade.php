@extends('layout.main')
@section('content')

    <div class="row">
        <div class="col-12">
            <h1>@lang('global.blocked_drivers')</h1>
            <div class="text-zero top-right-button-container">
            </div>
            <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                <ol class="breadcrumb pt-0">
                    <li class="breadcrumb-item">
                        <span class="default-cursor">@lang('global.security')</span>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('blocked-drivers.index') }}">@lang('global.blocked_drivers')</a>
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
                    @include('components._validation')
                    <table class="table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>@lang('global.driver_license')</th>
                            <th>@lang('global.driver_name')</th>
                            <th>@lang('global.driver_national_id')</th>
                            <th>@lang('global.driver_mobile')</th>
                            <th>@lang('global.blocked_count')</th>
                            <th>@lang('global.actions')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($drivers as $driver)
                            <tr>
                                <td>{{ ( ( $drivers->currentPage() - 1) * $drivers->perPage() ) + $loop->iteration }}</td>
                                <td>{{ $driver->license }}</td>
                                <td>{{ $driver->name }}</td>
                                <td>{{ $driver->national_id }}</td>
                                <td>{{ $driver->mobile }}</td>
                                <td>{{ $driver->blocked_count }}</td>
                                <td>
                                    <div style="display: -webkit-box">
                                    @permission('blocked-drivers.edit')
                                        <form action="{{ route('blocked-drivers.update' , ['id' => $driver->id]) }}" method="post">
                                            @csrf
                                            @method('put')
                                            <button type="submit"
                                                    class="btn btn-danger btn-sm mb-1 mr-2">@lang('global.unblock')</button>
                                        </form>
                                        <button type="button" data-target="#blockedModal" data-toggle="modal"  data-history="{{ $driver->logs }}"
                                                class="btn btn-primary btn-sm mb-1" >@lang('global.history')</button>
                                    @endpermission
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-warning font-weight-bold">@lang('global.no_data')</td>
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
            {{ $drivers->links() }}
        </div>
    </div>

    <div class="modal fade" id="blockedModal" tabindex="-1" role="dialog" aria-labelledby="blockedModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">@lang('global.history')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                    <div class="modal-body">
                        <table class="table table-bordered text-center">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>@lang('global.blocked_by')</th>
                                    <th>@lang('global.blocked_reason')</th>
                                    <th>@lang('global.created_at')</th>
                                </tr>
                            </thead>
                            <tbody class="historyBody">
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('global.close')</button>
                    </div>
            </div>
        </div>
    </div>

@endsection
@push('scripts')
    <script>
        $().ready(function(){
            $('#blockedModal').on('show.bs.modal', function (event) {
                let history  =   $(event.relatedTarget).data('history');
                let historyBody =   $('.historyBody');
                historyBody.empty();
                $.each(history , function (index , row) {
                    console.log(row);
                    let tr  =   "<tr>" +
                        "<td rowspan='2'>"+ (parseInt(index)+1) +"</td>" +
                        "<td>"+ row.blocked_by_name +"</td>" +
                        "<td>"+ row.blocked_reason +"</td>" +
                        "<td>"+ row.created_at +"</td>" +
                        "</tr>" +
                        "<tr>" +
                        "<td colspan='5' style='text-align: center'>"+ row.block_reason +"</td>" +
                        "</tr>" +
                        "<tr><td colspan='5'></td></tr>";
                    historyBody.append(tr);
                })
            });
        });
    </script>
@endpush
