<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class CreatePost extends Component
{

    public $post_content;
    public $user_id;

    // @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())

    public function mount() 
    {
        $this->user_id = Auth::id();
    }

    public function createPost() 
    {
        Post::create([
            'content' => $this->post_content,
            'user_id' => $this->user_id,
        ]);
    }

    public function render()
    {
        return view('livewire.create-post');
    }
}
