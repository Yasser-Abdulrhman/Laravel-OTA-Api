<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPlace extends Model
{
    use HasFactory;
    protected $table = "user_place";

    protected $fillable = [

        'user_id','place_id'

    ];

}
