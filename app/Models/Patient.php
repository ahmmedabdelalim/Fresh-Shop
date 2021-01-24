<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;
    
    protected $table = 'patients';
    protected $fillable = ['id','name','age',];
    protected $hidden = false;

    public function doctor()
    {
        return $this->hasOneThrough(
            Doctor::class,
            Medical::class,
            'patient-id', // Foreign key on the cars table...
            'medical-id', // Foreign key on the owners table...
            'id', // Local key on the mechanics table...
            'id' // Local key on the cars table...
        );
    }


    
}
