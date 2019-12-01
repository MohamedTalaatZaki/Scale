@extends('layout.main')
@section('content')

    <div class="row">
        <div class="col-12">
            <h1>@lang('global.blocked_drivers')</h1>
            <div class="text-zero top-right-button-container">
            </div>
            <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                <ol class="breadcrumb pt-0">
                    <li class="breadcrumb-item">
                        <span class="default-cursor">@lang('global.security')</span>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('blocked-drivers.index') }}">@lang('global.blocked_drivers')</a>
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
                            <th>@lang('global.driver_license')</th>
                            <th>@lang('global.driver_name')</th>
                            <th>@lang('global.driver_national_id')</th>
                            <th>@lang('global.driver_mobile')</th>
                            <th>@lang('global.blocked_count')</th>
                            <th>@lang('global.actions')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($drivers as $driver)
                            <tr>
                                <td>{{ ( ( $drivers->currentPage() - 1) * $drivers->perPage() ) + $loop->iteration }}</td>
                                <td>{{ $driver->license }}</td>
                                <td>{{ $driver->name }}</td>
                                <td>{{ $driver->national_id }}</td>
                                <td>{{ $driver->mobile }}</td>
                                <td>{{ $driver->blocked_count }}</td>
                                <td>
                                    @permission('blocked-drivers.update')
                                        <form action="{{ route('blocked-drivers.update' , ['id' => $driver->id]) }}" method="post">
                                            @csrf
                                            @method('put')
                                            <button type="submit"
                                                    class="btn btn-danger btn-sm mb-1">@lang('global.unblock')</button>
                                        </form>
                                    @endpermission
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-warning font-weight-bold">@lang('global.no_data')</td>
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
            {{ $drivers->links() }}
        </div>
    </div>
@endsection
