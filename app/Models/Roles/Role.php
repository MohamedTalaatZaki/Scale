<?php

namespace App\Models\Roles;

//use Illuminate\Database\Eloquent\Model;
use Zizaco\Entrust\EntrustRole;
use Zizaco\Entrust\Traits\EntrustRoleTrait;

/**
 * App\Models\Roles\Role
 *
 * @property int $id
 * @property string $name
 * @property string|null $display_name
 * @property string|null $description
 * @property int $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $is_admin
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Roles\Permission[] $perms
 * @property-read int|null $perms_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\User[] $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Roles\Role newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Roles\Role newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Roles\Role query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Roles\Role whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Roles\Role whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Roles\Role whereDisplayName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Roles\Role whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Roles\Role whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Roles\Role whereIsAdmin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Roles\Role whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Roles\Role whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Role extends EntrustRole
{
    protected $table    =   'roles';
    protected $guarded  =   ['id'];

    public function perms()
    {
        return $this->belongsToMany(\Config::get('entrust.permission'), \Config::get('entrust.permission_role_table') , 'role_id');
    }
}
