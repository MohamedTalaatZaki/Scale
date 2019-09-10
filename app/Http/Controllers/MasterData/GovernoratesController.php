<?php

namespace App\Http\Controllers\MasterData;

use App\Models\Governorate;
use App\Traits\AuthorizeTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GovernoratesController extends Controller
{
    use AuthorizeTrait;

    public function index()
    {
        $this->authorized('governorates.index');
        $governorates   =   Governorate::query()->paginate(25);
        return view('master-data.governorates.index' , ['governorates' => $governorates]);
    }

    public function create(){
        $this->authorized('governorates.create');
        return view('master-data.governorates.create');
    }

    public function store(Request $request) {
        $this->authorized('governorates.create');
        $this->validate($request , [
            'en_name'   =>  'required|unique:governorates,en_name',
            'ar_name'   =>  'required|unique:governorates,ar_name'
        ],
            [
                'en_name.required'=>trans('master.errors.en_name_required'),
                'ar_name.required'=>trans('master.errors.ar_name_required'),
                'en_name.unique'=>trans('master.errors.gov_en_name_exist'),
                'ar_name.unique'=>trans('master.errors.gov_ar_name_exist'),
            ]);

        $gov    =   Governorate::query()->create([
            'en_name'   =>  $request->get('en_name'),
            'ar_name'   =>  $request->get('ar_name'),
        ]);

        return redirect()->action('MasterData\GovernoratesController@index')->with('success' , trans('global.governorate_created'));
    }

    public function edit($id){
        $this->authorized('governorates.edit');
        $governorate    =   Governorate::query()->findOrFail($id);
        return view('master-data.governorates.edit' , ['governorate' => $governorate]);
    }

    public function update(Request $request , $id) {
        $this->authorized('governorates.edit');
        $this->validate($request , [
            'en_name'   =>  'required|unique:governorates,en_name,'.$id,
            'ar_name'   =>  'required|unique:governorates,ar_name,'.$id
        ],
        [
            'en_name.required'=>trans('master.errors.en_name_required'),
            'ar_name.required'=>trans('master.errors.ar_name_required'),
            'en_name.unique'=>trans('master.errors.gov_en_name_exist'),
            'ar_name.unique'=>trans('master.errors.gov_ar_name_exist'),
        ]);
        $gov    =   Governorate::query()->findOrFail($id);
        $gov->update([
            'en_name'   =>  $request->get('en_name'),
            'ar_name'   =>  $request->get('ar_name'),
        ]);

        return redirect()->action('MasterData\GovernoratesController@index')->with('success' , trans('global.governorate_updated'));
    }

}
