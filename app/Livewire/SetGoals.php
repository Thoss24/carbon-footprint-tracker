<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Goal;
use Illuminate\Support\Facades\Auth;
use App\Models\Household;

class SetGoals extends Component
{
  
    public $user_id = 0;
    public $target_date = "1999/12/12"; // yyyy/mm/dd
    public $improve_percentage_goal;
    public $original_entry_id = 0; // id of entry to compare to 
    public $previous_co2e; // co2e of entry to compare to
    public $type = 'household'; // default value is household
    public $previous_entries; // previous carbon footprint entries by type
    public $previous_goals; // previous goals by type
    public $goal_reached_feedback;

    public function mount()
    {
        $user = Auth::user();
        $this->user_id = $user->id;
        $this->previous_entries = Household::where('user_id', $this->user_id)->get();
        $this->previous_goals = Goal::where('user_id', $this->user_id)->where('type', $this->type)->get();
        $this->checkGoalMet();
    }

    public function setGoal()
    {
        Goal::create([
            'user_id' => $this->user_id,
            'target_date' => $this->target_date,
            'improve_percentage_goal' => $this->improve_percentage_goal,
            'previous_co2e' => $this->previous_co2e,
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
            $this->previous_goals = Goal::where('user_id', $this->user_id)->where('type', $this->type)->get();
            $this->checkGoalMet(); // check goals have been met each time a user changes the co2e type
        } else {
            $this->previous_entries = []; // replace with other co2e types
            $this->previous_goals  = []; // replace with co2e types
        }
    }

    public function checkGoalMet()
    {
        //
        $current_date = date('Y-m-d');
        $most_recently_submitted_household_data = Household::latest()->first();
        //$most_recently_submitted_household_data_date = explode(" ", $most_recently_submitted_household_data->created_at)[0];

        foreach ($this->previous_goals as $goal) {
            if ($current_date >= $goal->target_date) {
                $goal = Goal::find($goal->id);
                // do claculation to check if % goal was reached
                // compare most recently submitted household data with target co2e using the target %
                $co2e_to_compare_against = $goal->previous_co2e;
                $difference = $most_recently_submitted_household_data->total_household_co2e - $co2e_to_compare_against;
                $percentage_diff = ($difference / $co2e_to_compare_against) * 100;

                $this->goal_reached_feedback = $percentage_diff;

                if ($percentage_diff > -$goal->improve_percentage_goal) { // goal not met
                    $this->goal_reached_feedback = "Goal not met"; // provide details on which goal was not met
                    $goal->goal_met = 0;
                    $goal->save();
                } else { // goal met
                    $this->goal_reached_feedback = "Goal met"; // provide details on which goal was not met 
                    $goal->goal_met = 1;
                    $goal->save();
                }
            }
        }

        // get current day and compare most recently submitted entry against target date & data - if they are the same, check if percentage goal was reached
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
