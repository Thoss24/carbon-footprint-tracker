<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Goal extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'target_date',
        'improve_percentage_goal',
        'previous_co2e',
        'original_entry_id',
        'type',
        'co2e_time_of_goal_met'
    ];

}
