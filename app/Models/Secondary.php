<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Secondary extends Model
{
    use HasFactory;

    protected $table = 'secondary';

    protected $fillable = [
        'user_id',
        'food_and_drink',
        'pharmaceuticals',
        'clothing',
        'it_equipment',
        'telephone',
        'insurance',
        'educational',
        'total_co2e'
    ];
}
