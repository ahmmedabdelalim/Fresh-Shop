<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $table = 'offers';
    protected $fillable = ['id','name','price','photo','created_at','updated_at'];
    protected $hidden = ['created_at','updated_at'];
}
