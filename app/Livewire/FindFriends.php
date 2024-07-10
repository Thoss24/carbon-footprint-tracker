<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;

class FindFriends extends Component
{       

    public $users;

    public function getAllUsers()
    {
        $this->users = User::all();
    }

    public function mount()
    {
        $this->getAllUsers();
    }

    public function searchForUser()
    {

    }

    public function render()
    {
        return view('livewire.find-friends');
    }
}
