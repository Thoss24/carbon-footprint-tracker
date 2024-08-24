<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Friend_request;
use Illuminate\Support\Facades\Auth;

class AddFriend extends Component
{

    public $id;
    public $user_id; // recipient id
    public $user_feedback = "Add Friend +";

    public function mount($user_id = null)
    {
        $user = Auth::user();
        $this->id = $user->id;
        $this->user_id = $user_id;
    }

    public function addFriend()
    {   
        // when adding a friend - check if a pending request already exists 
        // if there exists a row where a sender_id or reciever_id matches then tell user the request already exists by updating $user_feedback

        

        Friend_request::create([
            'sender_id'=>$this->id,
            'receiver_id'=>$this->user_id
        ]);

        $this->user_feedback = "Request Sent!";
    }

    public function render()
    {
        return view('livewire.add-friend');
    }
}
