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
            'limit'  =>  'required',
            'scale_error'  =>  'required',
            'ip_address'  =>  ['required' , new ScaleUniqueIpAddress()],
            'brand'  =>  'required',
            'com_port'  =>  'required',
            'baud_rate'  =>  'required',
            'byte_size'  =>  'required',
            'stop_bits'  =>  'required',
            'parity'  =>  'required',
            'timeout'  =>  'required',
            'tolerance'  =>  'required',
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
            'limit'  =>  'required',
            'scale_error'  =>  'required',
            'ip_address'  =>  ['required' , new ScaleUniqueIpAddress()],
            'brand'  =>  'required',
            'com_port'  =>  'required',
            'baud_rate'  =>  'required',
            'byte_size'  =>  'required',
            'stop_bits'  =>  'required',
            'parity'  =>  'required',
            'timeout'  =>  'required',
            'tolerance'  =>  'required',
        ]);

        $request->offsetSet('is_active' , $request->input('is_active' , 0));
        $scale  =   Scale::query()->findOrFail($id);
        $scale->update($request->input());

        return redirect()->action('MasterData\ScalesController@index')->with('success' , trans('global.scale_updated'));
    }
}
