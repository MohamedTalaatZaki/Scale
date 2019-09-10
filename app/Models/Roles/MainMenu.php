<?php

namespace App\Models\Roles;

use App\Models\ViewModel\MenuPermissions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MainMenu extends Model
{
    protected $table = 'main_menus';
    protected $guarded = ['id'];
    protected $appends = ['name'];
    protected $hasPermissions = null;

    public function menuGroups()
    {
        return $this->hasMany(MenuGroup::class, 'main_menu_id', 'id');
    }

    public function getNameAttribute()
    {
        return $this->attributes['name'] = app()->getLocale() == 'ar' ? $this->ar_name : $this->en_name;
    }

    public function getHrefAttribute($value)
    {
        return $this->attributes['href'] = substr($value, 0, 1) === "#" ? $value : route($value);
    }

    public function hasPermissions()
    {
        if (is_null($this->hasPermissions)) {
            $role = Auth::user()->roles()->first();
            $prems = $role->perms()->pluck('id');
            if ($prems->count() <= 0) {
                $this->hasPermissions = false;
            } else {
                $permissions = $prems->join(',');
                $sql = "select count(*) as count
                from main_menus
                inner join menu_groups
                on(menu_groups.main_menu_id = main_menus.id)
                inner join sub_menus
                on(sub_menus.menu_group_id = menu_groups.id)
                inner join permissions
                on(permissions.sub_menu_id = sub_menus.id)
                where main_menus.id = {$this->id}
                AND permissions.id in ({$permissions})";
                $menu = MenuPermissions::hydrate(DB::select($sql))->first();
                $this->hasPermissions = ($menu->count > 0);
            }

        }
        return $this->hasPermissions;

    }


}
