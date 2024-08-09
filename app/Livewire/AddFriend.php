<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Friend_request;
use Illuminate\Support\Facades\Auth;

class AddFriend extends Component
{

    public $id;
    public $user_id; // recipient id

    public function mount($user_id = null)
    {
        $user = Auth::user();
        $this->id = $user->id;
        $this->user_id = $user_id;
    }

    public function addFriend()
    {
        Friend_request::create([
            'sender_id'=>$this->id,
            'receiver_id'=>$this->user_id
        ]);
    }

    public function render()
    {
        return view('livewire.add-friend');
    }
}
