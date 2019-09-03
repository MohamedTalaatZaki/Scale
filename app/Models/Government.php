<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Government extends Model
{
    protected $table    =   'governorates';
    protected $guarded  =   ['id'];
    protected $appends  =   ['name'];

    public function cities()
    {
        return $this->hasMany(City::class , 'gov_id' , 'id');
    }

    public function getNameAttribute() {
        return $this->attributes['name']   = app()->getLocale() == 'ar' ? $this->ar_name : $this->en_name;
    }
}
