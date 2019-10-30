<?php

namespace App\Models\Items;

use App\Models\QC\QcTestHeader;
use Illuminate\Database\Eloquent\Model;

class ItemGroup extends Model
{
    protected $table    =   'item_group';
    protected $guarded  =   ['id'];
    protected $appends  =   ['name'];

    public function qcTestHeader()
    {
        return $this->hasOne(QcTestHeader::class , 'item_group_id' , 'id');
    }

    public function getNameAttribute() {
        return $this->attributes['name']    =   app()->getLocale() == 'ar' ? $this->ar_name : $this->en_name;
    }

    public function qcTestHeader(){
        return $this->hasOne(QcTestHeader::class , 'item_group_id' , 'id');
    }
}
