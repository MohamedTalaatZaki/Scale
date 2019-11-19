<?php

namespace App\Models\Roles;

use Zizaco\Entrust\EntrustPermission;

/**
 * App\Models\Roles\Permission
 *
 * @property int $id
 * @property int $sub_menu_id
 * @property string $name
 * @property string|null $en_display_name
 * @property string|null $ar_display_name
 * @property string|null $en_description
 * @property string|null $ar_description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $display_name
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Roles\Role[] $roles
 * @property-read int|null $roles_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Roles\Permission newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Roles\Permission newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Roles\Permission query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Roles\Permission whereArDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Roles\Permission whereArDisplayName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Roles\Permission whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Roles\Permission whereEnDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Roles\Permission whereEnDisplayName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Roles\Permission whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Roles\Permission whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Roles\Permission whereSubMenuId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Roles\Permission whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Permission extends EntrustPermission
{
    protected $appends  =   ['display_name'];

    public function getDisplayNameAttribute() {
        return $this->attributes['display_name'] = app()->getLocale() == 'ar' ? $this->ar_display_name : $this->en_display_name;
    }
}
