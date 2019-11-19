<?php

namespace App\Models\QC;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\QC\QcTestDetail
 *
 * @property int $id
 * @property int $qc_test_header_id
 * @property int|null $expected_result
 * @property float|null $min_range
 * @property float|null $max_range
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $qc_element_id
 * @property-read \App\Models\QC\QcElement $element
 * @property-read \App\Models\QC\QcTestDetail $header
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\QC\QcTestDetail newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\QC\QcTestDetail newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\QC\QcTestDetail query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\QC\QcTestDetail whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\QC\QcTestDetail whereExpectedResult($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\QC\QcTestDetail whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\QC\QcTestDetail whereMaxRange($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\QC\QcTestDetail whereMinRange($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\QC\QcTestDetail whereQcElementId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\QC\QcTestDetail whereQcTestHeaderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\QC\QcTestDetail whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
