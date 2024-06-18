<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Household extends Model
{
    use HasFactory;

    protected $fillable = [
        'electricity',
        'natural_gas',
        'heating_oil',
        'coal',
        'lpg',
        'propane',
        'wood',
        'user_id'
    ];

    public function user() 
    {
        return $this->belongsTo(User::class);
    }

}
