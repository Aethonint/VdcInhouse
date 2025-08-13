<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assign extends Model
{
    protected $fillable = [
        'vehicle_id',
        'operator_id',
        'start_datetime',
        'end_datetime',
        'starting_odometer',
        'ending_odometer',
        'comment',
    ];

    // Relationships
    public function vehicle()
    {
        return $this->belongsTo(\App\Models\Vehicle::class);
    }

public function operator()
{
    return $this->belongsTo(User::class, 'operator_id');
}





}
