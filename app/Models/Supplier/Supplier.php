<?php

namespace App\Models\Supplier;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $table    =   'suppliers';
    protected $guarded  =   ['id'];

    public function items()
    {
//        $this->belongsToMany()
    }
}
