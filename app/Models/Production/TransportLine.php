<?php

namespace App\Models\Production;

use App\Models\Security\TransportDetail;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Production\TransportLine
 *
 * @property int $id
 * @property int $transport_detail_id
 * @property int|null $line_id
 * @property string|null $batch_number
 * @property string|null $started_at
 * @property string|null $finished_at
 * @property float|null $weight
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Production\Line|null $line
 * @property-read \App\Models\Security\TransportDetail $transportDetail
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Production\TransportLine newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Production\TransportLine newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Production\TransportLine query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Production\TransportLine whereBatchNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Production\TransportLine whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Production\TransportLine whereFinishedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Production\TransportLine whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Production\TransportLine whereLineId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Production\TransportLine whereStartedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Production\TransportLine whereTransportDetailId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Production\TransportLine whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Production\TransportLine whereWeight($value)
 * @mixin \Eloquent
 */
class TransportLine extends Model
{
    protected $table    =   'transport_lines';
    protected $guarded  =   ['id'];

    public function transport()
    {
        return $this->transportDetail()->transport();
    }

    public function transportDetail()
    {
        return $this->belongsTo(TransportDetail::class , 'transport_detail_id' , 'id');
    }

    public function line()
    {
        return $this->belongsTo(Line::class , 'line_id' , 'id');
    }
}
