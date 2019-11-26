<?php

namespace App\Models\Production;

use App\Models\Items\ItemType;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Production\Line
 *
 * @property int $id
 * @property string $ar_name
 * @property string $en_name
 * @property string $type
 * @property int $item_type_id
 * @property int $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $name
 * @property-read \App\Models\Items\ItemType $itemType
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Production\Line newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Production\Line newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Production\Line query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Production\Line whereArName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Production\Line whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Production\Line whereEnName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Production\Line whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Production\Line whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Production\Line whereItemTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Production\Line whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Production\Line whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Line extends Model
{
    protected $table    =   'lines';
    protected $guarded  =   ['id'];


    public function itemType()
    {
        return $this->belongsTo(ItemType::class , 'item_type_id' , 'id');
    }

    public function getNameAttribute() {
        return $this->attributes['name']   = app()->getLocale() == 'ar' ? $this->ar_name : $this->en_name;
    }
}
