<?php

namespace App\Models\Roles;

//use Illuminate\Database\Eloquent\Model;
use Zizaco\Entrust\EntrustRole;
use Zizaco\Entrust\Traits\EntrustRoleTrait;

class Role extends EntrustRole
{
    protected $table    =   'roles';
    protected $guarded  =   ['id'];

    public function perms()
    {
        return $this->belongsToMany(\Config::get('entrust.permission'), \Config::get('entrust.permission_role_table') , 'role_id');
    }
}
