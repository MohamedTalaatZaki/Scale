<?php

namespace App\Models\Production;

use App\Models\Items\ItemType;
use Illuminate\Database\Eloquent\Model;

class Line extends Model
{
    protected $table    =   'lines';
    protected $guarded  =   ['id'];


    public function itemType()
    {
        return $this->belongsTo(ItemType::class , 'item_type_id' , 'id');
    }

    public function getNameAttribute() {
        return $this->attributes['name']   = app()->getLocale() == 'ar' ? $this->ar_name : $this->en_name;
    }
}
