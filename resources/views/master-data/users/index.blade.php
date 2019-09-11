@extends('layout.main')
@section('content')

    <div class="row">
        <div class="col-12">
            <h1>@lang('global.users')</h1>
            <div class="text-zero top-right-button-container">
                @permission('users.create')
                <a href="{{ route('users.create') }}">
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
                        <a href="{{ route('users.index') }}">@lang('global.users')</a>
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
                    <h4 class="card-title">@lang('global.search')</h4>

                    <form action="{{route('users.index')}}" id="searchForm">
                        <input type="hidden" value="1" name="s" id="sf">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group ">
                                    <label class="col-md-12 control-label">@lang('global.full_name')</label>
                                    <input type="text" class="form-control" placeholder="{{trans('global.full_name')}}"
                                           name="full_name" value="{{request()->input('full_name')}}"
                                           autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group ">
                                    <label class="col-md-12 control-label">@lang('global.user_name')</label>
                                    <input type="text" class="form-control" placeholder="{{trans('global.user_name')}}"
                                           name="user_name" value="{{request()->input('user_name')}}"
                                           autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group ">
                                    <label class="col-md-12 control-label">@lang('global.email')</label>
                                    <input type="text" class="form-control" placeholder="{{trans('global.email')}}"
                                           name="email" value="{{request()->input('email')}}" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group ">
                                    <label class="col-md-12 control-label">@lang('global.employee_code')</label>
                                    <input type="text" class="form-control"
                                           placeholder="{{trans('global.employee_code')}}" name="employee_code"
                                           value="{{request()->input('employee_code')}}" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group ">
                                    <label class="col-md-12 control-label">@lang('global.role')</label>
                                    <select class="form-control select2-multiple" multiple="multiple" name="role[]">
                                        @foreach($roles as $role)
                                            <option  value="{{$role->id}}" {{in_array($role->id,request()->input('role',[])) ? "selected" : ""}}>{{$role->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group ">
                                    <label class="col-md-12 control-label">@lang('global.is_active')</label>
                                    <select class="form-control select2-multiple" multiple="multiple" name="is_active[]">
                                        @foreach(['1'=>trans('global.is_active'),'0'=>trans('global.not_active')] as $key=>$item)
                                            <option value="{{$key}}" {{in_array($key,request()->input('is_active',[]))? "selected" : ""}}>{{$item}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <div class="text-center">
                                    <a href="{{ route('users.index') }}">
                                        <button type="button"
                                                class="btn btn-danger btn-sm mt-3">@lang('global.clear_filters')</button>
                                    </a>
                                    <button type="submit"
                                            class="btn btn-primary btn-sm mt-3">@lang('global.search')</button>
                                </div>

                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <br/>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    @include('components._validation')
                    <table class="table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>@lang('global.full_name')</th>
                            <th>@lang('global.user_name')</th>
                            <th>@lang('global.email')</th>
                            <th>@lang('global.employee_code')</th>
                            <th>@lang('global.user_role')</th>
                            <th>@lang('global.is_active')</th>
                            <th>@lang('global.actions')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>
                                    <img src="{{ $user->avatar_url }}" class="rounded"
                                         style="width: 35px ; height: 35px ; margin: 0 20px">
                                </td>
                                <td>{{ $user->full_name }}</td>
                                <td>{{ $user->user_name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->employee_code }}</td>
                                <td>{{ optional($user->roles()->first())->name }}</td>
                                <td><i class="simple-icon-{{ $user->is_active == 1 ? 'check' : 'close' }}"></i></td>
                                <td>
                                    @permission('users.edit')
                                    @if($user->is_admin && Auth::user()->is_admin)
                                        <a href="{{ route('users.edit' , ['id' => $user->id]) }}"
                                           class="btn btn-primary btn-sm mb-1">@lang('global.edit')</a>
                                    @elseif(!$user->is_admin)
                                        <a href="{{ route('users.edit' , ['id' => $user->id]) }}"
                                           class="btn btn-primary btn-sm mb-1">@lang('global.edit')</a>
                                    @endif
                                    {{--                            <button type="button" class="btn btn-danger btn-sm mb-1">@lang('global.delete')</button>--}}
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
            {{ $users->links() }}
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(function () {
            $('.select2-multiple').select2();
        });
    </script>
@endpush
