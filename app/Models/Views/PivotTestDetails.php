<?php

namespace App\Models\Views;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasFilter;

class PivotTestDetails extends Model
{
    use HasFilter;
    protected $table    =   'v_pivot_test_transport';
}
