<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On; 
use Livewire\WithPagination;

class Comments extends Component
{   

    use WithPagination;

    public $comment_content = '';
    public $user_id;
    public $user_name;
    public $post_id;
    public $post_comments;
    public $perPage = 5;
    public $lastId = null;

    protected $listeners = [
        'send-post-id' => 'getPostId'
    ];

    public function getPostId($data)
    {
        $this->post_id = $data['data'];
        
        //$this->post_comments = Comment::where('post_id', $this->post_id)->paginate(5);
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

    public function loadMore()
    {
        $this->perPage += 5;
        $this->render();
    }

    #[On('reset-comments-pages')]
    public function resetPerPage()
    {
        $this->perPage = 5;
    }

    #[On('comment-created')]
    public function render()
    {
        $this->post_comments = Comment::where('post_id', $this->post_id)
        ->when($this->lastId, function ($query) {
            $query->where('id', '>', $this->lastId);
        })
        ->take($this->perPage)
        ->get();

        return view('livewire.comments', [
            'comments' => $this->post_comments,
        ]);
    }
}
