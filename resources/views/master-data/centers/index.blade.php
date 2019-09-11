@extends('layout.main')
@section('content')

    <div class="row">
        <div class="col-12">
            <h1>@lang('global.centers')</h1>
            <div class="text-zero top-right-button-container">
                @permission('centers.create')
                <a href="{{ route('centers.create') }}">
                    <button type="button"
                            class="btn btn-primary btn-sm top-right-button mr-1">@lang('global.create')</button>
                </a>
                @endpermission
            </div>
            <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                <ol class="breadcrumb pt-0">
                    <li class="breadcrumb-item">
                        <a href="#" class="default-cursor">@lang('global.master_data')</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('centers.index') }}">@lang('global.centers')</a>
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
                            <th>@lang('global.city_name')</th>
                            <th>@lang('global.en_name')</th>
                            <th>@lang('global.ar_name')</th>
                            <th>@lang('global.is_active')</th>
                            <th>@lang('global.actions')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($centers as $center)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $center->city->governorate->name }}</td>
                                <td>{{ $center->city->name }}</td>
                                <td>{{ $center->en_name }}</td>
                                <td>{{ $center->ar_name }}</td>
                                <td><i class="simple-icon-{{ $center->is_active ? 'check' : 'close' }}"></i></td>
                                <td>
                                    @permission('centers.edit')
                                    <a href="{{ route('centers.edit' , ['id' => $center->id]) }}"
                                       class="btn btn-primary btn-sm mb-1">@lang('global.edit')</a>
                                    @endpermission
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 list">
            {{ $centers->links() }}
        </div>
    </div>
@endsection
