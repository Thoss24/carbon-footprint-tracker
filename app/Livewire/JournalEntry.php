<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Journal;

class JournalEntry extends Component
{
    public $time;
    public $entry_data;
    public $entryId;
    public $delete_entry_modal_showing = false;

    public function mount($time, $entry_data)
    {
        $this->time = $time;
        $this->entry_data = $entry_data;
    }

    public function edit()
    {
        // Emit event to parent component to handle editing
        $this->dispatch('editEntry', entryId: $this->entryId);
    }

    public function delete()
    {
        // Find and delete the entry
        $entry = Journal::where('created_at', $this->time)
            ->where('entry', $this->entry_data)
            ->where('user_id', auth()->id())
            ->first();

        if ($entry) {
            $entry->delete();
            
            // Emit event to refresh the parent component
            $this->dispatch('entryDeleted');
            
            session()->flash('message', 'Journal entry deleted successfully.');
        }
    }

    public function toggleModal()
    {
        
    }

    public function render()
    {
        return view('livewire.journal-entry');
    }
}
