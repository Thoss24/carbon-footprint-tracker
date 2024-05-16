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
    public $curr_route;
    // @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())

    public function mount() 
    {
        $user = Auth::user();
        $this->user_id = $user->id;
        $this->user_name = $user->name;

        $route = Route::current();
        $routeName = $route->getName();
        $this->curr_route = $routeName;
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
        if ($this->curr_route == 'my_feed') {
            $this->createPost();
            $this->dispatch('post-created', post: $this->post_content);
        } elseif ($this->curr_route == 'dashboard') {
            $this->createPostPersonal();
            $this->dispatch('post-created-personal', post: $this->post_content);
        }
       
    }

    public function render()
    {
        return view('livewire.create-post');
    }
}
