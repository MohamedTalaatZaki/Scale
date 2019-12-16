<?php

namespace App\Models\Supplier;

use App\Models\Items\Item;
use App\Models\Items\ItemGroup;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Supplier\Supplier
 *
 * @property int $id
 * @property string $ar_name
 * @property string $en_name
 * @property string $sap_code
 * @property int $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $name
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Items\Item[] $items
 * @property-read int|null $items_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Supplier\Supplier newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Supplier\Supplier newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Supplier\Supplier query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Supplier\Supplier whereArName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Supplier\Supplier whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Supplier\Supplier whereEnName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Supplier\Supplier whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Supplier\Supplier whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Supplier\Supplier whereSapCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Supplier\Supplier whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Supplier extends Model
{
    protected $table    =   'suppliers';
    protected $guarded  =   ['id'];
    protected $appends  =   ['name'];

    public function items()
    {
        return $this->belongsToMany(Item::class , 'suppliers_items' , 'supplier_id','item_id' );
    }

    public function getNameAttribute()
    {
        return $this->attributes['name']    =   app()->getLocale() == 'ar' ? $this->ar_name : $this->en_name;
    }

    public function scopeSupplierByItemTypePrefix($query, $itemType)
    {
        return $this->whereHas('items' , function ($q)use($itemType){
            $q->whereHas('type' , function($query)use($itemType){
                $query->where('prefix' , $itemType);
            });
        });
    }
}
