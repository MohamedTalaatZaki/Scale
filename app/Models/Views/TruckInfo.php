<?php

namespace App\Models\Views;

use App\Traits\HasFilter;
use Illuminate\Database\Eloquent\Model;

class TruckInfo extends Model
{
    use HasFilter;

    protected $table    =   'v_trucks_info';
    protected $guarded  =   ['id'];

}
