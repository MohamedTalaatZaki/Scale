<?php

namespace App\Http\Controllers\MasterData;

use App\Models\Items\ItemType;
use App\Traits\AuthorizeTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ItemTypesController extends Controller
{
    use AuthorizeTrait;

    public function index()
    {
        $this->authorized('item-types.index');
        $item_types = ItemType::query()->paginate(25);
        return view('master-data.items.item-types.index', ['item_types' => $item_types]);
    }

    public function create()
    {
        $this->authorized('item-types.create');
        return view('master-data.items.item-types.create');
    }

    public function store(Request $request)
    {
        $this->authorized('item-types.create');
        $this->validate($request, [
            'en_name' => 'required|unique:item_types,en_name',
            'ar_name' => 'required|unique:item_types,ar_name'
        ],
            [
                'en_name.required' => trans('master.errors.en_name_required'),
                'ar_name.required' => trans('master.errors.ar_name_required'),
                'en_name.unique' => trans('master.errors.item_types_en_name_exist'),
                'ar_name.unique' => trans('master.errors.item_types_ar_name_exist'),
            ]);

        $item_types = ItemType::query()->create([
            'en_name' => $request->get('en_name'),
            'ar_name' => $request->get('ar_name'),
            'testable'  =>  $request->input('testable' , 0)
        ]);

        return redirect()->action('MasterData\ItemTypesController@index')->with('success', trans('global.item_types_created'));
    }

    public function edit($id)
    {
        $this->authorized('item-types.edit');
        $item_type = ItemType::query()->findOrFail($id);
        return view('master-data.items.item-types.edit', ['item_type' => $item_type]);
    }

    public function update(Request $request, $id)
    {
        $this->authorized('item-types.edit');
        $this->validate($request, [
            'en_name' => 'required|unique:item_types,en_name,' . $id,
            'ar_name' => 'required|unique:item_types,ar_name,' . $id,
        ],
            [
                'en_name.required' => trans('master.errors.en_name_required'),
                'ar_name.required' => trans('master.errors.ar_name_required'),
                'en_name.unique' => trans('master.errors.item_types_en_name_exist'),
                'ar_name.unique' => trans('master.errors.item_types_name_exist'),
            ]);
        $item_types = ItemType::query()->findOrFail($id);
        $item_types->update([
            'en_name' => $request->get('en_name'),
            'ar_name' => $request->get('ar_name'),
            'testable'  =>  $request->input('testable' , 0)
        ]);

        return redirect()->action('MasterData\ItemTypesController@index')->with('success', trans('global.item_types_updated'));
    }

}
