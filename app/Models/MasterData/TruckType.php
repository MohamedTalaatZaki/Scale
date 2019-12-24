<?php

namespace App\Models\MasterData;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\MasterData\TruckType
 *
 * @property int $id
 * @property string $ar_name
 * @property string $en_name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $name
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MasterData\TruckType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MasterData\TruckType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MasterData\TruckType query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MasterData\TruckType whereArName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MasterData\TruckType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MasterData\TruckType whereEnName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MasterData\TruckType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MasterData\TruckType whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class TruckType extends Model
{
    protected $table    =   'trucks_types';

    protected $appends  =   ['name'];

    public function getNameAttribute()
    {
        return $this->attributes['name']    =   app()->getLocale() == 'ar' ? $this->ar_name : $this->en_name;
    }
}
