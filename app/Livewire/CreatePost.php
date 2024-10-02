<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class CreatePost extends Component
{

    public $post_content;
    public $user_id;
    public $user_name;
    public $share_post = [];
    public $postModalOpen = false;
    public $user;

    protected $listeners = [
        'share-post' => 'sharePost'
    ];

    public function sharePost($post)
    {
        $this->share_post = $post;
        $this->post_content = 'I reached my goal of reducing my ' . $this->share_post['Type'] . ' co2e by ' . $this->share_post['Percentage goal'] .
        '%. Reduced from ' . $this->share_post['Original co2e'] . ' to ' . $this->share_post['Most recent co2e'] . '!';
        $this->postModalOpen = true;

    }

    public function mount() 
    {
        $this->user = Auth::user();
        $this->user_id = $this->user->id;
        $this->user_name = $this->user->name;
    }

    // create post my feed
    public function createPost() 
    {
        Post::create([
            'content' => $this->post_content,
            'user_id' => $this->user_id,
            'creator_name' => $this->user_name
        ]);

        $this->dispatch('post-created', post: $this->post_content);
    }

    public function render()
    {
        return view('livewire.create-post');
    }
}
