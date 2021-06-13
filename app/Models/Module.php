<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Module extends Model
{
    use HasFactory,SoftDeletes;

    public function lab()
    {
        return $this->belongsTo(Lab::class,'lab_id','id');
    }
}
