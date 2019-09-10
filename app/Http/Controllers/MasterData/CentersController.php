<?php

namespace App\Http\Controllers\MasterData;

use App\Models\Center;
use App\Models\City;
use App\Models\Governorate;
use App\Traits\AuthorizeTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CentersController extends Controller
{
    use AuthorizeTrait;
    public function index()
    {
        $this->authorized('centers.index');
        $centers   =   Center::query()->paginate(10);
        return view('master-data.centers.index' , ['centers' => $centers]);
    }

    public function create(){
        $this->authorized('centers.create');
        $governorates   =   Governorate::query()->with('cities')->get();
        return view('master-data.centers.create' , ['governorates' => $governorates]);
    }

    public function store(Request $request) {
        $this->authorized('centers.create');
        $this->validate($request , [
            'city_id'   =>  'required|exists:cities,id',
            'en_name'   =>  'required|unique:centers,en_name',
            'ar_name'   =>  'required|unique:centers,ar_name'
        ]);
        $center    =   Center::query()->create([
            'city_id'   =>  $request->get('city_id'),
            'en_name'   =>  $request->get('en_name'),
            'ar_name'   =>  $request->get('ar_name'),
            'is_active' =>  $request->has('is_active') ? 1 : 0,
        ]);

        return redirect()->action('MasterData\CentersController@index')->with('success' , trans('global.center_created'));
    }

    public function edit($id){
        $this->authorized('centers.edit');
        $governorates   =   Governorate::query()->with('cities')->get();
        $center    =   Center::query()->findOrFail($id);
        return view('master-data.centers.edit' , ['governorates' => $governorates , 'center' => $center]);
    }

    public function update(Request $request , $id) {
        $this->authorized('centers.edit');
        $this->validate($request , [
            'city_id'   =>  'required|exists:cities,id',
            'en_name'   =>  'required|unique:centers,en_name,'.$id,
            'ar_name'   =>  'required|unique:centers,ar_name,'.$id
        ]);
        $center    =   Center::query()->findOrFail($id);

        $center->update([
            'city_id'   =>  $request->input('city_id'),
            'en_name'   =>  $request->input('en_name'),
            'ar_name'   =>  $request->input('ar_name'),
            'is_active' =>  $request->has('is_active') ? 1 : 0,
        ]);

        return redirect()->action('MasterData\CentersController@index')->with('success' , trans('global.center_updated'));
    }
}
