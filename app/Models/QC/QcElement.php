<?php

namespace App\Models\QC;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\QC\QcElement
 *
 * @property int $id
 * @property string $en_name
 * @property string $ar_name
 * @property string $test_type
 * @property string $element_type
 * @property string|null $element_unit
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $name
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\QC\QcElement newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\QC\QcElement newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\QC\QcElement query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\QC\QcElement whereArName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\QC\QcElement whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\QC\QcElement whereElementType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\QC\QcElement whereElementUnit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\QC\QcElement whereEnName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\QC\QcElement whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\QC\QcElement whereTestType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\QC\QcElement whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
