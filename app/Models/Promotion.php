<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    protected $fillable = ['user_id','platform_id','description','image','code', 'url','start_date','end_date'];
    use HasFactory;

    public function platform()
    {
        return $this->belongsTo('App\Models\Platform');
    }
}
