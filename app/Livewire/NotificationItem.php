<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Friend_request;
use App\Models\Friendship;

class NotificationItem extends Component
{

    public $sender_name;
    public $receiver_name;
    public $receiver_id;
    public $sender_id;
    public $request_id;

    public function acceptRequest()
    {
        // Fetch the model instance
        $request = Friend_request::find($this->request_id);

        // // Modify the model's attributes
        $request->status = 'accepted';

        // // Save the updated model
        if ($request->save()) {
            $this->dispatch('friend_request_accepted', request: $this->request_id);

            Friendship::create([
                'user_id' => $this->sender_id, // user who sent request
                'friend_id' => $this->receiver_id // user who received request
            ]);
        };
    }

    public function rejectRequest()
    {
        // Fetch the model instance
        $request = Friend_request::find($this->request_id);

        // // Modify the model's attributes
        $request->status = 'rejected';

        // // Save the updated model
        if ($request->save()) {
            $this->dispatch('friend_request_rejected', request: $this->request_id);
        };
    }

    public function render()
    {
        return view('livewire.notification-item');
    }
}
