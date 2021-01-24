<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $table = 'countrys';
    protected $fillable = ['id','name', ];
    protected $hidden = false;

    public  function   doctors()
    {
        return $this->hasManyThrough(
            Doctor::class,
            Hospital::class,
            'country-id', // Foreign key on the environments table...
            'hospital-id', // Foreign key on the deployments table...
            'id', // Local key on the projects table...
            'id' );
    }
}
