@extends('layout.main')
@section('content')

    <div class="row">
        <div class="col-12">
            <h1>@lang('global.suppliers')</h1>
            <div class="text-zero top-right-button-container">
                @permission('suppliers.create')
                <a href="{{ route('suppliers.create') }}">
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
                        <a href="{{ route('suppliers.index') }}">@lang('global.suppliers')</a>
                    </li>
                    <li class="breadcrumb-item " aria-current="page">@lang('global.index')</li>
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
                            <th>@lang('global.sap_code')</th>
                            <th>@lang('global.items_count')</th>
                            <th>@lang('global.is_active')</th>
                            <th>@lang('global.actions')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($suppliers as $supplier)
                            <tr>
                                <td>{{ ( ( $suppliers->currentPage() - 1) * $suppliers->perPage() ) + $loop->iteration }}</td>
                                <td>{{ $supplier->en_name }}</td>
                                <td>{{ $supplier->ar_name }}</td>
                                <td>{{ $supplier->sap_code }}</td>
                                <td>{{ $supplier->items->count() }}</td>
                                <td>
                                    <i class="simple-icon-{{ $supplier->is_active == 1 ? 'check' : 'close' }}"></i>
                                </td>
                                <td>
                                    @permission('items.index')
                                    <a href="{{ route('suppliers.items' , ['id' => $supplier->id]) }}"
                                       class="btn btn-info btn-sm mb-1">@lang('global.supplier_items')</a>
                                    @endpermission
                                    @permission('suppliers.edit')
                                    <a href="{{ route('suppliers.edit' , ['id' => $supplier->id]) }}"
                                       class="btn btn-primary btn-sm mb-1">@lang('global.edit')</a>
                                    @endpermission
                                </td>
                            </tr>
                            @empty
                                <tr>
                                    <td colspan="7"
                                        class="text-center text-warning font-weight-bold">@lang('global.no_data')</td>
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
            {{ $suppliers->links() }}
        </div>
    </div>
@endsection
