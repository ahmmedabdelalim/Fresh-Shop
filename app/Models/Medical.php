<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medical extends Model
{
    use HasFactory;

    protected $table = 'medicals';
    protected $fillable = ['id','pdf','patient-id',];
    protected $hidden = false;
}
