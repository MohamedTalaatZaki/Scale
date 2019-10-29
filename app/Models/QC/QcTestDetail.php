<?php

namespace App\Models\QC;

use Illuminate\Database\Eloquent\Model;

class QcTestDetail extends Model
{
    protected $table    =   'qc_test_details';
    protected $guarded  =   ['id'];


    public function header()
    {
        return $this->belongsTo(QcTestDetail::class , 'qc_test_header_id' , 'id');
    }

    public function element()
    {
        return $this->belongsTo(QcElement::class , 'qc_element_id' , 'id');
    }

    public function getExpectedResult()
    {
        if($this->element->element_type == 'range'){
            return "{$this->min_range} - {$this->max_range}";
        } elseif ($this->element->element_type == 'question') {
            return $this->expected_result ? trans('global.yes') : trans('global.no');
        } else {
            return "";
        }
    }
}
