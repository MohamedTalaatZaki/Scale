<?php

namespace App\Http\Controllers\MasterData;

use App\Models\Items\ItemGroup;
use App\Models\QC\QcElement;
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
            'qc_test_headers'   =>  QcTestHeader::query()->paginate('25'),
        ]);
    }

    public function create()
    {
        $this->authorized('qc-test-headers.create');
        return  view('master-data.qc-test-header.create' , [
            'groups'    =>  ItemGroup::query()->doesntHave('qcTestHeader')->where('testable' , 1)->get(),
            'elements'          =>  QcElement::query()->get(),
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request , [
            'en_name'                   =>  'required',
            'ar_name'                   =>  'required',
            'item_group_id'             =>  'required|exists:item_group,id',
            'details'                   =>  'required|array',
            'details.*.test_type'       =>  'required',
            'details.*.element_type'    =>  'required',
            'details.*.expected_result' =>  'required_if:details.*.element_type,=,question',
            'details.*.min_range'       =>  'required_if:details.*.element_type,=,range',
            'details.*.max_range'       =>  'required_if:details.*.element_type,=,range',
        ],[
            "item_group_id.required"=>trans("master.errors.item_group_id_required")
        ]);

        $request->offsetSet('is_active' , $request->input('is_active' , 0));
        $header_data    =   $request->only('ar_name' , 'en_name' , 'item_group_id' , 'is_active');
        $header         =   QcTestHeader::query()->create($header_data);
        $details    =   array_map(function ($arr) {
            unset($arr['test_type']);
            unset($arr['element_type']);
            unset($arr['element_unit']);
            return $arr;
        }, $request->get('details'));

        $header->details()->createMany($details);

        return redirect()->action('MasterData\QcTestHeaderController@index')->with('success' , trans('global.created_success'));
    }

    public function edit($id)
    {
        $this->authorized('qc-test-headers.edit');
        $groups =   ItemGroup::query()
            ->whereDoesntHave('qcTestHeader' , function ($q) use($id) {
                $q->where('item_group_id' , '!=' , $id);})
            ->where('testable' , 1)->get();

        return  view('master-data.qc-test-header.edit' , [
            'qcTest'    =>  QcTestHeader::query()->with('details.element')->findOrFail($id),
            'groups'    =>  $groups,
            'elements'          =>  QcElement::query()->get(),
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
            'details.*.test_type'       =>  'required',
            'details.*.element_type'    =>  'required',
            'details.*.expected_result' =>  'required_if:details.*.element_type,=,question',
            'details.*.min_range'       =>  'required_if:details.*.element_type,=,range',
            'details.*.max_range'       =>  'required_if:details.*.element_type,=,range',
        ],[
            "item_group_id.required"=>trans("master.errors.item_group_id_required")
        ]);

        $request->offsetSet('is_active' , $request->input('is_active' , 0));

        $header =   QcTestHeader::query()->findOrFail($id);
        $header->update($request->only('ar_name' , 'en_name' , 'item_group_id' , 'is_active'));
        $deleted_ids    =   array_filter(array_column($request->input('details') , 'id') , function ($id){return !is_null($id);});
        $header->details()->whereNotIn('id' , $deleted_ids)->delete();
        $details    =   array_map(function ($arr) {
            unset($arr['test_type']);
            unset($arr['element_type']);
            unset($arr['element_unit']);
            return $arr;
        }, $request->get('details'));
        foreach ($details as $detail) {
            $detail['id']   =  $detail['id'] > 0 ? $detail['id'] : 0;
            $header->details()->updateOrCreate(['id' => $detail['id']] , $detail);
        }

        return redirect()->action('MasterData\QcTestHeaderController@index')->with('success' , trans('global.updated_success'));
    }
}
