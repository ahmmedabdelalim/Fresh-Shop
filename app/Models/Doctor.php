<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;
    protected $table = 'doctors';
    protected $fillable = ['id','name','title','hospital-id'];
    protected $hidden = ['pivot'];
    
    public function hospital()
    {
        return $this->belongsTo(Hospital::class, 'hospital-id', 'id');
    }

    public function service()
    {
        return $this->belongsToMany(Service::class , Doctor_service::class , 'doctor-id','service-id','id','id');
    }

}
