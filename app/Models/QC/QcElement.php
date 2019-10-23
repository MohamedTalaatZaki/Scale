<?php

namespace App\Models\QC;

use Illuminate\Database\Eloquent\Model;

class QcElement extends Model
{
    protected $table    =   'qc_elements';
    protected $guarded  =   ['id'];
      protected $appends  =   ['name'];

    public function getNameAttribute()
    {
        return $this->attributes['name']    =   app()->getLocale() == 'ar' ? $this->ar_name : $this->en_name;
    }
}
