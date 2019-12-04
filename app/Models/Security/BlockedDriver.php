<?php

namespace App\Models\Security;

use Illuminate\Database\Eloquent\Model;

class BlockedDriver extends Model
{
    protected $table    =   'blocked_drivers';
    protected $guarded  =   [];

    public function logs()
    {
        return $this->hasMany(BlockedDriverLog::class , 'blocked_driver_id' , 'id');
    }
}
