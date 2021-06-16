<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Module extends Model
{
    use HasFactory,SoftDeletes;
    protected $appends = ['full_path_image','full_path_file'];
    public function lab()
    {
        return $this->belongsTo(Lab::class,'lab_id','id');
    }

    public function getFullPathImageAttribute()
    {
        if($this->attributes['path_image']){
            return asset('storage/berkas/'.$this->attributes['path_image']);    
        }
        return '-';
    }
    public function getFullPathFileAttribute()
    {
        if($this->attributes['path_file']){
            return asset('storage/berkas/dokumen/'.$this->attributes['path_file']);    
        }
        return '-';
    }
}
