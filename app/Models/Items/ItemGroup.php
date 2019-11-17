<?php

namespace App\Models\Items;

use App\Models\QC\QcTestHeader;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Items\ItemGroup
 *
 * @property int $id
 * @property string $ar_name
 * @property string $en_name
 * @property int $testable
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $name
 * @property-read \App\Models\QC\QcTestHeader $qcTestHeader
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Items\ItemGroup newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Items\ItemGroup newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Items\ItemGroup query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Items\ItemGroup whereArName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Items\ItemGroup whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Items\ItemGroup whereEnName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Items\ItemGroup whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Items\ItemGroup whereTestable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Items\ItemGroup whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ItemGroup extends Model
{
    protected $table    =   'item_group';
    protected $guarded  =   ['id'];
    protected $appends  =   ['name'];

    public function qcTestHeader()
    {
        return $this->hasOne(QcTestHeader::class , 'item_group_id' , 'id');
    }

    public function getNameAttribute() {
        return $this->attributes['name']    =   app()->getLocale() == 'ar' ? $this->ar_name : $this->en_name;
    }
}
