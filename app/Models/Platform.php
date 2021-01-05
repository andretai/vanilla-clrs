<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Platform extends Model
{
    use HasFactory;

    public function courses(){
        return $this->hasMany('App\Models\Course');
    }
    public function missions(){
        return $this->hasMany('App\Models\Mission');
    }
    public function promotions(){
        return $this->hasMany('App\Models\Promotion');
    }
}
