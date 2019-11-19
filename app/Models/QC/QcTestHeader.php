<?php

namespace App\Models\QC;

use App\Models\Items\ItemGroup;
use App\Models\Security\TransportDetail;
use App\User;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\QC\QcTestHeader
 *
 * @property int $id
 * @property string $en_name
 * @property string $ar_name
 * @property int $item_group_id
 * @property int $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\QC\QcTestDetail[] $details
 * @property-read int|null $details_count
 * @property-read mixed $name
 * @property-read \App\Models\Items\ItemGroup $itemGroup
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\QC\QcTestHeader newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\QC\QcTestHeader newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\QC\QcTestHeader query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\QC\QcTestHeader whereArName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\QC\QcTestHeader whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\QC\QcTestHeader whereEnName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\QC\QcTestHeader whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\QC\QcTestHeader whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\QC\QcTestHeader whereItemGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\QC\QcTestHeader whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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

    public function itemGroup()
    {
        return $this->belongsTo(ItemGroup::class , 'item_group_id' , 'id');
    }

}
