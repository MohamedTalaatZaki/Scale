<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Center
 *
 * @property int $id
 * @property int $city_id
 * @property string $en_name
 * @property string $ar_name
 * @property int $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\City $city
 * @property-read mixed $name
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Center newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Center newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Center query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Center whereArName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Center whereCityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Center whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Center whereEnName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Center whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Center whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Center whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Center extends Model
{
    protected $table    =   'centers';
    protected $guarded  =   ['id'];


    public function city(){
        return $this->belongsTo(City::class , 'city_id' , 'id');
    }

    public function getNameAttribute() {
        return $this->attributes['name']   = app()->getLocale() == 'ar' ? $this->ar_name : $this->en_name;
    }
}
