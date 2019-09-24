@extends('layout.main')
@section('content')

    <div class="row">
        <div class="col-12">
            <h1>@lang('global.qc_test_headers')</h1>
            <div class="text-zero top-right-button-container">
                @permission('qc_test_headers.create')
                <a href="{{ route('qc_test_headers.create') }}">
                    <button type="button"
                            class="btn btn-primary btn-sm top-right-button mr-1">@lang('global.create')</button>
                </a>
                @endpermission
            </div>
            <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                <ol class="breadcrumb pt-0">
                    <li class="breadcrumb-item">
                        <span class="default-cursor">@lang('global.master_data')</span>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('qc-test-headers.index') }}">@lang('global.qc_test_headers')</a>
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
                            <th>@lang('global.en_name')</th>
                            <th>@lang('global.ar_name')</th>
                            <th>@lang('global.item_group')</th>
                            <th>@lang('global.element_count')</th>
                            <th>@lang('global.is_active')</th>
                            <th>@lang('global.actions')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($qc_test_headers as $qc_test_header)
                            <tr>
                                <td>{{ ( ( $cities->currentPage() - 1) * $cities->perPage() ) + $loop->iteration }}</td>
                                <td>{{ $qc_test_header->en_name }}</td>
                                <td>{{ $qc_test_header->ar_name }}</td>
                                <td>{{ optional($qc_test_header->itemGroup)->name }}</td>
                                <td>{{ $qc_test_header->details->count() }}</td>
                                <td>
                                    <i class="simple-icon-{{ $qc_test_header->is_active == 1 ? 'check' : 'close' }}"></i>
                                </td>
                                <td>
                                    @permission('qc_test_headers.edit')
                                    <a href="{{ route('qc_test_headers.edit' , ['id' => $item->id]) }}"
                                       class="btn btn-primary btn-sm mb-1">@lang('global.edit')</a>
                                    @endpermission
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
            {{ $qc_test_headers->appends(request()->query())->links() }}
        </div>
    </div>
@endsection
