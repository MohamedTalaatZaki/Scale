@extends('layout.main')
@section('content')

    <div class="row">
        <div class="col-12">
            <h1>@lang('global.scales')</h1>
            <div class="text-zero top-right-button-container">
                @permission('scales.create')
                <a href="{{ route('scales.create') }}">
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
                        <a href="{{ route('scales.index') }}">@lang('global.scales')</a>
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
                            <th>@lang('global.code')</th>
                            <th>@lang('global.brand')</th>
                            <th>@lang('global.model')</th>
                            <th>@lang('global.ip_address')</th>
                            <th>@lang('global.is_active')</th>
                            <th>@lang('global.actions')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($scales as $scale)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $scale->code }}</td>
                                <td>{{ $scale->brand }}</td>
                                <td>{{ $scale->model }}</td>
                                <td>{{ $scale->ip_address }}</td>
                                <td>
                                    <i class="simple-icon-{{ $scale->is_active == 1 ? 'check' : 'close' }}"></i>
                                </td>
                                <td>
                                    @permission('scales.edit')
                                    <a href="{{ route('scales.edit' , ['id' => $scale->id]) }}"
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
            {{ $scales->links() }}
        </div>
    </div>
@endsection
