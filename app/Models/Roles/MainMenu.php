<?php

namespace App\Models\Roles;

use Illuminate\Database\Eloquent\Model;

class MainMenu extends Model
{
    protected $table    =   'main_menus';
    protected $guarded  =   ['id'];
    protected $appends  =   ['name'];

    public function menuGroups() {
        return $this->hasMany(MenuGroup::class , 'main_menu_id' , 'id');
    }

    public function getNameAttribute() {
        return $this->attributes['name']   = app()->getLocale() == 'ar' ? $this->ar_name : $this->en_name;
    }

    public function getHrefAttribute($value) {
        return $this->attributes['href']   = substr( $value, 0, 1 ) === "#" ? $value : route($value);
    }


}
