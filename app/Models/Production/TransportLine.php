<?php

namespace App\Models\Production;

use App\Models\Security\TransportDetail;
use Illuminate\Database\Eloquent\Model;

class TransportLine extends Model
{
    protected $table    =   'transport_lines';
    protected $guarded  =   ['id'];

    public function transport()
    {
        return $this->transportDetail()->transport();
    }

    public function transportDetail()
    {
        return $this->belongsTo(TransportDetail::class , 'transport_detail_id' , 'id');
    }

    public function line()
    {
        return $this->belongsTo(Line::class , 'line_id' , 'id');
    }
}
