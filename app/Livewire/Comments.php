<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On; 

class Comments extends Component
{   

    public $comment_content;
    public $user_id;
    public $user_name;
    public $post_id;
    public $post_comments;

    protected $listeners = [
        'send-post-id' => 'getPostId',
    ];

    public function getPostId($data)
    {
        $this->post_id = $data['data'];
        
        $this->post_comments = Comment::where('post_id', $this->post_id)->get();

    }

    #[On('comment-created')]
    public function getAllComments()
    {
        $this->post_comments = Comment::where('post_id', $this->post_id)->get();
    }

    public function mount()
    {
        $user = Auth::user();
        $this->user_id = $user->id;
        $this->user_name = $user->name;
    }

    public function createComment()
    {
        Comment::create([
            'content' => $this->comment_content,
            'user_id' => $this->user_id,
            'post_id' => $this->post_id
        ]);

        $this->dispatch('comment-created', content: $this->comment_content);
    }

    public function render()
    {
        return view('livewire.comments');
    }
}
