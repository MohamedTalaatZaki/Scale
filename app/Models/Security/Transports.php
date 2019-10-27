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

    public function supplierItemGroups() {
        $supplier   =   $this->supplier;
        $ItemGroupsIds  =   $supplier->items()->distinct()->pluck('item_group_id');
        $itemGroups =   ItemGroup::query()->find($ItemGroupsIds);
        return $itemGroups;
    }
}
