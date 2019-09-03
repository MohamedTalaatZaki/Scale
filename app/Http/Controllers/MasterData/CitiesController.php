<?php

namespace App\Http\Controllers\MasterData;

use App\Models\City;
use App\Models\Government;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CitiesController extends Controller
{
    public function index()
    {
        $cities   =   City::query()->paginate(25);
        return view('master-data.cities.index' , ['cities' => $cities]);
    }

    public function create(){
        $governorates   =   Government::query()->get();
        return view('master-data.cities.create' , ['governorates' => $governorates]);
    }

    public function store(Request $request) {
        $this->validate($request , [
            'gov_id'    =>  'required',
            'en_name'   =>  'required|unique:cities,en_name',
            'ar_name'   =>  'required|unique:cities,ar_name'
        ],
        [
            'gov_id.required'=>trans('master.errors.gov_required'),
            'en_name.required'=>trans('master.errors.en_name_required'),
            'ar_name.required'=>trans('master.errors.ar_name_required'),
            'en_name.unique'=>trans('master.errors.city_en_name_exist'),
            'ar_name.unique'=>trans('master.errors.city_ar_name_exist'),
        ]);

        $city    =   City::query()->create([
            'gov_id'   =>  $request->get('gov_id'),
            'en_name'   =>  $request->get('en_name'),
            'ar_name'   =>  $request->get('ar_name'),
        ]);

        return redirect()->action('MasterData\CitiesController@index')->with('success' , trans('global.city_created'));
    }

    public function edit($id){
        $governorates   =   Government::query()->get();
        $city    =   City::query()->findOrFail($id);
        return view('master-data.cities.edit' , ['governorates' => $governorates , 'city' => $city]);
    }

    public function update(Request $request , $id) {
        $this->validate($request , [
            'gov_id'    =>  'required',
            'en_name'   =>  'required|unique:cities,en_name,'.$id,
            'ar_name'   =>  'required|unique:cities,ar_name,'.$id
        ],
            [
                'gov_id.required'=>trans('master.errors.gov_required'),
                'en_name.required'=>trans('master.errors.en_name_required'),
                'ar_name.required'=>trans('master.errors.ar_name_required'),
                'en_name.unique'=>trans('master.errors.city_en_name_exist'),
                'ar_name.unique'=>trans('master.errors.city_ar_name_exist'),
            ]);
        $city    =   City::query()->findOrFail($id);

        $city->update([
            'gov_id'   =>  $request->get('gov_id'),
            'en_name'   =>  $request->get('en_name'),
            'ar_name'   =>  $request->get('ar_name'),
        ]);

        return redirect()->action('MasterData\CitiesController@index')->with('success' , trans('global.city_updated'));
    }
}
