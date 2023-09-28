<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class YouthCenter extends Model
{
    use HasFactory;
    protected $fillable=["name","address","city_id"];
}
