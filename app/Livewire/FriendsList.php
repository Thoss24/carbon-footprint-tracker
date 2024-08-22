<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Friendship;
use Illuminate\Support\Facades\Auth;

class FriendsList extends Component
{

    public $friends;
    public $user_id;

    public function mount()
    {

        $user = Auth::user();
        $this->user_id = $user->id;

        $this->friends = Friendship::where(function ($query) {
            $query->where('user_id', $this->user_id)
                  ->orWhere('friend_id', $this->user_id);
        })
        ->join('users as u1', 'friendships.user_id', '=', 'u1.id')
        ->join('users as u2', 'friendships.friend_id', '=', 'u2.id')
        ->select(
            'friendships.*',
            'u1.name as user_name',
            'u2.name as friend_name'
        )
        ->get();
    }

    public function render()
    {
        return view('livewire.friends-list');
    }
}
