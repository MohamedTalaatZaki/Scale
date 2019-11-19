<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Governorate
 *
 * @property int $id
 * @property string $en_name
 * @property string $ar_name
 * @property int $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\City[] $cities
 * @property-read int|null $cities_count
 * @property-read mixed $name
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Governorate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Governorate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Governorate query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Governorate whereArName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Governorate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Governorate whereEnName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Governorate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Governorate whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Governorate whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Governorate extends Model
{
    protected $table    =   'governorates';
    protected $guarded  =   ['id'];
    protected $appends  =   ['name'];

    public function cities()
    {
        return $this->hasMany(City::class , 'gov_id' , 'id');
    }

    public function getNameAttribute() {
        return $this->attributes['name']   = app()->getLocale() == 'ar' ? $this->ar_name : $this->en_name;
    }
}
