<?php

namespace App\Models\Roles;

use Illuminate\Database\Eloquent\Model;
use Zizaco\Entrust\EntrustPermission;

/**
 * App\Models\Roles\SubMenu
 *
 * @property int $id
 * @property int $menu_group_id
 * @property string $en_name
 * @property string $ar_name
 * @property string $route
 * @property string|null $a_class
 * @property string|null $i_class
 * @property int|null $order
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $code
 * @property-read mixed $name
 * @property-read \App\Models\Roles\MenuGroup $menuGroup
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Roles\Permission[] $permissions
 * @property-read int|null $permissions_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Roles\SubMenu newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Roles\SubMenu newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Roles\SubMenu query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Roles\SubMenu whereAClass($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Roles\SubMenu whereArName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Roles\SubMenu whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Roles\SubMenu whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Roles\SubMenu whereEnName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Roles\SubMenu whereIClass($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Roles\SubMenu whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Roles\SubMenu whereMenuGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Roles\SubMenu whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Roles\SubMenu whereRoute($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Roles\SubMenu whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
