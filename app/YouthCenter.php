<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class YouthCenter extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable=["name","address","city_id"];
    
    public function city(){
        return $this->belongsTo(City::class,"city_id","id");
    }

    public function manager()
    {
        return $this->morphMany(UserWorkPlace::class, 'workplaceable', 'model_type', 'model_id');
    }

    public function services(){
        return $this->belongsToMany(Service::class,"youth_center_service","youth_center_id","service_id")
                    ->withPivot(["id","duration","max_places","status","created_at","updated_at"])
                    ->withTimestamps();

    }
}
