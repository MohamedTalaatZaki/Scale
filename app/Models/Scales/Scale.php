<?php

namespace App\Models\Scales;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Scales\Scale
 *
 * @property int $id
 * @property string $code
 * @property float $limit
 * @property float $scale_error
 * @property string|null $ip_address
 * @property string $brand
 * @property string|null $model
 * @property string $com_port
 * @property string $baud_rate
 * @property string $byte_size
 * @property string $stop_bits
 * @property string $parity
 * @property float $timeout
 * @property float $tolerance
 * @property int $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Scales\Scale newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Scales\Scale newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Scales\Scale query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Scales\Scale whereBaudRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Scales\Scale whereBrand($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Scales\Scale whereByteSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Scales\Scale whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Scales\Scale whereComPort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Scales\Scale whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Scales\Scale whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Scales\Scale whereIpAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Scales\Scale whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Scales\Scale whereLimit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Scales\Scale whereModel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Scales\Scale whereParity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Scales\Scale whereScaleError($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Scales\Scale whereStopBits($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Scales\Scale whereTimeout($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Scales\Scale whereTolerance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Scales\Scale whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Scale extends Model
{
    protected $table    =   'scales';
    protected $guarded  =   ['id'];
}
