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

    public $labels = ['January', 'February', 'March', 'April', 'May', 'June'];
    public $data = [10, 15, 12, 18, 20, 22];

    public function mount()
    {
        $user = Auth::user();
        $this->user_id = $user->id;

        $this->household_entries = Household::where('user_id', $this->user_id)->get();

    }

    public function render()
    {
        return view('livewire.house-hold-data-visualization');
    }
}
