<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;
    protected $fillable=["name"];

    public function provinces(){
        return $this->hasMany(Province::class,"region_id","id");
    }

    public function manager()
    {
        return $this->morphMany(UserWorkPlace::class, 'workplaceable', 'model_type', 'model_id');
    }
}
