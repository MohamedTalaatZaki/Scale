<?php

namespace App\Models\Security;

use Illuminate\Database\Eloquent\Model;

class BlockedReason extends Model
{
    protected $table    =   'blocked_reasons';
    protected $guarded  =   ['id'];
    protected $appends  =   ['name'];

    public function getNameAttribute() {
        return $this->attributes['name']   = app()->getLocale() == 'ar' ? $this->ar_name : $this->en_name;
    }
}
