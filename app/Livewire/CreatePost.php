<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;

class CreatePost extends Component
{

    public $post_content;

    public function createPost() 
    {
        Post::create([
            'content' => $this->post_content,
        ]);
    }

    public function render()
    {
        return view('livewire.create-post');
    }
}
