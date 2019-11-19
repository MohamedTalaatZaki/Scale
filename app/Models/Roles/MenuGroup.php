<?php

namespace App\Models\Roles;

use App\Models\ViewModel\MenuPermissions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * App\Models\Roles\MenuGroup
 *
 * @property int $id
 * @property int $main_menu_id
 * @property string $en_name
 * @property string $ar_name
 * @property string $aria_controls
 * @property int|null $order
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $name
 * @property-read \App\Models\Roles\MainMenu $mainMenu
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Roles\SubMenu[] $subMenus
 * @property-read int|null $sub_menus_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Roles\MenuGroup newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Roles\MenuGroup newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Roles\MenuGroup query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Roles\MenuGroup whereArName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Roles\MenuGroup whereAriaControls($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Roles\MenuGroup whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Roles\MenuGroup whereEnName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Roles\MenuGroup whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Roles\MenuGroup whereMainMenuId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Roles\MenuGroup whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Roles\MenuGroup whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class MenuGroup extends Model
{
    protected $table    =   'menu_groups';
    protected $guarded  =   ['id'];
    protected $appends  =   ['name'];
    protected $hasPermissions = null;

    public function mainMenu() {
        return $this->belongsTo(MainMenu::class , 'main_menu_id' , 'id');
    }

    public function subMenus() {
        return $this->hasMany(SubMenu::class , 'menu_group_id' , 'id');
    }

    public function getNameAttribute() {
        return $this->attributes['name']   = app()->getLocale() == 'ar' ? $this->ar_name : $this->en_name;
    }

    public function hasPermissions(){
        if(is_null($this->hasPermissions)){
            $role = Auth::user()->roles()->first();
            $prems = $role->perms()->pluck('id');
            if ($prems->count() <= 0) {
                $this->hasPermissions = false;
            }else{
                $permissions = $prems->join(',');
                $sql = "select count(*) as count
                from menu_groups
                inner join sub_menus
                on(sub_menus.menu_group_id = menu_groups.id)
                inner join permissions
                on(permissions.sub_menu_id = sub_menus.id)
                where menu_groups.id = {$this->id}
                AND permissions.id in ({$permissions})";
                $menu = MenuPermissions::hydrate(DB::select($sql))->first();
                $this->hasPermissions = ($menu->count > 0);
            }
        }
        return  $this->hasPermissions ;

    }
}
