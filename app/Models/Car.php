<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $table = 'car';

    protected $fillable = [
        'user_id',
        'mileage',
        'mileage_metric',
        'fuel_used',
        'fuel_type',
        'fuel_metric',
        'total_co2e'
    ];

    public function user() 
    {
        return $this->belongsTo(User::class);
    }
}
