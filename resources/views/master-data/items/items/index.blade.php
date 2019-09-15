@extends('layout.main')
@section('content')

    <div class="row">
        <div class="col-12">
            <h1>@lang('global.items')</h1>
            <div class="text-zero top-right-button-container">
                @permission('items.create')
                <a href="{{ route('items.create') }}">
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
                        <a href="{{ route('items.index') }}">@lang('global.items')</a>
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

                    <form action="{{route('items.index')}}" id="searchForm">

                        <input type="hidden" value="1" name="s" id="sf">

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group ">
                                    <label class="col-md-12 control-label">@lang('global.ar_name')</label>
                                    <input type="text" class="form-control" placeholder="{{trans('global.ar_name')}}"
                                           name="ar_name" value="{{request()->input('ar_name')}}"
                                           autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group ">
                                    <label class="col-md-12 control-label">@lang('global.en_name')</label>
                                    <input type="text" class="form-control" placeholder="{{trans('global.en_name')}}"
                                           name="en_name" value="{{request()->input('en_name')}}"
                                           autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group ">
                                    <label class="col-md-12 control-label">@lang('global.sap_code')</label>
                                    <input type="text" class="form-control" placeholder="{{trans('global.sap_code')}}"
                                           name="sap_code" value="{{request()->input('sap_code')}}" autocomplete="off">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-12">
                                <div class="text-center">
                                    <a href="{{ route('items.index') }}">
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
                            <th>@lang('global.en_name')</th>
                            <th>@lang('global.ar_name')</th>
                            <th>@lang('global.sap_code')</th>
                            <th>@lang('global.item_group')</th>
                            <th>@lang('global.item_type')</th>
                            <th>@lang('global.is_active')</th>
                            <th>@lang('global.actions')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($items as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->en_name }}</td>
                                <td>{{ $item->ar_name }}</td>
                                <td>{{ $item->sap_code }}</td>
                                <td>{{ $item->group->name }}</td>
                                <td>{{ $item->type->name }}</td>
                                <td>
                                    <i class="simple-icon-{{ $item->is_active == 1 ? 'check' : 'close' }}"></i>
                                </td>
                                <td>
                                    @permission('items.edit')
                                    <a href="{{ route('items.edit' , ['id' => $item->id]) }}"
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
            {{ $items->links() }}
        </div>
    </div>
@endsection
