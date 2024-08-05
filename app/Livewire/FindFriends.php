<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;

class FindFriends extends Component
{       
    public $users;
    public $queried_users;
    public $query;

    public function searchForUser()
    {
        if ($this->query == '') {
            $this->queried_users = [];
            return;
        };

        foreach ($this->users as $idx => $user) {
            // echo "User -- : " . print_r($user, true);
            if (str_contains($user->name, $this->query)) {
                $this->queried_users[$idx] = $user;
            }
        }
    }

    public function mount()
    {
        $this->users = User::all();
    }

    public function render()
    {
        return view('livewire.find-friends');
    }
}
