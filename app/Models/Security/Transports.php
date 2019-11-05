<?php

namespace App\Models\Security;

use App\Models\Center;
use App\Models\City;
use App\Models\Governorate;
use App\Models\Items\ItemGroup;
use App\Models\Items\ItemType;
use App\Models\Supplier\Supplier;
use Illuminate\Database\Eloquent\Model;

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
