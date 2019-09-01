<?php

namespace App\Http\Controllers\MasterData;

use App\Models\Governorate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GovernoratesController extends Controller
{
    public function index()
    {
        $governorates   =   Governorate::query()->paginate(10);
        return view('master-data.governorates.index' , ['governorates' => $governorates]);
    }

    public function create(){
        return view('master-data.governorates.create');
    }

    public function store(Request $request) {
        $this->validate($request , [
            'en_name'   =>  'required|unique:governorates,en_name',
            'ar_name'   =>  'required|unique:governorates,ar_name'
        ]);

        $gov    =   Governorate::query()->create([
            'en_name'   =>  $request->get('en_name'),
            'ar_name'   =>  $request->get('ar_name'),
            'is_active' =>  $request->has('is_active') ? 1 : 0,
        ]);

        return redirect()->action('MasterData\GovernoratesController@index')->with('success' , trans('global.governorate_created'));
    }

    public function edit($id){
        $governorate    =   Governorate::query()->findOrFail($id);
        return view('master-data.governorates.edit' , ['governorate' => $governorate]);
    }

    public function update(Request $request , $id) {
        $this->validate($request , [
            'en_name'   =>  'required|unique:governorates,id',
            'ar_name'   =>  'required|unique:governorates,id'
        ]);
        $gov    =   Governorate::query()->findOrFail($id);

        $gov->update([
            'en_name'   =>  $request->get('en_name'),
            'ar_name'   =>  $request->get('ar_name'),
            'is_active' =>  $request->has('is_active') ? 1 : 0,
        ]);

        return redirect()->action('MasterData\GovernoratesController@index')->with('success' , trans('global.governorate_updated'));
    }

}
