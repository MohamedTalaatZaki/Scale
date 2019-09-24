<?php

namespace App\Models\QC;

use Illuminate\Database\Eloquent\Model;

class QcTestHeader extends Model
{
    protected $table    =   'qc_test_header';
    protected $guarded  =   ['id'];
    protected $appends  =   ['name'];

    public function details()
    {
        return $this->hasMany(QcTestDetail::class , 'qc_test_header_id' , 'id');
    }

    public function getNameAttribute()
    {
        return $this->attributes['name']    =   app()->getLocale() == 'ar' ? $this->ar_name : $this->en_name;
    }
}
