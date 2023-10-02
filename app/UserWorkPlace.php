<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserWorkPlace extends Model
{
    use HasFactory;

    public $table = 'user_workplaces';

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'title',
        'user_id',
        'model_id',
        'model_type',
    ];
    
    public function workplaceable()
    {
        return $this->morphTo();
    }
}
