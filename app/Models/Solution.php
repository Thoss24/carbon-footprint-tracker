<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solution extends Model
{
    use HasFactory;

    protected $table = 'solutions';

    protected $fillable = [
        'title',
        'description',
        'category',
        'impact_score',
        'goal_id',
    ];

    public function goal() 
    {
        return $this->belongsTo(Goal::class);
    }
}
