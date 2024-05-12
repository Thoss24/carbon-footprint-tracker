<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class CreatePost extends Component
{

    public $post_content;
    public $user_id;
    public $user_name;
    public $post_modal_open = false;
    // @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())

    public function closeModal() 
    {
        $this->post_modal_open = false;
    }

    public function openModal() 
    {
        $this->post_modal_open = true;
    }

    public function mount() 
    {
        $user = Auth::user();
        $this->user_id = $user->id;
        $this->user_name = $user->name;
    }

    public function createPost() 
    {
        Post::create([
            'content' => $this->post_content,
            'user_id' => $this->user_id,
        ]);

        $this->dispatch('post-created', post: $this->post_content);
        
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.create-post');
    }
}
