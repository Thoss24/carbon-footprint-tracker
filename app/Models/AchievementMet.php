<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AchievementMet extends Model
{
    use HasFactory;

    protected $table = 'achievement_met';

    protected $fillable = [
        'user_id',
        'achievement_id',
    ];
}
