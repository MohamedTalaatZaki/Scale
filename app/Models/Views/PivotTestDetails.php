<?php

namespace App\Models\Views;

use Illuminate\Database\Eloquent\Model;

class PivotTestDetails extends Model
{
    use HasFilter;
    protected $table    =   'v_accepted_results_details';
}
