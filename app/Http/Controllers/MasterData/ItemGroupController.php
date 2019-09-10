<?php

namespace App\Http\Controllers\MasterData;

use App\Models\Governorate;
use App\Models\Items\ItemGroup;
use App\Traits\AuthorizeTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ItemGroupController extends Controller
{
    use AuthorizeTrait;

    public function index()
    {
        $this->authorized('item-group.index');
        $item_groups   =   ItemGroup::query()->paginate(25);
        return view('master-data.items.item-group.index' , ['item_groups' => $item_groups]);
    }

    public function create(){
        $this->authorized('item-group.create');
        return view('master-data.items.item-group.create');
    }

    public function store(Request $request) {
        $this->authorized('item-group.create');
        $this->validate($request , [
            'en_name'   =>  'required|unique:item_group,en_name',
            'ar_name'   =>  'required|unique:item_group,ar_name'
        ],
            [
                'en_name.required'=>trans('master.errors.en_name_required'),
                'ar_name.required'=>trans('master.errors.ar_name_required'),
                'en_name.unique'=>trans('master.errors.item_group_en_name_exist'),
                'ar_name.unique'=>trans('master.errors.item_group_ar_name_exist'),
            ]);

        $item_group    =   ItemGroup::query()->create([
            'en_name'   =>  $request->get('en_name'),
            'ar_name'   =>  $request->get('ar_name'),
        ]);

        return redirect()->action('MasterData\ItemGroupController@index')->with('success' , trans('global.item_group_created'));
    }

    public function edit($id){
        $this->authorized('item-group.edit');
        $item_group    =   ItemGroup::query()->findOrFail($id);
        return view('master-data.items.item-group.edit' , ['item_group' => $item_group]);
    }

    public function update(Request $request , $id) {
        $this->authorized('item-group.edit');
        $this->validate($request , [
            'en_name'   =>  'required|unique:item_group,en_name,'.$id,
            'ar_name'   =>  'required|unique:item_group,ar_name,'.$id
        ],
            [
                'en_name.required'=>trans('master.errors.en_name_required'),
                'ar_name.required'=>trans('master.errors.ar_name_required'),
                'en_name.unique'=>trans('master.errors.item_group_en_name_exist'),
                'ar_name.unique'=>trans('master.errors.item_group_name_exist'),
            ]);
        $item_group    =   ItemGroup::query()->findOrFail($id);
        $item_group->update([
            'en_name'   =>  $request->get('en_name'),
            'ar_name'   =>  $request->get('ar_name'),
        ]);

        return redirect()->action('MasterData\ItemGroupController@index')->with('success' , trans('global.item_group_updated'));
    }

}
