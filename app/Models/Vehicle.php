<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
       protected $fillable = [
    'vin_sn',
        'vehicle_name',
        'type',
        'status',
        'ownership',
        'pictures',
        'note',
    ];

    protected $casts = [
        'pictures' => 'array', // Automatically cast JSON to array
    ];
}
