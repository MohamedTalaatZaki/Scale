<?php

namespace App\Http\Controllers\QC;

use App\Filters\SampledTestFilter;
use App\Filters\SampledPivotFilter;
use App\Models\QC\QcTestHeader;
use App\Models\QC\SampleTestPivot;
use App\Models\QC\SampleTestHeader;
use App\Models\Security\TransportDetail;
use App\Models\Supplier\Supplier;
use App\Models\Items\ItemGroup;
use App\Models\views\PivotTestDetails;
use App\Traits\AuthorizeTrait;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SamplesTestController extends Controller
{
    use AuthorizeTrait;
    public function index()
    {
        $this->authorized('samples-test.index');
        $sampleTestHeaders  =   SampleTestHeader::query()
            ->filter(new SampledTestFilter(\request()))
            ->orderByDesc('created_at')
            ->paginate(25);
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


    public function pivotResult()
    {
        $this->authorized('samples-test.index');
        
        $sampleTestHeaders  =  [];
        $user = Auth::user()->id;

        if(!empty(request()->input())){
            $rpt = SampleTestPivot::where('user_id',$user)->delete();
            $sampleTestHeaders  =   PivotTestDetails::query()
                ->filter(new SampledPivotFilter(\request()))
                ->orderByDesc('test_datetime');
                
            foreach ($sampleTestHeaders->get() as $test) {
                    SampleTestPivot::create([
                            "user_id"             =>  $user,
                            "transport_header_id" =>  $test->transport_header_id,
                            "transport_detail_id" =>  $test->transport_detail_id,
                            "item_group_id"       =>  $test->item_group_id,
                            "item_name"           =>  $test->item_name,
                            "truck_plates"        =>  $test->truck_plates,
                            "transport_no"        =>  $test->transport_no,
                            "result"              =>  $test->result,
                            "test_datetime"       =>  $test->test_datetime,
                            "sample_test_header_id" => $test->sample_test_header_id,
                            "test_date"             => $test->test_date,
                            "test_time"             => $test->test_time,
                            "brix"                  => $test->brix,
                            "ph"                    => $test->ph,
                            "acidity"               => $test->acidity,
                            "ratio"                 => $test->ratio,
                            "mold"                  => $test->mold,
                            "damaged"               => $test->damaged,
                        ]);
                }    

            $sampleTestHeaders =   $sampleTestHeaders->paginate(25);

        }

        $groups             =   ItemGroup::query()->get();

        return view('quality-control.pivot-test.index' , [
            'sampleTestHeaders'   =>  $sampleTestHeaders,
            'groups' =>  $groups,
            'user' => $user
        ]);
    }    


    public function create()
    {
        $this->authorized('samples-test.create');
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
        $this->authorized(['samples-test.create' , 'samples-test.edit']);
        $this->validate($request , [
            'details.*.sampled_range'           =>  'required_if:element_type,range',
            'details.*.sampled_expected_result' =>  'required_if:element_type,question',
            'details.*.result'                  =>  'required',
            'result'                            =>  'required',
        ]);

        DB::beginTransaction();

        try {
             if( $request->input('check_permission') && !\Entrust::can('samples-test.acceptRejected') )
             {
                 return redirect()->back()->with('failed' , trans('global.cannot_accept_rejected'));
             }

            $transportDetail    =   TransportDetail::query()->find($request->get('transport_detail_id'));
            $header =   $transportDetail->sampleTestHeader()->create([
                'transport_detail_id'   =>  $request->get('transport_detail_id'),
                'qc_test_header_id'     =>  $request->get('qc_test_header_id'),
                'result'                =>  strtolower($request->get('result')),
                'reason'                =>  $request->get('reason'),
                'test_type'             =>  $transportDetail->sampleTestHeader->count() > 0 ? "r" : "t",
                'created_by'            =>  Auth::user()->id,
            ]);

            $header->details()->createMany($request->get('details'));

            $transportDetail->update(['status' => strtolower($request->get('result'))]);
            $transportDetail->transport->updateStatus();

            DB::commit();

            if($request->input('single'))
                return redirect()->action('QC\ArrivedTrucksSingleController@index');
            else
                return redirect()->action('QC\ArrivedTrucksController@index');

        } catch (\Exception $e) {
            DB::rollBack();
            //dd($e->getMessage() , $request->input());
            return redirect()->back()->with('failed' , trans('global.cannot_save_contact_admin'));
        }



    }

    public function edit($id) {
        $this->authorized('samples-test.edit');
        $transport_detail   =   TransportDetail::query()
                                    ->where('id' , $id)
                                    ->first();

        if($transport_detail) {
            $transport_detail->load('transport' , 'testableType.qcTestHeader.details');
        } else {
            if(env('SINGLE_QC'))
                return redirect()->action('QC\ArrivedTrucksSingleController@index');
            else
                return redirect()->action('QC\ArrivedTrucksController@index');
        }


        return view('quality-control.sample-test.create' , ['transport_detail'  =>  $transport_detail]);
    }

}
