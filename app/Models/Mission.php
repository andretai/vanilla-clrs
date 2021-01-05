<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mission extends Model
{
    protected $fillable = ['title','reward','platform','type','volume'];
    use HasFactory;

    public function platform()
    {
        return $this->belongsTo('App\Models\Platform');
    }
}
