<?php

namespace App\Livewire;

use Livewire\Component;

class PostItemModal extends Component
{

    public function resetPerPage()
    {
        $this->dispatch('reset-comments-pages');
    }

    public function render()
    {
        return view('livewire.post-item-modal');
    }
}
