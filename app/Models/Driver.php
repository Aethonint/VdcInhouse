<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
   protected $fillable = [
        'user_id',
        'job_title',
        'dob',
        'start_date',
        'end_date',
        'license_number',
        'employee_no',
        'hourly_rate',
        'address',
        'is_operator',
        'is_employee',
        'is_technician',
        'classification'
    ];

  
    public function user()
{
    return $this->belongsTo(User::class, 'user_id');
}

}
