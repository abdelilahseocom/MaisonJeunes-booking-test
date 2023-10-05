<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class YouthCenterService extends Model
{
    use HasFactory;
    protected $table="youth_center_service";

    public function service(){
        return $this->belongsTo(Service::class,"service_id","id");
    }
    public function youthCenter(){
        return $this->belongsTo(YouthCenter::class,"youth_center_id","id");
    }
}
