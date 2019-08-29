<?php

namespace App\Http\Controllers\MasterData;

use App\Models\City;
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
        return view('master-data.cities.create');
    }

    public function store(Request $request) {
        $this->validate($request , [
            'gov_id'    =>  'required',
            'en_name'   =>  'required|unique:cities,en_name',
            'ar_name'   =>  'required|unique:cities,ar_name'
        ]);

        $gov    =   City::query()->create([
            'en_name'   =>  $request->get('en_name'),
            'ar_name'   =>  $request->get('ar_name'),
            'is_active' =>  $request->has('is_active') ? 1 : 0,
        ]);

        return redirect()->action('MasterData\CitiesController@index')->with('success' , trans('global.city_created'));
    }

    public function edit($id){
        $city    =   City::query()->findOrFail($id);
        return view('master-data.cities.edit' , ['city' => $city]);
    }

    public function update(Request $request , $id) {
        $this->validate($request , [
            'gov_id'    =>  'required',
            'en_name'   =>  'required|unique:cities,id',
            'ar_name'   =>  'required|unique:cities,id'
        ]);
        $gov    =   City::query()->findOrFail($id);

        $gov->update([
            'en_name'   =>  $request->get('en_name'),
            'ar_name'   =>  $request->get('ar_name'),
            'is_active' =>  $request->has('is_active') ? 1 : 0,
        ]);

        return redirect()->action('MasterData\CitiesController@index')->with('success' , trans('global.city_updated'));
    }
}
