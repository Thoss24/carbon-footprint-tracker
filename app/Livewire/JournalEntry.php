<?php

namespace App\Livewire;

use Livewire\Component;

class JournalEntry extends Component
{

    public $time;
    public $entry_data;

    public function render()
    {
        return view('livewire.journal-entry');
    }
}
