<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recommendation extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'order','key'];

    public function recommendations_rating()
    {
        return $this->hasMany('App\Models\RecommendationsRating','rec_id');
    }
}
