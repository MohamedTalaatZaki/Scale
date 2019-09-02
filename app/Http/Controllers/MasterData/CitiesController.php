<?php

namespace App\Http\Controllers\MasterData;

use App\Models\City;
use App\Models\Governorate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CitiesController extends Controller
{
    public function index()
    {
        $cities   =   City::query()->paginate(10);
        return view('master-data.cities.index' , ['cities' => $cities]);
    }

    public function create(){
        $governorates   =   Governorate::query()->where('is_active' , true)->get();
        return view('master-data.cities.create' , ['governorates' => $governorates]);
    }

    public function store(Request $request) {
        $this->validate($request , [
            'gov_id'    =>  'required|exists:governorates,id',
            'en_name'   =>  'required|unique:cities,en_name',
            'ar_name'   =>  'required|unique:cities,ar_name'
        ]);

        $city    =   City::query()->create([
            'gov_id'   =>  $request->get('gov_id'),
            'en_name'   =>  $request->get('en_name'),
            'ar_name'   =>  $request->get('ar_name'),
            'is_active' =>  $request->has('is_active') ? 1 : 0,
        ]);

        return redirect()->action('MasterData\CitiesController@index')->with('success' , trans('global.city_created'));
    }

    public function edit($id){
        $governorates   =   Governorate::query()->where('is_active' , true)->get();
        $city    =   City::query()->findOrFail($id);
        return view('master-data.cities.edit' , ['governorates' => $governorates , 'city' => $city]);
    }

    public function update(Request $request , $id) {
        $this->validate($request , [
            'gov_id'    =>  'required|exists:governorates,id',
            'en_name'   =>  'required|unique:cities,id',
            'ar_name'   =>  'required|unique:cities,id'
        ]);
        $city    =   City::query()->findOrFail($id);

        $city->update([
            'gov_id'   =>  $request->get('gov_id'),
            'en_name'   =>  $request->get('en_name'),
            'ar_name'   =>  $request->get('ar_name'),
            'is_active' =>  $request->has('is_active') ? 1 : 0,
        ]);

        return redirect()->action('MasterData\CitiesController@index')->with('success' , trans('global.city_updated'));
    }
}
