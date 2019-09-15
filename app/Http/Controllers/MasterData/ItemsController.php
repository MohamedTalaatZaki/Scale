<?php

namespace App\Http\Controllers\MasterData;

use App\Models\items\Item;
use App\Models\Items\ItemGroup;
use App\Models\Items\ItemType;
use App\Traits\AuthorizeTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ItemsController extends Controller
{
    use AuthorizeTrait;

    public function index()
    {
        $this->authorized('items.index');
        return view('master-data.items.items.index', [
            'items' => Item::query()->paginate(25),
        ]);
    }

    public function create()
    {
        $this->authorized('items.create');
        return view('master-data.items.items.create', [
            'types' => ItemType::all(),
            'groups' => ItemGroup::all(),
        ]);
    }

    public function store(Request $request)
    {
        $this->authorized('items.create');
        $this->validate($request, [
            'ar_name' => 'required|unique:items,ar_name',
            'en_name' => 'required|unique:items,en_name',
            'sap_code' => 'required|unique:items,sap_code',
            'item_type_id' => 'required|exists:item_types,id',
            'item_group_id' => 'required|exists:item_group,id',
        ],
            [
                'ar_name.required' => trans('master.errors.ar_name_required'),
                'ar_name.unique' => trans('master.errors.item_ar_name_unique'),
                'en_name.required' => trans('master.errors.en_name_required'),
                'en_name.unique' => trans('master.errors.item_en_name_unique'),
                'sap_code.required' => trans('master.errors.sap_code_required'),
                'sap_code.unique' => trans('master.errors.sap_code_unique'),
                'item_type_id.required' => trans('master.errors.item_type_id_required'),
                'item_group_id.required' => trans('master.errors.item_group_id_required'),
            ]);

        $request->offsetSet('is_active' , $request->get('is_active' , 0));

        Item::query()->create($request->input());

        return redirect()
            ->action('MasterData\ItemsController@index')
            ->with('success' , trans('global.item_created_success'));
    }

    public function edit($id)
    {
        $this->authorized('items.edit');
        return view('master-data.items.items.edit', [
            'item' => Item::query()->findOrFail($id),
            'types' => ItemType::all(),
            'groups' => ItemGroup::all(),
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->authorized('items.edit');
        $this->validate($request, [
            'ar_name' => 'required|unique:items,ar_name,' . $id,
            'en_name' => 'required|unique:items,en_name,' . $id,
            'sap_code' => 'required|unique:items,sap_code,' . $id,
            'item_type_id' => 'required|exists:item_types,id',
            'item_group_id' => 'required|exists:item_group,id',
        ],
            [
                'ar_name.required' => trans('master.errors.ar_name_required'),
                'ar_name.unique' => trans('master.errors.item_ar_name_unique'),
                'en_name.required' => trans('master.errors.en_name_required'),
                'en_name.unique' => trans('master.errors.item_en_name_unique'),
                'sap_code.required' => trans('master.errors.sap_code_required'),
                'sap_code.unique' => trans('master.errors.sap_code_unique'),
                'item_type_id.required' => trans('master.errors.item_type_id_required'),
                'item_group_id.required' => trans('master.errors.item_group_id_required'),
            ]);

        $request->offsetSet('is_active', $request->get('is_active', 0));

        $item = Item::query()->findOrFail($id);
        $item->update($request->input());

        return redirect()
            ->action('MasterData\ItemsController@index')
            ->with('success', trans('global.item_updated_success'));
    }


}
