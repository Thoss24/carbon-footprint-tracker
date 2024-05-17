<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;

class CreatePost extends Component
{

    public $post_content;
    public $user_id;
    public $user_name;
    // @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())

    public function mount() 
    {
        $user = Auth::user();
        $this->user_id = $user->id;
        $this->user_name = $user->name;
    }

    // create post my feed
    public function createPost() 
    {
        Post::create([
            'content' => $this->post_content,
            'user_id' => $this->user_id,
            'creator_name' => $this->user_name
        ]);

        $this->dispatch('post-created', post: $this->post_content);
    }

    public function render()
    {
        return view('livewire.create-post');
    }
}
