<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Achievements extends Model
{
    use HasFactory;

    protected $table = 'achievements';

    protected $fillable = [
        'count_requirement',
        'carbon_footprint_type',
        'achievement_type',
    ];
}
