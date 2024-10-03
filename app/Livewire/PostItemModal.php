<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;

class PostItemModal extends Component
{

    public $user;
    public $postContent;

    protected $listeners = [
        'post-modal-opened' => 'getUser'
    ];

    public function getUser($postUserId, $postContent)
    {
        $this->user = User::find($postUserId);
        $this->postContent = $postContent;
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
