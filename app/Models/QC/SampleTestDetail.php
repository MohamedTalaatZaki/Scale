<?php

namespace App\Models\QC;

use Illuminate\Database\Eloquent\Model;

class SampleTestDetail extends Model
{
    protected $table    =   'samples_test_details';
    protected $guarded  =   ['id'];

    public function header()
    {
        return $this->belongsTo(SampleTestHeader::class , 'sample_test_header_id' , 'id');
    }

    public function qcTestDetail()
    {
        return $this->belongsTo(QcTestDetail::class , 'qc_test_detail_id' , 'id');
    }

}
