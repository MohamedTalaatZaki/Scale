<?php

namespace App\Models\Roles;

use Illuminate\Database\Eloquent\Model;
use Zizaco\Entrust\EntrustPermission;

class SubMenu extends Model
{
    protected $table    =   'sub_menus';
    protected $guarded  =   ['id'];
    protected $appends  =   ['name'];

    public function menuGroup() {
        return $this->belongsTo(MenuGroup::class , 'menu_group' , 'id');
    }

    public function getNameAttribute() {
        return $this->attributes['name']   = app()->getLocale() == 'ar' ? $this->ar_name : $this->en_name;
    }

    public function permissions() {
        return $this->hasMany(Permission::class , 'sub_menu_id' , 'id');
    }
}
