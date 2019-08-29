<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table    =   'cities';
    protected $guarded  =   ['id'];

    public function governorate(){
        return $this->belongsTo(Governorate::class , 'gov_id' , 'id');
    }

    public function centers()
    {
        return $this->hasMany(Center::class , 'city_id' , 'id');
    }
}
