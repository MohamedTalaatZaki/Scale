<?php

namespace App\Models\Security;

use App\Models\Center;
use App\Models\City;
use App\Models\Governorate;
use App\Models\Items\ItemGroup;
use App\Models\Items\ItemType;
use App\Models\Supplier\Supplier;
use Illuminate\Database\Eloquent\Model;

class TruckArrival extends Model
{
    protected $table    =   'trucks_arrival';
    protected $guarded  =   ['id'];
    protected $dates    =   ['arrival_time'];
    protected $appends  =   ['card_loop_count'];

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

    public function getCardLoopCountAttribute()
    {
        return is_null($this->truck_plates_trailer) ? 1 : 2;
    }
    public function supplierItemGroups() {
        $supplier   =   $this->supplier;
        $ItemGroupsIds  =   $supplier->items()->distinct()->pluck('item_group_id');
        $itemGroups =   ItemGroup::query()->find($ItemGroupsIds);
        return $itemGroups;
    }
}
