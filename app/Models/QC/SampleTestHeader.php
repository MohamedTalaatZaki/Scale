<?php

namespace App\Models\QC;

use App\Models\Security\TransportDetail;
use App\Traits\HasFilter;
use App\User;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\QC\SampleTestHeader
 *
 * @property int $id
 * @property int $transport_detail_id
 * @property int $qc_test_header_id
 * @property string $result
 * @property string|null $reason
 * @property int $created_by
 * @property string $test_type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\User $createdBy
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\QC\SampleTestDetail[] $details
 * @property-read int|null $details_count
 * @property-read \App\Models\QC\QcTestDetail $qcTestDetail
 * @property-read \App\Models\QC\QcTestHeader $qcTestHeader
 * @property-read \App\Models\Security\TransportDetail $transportDetail
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\QC\SampleTestHeader newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\QC\SampleTestHeader newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\QC\SampleTestHeader query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\QC\SampleTestHeader whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\QC\SampleTestHeader whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\QC\SampleTestHeader whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\QC\SampleTestHeader whereQcTestHeaderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\QC\SampleTestHeader whereReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\QC\SampleTestHeader whereResult($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\QC\SampleTestHeader whereTestType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\QC\SampleTestHeader whereTransportDetailId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\QC\SampleTestHeader whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class SampleTestHeader extends Model
{
    use HasFilter;
    protected $table    =   'samples_test_header';
    protected $guarded  =   ['id'];

    public function details()
    {
        return $this->hasMany(SampleTestDetail::class , 'sample_test_header_id' , 'id');
    }

    public function qcTestDetail()
    {
        return $this->belongsTo(QcTestDetail::class , 'qc_test_detail_id' , 'id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class , 'created_by' , 'id');
    }

    public function transportDetail() {
        return $this->belongsTo(TransportDetail::class , 'transport_detail_id' , 'id');
    }

    public function qcTestHeader()
    {
        return $this->belongsTo(QcTestHeader::class , 'qc_test_header_id' , 'id');
    }

}
