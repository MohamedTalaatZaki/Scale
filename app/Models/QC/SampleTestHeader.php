<?php

namespace App\Models\QC;

use App\Models\Security\TransportDetail;
use App\User;
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

    public function createdBy()
    {
        return $this->belongsTo(User::class , 'created_by' , 'id');
    }

    public function transportDetail() {
        return $this->belongsTo(TransportDetail::class , 'transport_detail_id' , 'id');
    }

    public function qcTestHeader()
    {
        return $this->belongsTo(QcTestHeader::class , 'qc_test_header_id' , 'id');
    }

}
