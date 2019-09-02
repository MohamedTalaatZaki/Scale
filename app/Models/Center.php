<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Center extends Model
{
    protected $table    =   'centers';
    protected $guarded  =   ['id'];


    public function city(){
        return $this->belongsTo(City::class , 'city_id' , 'id');
    }
}
