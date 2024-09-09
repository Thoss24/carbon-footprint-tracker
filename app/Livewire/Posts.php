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
    public $post_type = 'all';

    #[On('post-created')]
    #[On('post-deleted')]
    public function mount()
    {
        $user = Auth::user();
        $this->user_id = $user->id;
        $this->user_name = $user->name;
        $this->posts =  Post::all();
    }

    public function togglePosts()
    {
        if ($this->post_type == 'personal') {
            $this->posts =  Post::where('user_id', $this->user_id)->get();
        } else {
            $this->posts =  Post::all();
        }
    }

    public function render()
    {
        return view('livewire.posts');
    }
}
