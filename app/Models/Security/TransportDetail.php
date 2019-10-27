<?php

namespace App\Models\Security;

use App\Models\Items\ItemGroup;
use Illuminate\Database\Eloquent\Model;

class TransportDetail extends Model
{
    protected $table    =   'transport_details';
    protected $guarded  =   ['id'];
    protected $appends  =   ['plate_name'];

    public function transport()
    {
        return $this->belongsTo(Transports::class , 'transport_id' , 'id');
    }

    public function testableType()
    {
        return $this->hasOneThrough(ItemGroup::class , Transports::class , 'id' , 'id' , 'transport_id' , 'item_group_id');
    }

    public function getPlateNameAttribute() {
        return $this->attributes['plate_name']  =   $this->is_trailer ? 'trailer' : 'tractor' ;
    }
}
