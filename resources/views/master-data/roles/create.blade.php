@extends('layout.main')
@section('content')

    <div class="row">
        <div class="col-12">
            <h1>@lang('global.roles')</h1>

            <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                <ol class="breadcrumb pt-0">
                    <li class="breadcrumb-item">
                        <a href="#" class="default-cursor">@lang('global.master_data')</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('roles.index') }}">@lang('global.roles')</a>
                    </li>
                    <li class="breadcrumb-item " aria-current="page">@lang('global.create')</li>
                </ol>
            </nav>
            <div class="separator mb-5"></div>
        </div>
    </div>

    <br />
    <br />
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div>
                        <h5 class="mb-4">@lang('global.create_role')</h5>
                    </div>


                    <form action="{{ route('roles.store') }}" method="post">
                        @csrf

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label>@lang('global.name')</label>
                                <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="@lang('global.name')" required>
                                @if($errors->has('name'))
                                    <div id="jQueryName-error" class="error" style="">{{ $errors->first('name') }}</div>
                                @endif
                            </div>
                        </div>
                        <hr/>

                        <div class="col-lg-12 col-md-12 mb-12">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">@lang('global.select_permissions')</h5>
                                    <table class="table">
                                        @foreach($main_menus as $main)
                                            <tr class="main-head">
                                                <th>{{ $main->name }}</th>
                                            </tr>
                                            @foreach($main->menuGroups as $group)
                                                <tr class="main-group">
                                                    <td>{{ $group->name }}</td>
                                                </tr>
                                                @foreach($group->subMenus as $subMenu)
                                                    <tr>
                                                        <td class="sub-menu-style">{{ $subMenu->name }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="form-group row mb-1">
                                                                <ul style="list-style: none ; display: flex ; flex-direction: row">
                                                                    @foreach($subMenu->permissions as $permission)
                                                                        <li style="margin: 10px 50px 0 0">
                                                                            <div class="custom-control custom-checkbox mb-2">
                                                                                <input type="checkbox" name="permissions[]" value="{{ $permission->id }}" class="custom-control-input" id="permission{{ $permission->id }}">
                                                                                <label class="custom-control-label" for="permission{{ $permission->id }}">{{ $permission->display_name }}</label>
                                                                            </div>
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                @endforeach
                                            @endforeach
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-md-12">
                            <div class="float-right">
                                <a href="{{ route('roles.index') }}">
                                    <button type="button" class="btn btn-danger btn-sm mt-3">@lang('global.cancel')</button>
                                </a>
                                <button type="submit" class="btn btn-primary btn-sm mt-3">@lang('global.save')</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('styles')
    <style>
        .main-head{
            text-align: center;
            font-weight: bold;
            background-color: #1b191b;
        }
        .main-group{
            text-align: center;
            font-weight: bold;
            background-color: #2a2a2a;
            color: darkgoldenrod;
        }
        .sub-menu-style {
            background-color: #232425;
            color: darkgray;
        }
    </style>
@endpush
