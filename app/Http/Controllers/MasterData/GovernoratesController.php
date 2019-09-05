<?php

namespace App\Http\Controllers\MasterData;

use App\Models\Government;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GovernoratesController extends Controller
{
    public function index()
    {
        $governorates   =   Government::query()->paginate(25);
        return view('master-data.governorates.index' , ['governorates' => $governorates]);
    }

    public function create(){
        return view('master-data.governorates.create');
    }

    public function store(Request $request) {
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

        $gov    =   Government::query()->create([
            'en_name'   =>  $request->get('en_name'),
            'ar_name'   =>  $request->get('ar_name'),
        ]);

        return redirect()->action('MasterData\GovernmentsController@index')->with('success' , trans('global.governorate_created'));
    }

    public function edit($id){
        $governorate    =   Government::query()->findOrFail($id);
        return view('master-data.governorates.edit' , ['governorate' => $governorate]);
    }

    public function update(Request $request , $id) {
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
        $gov    =   Government::query()->findOrFail($id);
        $gov->update([
            'en_name'   =>  $request->get('en_name'),
            'ar_name'   =>  $request->get('ar_name'),
        ]);

        return redirect()->action('MasterData\GovernmentsController@index')->with('success' , trans('global.governorate_updated'));
    }

}
