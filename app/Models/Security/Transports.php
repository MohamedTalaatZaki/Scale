<?php

namespace App\Models\Security;

use App\Models\Center;
use App\Models\City;
use App\Models\Governorate;
use App\Models\Items\ItemGroup;
use App\Models\Items\ItemType;
use App\Models\Supplier\Supplier;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Security\Transports
 *
 * @property int $id
 * @property string $transport_number
 * @property string $status
 * @property string $driver_name
 * @property string $driver_license
 * @property string $driver_national_id
 * @property string $driver_mobile
 * @property int $supplier_id
 * @property int $governorate_id
 * @property int $city_id
 * @property int|null $center_id
 * @property int $truck_type_id
 * @property string $truck_plates_tractor
 * @property string|null $truck_plates_trailer
 * @property int $item_type_id
 * @property int|null $item_group_id
 * @property float|null $theoretical_weight
 * @property \Illuminate\Support\Carbon|null $arrival_time
 * @property float $total_weight
 * @property float|null $weight_difference
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $order
 * @property-read \App\Models\Items\ItemGroup|null $ItemGroup
 * @property-read \App\Models\Center|null $center
 * @property-read \App\Models\City $city
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Security\TransportDetail[] $details
 * @property-read int|null $details_count
 * @property-read \App\Models\Governorate $governorate
 * @property-read \App\Models\Items\ItemType $itemType
 * @property-read \App\Models\Supplier\Supplier $supplier
 * @property-read \App\Models\Items\ItemGroup|null $testableType
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Security\Transports canWeight()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Security\Transports finishOrder($orderBy = 'ASC')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Security\Transports newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Security\Transports newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Security\Transports query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Security\Transports rawOrder($orderBy = 'ASC')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Security\Transports scrapOrder($orderBy = 'ASC')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Security\Transports whereArrivalTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Security\Transports whereCenterId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Security\Transports whereCityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Security\Transports whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Security\Transports whereDriverLicense($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Security\Transports whereDriverMobile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Security\Transports whereDriverName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Security\Transports whereDriverNationalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Security\Transports whereGovernorateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Security\Transports whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Security\Transports whereItemGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Security\Transports whereItemTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Security\Transports whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Security\Transports whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Security\Transports whereSupplierId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Security\Transports whereTheoreticalWeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Security\Transports whereTotalWeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Security\Transports whereTransportNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Security\Transports whereTruckPlatesTractor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Security\Transports whereTruckPlatesTrailer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Security\Transports whereTruckTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Security\Transports whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Security\Transports whereWeightDifference($value)
 * @mixin \Eloquent
 */

class Transports extends Model
{
    protected $table    =   'transports';
    protected $guarded  =   ['id'];
    protected $dates    =   ['arrival_time'];


    public function details()
    {
        return $this->hasMany(TransportDetail::class , 'transport_id' , 'id');
    }

    public function arrivedDetails()
    {
        return $this->details()->where('status' , 'arrived');
    }

    public function sampledDetails()
    {
        return $this->details()->where('status' , 'sampled')
            ->orWhere('status' , 'retest');
    }

    public function retestDetails()
    {
        return $this->details()->where('status' , 'retest');
    }

    public function acceptedDetails()
    {
        return $this->details()->where('status' , 'accepted');
    }

    public function rejectedDetails()
    {
        return $this->details()->where('status' , 'rejected');
    }


    public function governorate()
    {
        return $this->belongsTo(Governorate::class , 'governorate_id' , 'id');
    }

    public function city()
    {
        return $this->belongsTo(City::class , 'city_id' , 'id');
    }

    public function center()
    {
        return $this->belongsTo(Center::class , 'center_id' , 'id');
    }

    public function itemType()
    {
        return $this->belongsTo(ItemType::class , 'item_type_id' , 'id');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class ,'supplier_id' , 'id');
    }

    public function ItemGroup()
    {
        return $this->belongsTo(ItemGroup::class , 'item_group_id' , 'id');
    }

    public function testableType()
    {
        return $this->belongsTo(ItemGroup::class , 'item_group_id' , 'id')->where('testable' , 1);
    }

    public function supplierItemGroups() {
        $supplier   =   $this->supplier;
        $ItemGroupsIds  =   $supplier->items()->distinct()->pluck('item_group_id');
        $itemGroups =   ItemGroup::query()->find($ItemGroupsIds);
        return $itemGroups;
    }

    public function updateStatus()
    {
        $status         =   "sampled";
        $nextOrder      =   null;

        $statusArray    =   $this->details->map(function($detail){
            return optional(optional($detail->lastSampleTestHeader->first()))->result;
        })->toArray();

        if(in_array(null , $statusArray))
        {
            $status = 'sampled';
        }elseif(in_array('accepted' , $statusArray)) {
            $order      =   \App\Models\Security\Transports::query()->finishOrder('DESC')->select('order')->first();
            $nextOrder  =   $order ? $order->order + 1 : 1;
            $status = 'accepted';
        }elseif(in_array('rejected' , $statusArray))
        {
            $status = 'rejected';
        }

        $this->update(['status' => $status , 'order' => $nextOrder]);

    }

    public function scopeRawOrder($q , $orderBy = 'ASC') {
        return $q
            ->where('status' , 'accepted')
            ->whereHas('itemType' , function($query){
                return $query->where('prefix' , 'raw');
            })->orderBy('order' , $orderBy);
    }

    public function scopeScrapOrder($q , $orderBy = 'ASC') {
        return $q
            ->where('status' , 'waiting')
            ->whereHas('itemType' , function($query){
                return $query->where('prefix' , 'scrap');
            })->orderBy('order' , $orderBy);
    }

    public function scopeFinishOrder($q , $orderBy = 'ASC') {
        return $q
            ->where('status' , 'waiting')
            ->whereHas('itemType' , function($query){
                return $query->where('prefix' , 'finish');
            })->orderBy('order' , $orderBy);
    }

}
