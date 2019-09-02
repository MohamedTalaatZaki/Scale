<?php

namespace App\Models\Roles;

use Illuminate\Database\Eloquent\Model;

class MenuGroup extends Model
{
    protected $table    =   'menu_groups';
    protected $guarded  =   ['id'];
    protected $appends  =   ['name'];

    public function mainMenu() {
        return $this->belongsTo(MainMenu::class , 'main_menu_id' , 'id');
    }

    public function subMenus() {
        return $this->hasMany(SubMenu::class , 'menu_group_id' , 'id');
    }

    public function getNameAttribute() {
        return $this->attributes['name']   = app()->getLocale() == 'ar' ? $this->ar_name : $this->en_name;
    }
}
