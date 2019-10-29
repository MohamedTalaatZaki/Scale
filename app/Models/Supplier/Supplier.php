<?php

namespace App\Models\Supplier;

use App\Models\Items\Item;
use App\Models\Items\ItemGroup;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $table    =   'suppliers';
    protected $guarded  =   ['id'];
    protected $appends  =   ['name'];

    public function items()
    {
        return $this->belongsToMany(Item::class , 'suppliers_items' , 'supplier_id','item_id' );
    }

    public function getNameAttribute()
    {
        return $this->attributes['name']    =   app()->getLocale() == 'ar' ? $this->ar_name : $this->en_name;
    }
}
