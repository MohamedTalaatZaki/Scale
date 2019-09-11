@extends('layout.main')
@section('content')

    <div class="row">
        <div class="col-12">
            <h1>@lang('global.item_types')</h1>
            <div class="text-zero top-right-button-container">
                @permission('item-types.create')
                <a href="{{ route('item-types.create') }}">
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
                        <a href="{{ route('item-types.index') }}">@lang('global.item_types')</a>
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
                @foreach($item_types as $item_type)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item_type->en_name }}</td>
                        <td>{{ $item_type->ar_name }}</td>
                        <td>
                            @permission('item-types.edit')
                            <a href="{{ route('item-types.edit' , ['id' => $item_type->id]) }}" class="btn btn-primary btn-sm mb-1">@lang('global.edit')</a>
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
            {{ $item_types->links() }}
        </div>
    </div>
@endsection
