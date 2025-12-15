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
    public $profile_initials;

    public function mount()
    {
        $initials = explode(" ", $this->user_name);
        $this->profile_initials = $initials[0][0];
    }

    public function render()
    {
        return view('livewire.friend');
    }
}
