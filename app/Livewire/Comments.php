<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class Comments extends Component
{   

    public $comment_content;
    public $user_id;
    public $user_name;
    public $post_id;

    protected $listeners = [
        'post-modal-opened' => 'getPostInfo',
    ];

    public function getPostInfo($data)
    {
        //$this->dispatchBrowserEvent('show-debugger');
      // print_r($data);
        $this->post_id = $data;
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
        ]);
    }

    public function render()
    {
        return view('livewire.comments');
    }
}
