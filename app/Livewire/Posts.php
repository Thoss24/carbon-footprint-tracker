<?php

namespace App\Livewire;
use Livewire\Component;
use App\Models\Post;
use Livewire\Attributes\On; 
use Illuminate\Support\Facades\Auth;

class Posts extends Component
{

    public $posts;
    public $user_name;
    public $user_id;

    #[On('post-created')]
    #[On('post-deleted')]
    public function mount()
    {
        $user = Auth::user();
        $this->user_id = $user->id;
        $this->user_name = $user->name;
        $this->posts =  Post::all();
    }

    public function render()
    {
        return view('livewire.posts');
    }
}
