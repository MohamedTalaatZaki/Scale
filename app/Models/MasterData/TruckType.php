<?php

namespace App\Models\MasterData;

use Illuminate\Database\Eloquent\Model;

class TruckType extends Model
{
    protected $table    =   'trucks_types';

    protected $appends  =   ['name'];

    public function getNameAttribute()
    {
        return $this->attributes['name']    =   app()->getLocale() == 'ar' ? $this->ar_name : $this->en_name;
    }
}
