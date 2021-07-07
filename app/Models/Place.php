<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    use HasFactory;
    protected $table = "places";

    protected $fillable = [
        'name',
        'description',
        'location',
        'image',
        'price',
        'offer',
        'admin_id',
        'category_id',
        'created_at',
        'updated_at'
    ];
    protected $hidden = ['created_at','updated_at'];


}
