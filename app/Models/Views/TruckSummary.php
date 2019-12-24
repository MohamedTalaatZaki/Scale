<?php

namespace App\Models\views;

use App\Traits\HasFilter;
use Illuminate\Database\Eloquent\Model;

class TruckSummary extends Model
{
    use HasFilter;
    protected $table    =   'v_truck_history_summary';
}
