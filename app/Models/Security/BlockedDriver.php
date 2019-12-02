<?php

namespace App\Models\Security;

use Illuminate\Database\Eloquent\Model;

class BlockedDriver extends Model
{
    protected $table    =   'blocked_drivers';
    protected $guarded  =   [];

}
