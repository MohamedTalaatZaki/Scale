<?php

namespace App\Models\Security;

use App\Models\Items\ItemGroup;
use App\Models\Production\TransportLine;
use App\Models\QC\SampleTestHeader;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Security\TransportDetail
 *
 * @property int $id
 * @property int $transport_id
 * @property string $truck_plates
 * @property int $is_trailer
 * @property string $status
 * @property float $out_weight
 * @property float $in_weight
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $ar_plate_name
 * @property-read mixed $plate_name
 * @property-read mixed $readable_status
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\QC\SampleTestHeader[] $sampleTestHeader
 * @property-read int|null $sample_test_header_count
 * @property-read \App\Models\Security\Transports $transport
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Security\TransportDetail newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Security\TransportDetail newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Security\TransportDetail query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Security\TransportDetail whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Security\TransportDetail whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Security\TransportDetail whereInWeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Security\TransportDetail whereIsTrailer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Security\TransportDetail whereOutWeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Security\TransportDetail whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Security\TransportDetail whereTransportId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Security\TransportDetail whereTruckPlates($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Security\TransportDetail whereUpdatedAt($value)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Security\TransportDetail transportCanWeight()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Security\TransportDetail transportCanReWeight()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Security\TransportDetail transportCannotWeight()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Security\TransportDetail transportHasInProcess()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Security\TransportDetail notStartedTransports()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Security\TransportDetail startedTransports()
 */
class TransportDetail extends Model
{
    protected $table    =   'transport_details';
    protected $guarded  =   ['id'];
    protected $appends  =   ['ar_plate_name' ,'plate_name' , 'readable_status'];

    const WAITING       =   'waiting';
    const ACCEPTED      =   'accepted';
    const PROCESSED     =   'processed';
    const RE_WEIGHT     =   're_weight';
    const REJECTED      =   'rejected';
    const IN_PROCESS    =   'in_process';
    const IN_WEIGHT     =   'in_weight';
    const OUT_WEIGHT    =   'in_weight';
    const START_UNLOAD  =   'start_unload';
    const START_LOAD    =   'start_load';

    public function transport()
    {
        return $this->belongsTo(Transports::class , 'transport_id' , 'id');
    }

    public function ItemGroup()
    {
        return $this->belongsTo(ItemGroup::class , 'item_group_id' , 'id');
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



    public function transportLine()
    {
        return $this->hasMany(TransportLine::class , 'transport_detail_id' , 'id');
    }

    public function LastTransportLine()
    {
        return $this->transportLine()->orderByDesc('id')->limit(1);
    }

    public function getPlateNameAttribute() {
        return $this->attributes['plate_name']  =   $this->is_trailer ? 'trailer' : 'tractor' ;
    }

    public function getArPlateNameAttribute() {
        return $this->attributes['ar_plate_name']  =   $this->is_trailer ? 'مقطورة' : 'جرار' ;
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
            case "processed":
                $status = 'بانتظار الوزنه الثانيه';
                break;
            case "re_weight":
                $status =   'بانتظار اعادة الوزن';
                break;
            case "rejected":
                $status =   'مرفوضه من المعمل';
                break;
        }
        return $this->attributes['readable_status']  =   $status;
    }

    public function scopeTransportCanWeight()
    {
        return $this
            ->whereHas('transport' , function ($query){
                $query->whereIn('status' , ['accepted' , 'waiting' , 'in_process']);
            })
            ->whereIn('status' , ['accepted' , 'waiting' , 'processed' , 're_weight'])
            ->where(function ($query){
                $query->where('in_weight' , 0)->orWhere('out_weight' , 0);
            });
    }

    public function scopeTransportHasInProcess()
    {
        return $this
            ->whereHas('transport' , function ($query){
                $query->where('status' , 'in_process');
            })
            ->whereIn('status' ,  ['re_weight' , 'in_process' , 'processed'])
            ->where(function ($query){
                $query->where('in_weight' , 0)->orWhere('out_weight' , 0);
            });
    }

    public function scopeTransportCanReWeight()
    {
        return $this
            ->whereHas('transport' , function ($query){
                $query->where('status' , 'in_process');
            })
            ->where('status' ,  're_weight')
            ->where(function ($query){
                $query->where('in_weight' , '>' , 0)->where('out_weight' , 0);
            });
    }

    public function scopeTransportCannotWeight()
    {
        switch ($this->status)
        {
            case "arrived":
                return trans('global.waiting_qc_result' , ['name' => $this->ar_plate_name]);
            case "rejected":
                return trans('global.truck_rejected');
            case "depart":
                return trans('global.truck_depart');
                break;
            case "first_weight":
                return trans('global.the_first_weight_already_taken' , ['weight' => $this->in_weight , 'truck' => $this->ar_plate_name]);
            case "in_process":
                return trans('global.the_truck_in_process' , ['plate' => $this->truck_plates , 'name' => $this->ar_plate_name]);
            case "out_weight":
                return trans('global.the_second_weight_already_taken' , ['weight' => $this->out_weight , 'truck' => $this->ar_plate_name]);
            default:
                return trans('global.contact_with_support');
        }
    }

    public function scopeRawNotStartedTransports()
    {
        return $this
            ->whereHas('transport' , function ($query){
                $query->whereHas('itemType' , function($q){
                    return $q->where('prefix' , 'raw');
                });
            })
            ->whereHas('LastTransportLine' , function ($query){
                $query->whereNull('started_at')->whereNull('finished_at');
            })
            ->where('status' , 'in_process');
    }

    public function scopeRawStartedTransports()
    {
        return $this
            ->whereHas('transport' , function ($query){
                $query->whereHas('itemType' , function($q){
                    return $q->where('prefix' , 'raw');
                });
            })
            ->whereHas('LastTransportLine' , function ($query){
                $query->whereNotNull('started_at')->whereNull('finished_at');
            })
            ->where('status' , 'start_unload');
    }

    public function scopeScrapNotStartedTransports()
    {
        return $this
            ->whereHas('transport' , function ($query){
                $query->whereHas('itemType' , function($q){
                    return $q->where('prefix' , 'scrap');
                });
            })
            ->whereHas('LastTransportLine' , function ($query){
                $query->whereNull('started_at')->whereNull('finished_at');
            })
            ->where('status' , 'in_process');
    }

    public function scopeScrapStartedTransports()
    {
        return $this
            ->whereHas('transport' , function ($query){
                $query->whereHas('itemType' , function($q){
                    return $q->where('prefix' , 'scrap');
                });
            })
            ->whereHas('LastTransportLine' , function ($query){
                $query->whereNotNull('started_at')->whereNull('finished_at');
            })
            ->where('status' , 'start_load');
    }

    public function scopeFinishNotStartedTransports()
    {
        return $this
            ->whereHas('transport' , function ($query){
                $query->whereHas('itemType' , function($q){
                    return $q->where('prefix' , 'finish');
                });
            })
            ->whereHas('LastTransportLine' , function ($query){
                $query->whereNull('started_at')->whereNull('finished_at');
            })
            ->where('status' , 'in_process');
    }

    public function scopeFinishStartedTransports()
    {
        return $this
            ->whereHas('transport' , function ($query){
                $query->whereHas('itemType' , function($q){
                    return $q->where('prefix' , 'finish');
                });
            })
            ->whereHas('LastTransportLine' , function ($query){
                $query->whereNotNull('started_at')->whereNull('finished_at');
            })
            ->where('status' , 'start_load');
    }
}
