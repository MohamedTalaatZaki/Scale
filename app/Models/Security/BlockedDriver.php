<?php

namespace App\Models\Security;

use Illuminate\Database\Eloquent\Model;

class BlockedDriver extends Model
{
    protected $table    =   'blocked_drivers';
    protected $guarded  =   [];

    public function reason()
    {
        return $this->belongsTo(BlockedReason::class , 'blocked_reason_id' , 'id');
    }
    public function logs()
    {
        return $this->hasMany(BlockedDriverLog::class , 'blocked_driver_id' , 'id');
    }
}
