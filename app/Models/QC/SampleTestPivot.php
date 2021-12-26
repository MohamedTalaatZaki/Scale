<?php

namespace App\Models\QC;

use Illuminate\Database\Eloquent\Model;

class SampleTestPivot extends Model
{
    protected $table    =   'qc_pivot_result_rpt';
    protected $guarded  =   ['id'];
}
