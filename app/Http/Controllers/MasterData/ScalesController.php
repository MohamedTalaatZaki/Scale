<?php

namespace App\Http\Controllers\MasterData;

use App\Models\Scales\Scale;
use App\Rules\ScaleUniqueIpAddress;
use App\Traits\AuthorizeTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ScalesController extends Controller
{
    use AuthorizeTrait;

    public function index() {
        $this->authorized('scales.index');
        return view('master-data.scales.index' , [
            'scales'    =>  Scale::query()->paginate(25),
        ]);
    }

    public function create() {
        $this->authorized('scales.create');
        return view('master-data.scales.create' );
    }

    public function store(Request $request) {
        $this->authorized('scales.create');

        $this->validate($request , [
            'code'  =>  'required|unique:scales,code',
            'ip_address'  =>  ['required' , new ScaleUniqueIpAddress()],
            'brand'  =>  'required',
            'com_port'  =>  'required',
            'baud_rate'  =>  'required',
            'byte_size'  =>  'required',
            'stop_bits'  =>  'required',
            'parity'  =>  'required',
            'limit' =>  'nullable|numeric|min:0',
            'scale_error' =>  'nullable|numeric|min:0',
            'tolerance' =>  'nullable|numeric|min:0',
            'timeout' =>  'nullable|numeric|min:0',
        ]);

        Scale::query()->create($request->input());

        return redirect()->action('MasterData\ScalesController@index')->with('success' , trans('global.scale_created'));
    }

    public function edit($id) {
        $this->authorized('scales.edit');
        return view('master-data.scales.edit'  , [
            'scale' =>  Scale::query()->findOrFail($id),
        ]);
    }

    public function update(Request $request , $id) {
        $this->authorized('scales.edit');

        $this->validate($request , [
            'code'  =>  'required|unique:scales,code,'.$id,
            'ip_address'  =>  ['required' , new ScaleUniqueIpAddress($id)],
            'brand'  =>  'required',
            'com_port'  =>  'required',
            'baud_rate'  =>  'required',
            'byte_size'  =>  'required',
            'stop_bits'  =>  'required',
            'parity'  =>  'required',
            'limit' =>  'nullable|numeric|min:0',
            'scale_error' =>  'nullable|numeric|min:0',
            'tolerance' =>  'nullable|numeric|min:0',
            'timeout' =>  'nullable|numeric|min:0',
        ]);

        $request->offsetSet('limit' , $request->input('limit') != null ?$request->input('limit'): 10000);
        $request->offsetSet('scale_error' , $request->input('scale_error') != null ?$request->input('scale_error'): 0);
        $request->offsetSet('tolerance' , $request->input('tolerance') != null ?$request->input('tolerance'): 0);
        $request->offsetSet('timeout' , $request->input('timeout') != null ?$request->input('timeout'): 0);
        $request->offsetSet('is_active' , $request->input('is_active' , 0));

        $inputs = array_filter($request->input() , function ($elem){ return !is_null($elem);});
        $scale  =   Scale::query()->findOrFail($id);
        $scale->update($inputs);

        return redirect()->action('MasterData\ScalesController@index')->with('success' , trans('global.scale_updated'));
    }

    public function getScaleDataAjax(Request $request)
    {
        $scale  =   Scale::query()->where('ip_address' , $request->getClientIp())->first();
        return $scale ? $scale : response("cannot find scale" , 400);
    }
}
