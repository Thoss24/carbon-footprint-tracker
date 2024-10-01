<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class FriendPage extends Component
{

    public $friend_id;
    public $posts;
    public $user;
    public $user_id;
    public $data_types = ['log-household-carbon-footprint', 'log-transport-carbon-footprint', 'log-secondary-carbon-footprint'];
    public $transport_type = ['car', 'flights', 'bus&rail'];

    public function mount()
    {
        $user = Auth::user();
        $this->user_id = $user->id;
        $urlArr = explode("/", url()->current());
        $this->friend_id = $urlArr[count($urlArr) - 1];
        $this->user = User::find($this->friend_id);
        $this->getAllPosts();
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
