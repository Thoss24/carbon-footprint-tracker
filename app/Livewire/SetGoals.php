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

    public $test_target_percentage;
    public $test_actual_percentage;

    public function mount()
    {
        $user = Auth::user();
        $this->user_id = $user->id;
        $this->previous_entries = Household::where('user_id', $this->user_id)->get();
        #$this->active_goals = Goal::where('user_id', $this->user_id)->where('type', $this->type)->where('goal_seen', 0)->get();
        $this->checkGoalMet();
        $this->past_goals = Goal::where('user_id', $this->user_id)->where('type', $this->type)->where('goal_seen', 1)->get();
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

        $active_goals = Goal::where('user_id', $this->user_id)->where('type', $this->type)->where('goal_seen', 0)->get();

        foreach ($active_goals as $goal) {
            if ($current_date >= $goal->target_date) {
                $goal = Goal::find($goal->id);
                // do claculation to check if % goal was reached
                // compare most recently submitted household data with target co2e using the target %
                $co2e_to_compare_against = $goal->previous_co2e;
                $difference = $most_recently_submitted_data->total_household_co2e - $co2e_to_compare_against;
                $percentage_diff = ($difference / $co2e_to_compare_against) * 100;

                $this->test_target_percentage = $goal->improve_percentage_goal;
                $this->test_actual_percentage = $percentage_diff;

                if ($percentage_diff < $goal->improve_percentage_goal) { // goal not met    
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

        $this->active_goals = Goal::where('user_id', $this->user_id)->where('type', $this->type)->where('goal_seen', 0)->get();

        // get current day and compare most recently submitted entry against target date & data - if they are the same, check if percentage goal was reached
        // award point if true - otherwise return data telling user goal was not met
    }

    public function provideHouseholdSolutions($entryId, $goalId)
    {

        $recommendations = [];

        $goal = Goal::find($goalId);

        $householdToAnalyse = Household::find($entryId);
        $householdSize = $householdToAnalyse->num_people_in_household;
        $householdElectricity = $householdToAnalyse->electricity;
        $householdNaturalGas = $householdToAnalyse->natural_gas;
        $householdHeatingOil = $householdToAnalyse->heating_oil;
        $householdCoal = $householdToAnalyse->coal;
        $householdLpg = $householdToAnalyse->lpg;
        $householdPropane = $householdToAnalyse->propane;
        $householdWood = $householdToAnalyse->wood;
        
        if (($householdElectricity / $householdSize) > 500) {

            $recommendation = array('Title'=>'Solution to reduce Electricity consumption', 'Description'=>'Choose appliances with a high energy rating, such as A+++, when shopping for new appliances. Take quick showers, turn off running taps when unused, and use the required amount of water while cooking. ');

            array_push($recommendations, $recommendation);
        }
        if (($householdNaturalGas / $householdSize) > 300) {

            $recommendation = array('Title'=>'Solution to reduce Natural Gas consumption', 'Description'=>'Turn down the temperature on your radiator or boiler when you`re not using a room. Choose appliances that are designed to use less energy and gas. ');

            array_push($recommendations, $recommendation);
        }
        if (($householdHeatingOil / $householdSize) > 30) {

            $recommendation = array('Title'=>'Solution to reduce Heating Oil consumption', 'Description'=>'Insulation helps maintain your home`s temperature and reduce fuel usage. Lower the temperature on your thermostat, even by one degree.');

            array_push($recommendations, $recommendation);
        }
        if (($householdCoal / $householdSize) > 20) {

            $recommendation = array('Title'=>'Solution to reduce Coal consumption', 'Description'=>'Upgrade insulation in walls, roofs, and floors to minimize heat loss. Proper insulation helps maintain indoor temperatures, reducing the need for heating. Identify and seal drafts around windows, doors, and other openings to prevent heat loss. If available, transitioning to natural gas heating can be a cleaner alternative to coal.');

            array_push($recommendations, $recommendation);
        }
        if (($householdLpg / $householdSize) > 30) {

            $recommendation = array('Title'=>'Solution to reduce LPG consumption', 'Description'=>'Invest in energy-efficient gas stoves or induction cooktops, which can use gas more efficiently. If you use LPG for heating, consider lowering the thermostat a few degrees. Use microwaves or slow cookers for meals that don’t require a stove, as they can be more efficient.');

            array_push($recommendations, $recommendation);
        }
        if (($householdPropane / $householdSize) > 20) {

            $recommendation = array('Title'=>'Solution to reduce Propane consumption', 'Description'=>' Set your thermostat a few degrees lower in winter. Each degree can reduce usage significantly. Set heating schedules to lower temperatures when you’re not home. Insulate attics, walls, and floors to minimize heat loss. Invest in high-efficiency propane appliances, such as furnaces, water heaters, and stoves, which use less fuel.');

            array_push($recommendations, $recommendation);
        }
        if (($householdWood / $householdSize) > 40) {

            $recommendation = array('Title'=>'Solution to reduce Propane consumption', 'Description'=>'Enhance insulation in your home to retain heat, reducing the need for wood heating.  Use high-efficiency wood stoves or fireplaces that burn wood more completely and produce less waste. Consider using electric heaters, propane, or natural gas as alternatives to reduce reliance on wood. Use properly seasoned wood, which burns more efficiently and produces less smoke.');

            array_push($recommendations, $recommendation);
        }

        foreach ($recommendations as $recommendation) {
            Solution::create([
                'goal_id' => $goalId,
                'title' => $recommendation['Title'],
                'description' => $recommendation['Description'],
                'category' => $this->type,
                'impact_score' => 0,
            ]);
        }

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
