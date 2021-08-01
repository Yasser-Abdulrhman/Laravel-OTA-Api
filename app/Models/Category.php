<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'admin_id',
        'created_at',
        'updated_at'
    ];
    //protected $hidden = ['created_at','updated_at'];

    public function places()
    {
        return $this->hasMany(Place::class); 
    }


}
