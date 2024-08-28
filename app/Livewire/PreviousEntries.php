<?php

namespace App\Livewire;

use Livewire\Component;

class PreviousEntries extends Component
{

    public $entry_id;
    public $entry_co2e;

    public function selectPrevCo2e()
    {
        $this->dispatch('select_prev_entry', request: $this->entry_id);
    }

    public function render()
    {
        return view('livewire.previous-entries');
    }
}
