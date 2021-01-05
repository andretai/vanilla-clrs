<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MissionStatus extends Model
{
    protected $fillable = ['mission_id','user_id','status'];
    use HasFactory;
    protected $table = 'missions_status';
}
