<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lab extends Model
{
    use HasFactory,SoftDeletes;
    public function prodi()
    {
        return $this->belongsTo(Prodi::class,'prodi_id','id');
    }
}
