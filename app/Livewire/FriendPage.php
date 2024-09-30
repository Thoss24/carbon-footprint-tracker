<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Post;

class FriendPage extends Component
{

    public $friend_id;
    public $posts;
    public $user;

    public function mount()
    {
        $urlArr = explode("/", url()->current());
        $this->friend_id = $urlArr[count($urlArr) - 1];
        $this->user = User::find($this->friend_id);
    }

    public function getAllPosts()
    {
        $this->posts = Post::where('user_id', $this->friend_id)->get();
    }

    public function getCarbonFootprintData()
    {
        
    }

    public function render()
    {
        return view('livewire.friend-page');
    }
}
