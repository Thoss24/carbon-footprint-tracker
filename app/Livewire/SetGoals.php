<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Goal;
use Illuminate\Support\Facades\Auth;
use App\Models\Household;
use App\Models\Solution;

class SetGoals extends Component
{
  
    public $user_id = 0;
    public $target_date = "1999/12/12"; // yyyy/mm/dd
    public $improve_percentage_goal;
    public $original_entry_id = 0; // id of entry to compare to 
    public $previous_co2e; // co2e of entry to compare to
    public $type = 'household'; // default value is household
    public $previous_entries; // previous carbon footprint entries by type
    public $active_goals; // all active goals
    public $past_goals; // achieved or not achieved goals

    public $test_last_entry;
    public $test_last_entry_id;
    public $test_last_goal_id;

    public function mount()
    {
        $user = Auth::user();
        $this->user_id = $user->id;
        $this->previous_entries = Household::where('user_id', $this->user_id)->get();
        $this->active_goals = Goal::where('user_id', $this->user_id)->where('type', $this->type)->where('goal_seen', 0)->get();
        $this->past_goals = Goal::where('user_id', $this->user_id)->where('type', $this->type)->where('goal_seen', 1)->get();
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

    public function getPreviousEntryData() // invoked when user changes co2e type
    {
        if ($this->type == 'household') {
            $this->previous_entries = Household::where('user_id', $this->user_id)->get();
            $this->active_goals = Goal::where('user_id', $this->user_id)->where('type', $this->type)->where('goal_seen', 0)->get();
            $this->past_goals = Goal::where('user_id', $this->user_id)->where('type', $this->type)->where('goal_seen', 1)->get();
            $this->checkGoalMet(); // check goals have been met each time a user changes the co2e type
        } else {
            $this->previous_entries = []; // replace with other co2e types
            $this->active_goals  = []; // replace with co2e types
            $this->past_goals = [];
        }
    }

    public function checkGoalMet()
    {
        $current_date = date('Y-m-d');
        $most_recently_submitted_data = [];
        
        switch($this->type){
            case 'household':
                $most_recently_submitted_data = Household::latest()->first();
                break;
            case 'transport':
                $most_recently_submitted_data = []; // change when new types are added
                break;
            case 'secondary':
                $most_recently_submitted_data = []; // change when new types are added
                break;
        }

        foreach ($this->active_goals as $goal) {
            if ($current_date >= $goal->target_date) {
                $goal = Goal::find($goal->id);
                // do claculation to check if % goal was reached
                // compare most recently submitted household data with target co2e using the target %
                $co2e_to_compare_against = $goal->previous_co2e;
                $difference = $most_recently_submitted_data->total_household_co2e - $co2e_to_compare_against;
                $percentage_diff = ($difference / $co2e_to_compare_against) * 100;

                if (-$percentage_diff < -$goal->improve_percentage_goal) { // goal not met    
                    $goal->goal_met = 0;
                    $goal->goal_seen = 1;
                    $goal->save();
                    $this->provideSolutions($most_recently_submitted_data->id, $goal->id);
                } else { // goal met
                    $goal->goal_met = 1;
                    $goal->goal_seen = 1;
                    $goal->save();
                }
            }
        }

        // get current day and compare most recently submitted entry against target date & data - if they are the same, check if percentage goal was reached
        // award point if true - otherwise return data telling user goal was not met
    }

    public function provideHouseholdSolutions($entryId, $goalId)
    {
        $this->test_last_entry = Household::find($entryId);

        $this->test_last_entry_id = $entryId;
        $this->test_last_goal_id = $goalId;
        // handle solution logic for each type

        // store solutions in an array with specific data for each entry
        // update db

        Solution::create([
            'goal_id' => $goalId,
            'title' => "Placeholder title",
            'description' => "Placeholder description",
            'category' => $this->type,
            'impact_score' => 0,
        ]);

    }

    public function provideTransportSolutions($entryId, $goalId)
    {
        // handle solution logic for each type
    }

    public function provideSecondarySolutions($entryId, $goalId)
    {
        // handle solution logic for each type
    }

    public function provideSolutions($lastEntryId, $goalId)
    {
        switch($this->type){
            case 'household':
                $this->provideHouseholdSolutions($lastEntryId, $goalId);
                break;
            case 'transport':
                $this->provideTransportSolutions($lastEntryId, $goalId);
                break;
            case 'secondary':
                $this->provideSecondarySolutions($lastEntryId, $goalId);
                break;
        }
    }

    public function render()
    {
        return view('livewire.set-goals');
    }
}
