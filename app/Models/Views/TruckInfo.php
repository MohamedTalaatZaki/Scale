<?php

namespace App\Models\Views;

use App\Models\Production\TransportLine;
use App\Models\Security\TransportDetail;
use App\Models\Supplier\Supplier;
use App\Traits\HasFilter;
use Illuminate\Database\Eloquent\Model;

class TruckInfo extends Model
{
    use HasFilter;

    protected $table    =   'v_trucks_info';
    protected $guarded  =   ['id'];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class , 'supplier_id' , 'id');
    }
    public function trucksLineTransactions()
    {
        return $this->hasManyThrough(TransportLine::class,  TransportDetail::class, 'transport_id' , 'transport_detail_id' );
    }
}
