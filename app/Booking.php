<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends Model
{
    use SoftDeletes;

    public $table = 'bookings';

    protected $dates = [
        'start_time',
        'end_time',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'start_time',
        'end_time',
        'comment',
        'type',
        'client_id',
        'youth_center_service_id',
        'created_at',
        'updated_at',
        'deleted_at',
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
    
}
