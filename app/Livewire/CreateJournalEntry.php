<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Journal;
use Illuminate\Support\Facades\Auth;

class CreateJournalEntry extends Component
{

    public $all_entries;
    public $user_id;
    public $entry;
    public $entry_date;

    public function mount()
    {
        unset($this->all_entries);
        $user = Auth::user();
        $this->user_id = $user->id;
        $this->all_entries = Journal::where('user_id', $this->user_id)->get();
    }

    public function createEntry()
    {
        Journal::create([
            'entry' => $this->entry,
            'user_id' => $this->user_id,
            'date' => $this->entry_date
        ]);

        $this->mount();
    }

    public function render()
    {
        return view('livewire.create-journal-entry');
    }
}
