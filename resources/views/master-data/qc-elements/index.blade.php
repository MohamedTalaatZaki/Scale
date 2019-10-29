@extends('layout.main')
@section('content')

    <div class="row">
        <div class="col-12">
            <h1>@lang('global.qc_elements')</h1>
            <div class="text-zero top-right-button-container">
                @permission('qc-elements.create')
                <a href="{{ route('qc-elements.create') }}">
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
                        <a href="{{ route('qc-elements.index') }}">@lang('global.qc_elements')</a>
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
                            <th>@lang('global.test_type')</th>
                            <th>@lang('global.element_type')</th>
                            <th>@lang('global.element_unit')</th>
                            <th>@lang('global.actions')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($elements as $qc_element)
                            <tr>
                                <td>{{ ( ( $elements->currentPage() - 1) * $elements->perPage() ) + $loop->iteration }}</td>
                                <td>{{ $qc_element->en_name }}</td>
                                <td>{{ $qc_element->ar_name }}</td>
                                <td>{{ $qc_element->test_type }}</td>
                                <td>{{ $qc_element->element_type }}</td>
                                <td>{{ $qc_element->element_unit }}</td>
                                <td>
                                    @permission('qc-elements.edit')
                                        <a href="{{ route('qc-elements.edit' , ['id' => $qc_element->id]) }}" class="btn btn-primary btn-sm mb-1">@lang('global.edit')</a>
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
            {{ $elements->appends(request()->query())->links() }}
        </div>
    </div>
@endsection
