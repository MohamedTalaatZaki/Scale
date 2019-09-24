@extends('layout.main')
@section('content')

    <div class="row">
        <div class="col-12">
            <h1>@lang('global.cities')</h1>
            <div class="text-zero top-right-button-container">
                @permission('cities.create')
                <a href="{{ route('cities.create') }}">
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
                        <a href="{{ route('cities.index') }}">@lang('global.cities')</a>
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
                            <th>@lang('global.governorate_name')</th>
                            <th>@lang('global.en_name')</th>
                            <th>@lang('global.ar_name')</th>
                            <th>@lang('global.actions')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($cities as $city)
                            <tr>
                                <td>{{ ( ( $cities->currentPage() - 1) * $cities->perPage() ) + $loop->iteration }}</td>
                                <td>{{ $city->governorate->name }}</td>
                                <td>{{ $city->en_name }}</td>
                                <td>{{ $city->ar_name }}</td>

                                <td>
                                    @permission('cities.edit')
                                    <a href="{{ route('cities.edit' , ['id' => $city->id]) }}"
                                       class="btn btn-primary btn-sm mb-1">@lang('global.edit')</a>
                                    @endpermission
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-warning font-weight-bold">@lang('global.no_data')</td>
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
            {{ $cities->links() }}
        </div>
    </div>
@endsection
