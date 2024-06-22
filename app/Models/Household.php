<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Household extends Model
{
    use HasFactory;

    protected $table = 'household';

    protected $fillable = [
        'electricity',
        'electricity_metric',
        'natural_gas',
        'natural_gas_metric',
        'heating_oil',
        'heating_oil_metric',
        'coal',
        'coal_metric',
        'lpg',
        'lpg_metric',
        'propane',
        'propane_metric',
        'wood',
        'wood_metric',
        'user_id'
    ];

    public function user() 
    {
        return $this->belongsTo(User::class);
    }

}
