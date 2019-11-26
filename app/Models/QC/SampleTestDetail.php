<?php

namespace App\Models\QC;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\QC\SampleTestDetail
 *
 * @property int $id
 * @property int $sample_test_header_id
 * @property int $qc_test_detail_id
 * @property string|null $element_name
 * @property string|null $test_type
 * @property string|null $element_type
 * @property int|null $expected_result
 * @property float|null $min_range
 * @property float|null $max_range
 * @property string|null $element_unit
 * @property int|null $sampled_expected_result
 * @property float|null $sampled_range
 * @property string|null $result
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\QC\SampleTestHeader $header
 * @property-read \App\Models\QC\QcTestDetail $qcTestDetail
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\QC\SampleTestDetail newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\QC\SampleTestDetail newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\QC\SampleTestDetail query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\QC\SampleTestDetail whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\QC\SampleTestDetail whereElementName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\QC\SampleTestDetail whereElementType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\QC\SampleTestDetail whereElementUnit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\QC\SampleTestDetail whereExpectedResult($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\QC\SampleTestDetail whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\QC\SampleTestDetail whereMaxRange($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\QC\SampleTestDetail whereMinRange($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\QC\SampleTestDetail whereQcTestDetailId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\QC\SampleTestDetail whereResult($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\QC\SampleTestDetail whereSampleTestHeaderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\QC\SampleTestDetail whereSampledExpectedResult($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\QC\SampleTestDetail whereSampledRange($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\QC\SampleTestDetail whereTestType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\QC\SampleTestDetail whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class SampleTestDetail extends Model
{
    protected $table    =   'samples_test_details';
    protected $guarded  =   ['id'];

    public function header()
    {
        return $this->belongsTo(SampleTestHeader::class , 'sample_test_header_id' , 'id');
    }

    public function qcTestDetail()
    {
        return $this->belongsTo(QcTestDetail::class , 'qc_test_detail_id' , 'id');
    }

}
