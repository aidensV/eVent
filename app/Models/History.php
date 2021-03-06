<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;

    protected $table = 'history';

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function module()
    {
        return $this->belongsTo(Module::class,'modul_id','id');
    }

    public function prodi()
    {
        return $this->belongsTo(Prodi::class,'prodi_id');
    }
}
