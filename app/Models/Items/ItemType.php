<?php

namespace App\Models\Items;

use Illuminate\Database\Eloquent\Model;

class ItemType extends Model
{
    protected $table    =   'item_types';
    protected $guarded  =   ['id'];
    protected $appends  =   ['name'];

    public function getNameAttribute()
    {
        return $this->attributes['name']    =   app()->getLocale() == 'ar' ? $this->ar_name : $this->en_name;
    }
}
