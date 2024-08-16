<?php

namespace App\Livewire;
use Livewire\Component;
use App\Models\Friend_request;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On; 

class Notifications extends Component
{

    public $user_id;
    public $pending_friend_requests;
    public $pending_friend_requests_count;
    public $accepted_friend_requests;
    public $notification_id;

    public function mount()
    {   
        $user = Auth::user();
        $this->user_id = $user->id;

        $this->pending_friend_requests = Friend_request::where('receiver_id', '=', $this->user_id, 'and')
        ->where('status', '=', 'pending',)
        ->join('users as sender', 'friend_request.sender_id', '=', 'sender.id')
        ->join('users as receiver', 'friend_request.receiver_id', '=', 'receiver.id')
        ->select('friend_request.*',
        'sender.name as sender_name',
        'receiver.name as receiver_name'
        )
        ->get();
        $this->pending_friend_requests_count = count($this->pending_friend_requests);
    }


    public function render()
    {
        return view('livewire.notifications');
    }
}
