<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    
    public function favourites(){
        return $this->hasMany('App\Models\Favourite');
    }

    public function ratings(){
        return $this->hasMany('App\Models\Rating');
    }
}
