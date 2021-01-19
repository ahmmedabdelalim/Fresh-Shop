<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    use HasFactory;

    protected $table = 'phones';
    protected $fillable = ['id','code','phone','user-id',];
    protected $hidden = ['user-id'];
    public $timestamp = false ;

    ############ relation ##########

    public function user()
    {
        return $this->belongsTo(User::class, 'user-id');
    }
}


