<?php

namespace App\Livewire;
use Livewire\Attributes\Reactive;
use App\Models\Post;
use Illuminate\Support\Facades\DB;

use Livewire\Component;

class PostItem extends Component
{
    public $user_name;
    public $post_content;
    public $post_id;
    public $user_id;

    public function deletePost()
    {
        // DB::table('posts')->where('id', $this->post_id)->delete();
        $post = Post::find($this->post_id);

        // Delete the post using the ORM
        $post->delete();
        $this->dispatch('post-deleted', post: $this->post_id);
    }
   
    public function render()
    {
        return view('livewire.post-item');
    }
}
