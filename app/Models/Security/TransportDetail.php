<?php

namespace App\Models\Security;

use App\Models\Items\ItemGroup;
use App\Models\QC\SampleTestHeader;
use Illuminate\Database\Eloquent\Model;

class TransportDetail extends Model
{
    protected $table    =   'transport_details';
    protected $guarded  =   ['id'];
    protected $appends  =   ['ar_plate_name' ,'plate_name' , 'readable_status'];

    public function transport()
    {
        return $this->belongsTo(Transports::class , 'transport_id' , 'id');
    }

    public function testableType()
    {
        return $this->hasOneThrough(ItemGroup::class , Transports::class , 'id' , 'id' , 'transport_id' , 'item_group_id');
    }

    public function sampleTestHeader(){
        return $this->hasMany(SampleTestHeader::class , 'transport_detail_id' , 'id');
    }

    public function lastSampleTestHeader(){
        return $this->sampleTestHeader()->orderByDesc('created_at')->limit(1);
    }

    public function getPlateNameAttribute() {
        return $this->attributes['plate_name']  =   $this->is_trailer ? 'trailer' : 'tractor' ;
    }

    public function getArPlateNameAttribute() {
        return $this->attributes['ar_plate_name']  =   $this->is_trailer ? 'المقطورة' : 'الجرار' ;
    }

    public function getReadableStatusAttribute()
    {
        $status =   "";
        switch ($this->status) {
            case "waiting":
                $status =   'بانتظار الوزن';
                break;
            case "accepted":
                $status =   'مقبولة من المعمل و بانتظار الوزن';
                break;
            case "rejected":
                $status =   'مرفوضه من المعمل';
                break;
        }
        return $this->attributes['readable_status']  =   $status;
    }
}
