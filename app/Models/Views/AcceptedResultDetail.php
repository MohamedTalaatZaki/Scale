<?php

namespace App\Models\Views;

use App\Traits\HasFilter;
use Illuminate\Database\Eloquent\Model;

class AcceptedResultDetail extends Model
{
    use HasFilter;
    protected $table    =   'v_accepted_results_details';
}
