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
            if (preg_match("/\b" . preg_quote(str_replace(" ", "\s*", $this->query), "/") . "\b/i", $user->name)) {
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
