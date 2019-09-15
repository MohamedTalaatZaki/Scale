<?php

namespace App\Models\Supplier;

use App\Models\items\Item;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $table    =   'suppliers';
    protected $guarded  =   ['id'];

    public function items()
    {
        return $this->belongsToMany(Item::class , 'suppliers_items' , 'supplier_id','item_id' );
    }
}
