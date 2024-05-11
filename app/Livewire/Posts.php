<?php

namespace App\Livewire;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;

class Posts extends Component
{

    public $posts;

    public function mount()
    {
        $this->posts =  Post::all();
    }

    public function render()
    {
        return view('livewire.posts');
    }
}
