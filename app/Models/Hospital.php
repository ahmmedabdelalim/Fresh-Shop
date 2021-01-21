<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    use HasFactory;
    protected $table = 'hospitals';
    protected $fillable = ['id','name','address',];

    public function doctor()
    {
        return $this->hasMany(Doctor::class, 'hospital-id', 'id');
    }
}
