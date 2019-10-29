<?php

namespace App\Models\QC;

use Illuminate\Database\Eloquent\Model;

class SampleTestHeader extends Model
{
    protected $table    =   'samples_test_header';
    protected $guarded  =   ['id'];

    public function details()
    {
        return $this->hasMany(SampleTestDetail::class , 'sample_test_header_id' , 'id');
    }

    public function qcTestDetail()
    {
        return $this->belongsTo(QcTestDetail::class , 'qc_test_detail_id' , 'id');
    }
}
