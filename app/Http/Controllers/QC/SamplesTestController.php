<?php

namespace App\Http\Controllers\QC;

use App\Models\QC\QcTestHeader;
use App\Models\QC\SampleTestHeader;
use App\Models\Security\TransportDetail;
use App\Models\Supplier\Supplier;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SamplesTestController extends Controller
{
    public function index()
    {
        $sampleTestHeaders  =   SampleTestHeader::query()->orderByDesc('created_at')->paginate(25);
        $suppliers          =   Supplier::all();
        $qc_tests           =   QcTestHeader::query()->get();
        $users              =   User::query()->whereHas('labUsers')->get();

        return view('quality-control.sample-test.index' , [
            'sampleTestHeaders'   =>  $sampleTestHeaders,
            'suppliers' =>  $suppliers,
            'users' =>  $users,
            'qc_tests' =>  $qc_tests,
        ]);
    }
    public function create()
    {
        $transport_detail   =   TransportDetail::query()
            ->where('id' , \request()->get('transport_detail_id'))
            ->doesntHave('sampleTestHeader')
            ->first();

        if($transport_detail) {
            $transport_detail->load('transport' , 'testableType.qcTestHeader.details');
        } else {
            return redirect()->action('QC\ArrivedTrucksController@index');
        }


        return view('quality-control.sample-test.create' , ['transport_detail'  =>  $transport_detail]);
    }

    public function store(Request $request)
    {
        $this->validate($request , [
            'details.*.sampled_range'           =>  'required_if:element_type,range',
            'details.*.sampled_expected_result' =>  'required_if:element_type,question',
            'details.*.result'                  =>  'required',
            'result'                            =>  'required',
        ]);

        DB::beginTransaction();

        try {

            $transportDetail    =   TransportDetail::query()->find($request->get('transport_detail_id'));
            $header =   $transportDetail->sampleTestHeader()->create([
                'transport_detail_id'   =>  $request->get('transport_detail_id'),
                'qc_test_header_id'     =>  $request->get('qc_test_header_id'),
                'result'                =>  strtolower($request->get('result')),
                'reason'                =>  $request->get('reason'),
                'created_by'            =>  Auth::user()->id,
            ]);

            $header->details()->createMany($request->get('details'));

            $transportDetail->update(['status' => strtolower($request->get('result'))]);
            $transportDetail->transport->updateStatus();

            DB::commit();

            return redirect()->action('QC\ArrivedTrucksController@index');
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage() , $request->input());
            return redirect()->back()->with('error' , trans('global.cannot_save_contact_admin'));
        }



    }

    public function edit($id) {
        $transport_detail   =   TransportDetail::query()
            ->where('id' , $id)
            ->first();

        if($transport_detail) {
            $transport_detail->load('transport' , 'testableType.qcTestHeader.details');
        } else {
            return redirect()->action('QC\ArrivedTrucksController@index');
        }


        return view('quality-control.sample-test.create' , ['transport_detail'  =>  $transport_detail]);
    }

}