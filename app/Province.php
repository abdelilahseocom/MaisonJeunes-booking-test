<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;
    protected $fillable=["name","region_id"];

    public function region(){
        return $this->belongsTo(Region::class,"region_id","id");
    }
    public function cities(){
        return $this->hasMany(City::class,"province_id","id");
    }
}
