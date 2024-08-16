<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use Livewire\Attributes\On; 

class PersonalFeed extends Component
{

    public $personal_posts;
    public $post_content;
    public $user_id;
    public $user_name;

    #[On('post-created')]
    #[On('post-deleted')]
    public function mount()
    {
        $user = Auth::user();
        $this->user_id = $user->id;
        $this->user_name = $user->name;
        $this->personal_posts =  Post::where('user_id', $this->user_id)->get();
    }

    public function render()
    {
        return view('livewire.personal-feed');
    }
}
