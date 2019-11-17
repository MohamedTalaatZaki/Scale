<?php

namespace App\Models\Items;

use App\Models\Supplier\Supplier;
use App\Traits\HasFilter;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Items\Item
 *
 * @property int $id
 * @property string $ar_name
 * @property string $en_name
 * @property string $sap_code
 * @property int $item_group_id
 * @property int $item_type_id
 * @property string|null $description
 * @property int $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $name
 * @property-read \App\Models\Items\ItemGroup $group
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Supplier\Supplier[] $suppliers
 * @property-read int|null $suppliers_count
 * @property-read \App\Models\Items\ItemType $type
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Items\Item filter($filter)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Items\Item newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Items\Item newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Items\Item query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Items\Item whereArName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Items\Item whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Items\Item whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Items\Item whereEnName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Items\Item whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Items\Item whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Items\Item whereItemGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Items\Item whereItemTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Items\Item whereSapCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Items\Item whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Item extends Model
{
    use HasFilter;
    protected $table    =   'items';
    protected $guarded  =   ['id'];
    protected $appends  =   ['name'];

    public function group()
    {
        return $this->belongsTo(ItemGroup::class , 'item_group_id' , 'id');
    }

    public function type()
    {
        return $this->belongsTo(ItemType::class , 'item_type_id' , 'id');
    }

    public function suppliers()
    {
        return $this->belongsToMany(Supplier::class , 'suppliers_items'  , 'item_id' , 'supplier_id');
    }

    public function getNameAttribute() {
        return $this->attributes['name']    =   app()->getLocale() == 'ar' ? $this->ar_name : $this->en_name;
    }

}
