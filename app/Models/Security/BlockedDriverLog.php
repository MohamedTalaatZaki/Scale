<?php

namespace App\Models\Security;

use App\User;
use Illuminate\Database\Eloquent\Model;

class BlockedDriverLog extends Model
{
    protected $table    =   'blocked_driver_logs';
    protected $guarded  =   ['id'];
    protected $appends  =   ['blocked_by_name' , 'blocked_reason'];

    public function reason()
    {
        return $this->belongsTo(BlockedReason::class , 'blocked_reason_id' , 'id');
    }

    public function blockedBy()
    {
        return $this->belongsTo(User::class , 'blocked_by' , 'id');
    }

    public function getBlockedByNameAttribute()
    {
        $name   =   User::query()->find($this->blocked_by);
        return optional($name)->full_name;
    }

    public function getBlockedReasonAttribute()
    {
        $reason   =   BlockedReason::query()->find($this->blocked_reason_id);
        return optional($reason)->name;
    }
}
