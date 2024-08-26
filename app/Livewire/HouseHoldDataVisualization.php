<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Household;
use Illuminate\Support\Facades\Auth;
use ConsoleTVs\Charts\Facades\Charts;

class HouseHoldDataVisualization extends Component
{

    public $user_id;
    public $household_entries;

    public $labels;

    public function mount()
    {
        $user = Auth::user();
        $this->user_id = $user->id;

        //$this->household_entries = Household::where('user_id', $this->user_id)->get();

        $this->household_entries = Household::where('user_id', $this->user_id)
                                   ->pluck('total_household_co2e')
                                   ->toArray();
        
        $this->labels = Household::where('user_id', $this->user_id)
        ->pluck('created_at')
        ->toArray();

    }

    public function render()
    {
        return view('livewire.house-hold-data-visualization');
    }
}
