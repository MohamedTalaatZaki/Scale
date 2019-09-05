<?php

namespace App\Models\Roles;

use Zizaco\Entrust\EntrustPermission;

class Permission extends EntrustPermission
{
    protected $appends  =   ['display_name'];

    public function getDisplayNameAttribute() {
        return $this->attributes['display_name'] = app()->getLocale() == 'ar' ? $this->ar_display_name : $this->en_display_name;
    }
}
