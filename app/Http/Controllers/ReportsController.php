<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
