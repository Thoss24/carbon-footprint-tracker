<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Friend_request;

class NotificationItem extends Component
{

    public $sender_name;
    public $receiver_name;
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
