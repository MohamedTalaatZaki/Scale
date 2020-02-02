<?php

namespace App\Models\Security;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Artisan;

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
