<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Defect extends Model
{
   protected $fillable = ['user_id', 'vehicle_id','assignment_id'];

 public function details()
{
    return $this->hasMany(DefectDetail::class, 'defect_id');
}

public function assignment()
{
    return $this->belongsTo(Assign::class, 'assignment_id');
}
public function user()
{
    return $this->belongsTo(User::class);
}

}
