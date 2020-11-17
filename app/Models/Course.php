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
    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function platform()
    {
        return $this->belongsTo('App\Models\Platform');
    }
        
    public function avgRating()
    {
        return number_format($this->ratings()->avg('rate'),1);
    }

    public function countRating()
    {
        return $this->ratings()->count();
    }
}
