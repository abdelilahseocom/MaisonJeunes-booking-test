<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use SoftDeletes, HasFactory,SoftDeletes;

    public $table = 'services';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'price',
        'created_at',
        'updated_at',
        'deleted_at',
    ];


    public function bookings()
    {
        return $this->belongsToMany(Booking::class);
    }
    
   
    public function youthCenters(){
        return $this->belongsToMany(YouthCenter::class,"youth_center_service","service_id","youth_center_id")
                    ->withPivot(["id","duration","max_places","status","created_at","updated_at"])
                    ->withTimestamps();
    }
}
