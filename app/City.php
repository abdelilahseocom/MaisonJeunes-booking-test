<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    protected $fillable=["name","province_id"];

    public function province(){
        return $this->belongsTo(Province::class,"province_id","id");
    }

    public function youthCenters(){
        return $this->hasMany(YouthCenter::class,"city_id","id");
    }
}
