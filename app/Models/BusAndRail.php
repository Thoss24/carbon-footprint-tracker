<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusAndRail extends Model
{
    use HasFactory;

    protected $table = 'bus_and_rail';

    protected $fillable = [
        'user_id',
        'coach_distance',
        'bus_distance',
        'train_distance',
        'tram_distance',
        'subway_distance',
        'taxi_distance',
        'total_co2e'
    ];

}
