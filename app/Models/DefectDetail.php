<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DefectDetail extends Model
{
    protected $fillable = ['defect_id', 'is_defect', 'note', 'image_path'];

  public function defect()
{
    return $this->belongsTo(Defect::class, 'defect_id');
}

}
