@extends('layout.main')
@section('content')

    <div class="row">
        <div class="col-12">
            <h1>@lang('global.users')</h1>
            <div class="text-zero top-right-button-container">
                <a href="{{ route('users.create') }}">
                <button type="button"
                        class="btn btn-primary btn-lg top-right-button mr-1">@lang('global.create')</button>
                </a>
            </div>
            <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                <ol class="breadcrumb pt-0">
                    <li class="breadcrumb-item">
                        <a href="#">@lang('global.master_data')</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="#">@lang('global.users')</a>
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
            <table class="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>@lang('global.full_name')</th>
                    <th>@lang('global.user_name')</th>
                    <th>@lang('global.email')</th>
                    <th>@lang('global.employee_code')</th>
                    <th>@lang('global.user_role')</th>
                    <th>@lang('global.actions')</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>
                            <img src="{{ $user->avatar_url }}" style="width: 35px ; height: 35px ; margin: 0 20px">
                        </td>
                        <td>{{ $user->full_name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->user_name }}</td>
                        <td>{{ $user->employee_code }}</td>
                        <td></td>
                        <td>
                            <button type="button" class="btn btn-primary btn-sm mb-1">@lang('global.edit')</button>
                            <button type="button" class="btn btn-danger btn-sm mb-1">@lang('global.delete')</button>
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
            {{ $users->links() }}
        </div>
    </div>
@endsection
