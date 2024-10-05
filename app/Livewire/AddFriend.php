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
        // Check if a pending friend request already exists
        $existingRequest = Friend_request::where(function ($query) {
            $query->where('sender_id', $this->id)
                  ->orWhere('receiver_id', $this->id);
        })
        ->where(function ($query) {
            $query->where('sender_id', $this->user_id)
                  ->orWhere('receiver_id', $this->user_id);
        })
        ->where('status', 'pending')
        ->first(); // Use first() to get the actual record if exists
    
        if ($existingRequest) {
            // If a pending request exists, update user feedback
            $this->user_feedback = "A friend request is already pending.";
            return; // Exit the method early
        }
    
        // No existing pending request, proceed to create a new friend request
        Friend_request::create([
            'sender_id' => $this->id,
            'receiver_id' => $this->user_id
        ]);
    
        $this->user_feedback = "Request Sent!";
    }

    public function render()
    {
        return view('livewire.add-friend');
    }
}
