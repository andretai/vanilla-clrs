<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecommendationsRating extends Model
{
    use HasFactory;
    protected $fillable = ['rec_id','user_id','sentiment'];

    public function recommendation()
    {
        return $this->belongsTo('App\Models\Recommendation','rec_id');
    }
}
