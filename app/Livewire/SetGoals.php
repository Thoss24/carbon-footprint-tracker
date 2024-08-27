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
    public $previous_co2e;
    public $type;

    public function mount()
    {
        $user = Auth::user();
        $this->user_id = $user->id;
    }

    public function setGoal()
    {
        Goal::create([
            'target_date' => $this->post_content,
            'improve_percentage_goal' => $this->user_id,
            'previous_co2e' => $this->user_name,
            'type' => $this->user_name
        ]);
    }

    public function getPreviousEntryData() 
    {
        // get previous entry data depending on which type the user selects
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
