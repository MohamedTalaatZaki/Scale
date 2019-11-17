<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\City
 *
 * @property int $id
 * @property int $gov_id
 * @property string $en_name
 * @property string $ar_name
 * @property int $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Center[] $centers
 * @property-read int|null $centers_count
 * @property-read mixed $name
 * @property-read \App\Models\Governorate $governorate
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\City newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\City newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\City query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\City whereArName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\City whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\City whereEnName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\City whereGovId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\City whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\City whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\City whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class City extends Model
{
    protected $table    =   'cities';
    protected $guarded  =   ['id'];
    protected $appends  =   ['name'];

    public function governorate(){
        return $this->belongsTo(Governorate::class , 'gov_id' , 'id');
    }

    public function centers()
    {
        return $this->hasMany(Center::class , 'city_id' , 'id');
    }

    public function getNameAttribute() {
        return $this->attributes['name']   = app()->getLocale() == 'ar' ? $this->ar_name : $this->en_name;
    }
}
