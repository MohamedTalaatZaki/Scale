@extends('layout.main')
@section('content')

    <div class="row">
        <div class="col-12">
            <h1>@lang('global.roles')</h1>
            <div class="text-zero top-right-button-container">
                <a href="{{ route('roles.create') }}">
                    <button type="button"
                            class="btn btn-primary btn-sm top-right-button mr-1">@lang('global.create')</button>
                </a>
            </div>
            <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                <ol class="breadcrumb pt-0">
                    <li class="breadcrumb-item">
                        <a href="#" class="default-cursor">@lang('global.master_data')</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('roles.index') }}">@lang('global.roles')</a>
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
                            <th>@lang('global.name')</th>
                            <th>@lang('global.permissions_count')</th>
                            <th>@lang('global.users_count')</th>
                            <th>@lang('global.actions')</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($roles as $role)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $role->name }}</td>
                            <td>{{ $role->perms->count() }}</td>
                            <td>{{ $role->users->count() }}</td>
                            <td>
                                <a href="{{ route('roles.edit' , ['id' => $role->id]) }}" class="btn btn-primary btn-sm mb-1">@lang('global.edit')</a>
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
            {{ $roles->links() }}
        </div>
    </div>
@endsection
