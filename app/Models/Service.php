<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $table = 'services';
    protected $fillable = ['id','name',];
    protected $hidden = ['pivot']; 
    
    public $timestamp = false ;

    public function doctor()
    {
        return $this->belongsToMany(Doctor::class , Doctor_service::class , 'service-id','doctor-id','id','id');
    }

}
