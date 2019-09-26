<?php

namespace App\Http\Controllers\MasterData;

use App\Models\Items\ItemGroup;
use App\Models\QC\QcTestHeader;
use App\Traits\AuthorizeTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QcTestHeaderController extends Controller
{
    use AuthorizeTrait;

    public function index()
    {
        $this->authorized('qc-test-headers.index');
        return  view('master-data.qc-test-header.index' , [
            'qc_test_headers'  =>   QcTestHeader::query()->paginate('25'),
        ]);
    }

    public function create()
    {
        $this->authorized('qc-test-headers.create');
        return  view('master-data.qc-test-header.create' , [
            'groups'    =>  ItemGroup::query()->where('testable' , 1)->get(),
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request , [
            'en_name'                   =>  'required',
            'ar_name'                   =>  'required',
            'item_group_id'             =>  'required|exists:item_group,id',
            'details'                   =>  'required|array',
            'details.*.en_name'         =>  'required',
            'details.*.ar_name'         =>  'required',
            'details.*.test_type'       =>  'required',
            'details.*.element_type'    =>  'required',
            'details.*.expected_result' =>  'required_if:details.*.element_type,=,question',
            'details.*.min_range'       =>  'required_if:details.*.element_type,=,range',
            'details.*.max_range'       =>  'required_if:details.*.element_type,=,range',
            'details.*.element_unit'    =>  'required_if:details.*.element_type,=,range',
        ]);

        $request->offsetSet('is_active' , $request->input('is_active' , 0));
        $header_data    =   $request->only('ar_name' , 'en_name' , 'item_group_id' , 'is_active');
        $header         =   QcTestHeader::query()->create($header_data);
        $header->details()->createMany($request->get('details'));

        return redirect()->action('MasterData\QcTestHeaderController@index')->with('success' , trans('global.created_success'));
    }

    public function edit($id)
    {
        $this->authorized('qc-test-headers.edit');
        return  view('master-data.qc-test-header.edit' , [
            'qcTest'    =>  QcTestHeader::query()->findOrFail($id),
            'groups'    =>  ItemGroup::query()->where('testable' , 1)->get(),
        ]);
    }

    public function update(Request $request , $id)
    {
        $this->authorized('qc-test-headers.edit');
        $this->validate($request , [
            'en_name'                   =>  'required',
            'ar_name'                   =>  'required',
            'item_group_id'             =>  'required|exists:item_group,id',
            'details'                   =>  'required|array',
            'details.*.en_name'         =>  'required',
            'details.*.ar_name'         =>  'required',
            'details.*.test_type'       =>  'required',
            'details.*.element_type'    =>  'required',
            'details.*.expected_result' =>  'required_if:details.*.element_type,=,question',
            'details.*.min_range'       =>  'required_if:details.*.element_type,=,range',
            'details.*.max_range'       =>  'required_if:details.*.element_type,=,range',
            'details.*.element_unit'    =>  'required_if:details.*.element_type,=,range',
        ]);

        $request->offsetSet('is_active' , $request->input('is_active' , 0));

        $header =   QcTestHeader::query()->findOrFail($id);
        $header->update($request->only('ar_name' , 'en_name' , 'item_group_id' , 'is_active'));
        foreach ($request->input('details') as $detail) {
            $detail['id']   =  $detail['id'] > 0 ? $detail['id'] : 0;
            $header->details()->updateOrCreate(['id' => $detail['id']] , $detail);
        }

        return redirect()->action('MasterData\QcTestHeaderController@index')->with('success' , trans('global.updated_success'));
    }
}
