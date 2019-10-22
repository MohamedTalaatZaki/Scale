<?php

namespace App\Models\Security;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Mail\Transport\Transport;

class TransportDetail extends Model
{
    protected $table    =   'transport_details';
    protected $guarded  =   ['id'];

    public function transport()
    {
        return $this->belongsTo(Transport::class , 'transport_id' , 'id');
    }
}
