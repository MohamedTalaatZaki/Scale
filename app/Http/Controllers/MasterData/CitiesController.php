<?php

namespace App\Http\Controllers\MasterData;

use App\Models\City;
use App\Models\Governorate;
use App\Traits\AuthorizeTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CitiesController extends Controller
{
    use AuthorizeTrait;
    public function index()
    {
        $this->authorized('cities.index');
        $cities   =   City::query()->paginate(25);
        return view('master-data.cities.index' , ['cities' => $cities]);
    }

    public function create(){
        $this->authorized('cities.create');
        $governorates   =   Governorate::query()->get();
        return view('master-data.cities.create' , ['governorates' => $governorates]);
    }

    public function store(Request $request) {
        $this->authorized('cities.create');
        $this->validate($request , [
            'gov_id'    =>  'required',
            'en_name'   =>  'required',
           // 'en_name'   =>  'required|unique:cities,en_name',
            'ar_name'   =>  'required'
           // 'ar_name'   =>  'required|unique:cities,ar_name'
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
        $this->authorized('cities.edit');
        $governorates   =   Governorate::query()->get();
        $city    =   City::query()->findOrFail($id);
        return view('master-data.cities.edit' , ['governorates' => $governorates , 'city' => $city]);
    }

    public function update(Request $request , $id) {
        $this->authorized('cities.edit');
        $this->validate($request , [
            'gov_id'    =>  'required',
            'en_name'   =>  'required',
            //'en_name'   =>  'required|unique:cities,en_name,'.$id,
            'ar_name'   =>  'required'
            //'ar_name'   =>  'required|unique:cities,ar_name,'.$id
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


    public function getGovernorateCities(Request $request)
    {
        $governorate =   Governorate::query()->find($request->get('id'));
        if($governorate)
        {
            return response()->json(['cities'   =>  $governorate->cities()->get()->pluck( 'name' , 'id')]);
        } else {
            return response()->json(['cities' => []]);
        }
    }
}
