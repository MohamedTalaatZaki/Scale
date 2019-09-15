@extends('layout.main')
@section('content')

    <div class="row">
        <div class="col-12">
            <h1>@lang('global.item_group')</h1>
            <div class="text-zero top-right-button-container">
                @permission('item-group.create')
                <a href="{{ route('item-group.create') }}">
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
                        <a href="{{ route('item-group.index') }}">@lang('global.item_group')</a>
                    </li>
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
                    <th>@lang('global.is_testable')</th>
                    <th>@lang('global.actions')</th>
                </tr>
                </thead>
                <tbody>
                @forelse($item_groups as $item_group)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item_group->en_name }}</td>
                        <td>{{ $item_group->ar_name }}</td>
                        <td>
                            <i class="simple-icon-{{ $item_group->testable == 1 ? 'check' : 'close' }}" ></i>
                            {{ $item_group->testable == 1 ? trans('global.yes_testable') : trans('global.not_testable') }}
                        </td>
                        <td>
                            @permission('item-group.edit')
                            <a href="{{ route('item-group.edit' , ['id' => $item_group->id]) }}" class="btn btn-primary btn-sm mb-1">@lang('global.edit')</a>
                            @endpermission
                        </td>
                    </tr>
                    @empty
                        <tr>
                            <td colspan="5"
                                class="text-center text-warning font-weight-bold">@lang('global.no_data')</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 list">
            {{ $item_groups->links() }}
        </div>
    </div>
@endsection
