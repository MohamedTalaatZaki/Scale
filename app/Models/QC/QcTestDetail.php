<?php

namespace App\Models\QC;

use Illuminate\Database\Eloquent\Model;

class QcTestDetail extends Model
{
    protected $table    =   'qc_test_details';
    protected $guarded  =   ['id'];


    public function header()
    {
        return $this->belongsTo(QcTestDetail::class , 'qc_test_header_id' , 'id');
    }

}
