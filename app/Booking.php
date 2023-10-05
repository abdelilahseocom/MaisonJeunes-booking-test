<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends Model
{
    public $table = 'bookings';

    protected $dates = [
        'start_time',
        'end_time',
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'start_time',
        'end_time',
        'comment',
        'type',
        'client_id',
        'youth_center_service_id',
        'youth_center_id',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'start_time' => 'datetime:Y-m-d H:m',
        'end_time' => 'datetime:Y-m-d H:m',
        'created_at' => 'datetime:Y-m-d H:m',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function youthCenterService(){
        return $this->belongsTo(YouthCenterService::class,"youth_center_service_id","id");
    }
    
    public function getTitleAttribute() {
        $title = '';
        if($this->type == "service") {
            $title =  $this->client->name.' | ';
        } else if($this->type == "travaux") {
            $title = "Travaux"; 
        } else {
            $title =  "Indisponible";
        }
        return $title;
    }

    public function youth_center() {
        return $this->belongsTo(YouthCenter::class);
    }
}
