<?php

namespace App\Http\Controllers\MasterData;

use App\Models\QC\QcElement;
use App\Traits\AuthorizeTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QcElementsController extends Controller
{
    use AuthorizeTrait;

    public function index()
    {
        $this->authorized('qc-elements.index');
        $elements   =   QcElement::query()->paginate(25);
        return view('master-data.qc-elements.index' , ['elements'   =>  $elements]);
    }

    public function create()
    {
        $this->authorized('qc-elements.create');
        return view('master-data.qc-elements.create');
    }

    public function store(Request $request)
    {
        $this->authorized('qc-elements.create');

        $this->validate($request , [
            'en_name'   =>  'required|unique:qc_elements',
            'ar_name'   =>  'required',
            'test_type' =>  'required|in:visual,chemical',
            'element_type'  =>  'required|in:range,question',
            'element_unit'  =>  'required',
        ]);

        $element    =   QcElement::query()->create($request->input());

        return redirect()->action('MasterData\QcElementsController@index')->with('success' , trans('global.created_success'));
    }

    public function edit($id)
    {
        $this->authorized('qc-elements.edit');
        $element    =   QcElement::query()->findOrFail($id);

        return view('master-data.qc-elements.edit' , ['element' =>  $element]);
    }

    public function update(Request $request , $id)
    {
        $this->authorized('qc-elements.create');

        $this->validate($request , [
            'en_name'   =>  'required|unique:qc_elements,en_name,'.$id,
            'ar_name'   =>  'required',
            'test_type' =>  'required|in:visual,chemical',
            'element_type'  =>  'required|in:range,question',
            'element_unit'  =>  'required',
        ]);

        $element    =   QcElement::query()->findOrFail($id);
        $element->update($request->input());

        return redirect()->action('MasterData\QcElementsController@index')->with('success' , trans('global.updated_success'));
    }
}
