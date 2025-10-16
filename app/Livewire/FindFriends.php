<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class FindFriends extends Component
{       
    public $users;
    public $queried_users = [];
    public $query = '';
    public $user_id; // currently authenticated user

    public function searchForUser()
    {
        if (trim($this->query) === '') {
            $this->queried_users = $this->users;
            return;
        }

        $pattern = "/\b" . preg_quote(str_replace(' ', '\s*', $this->query), "/") . "\b/i";

        $this->queried_users = $this->users->filter(function ($user) use ($pattern) {
            return preg_match($pattern, $user->name);
        })->values();
    }

    public function mount()
    {
        $user = Auth::user();
        $this->user_id = $user->id;

        $this->users = User::whereDoesntHave('friendships', function ($query) {
            $query->where(function ($query) {
                $query->where('friend_id', Auth::id())
                      ->orWhere('user_id', Auth::id());
            });
        })->get();

        $this->queried_users = $this->users;

    }

    public function render()
    {
        return view('livewire.find-friends');
    }
}
