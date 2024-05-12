<?php

namespace App\Livewire;
use Livewire\Attributes\Reactive;

use Livewire\Component;

class PostItem extends Component
{
    #[Reactive]
    public $user_name;
    public $post_content;
   
    public function render()
    {
        return view('livewire.post-item');
    }
}
