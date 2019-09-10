<?php

namespace App\Models\Items;

use Illuminate\Database\Eloquent\Model;

class ItemGroup extends Model
{
    protected $table    =   'item_group';
    protected $guarded  =   ['id'];
    protected $appends  =   ['name'];

    public function items() {

    }

    public function getNameAttribute() {
        return $this->attributes['name']    =   app()->getLocale() == 'ar' ? $this->ar_name : $this->en_name;
    }
}
