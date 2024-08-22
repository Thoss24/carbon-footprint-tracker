<?php

namespace App\Livewire;

use Livewire\Component;

class Friend extends Component
{
    public $auth_user_id;
    public $user_id;
    public $user_name;
    public $friend_name;
    public $friend_id;

    public function render()
    {
        return view('livewire.friend');
    }
}
