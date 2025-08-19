<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IncidentDetail extends Model
{
     protected $fillable = [
        'incident_id', 'field_name', 'notes', 'image_path'
    ];

    public function incident()
    {
        return $this->belongsTo(Incident::class);
    }
}
