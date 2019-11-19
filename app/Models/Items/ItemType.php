<?php

namespace App\Models\Items;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Items\ItemType
 *
 * @property int $id
 * @property string $ar_name
 * @property string $en_name
 * @property string|null $prefix
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $name
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Items\ItemType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Items\ItemType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Items\ItemType query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Items\ItemType whereArName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Items\ItemType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Items\ItemType whereEnName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Items\ItemType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Items\ItemType wherePrefix($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Items\ItemType whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ItemType extends Model
{
    protected $table    =   'item_types';
    protected $guarded  =   ['id'];
    protected $appends  =   ['name'];

    public function getNameAttribute()
    {
        return $this->attributes['name']    =   app()->getLocale() == 'ar' ? $this->ar_name : $this->en_name;
    }
}
