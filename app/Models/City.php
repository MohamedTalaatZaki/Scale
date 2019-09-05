<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table    =   'cities';
    protected $guarded  =   ['id'];
    protected $appends  =   ['name'];

    public function governorate(){
        return $this->belongsTo(Government::class , 'gov_id' , 'id');
    }

    public function centers()
    {
        return $this->hasMany(Center::class , 'city_id' , 'id');
    }

    public function getNameAttribute() {
        return $this->attributes['name']   = app()->getLocale() == 'ar' ? $this->ar_name : $this->en_name;
    }
}
