<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flights extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'distance',
        'num_passengers',
        'total_co2e'
    ];

    public function user() 
    {
        return $this->belongsTo(User::class);
    }
}
