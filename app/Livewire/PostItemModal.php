<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;

class PostItemModal extends Component
{

    public $user;

    protected $listeners = [
        'post-modal-opened' => 'getUser'
    ];

    public function getUser($postUserId)
    {
        $this->user = User::find($postUserId);
    }

    public function resetPerPage()
    {
        $this->dispatch('reset-comments-pages');
    }

    public function render()
    {
        return view('livewire.post-item-modal');
    }
}
