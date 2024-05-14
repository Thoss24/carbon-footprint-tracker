<?php

namespace App\Livewire;
use Livewire\Component;
use App\Models\Post;
use Livewire\Attributes\On; 

class Posts extends Component
{

    public $posts;

    #[On('post-created')]
    public function mount()
    {
       // $this->posts =  Post::with('user')->get();
        $this->posts =  Post::all();
    }

    public function render()
    {
        return view('livewire.posts');
    }
}
