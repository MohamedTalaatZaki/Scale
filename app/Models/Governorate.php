<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Governorate extends Model
{
    protected $table    =   'governorates';
    protected $guarded  =   ['id'];

    public function cities()
    {
        return $this->hasMany(City::class , 'gov_id' , 'id');
    }
}
