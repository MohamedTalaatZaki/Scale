<?php

namespace App\Models\Items;

use App\Models\Supplier\Supplier;
use App\Traits\HasFilter;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFilter;
    protected $table    =   'items';
    protected $guarded  =   ['id'];
    protected $appends  =   ['name'];

    public function group()
    {
        return $this->belongsTo(ItemGroup::class , 'item_type_id' , 'id');
    }

    public function type()
    {
        return $this->belongsTo(ItemType::class , 'item_type_id' , 'id');
    }

    public function suppliers()
    {
        return $this->belongsToMany(Supplier::class , 'suppliers_items'  , 'item_id' , 'supplier_id');
    }

    public function getNameAttribute() {
        return $this->attributes['name']    =   app()->getLocale() == 'ar' ? $this->ar_name : $this->en_name;
    }

}
