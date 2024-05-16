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
    public $post_item_modal = false;

    public function showPostItemModal()
    {   
        $this->post_item_modal = true;
    }

    public function hidePostItemModal()
    {   
        $this->post_item_modal = false;
    }

    public function deletePost()
    {
        $post = Post::find($this->post_id);

        $post->delete();
        $this->dispatch('post-deleted', post: $this->post_id);
    }
   
    public function render()
    {
        return view('livewire.post-item');
    }
}
