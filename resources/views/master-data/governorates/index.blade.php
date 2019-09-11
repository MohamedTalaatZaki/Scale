@extends('layout.main')
@section('content')

    <div class="row">
        <div class="col-12">
            <h1>@lang('global.governorates')</h1>
            <div class="text-zero top-right-button-container">
                @permission('governorates.create')
                <a href="{{ route('governorates.create') }}">
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
                        <a href="{{ route('governorates.index') }}">@lang('global.governorates')</a>
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
            <div class="card-body"></div>
            @include('components._validation')
            <table class="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>@lang('global.en_name')</th>
                    <th>@lang('global.ar_name')</th>
                    <th>@lang('global.actions')</th>
                </tr>
                </thead>
                <tbody>
                @foreach($governorates as $governorate)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $governorate->en_name }}</td>
                        <td>{{ $governorate->ar_name }}</td>
                        <td>
                            @permission('governorates.edit')
                            <a href="{{ route('governorates.edit' , ['id' => $governorate->id]) }}" class="btn btn-primary btn-sm mb-1">@lang('global.edit')</a>
                            @endpermission
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 list">
            {{ $governorates->links() }}
        </div>
    </div>
@endsection
