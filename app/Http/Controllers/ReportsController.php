<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class ReportsController extends Controller
{
    private $repo_path = "http://10.3.200.15:8080/";
    private $vars      = "?skinName=highcontrast&type=Scale&rpt=";

    public function getScalePrintOutRpt($request)
    {
        $values  =  '&value='.$request;
        $html    =  "scale-printout.html";
        $rpt     =  "scale-printout";

        return redirect()->away($this->repo_path.$html.$this->vars.$rpt.$values);
    }

    public function getQcLabelRpt($request)
    {
        $values  =  '&value='.$request;
        $html    =  "qc-label.html";
        $rpt     =  "qc-label";

        return redirect()->away($this->repo_path.$html.$this->vars.$rpt.$values);
    }

    public function getQcAnalysisRpt($request){
        $values  =  '&value='.$request;
        $html    =  "qc-analysis.html";
        $rpt     =  "qc-testprintout";

        return redirect()->away($this->repo_path.$html.$this->vars.$rpt.$values);
    }

    public function getQcPivotRpt($request){

        $values  =  '&value='.$request;
        $html    =  "qc-pivot.html";
        $rpt     =  "qc-pivot";

        return redirect()->away($this->repo_path.$html.$this->vars.$rpt.$values);
    }

    public function getTruckSummary(Request $request){

        $link = '';    

        foreach ($request->input() as $key => $value) {
             
             if($key == 'from_date' || $key == 'to_date'){
                $dt = Carbon::createFromFormat('m/d/Y',$value);
                $value = $dt->format('Y-m-d');
             }

             $link = $link.'&'.$key.'='.$value;
        }

        $values  =  $link;
        $html    =  "truck-summary-suppliers.html";
        $rpt     =  "truck-summary-suppliers";

        if($request->input('supplier_id') != null){

                $html    =  "truck-summary.html";
                $rpt     =  "truck-summary";            
        }
        //dd($this->repo_path.$html.$this->vars.$rpt.$values);

        return redirect()->away($this->repo_path.$html.$this->vars.$rpt.$values);
    }
}
