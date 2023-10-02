<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class YouthCenter extends Model
{
    use HasFactory;
    protected $fillable=["name","address","city_id"];
    
    public function city(){
        return $this->belongsTo(City::class,"city_id","id");
    }

    public function manager()
    {
        return $this->morphMany(UserWorkPlace::class, 'workplaceable', 'model_type', 'model_id');
    }
}
