<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Friend_request extends Model
{

    protected $table = 'friend_request';

    use HasFactory;

    protected $fillable = [
        'status',
        'sender_id',
        'receiver_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
