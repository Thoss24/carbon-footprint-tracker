<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Goal;
use Illuminate\Support\Facades\Auth;
use App\Models\Household;

class SetGoals extends Component
{
  
    public $user_id;
    public $target_date = "1999/12/12"; // yyyy/mm/dd
    public $improve_percentage_goal;
    public $original_entry_id = 0; // id of entry to compare to 
    public $previous_co2e;
    public $type = 'household'; // default value is household
    public $previous_entries;

    public function mount()
    {
        $user = Auth::user();
        $this->user_id = $user->id;
        $this->previous_entries = Household::where('user_id', $this->user_id)->get();
    }

    public function setGoal()
    {
        Goal::create([
            'target_date' => $this->target_date,
            'improve_percentage_goal' => $this->improve_percentage_goal,
            'previous_co2e' => $this->previous_co2e, // ISSUES SELECTING PREV CO2E RENDERING OPTION INSIDE FOREACH - TRY RENDERING
            'type' => $this->type,
            'original_entry_id' => $this-> original_entry_id
        ]);
    }

    public function selectPrevCo2e($co2e, $prev_id)
    {   
        $this->previous_co2e = $co2e;
        $this->original_entry_id = $prev_id;
    }

    public function getPreviousEntryData() 
    {
        if ($this->type == 'household') {
            $this->previous_entries = Household::where('user_id', $this->user_id)->get();
        }

        // do the same for the other types when those tables are created

    }

    public function checkGoalMet()
    {
        // get current day and compare against target date - if they are the same, check if percentage goal was reached
        // award point if true - otherwise return data telling user goal was not met
    }

    public function provideSolutions()
    {
        // provide some possible solutions based on the submitted carbon footprint data - need to get this data from the household table
    }

    public function render()
    {
        return view('livewire.set-goals');
    }
}
