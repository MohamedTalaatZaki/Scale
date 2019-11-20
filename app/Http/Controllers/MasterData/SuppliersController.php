<?php

namespace App\Http\Controllers\MasterData;

use App\Models\Items\Item;
use App\Models\Items\ItemGroup;
use App\Models\Supplier\Supplier;
use App\Traits\AuthorizeTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SuppliersController extends Controller
{
    use AuthorizeTrait;

    public function index() {
        $this->authorized('suppliers.index');
        return view('master-data.suppliers.index' , [
            'suppliers' =>  Supplier::query()->paginate(25),
        ]);
    }

    public function create() {
        $this->authorized('suppliers.create');
        return view('master-data.suppliers.create' , [
            'items' =>  Item::query()->where('is_active' , 1)->get(),
        ]);
    }

    public function store(Request $request) {
        $this->authorized('suppliers.create');
        $this->validate($request , [
            'ar_name'   =>  'required',
            'en_name'   =>  'required',
            'sap_code'  =>  'required|unique:suppliers,sap_code',
            'items'     =>  'nullable|array',
        ],[
            'en_name.required'=>trans('master.errors.en_name_required'),
            'ar_name.required'=>trans('master.errors.ar_name_required'),
            'sap_code' => 'required|unique:items,sap_code',
        ]);

        $request->offsetSet('is_active' , $request->get('is_active' , 0));
        $supplier   =   Supplier::query()->create($request->except('items'));
        $supplier->items()->sync($request->input('items' , []));
        return redirect()->action('MasterData\SuppliersController@index')->with('success' , trans('global.supplier_created_success'));
    }
    public function edit($id) {
        $this->authorized('suppliers.edit');
        return view('master-data.suppliers.edit' , [
            'supplier'  =>  Supplier::query()->findOrFail($id),
            'items'     =>  Item::query()->where('is_active' , 1)->get(),
        ]);
    }

    public function update(Request $request , $id) {
        $this->authorized('suppliers.edit');
        $this->validate($request , [
            'ar_name'   =>  'required',
            'en_name'   =>  'required',
            'sap_code'  =>  'required|unique:suppliers,sap_code,'.$id,
            'items'     =>  'nullable|array',
        ],
            [
                'en_name.required'=>trans('master.errors.en_name_required'),
                'ar_name.required'=>trans('master.errors.ar_name_required'),
                'sap_code' => 'required|unique:items,sap_code',
            ]);
        $request->offsetSet('is_active' , $request->get('is_active' , 0));
        $supplier   =   Supplier::query()->findOrFail($id);
        $supplier->update($request->except('items'));
        $supplier->items()->sync($request->input('items' , []));
        return redirect()->action('MasterData\SuppliersController@index')->with('success' , trans('global.supplier_updated_success'));
    }

    public function getSupplierItemGroups(Request $request)
    {
        $supplier   =   Supplier::query()->find($request->get('id'));

        if($supplier)
        {
            $ItemGroupsIds  =   $supplier->items()
                ->when($request->has('type') , function ($q) use($request){
                    $q->whereHas('type' , function ($query) use($request){
                        $query->where('prefix' , $request->input('type'));
                    });
                })
                ->distinct()
                ->pluck('item_group_id');
            $itemGroups =   ItemGroup::query()->find($ItemGroupsIds);
            return response()->json(['itemGroups'   =>  $itemGroups->pluck( 'name' , 'id')]);
        } else {
            return response()->json(['itemGroups' => []]);
        }
    }
}
