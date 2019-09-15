@extends('layout.main')
@section('content')

    <div class="row">
        <div class="col-12">
            <h1>@lang('global.suppliers')</h1>

            <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                <ol class="breadcrumb pt-0">
                    <li class="breadcrumb-item">
                        <a href="#" class="default-cursor">@lang('global.master_data')</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('suppliers.index') }}">@lang('global.suppliers')</a>
                    </li>
                    <li class="breadcrumb-item " aria-current="page">@lang('global.edit')</li>
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
                        <h5 class="mb-4">@lang('global.create_item')</h5>
                    </div>

                    <form action="{{ route('suppliers.update' , ['id' => $supplier->id]) }}" method="post">
                        @csrf
                        @method('PUT')

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>@lang('global.en_name') *</label>
                                <input type="text" class="form-control onlyEn" name="en_name" value="{{ old('en_name' , $supplier->en_name) }}" placeholder="@lang('global.en_name')" autocomplete="off" required>
                                @if($errors->has('en_name'))
                                    <div id="jQueryName-error" class="error" style="">{{ $errors->first('en_name') }}</div>
                                @endif
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPassword1">@lang('global.ar_name') *</label>
                                <input type="text" class="form-control onlyAr" id="inputPassword1" name="ar_name" value="{{ old('ar_name' , $supplier->ar_name) }}"
                                       placeholder="@lang('global.ar_name')" autocomplete="off" required>
                                @if($errors->has('ar_name'))
                                    <div id="jQueryName-error" class="error" style="">{{ $errors->first('ar_name' , $supplier->ar_name) }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>@lang('global.sap_code') *</label>
                                <input type="text" class="form-control" name="sap_code" value="{{ old('sap_code' , $supplier->sap_code) }}" placeholder="@lang('global.sap_code')" autocomplete="off" required>
                                @if($errors->has('sap_code'))
                                    <div id="jQueryName-error" class="error" style="">{{ $errors->first('sap_code') }}</div>
                                @endif
                            </div>
                            <div class="form-group col-md-6">
                                <label class="col-12 col-form-label">@lang('global.is_active')</label>
                                <div class="col-12">
                                    <div class="custom-switch custom-switch-primary-inverse mb-2" style="padding-left: 0">
                                        <input class="custom-switch-input" id="is_active" type="checkbox" value="1" name="is_active" {{ old('is_active' , $supplier->is_active) == '1' ? 'checked' : '' }}>
                                        <label class="custom-switch-btn" for="is_active"></label>
                                    </div>
                                    @if($errors->has('is_active'))
                                        <div id="jQueryName-error" class="error" style="">{{ $errors->first('is_active') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="items">@lang('global.items')</label>
                                <select id='items' class="items" multiple='multiple' name="items[]">
                                    @foreach($items as $item)
                                        <option value="{{ $item->id }}" {{ in_array($item->id , old('items' , $supplier->items->pluck('id')->toArray())) ? 'selected' : '' }}> {{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group col-md-12">
                            <div class="float-right">
                                <a href="{{ route('suppliers.index') }}">
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
        .ms-container{
            width: 100%;
        }
    </style>
@endpush
@push('scripts')
    <script>
        $().ready(function(){
            $('body').on('click' , '#select-all' , function(){
                $('.items').multiSelect('select_all');
                return false;
            });
            $('body').on('click' , '#deselect-all' ,function(){
                $('.items').multiSelect('deselect_all');
                return false;
            });
            $('.items').multiSelect({
                keepOrder: true,
                selectableHeader: "<input type='text' class='form-control search-input' autocomplete='off' placeholder='@lang('global.items_search')'>",
                selectionHeader: "<input type='text' class='form-control search-input' autocomplete='off' placeholder='@lang('global.items_search')'>",
                selectableFooter: "<button type='button' id='select-all' class='btn default btn-primary btn-block' ><b>@lang('global.select_all')</b> </button>",
                selectionFooter: "<button type='button' id='deselect-all' class='btn default btn-primary btn-block' > <b>@lang('global.deselect_all')</b> </button>",
                afterInit: function(ms){
                    var that = this,
                        $selectableSearch = that.$selectableUl.prev(),
                        $selectionSearch = that.$selectionUl.prev(),
                        selectableSearchString = '#'+that.$container.attr('id')+' .ms-elem-selectable:not(.ms-selected)',
                        selectionSearchString = '#'+that.$container.attr('id')+' .ms-elem-selection.ms-selected';

                    that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
                        .on('keydown', function(e){
                            if (e.which === 40){
                                that.$selectableUl.focus();
                                return false;
                            }
                        });

                    that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
                        .on('keydown', function(e){
                            if (e.which == 40){
                                that.$selectionUl.focus();
                                return false;
                            }
                        });
                },
                afterSelect: function(){
                    this.qs1.cache();
                    this.qs2.cache();
                },
                afterDeselect: function(){
                    this.qs1.cache();
                    this.qs2.cache();
                }
            });
        })
    </script>
@endpush
