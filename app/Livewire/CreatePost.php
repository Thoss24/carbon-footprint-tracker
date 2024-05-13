<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class CreatePost extends Component
{

    public $post_content;
    public $user_id;
    public $user_name;
    public $post_modal_open = false;
    public $curr_route;
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
        $this->curr_route = Request::url();
    }

    // create post my feed
    public function createPost() 
    {
        Post::create([
            'content' => $this->post_content,
            'user_id' => $this->user_id,
        ]);
        
        $this->closeModal();
    }

    // create post personal feed - was causing errors using same dispatch method in createPost on different pages
    public function createPostPersonal()
    {
        Post::create([
            'content' => $this->post_content,
            'user_id' => $this->user_id,
        ]);
        
        $this->closeModal();
    }

    public function submitForm()
    {
        $path = parse_url($this->curr_route, PHP_URL_PATH);
        $route = basename($path); 

        if ($route == 'my_feed') {
            $this->createPost();
            $this->dispatch('post-created', post: $this->post_content);
        } elseif ($route == 'dashboard') {
            $this->createPostPersonal();
            $this->dispatch('post-created-personal', post: $this->post_content);
        }
       
    }

    public function render()
    {
        return view('livewire.create-post');
    }
}
