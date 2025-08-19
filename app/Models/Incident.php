<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Incident extends Model
{
  
    protected $fillable = [
        'driver_id', 'assignment_id', 'vehicle_number', 'incident_date', 'status'
    ];

    public function details()
    {
        return $this->hasMany(IncidentDetail::class);
    }
    public function assignment()
{
    return $this->belongsTo(Assign::class, 'assignment_id');
}
public function user()
{
    return $this->belongsTo(User::class, 'driver_id', 'id');
}

}
