<?php

namespace App\Models\Roles;

use App\Models\ViewModel\MenuPermissions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * App\Models\Roles\MainMenu
 *
 * @property int $id
 * @property string $en_name
 * @property string $ar_name
 * @property string|null $class
 * @property string $href
 * @property string|null $sub_class
 * @property string|null $data_link
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $name
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Roles\MenuGroup[] $menuGroups
 * @property-read int|null $menu_groups_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Roles\MainMenu newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Roles\MainMenu newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Roles\MainMenu query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Roles\MainMenu whereArName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Roles\MainMenu whereClass($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Roles\MainMenu whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Roles\MainMenu whereDataLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Roles\MainMenu whereEnName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Roles\MainMenu whereHref($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Roles\MainMenu whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Roles\MainMenu whereSubClass($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Roles\MainMenu whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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

    public function getHref(){
        return $this->attributes['href'];
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
