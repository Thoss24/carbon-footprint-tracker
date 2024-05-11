<?php

namespace App\Livewire;
use Livewire\Attributes\Reactive;

use Livewire\Component;

class PostItem extends Component
{
    #[Reactive]
    public $post;
   
    public function render()
    {
        return view('livewire.post-item');
    }
}
