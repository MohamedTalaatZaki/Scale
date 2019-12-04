<?php

namespace App\Models\Security;

use Illuminate\Database\Eloquent\Model;

class BlockedDriverLog extends Model
{
    protected $table    =   'blocked_driver_logs';
    protected $guarded  =   ['id'];
}
