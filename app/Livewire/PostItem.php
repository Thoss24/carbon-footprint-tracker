<?php

namespace App\Livewire;
use Livewire\Attributes\Reactive;
use App\Models\Comment;
use App\Models\Post;

use Livewire\Component;

class PostItem extends Component
{
    public $user_name;
    public $post_content;
    public $post_id;
    public $user_id;
    public $auth_user_id;
    public $profile_photo;

    public function deletePost()
    {
        $post = Post::find($this->post_id);

        $post->delete();
        $this->dispatch('post-deleted', post: $this->post_id);
    }

    public function openModal()
    {
        $this->dispatch('post-modal-opened', postContent: $this->post_content, userName: $this->user_name, authUserId: $this->auth_user_id, postUserId: $this->user_id);
        $this->dispatch('send-post-id', ['data' => $this->post_id]);
    }
   
    public function render()
    {
        return view('livewire.post-item');
    }
}
