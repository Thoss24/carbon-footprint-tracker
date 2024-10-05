<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class FindFriends extends Component
{       
    public $users;
    public $queried_users;
    public $query = '';
    public $user_id; // currently authenticated user

    public function searchForUser()
    {
        if ($this->query == '') {
            $this->queried_users = [];
            return;
        };

        foreach ($this->users as $idx => $user) {
            if (preg_match("/\b" . preg_quote(str_replace(" ", "\s*", $this->query), "/") . "\b/i", $user->name)) {
                $this->queried_users[$idx] = $user;
            }
        }
    }

    public function mount()
    {

        $user = Auth::user();
        $this->user_id = $user->id;
        
        // $this->users = User::where('id', '!=', $this->user_id)
        //     ->whereNotIn('id', function ($query) {
        //         $query->select('user_id')
        //             ->orWhere('friend_id', $this->user_id)
        //             ->from('friendships')
        //             ->where(function ($q)  {
        //                 $q->where('user_id', $this->user_id)
        //                     ->orWhere('friend_id', $this->user_id);
        //             });
        //     })
        //     ->get();

        $this->users = User::whereDoesntHave('friendships')->get();

    }

    public function render()
    {
        return view('livewire.find-friends');
    }
}
