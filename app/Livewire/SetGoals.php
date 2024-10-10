<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Goal;
use Illuminate\Support\Facades\Auth;
use App\Models\Household;
use App\Models\Car;
use App\Models\Flights;
use App\Models\BusAndRail;
use App\Models\Secondary;
use App\Models\Solution;
use App\Models\Achievements;
use App\Models\AchievementMet;
use App\Models\User;
use App\Services\MyServices;

class SetGoals extends Component
{
    public $user_id = 0;
    public $target_date = "1999/12/12"; // yyyy/mm/dd
    public $improve_percentage_goal;
    public $original_entry_id = 0; // id of entry to compare to 
    public $previous_co2e = 0; // co2e of entry to compare to
    public $type = 'household'; // default value is household
    public $previous_entries; // previous carbon footprint entries by type
    public $active_goals; // all active goals
    public $past_goals; // achieved or not achieved goals
    public $achievements;
    public $goals_not_met; // goals not met#
    public $responseMessage;

    public function mount()
    {
        $service = new MyServices();
        $service->clearFlash();
        $user = Auth::user();
        $this->user_id = $user->id;
        $this->previous_entries = Household::where('user_id', $this->user_id)->get();
        $this->active_goals = Goal::where('user_id', $this->user_id)->where('type', $this->type)->where('goal_seen', 0)->get();
        $this->checkGoalMet();
        $this->past_goals = Goal::where('user_id', $this->user_id)->where('type', $this->type)->where('goal_seen', 1)->get();
    }

    public function setGoal()
    {

        if ($this->previous_co2e == 0) {
            return;
        }

        if (Goal::create([
            'user_id' => $this->user_id,
            'target_date' => $this->target_date,
            'improve_percentage_goal' => $this->improve_percentage_goal,
            'previous_co2e' => $this->previous_co2e,
            'type' => $this->type,
            'original_entry_id' => $this-> original_entry_id,
            'co2e_time_of_goal_met' => 0
        ])) {
            $this->dispatch('entry-added');
            $this->responseMessage = 'Data inserted successfully!';
        } else {
            $this->responseMessage = 'Data could not be inserted.';
        };
       
    }

    public function selectPrevCo2e($co2e, $prev_id)
    {   
        $this->previous_co2e = $co2e;
        $this->original_entry_id = $prev_id;
    }

    public function getPreviousEntryData() // invoked when user changes co2e type
    {
        switch($this->type){
            case 'household':
                $this->mount();
                $this->previous_entries = Household::where('user_id', $this->user_id)->get();
                $this->active_goals = Goal::where('user_id', $this->user_id)->where('type', $this->type)->where('goal_seen', 0)->get();
                break;
            case 'car':
                $this->mount();
                $this->previous_entries = Car::where('user_id', $this->user_id)->get();
                $this->active_goals = Goal::where('user_id', $this->user_id)->where('type', $this->type)->where('goal_seen', 0)->get();
                break;
            case 'flights':
                $this->mount();
                $this->previous_entries = Flights::where('user_id', $this->user_id)->get();
                $this->active_goals = Goal::where('user_id', $this->user_id)->where('type', $this->type)->where('goal_seen', 0)->get();
                break;
            case 'bus & rail':
                $this->mount();
                $this->previous_entries = BusAndRail::where('user_id', $this->user_id)->get();
                $this->active_goals = Goal::where('user_id', $this->user_id)->where('type', $this->type)->where('goal_seen', 0)->get();
                break;
            case 'secondary':
                $this->mount();
                $this->previous_entries = Secondary::where('user_id', $this->user_id)->get();
                $this->active_goals = Goal::where('user_id', $this->user_id)->where('type', $this->type)->where('goal_seen', 0)->get();
                break;
        }
    }

    public function checkGoalMet()
    {

        $current_date = date('Y-m-d');
        $most_recently_submitted_data = [];
        
        switch($this->type){
            case 'household':
                // calculate time betwwen last entry and todays date
                $most_recently_submitted_data = Household::latest()->first();
                $this->achievements = Achievements::where('carbon_footprint_type', 'household')->where('achievement_type', 'goals')->get();
                break;
            case 'car':
                $most_recently_submitted_data = Car::latest()->first(); // change when new types are added
                $this->achievements = Achievements::where('carbon_footprint_type', 'car')->where('achievement_type', 'goals')->get();
                break;
            case 'flights':
                $most_recently_submitted_data = Flights::latest()->first(); // change when new types are added
                $this->achievements = Achievements::where('carbon_footprint_type', 'flights')->where('achievement_type', 'goals')->get();
                break;
            case 'bus & rail':
                $most_recently_submitted_data = BusAndRail::latest()->first(); // change when new types are added
                $this->achievements = Achievements::where('carbon_footprint_type', 'bus&rail')->where('achievement_type', 'goals')->get();
                break;
            case 'secondary':
                $most_recently_submitted_data = Secondary::latest()->first(); // change when new types are added
                $this->achievements = Achievements::where('carbon_footprint_type', 'secondary')->where('achievement_type', 'goals')->get();
                break;
        }

        $active_goals = Goal::where('user_id', $this->user_id)->where('type', $this->type)->where('goal_seen', 0)->get();

        $most_recent_entry_date = explode(' ', $most_recently_submitted_data->created_at)[0];

        $diff_in_seconds = strtotime($most_recent_entry_date) - strtotime($current_date);

        $weeks = trim(floor($diff_in_seconds / (7 * 24 * 60 * 60)), '-');

        $this->checkAchievementsMet();

        foreach ($active_goals as $goal) {
            if ($current_date >= $goal->target_date) {
                $goal = Goal::find($goal->id);
                // do claculation to check if % goal was reached
                // compare most recently submitted household data with target co2e using the target %
                $co2e_to_compare_against = $goal->previous_co2e;
                $difference = $most_recently_submitted_data->total_co2e - $co2e_to_compare_against;

                #$percentage_diff = ($difference / $co2e_to_compare_against) * 100;

                if ($co2e_to_compare_against == 0) {
                    $percentage_diff = ($difference == 0) ? 0 : 'Undefined'; // or any appropriate value/error message
                } else {
                    $percentage_diff = ($difference / $co2e_to_compare_against) * 100;
                }


                if ($percentage_diff > $goal->improve_percentage_goal) { // goal not met    
                    $goal->goal_met = 0;
                    $goal->goal_seen = 1;
                    $goal->save();
                    $this->provideSolutions($most_recently_submitted_data->id, $goal->id, $weeks);
                } else { // goal met
                    $goal->goal_met = 1;
                    $goal->goal_seen = 1;
                    $goal->co2e_time_of_goal_met = $most_recently_submitted_data->total_co2e;
                    $goal->save();
                    $this->checkAchievementsMet();
                }
            }
        }

        $this->active_goals = Goal::where('user_id', $this->user_id)->where('type', $this->type)->where('goal_seen', 0)->get();

        // get current day and compare most recently submitted entry against target date & data - if they are the same, check if percentage goal was reached
        // award point if true - otherwise return data telling user goal was not met
    }

    public function checkAchievementsMet() 
    {
        $this->goals_not_met = Goal::where('user_id', $this->user_id)->where('type', $this->type)->where('goal_met', 0  )->get();

        foreach ($this->achievements as $achievement) {
            if (count($this->goals_not_met) >= $achievement->count_requirement) {
                $achievement_already_met = AchievementMet::where('user_id', $this->user_id)->where('achievement_id', $achievement->id)->get();
                if (count($achievement_already_met) == 0) {

                    AchievementMet::create([
                        'user_id' => $this->user_id,
                        'achievement_id' => $achievement->id
                    ]);

                    $user_request = User::find($this->user_id);

                    $user_request->points += $achievement->points;

                    $user_request->save();

                    session()->flash('message', 'Achievement met! - You have met your ' . $this->type . ' related goal ' . $achievement->count_requirement .  ' times!');

                }
            }
        }
    }

    public function provideHouseholdSolutions($entryId, $goalId, $weeks)
    {

        $recommendations = [];

        $householdToAnalyse = Household::find($entryId);
        $householdSize = $householdToAnalyse->num_people_in_household;
        $householdElectricity = $householdToAnalyse->electricity;
        $householdNaturalGas = $householdToAnalyse->natural_gas;
        $householdHeatingOil = $householdToAnalyse->heating_oil;
        $householdCoal = $householdToAnalyse->coal;
        $householdLpg = $householdToAnalyse->lpg;
        $householdPropane = $householdToAnalyse->propane;
        $householdWood = $householdToAnalyse->wood;
        
        if (($householdElectricity / $householdSize) > 500 * $weeks) {

            $recommendation = array('Title'=>'Solution to reduce Electricity consumption', 'Description'=>'Choose appliances with a high energy rating, such as A+++, when shopping for new appliances. Take quick showers, turn off running taps when unused, and use the required amount of water while cooking. ');

            array_push($recommendations, $recommendation);
        }
        if (($householdNaturalGas / $householdSize) > 300 * $weeks) {

            $recommendation = array('Title'=>'Solution to reduce Natural Gas consumption', 'Description'=>'Turn down the temperature on your radiator or boiler when you`re not using a room. Choose appliances that are designed to use less energy and gas. ');

            array_push($recommendations, $recommendation);
        }
        if (($householdHeatingOil / $householdSize) > 30 * $weeks) {

            $recommendation = array('Title'=>'Solution to reduce Heating Oil consumption', 'Description'=>'Insulation helps maintain your home`s temperature and reduce fuel usage. Lower the temperature on your thermostat, even by one degree.');

            array_push($recommendations, $recommendation);
        }
        if (($householdCoal / $householdSize) > 20 * $weeks) {

            $recommendation = array('Title'=>'Solution to reduce Coal consumption', 'Description'=>'Upgrade insulation in walls, roofs, and floors to minimize heat loss. Proper insulation helps maintain indoor temperatures, reducing the need for heating. Identify and seal drafts around windows, doors, and other openings to prevent heat loss. If available, transitioning to natural gas heating can be a cleaner alternative to coal.');

            array_push($recommendations, $recommendation);
        }
        if (($householdLpg / $householdSize) > 30 * $weeks) {

            $recommendation = array('Title'=>'Solution to reduce LPG consumption', 'Description'=>'Invest in energy-efficient gas stoves or induction cooktops, which can use gas more efficiently. If you use LPG for heating, consider lowering the thermostat a few degrees. Use microwaves or slow cookers for meals that don’t require a stove, as they can be more efficient.');

            array_push($recommendations, $recommendation);
        }
        if (($householdPropane / $householdSize) > 20 * $weeks) {

            $recommendation = array('Title'=>'Solution to reduce Propane consumption', 'Description'=>' Set your thermostat a few degrees lower in winter. Each degree can reduce usage significantly. Set heating schedules to lower temperatures when you’re not home. Insulate attics, walls, and floors to minimize heat loss. Invest in high-efficiency propane appliances, such as furnaces, water heaters, and stoves, which use less fuel.');

            array_push($recommendations, $recommendation);
        }
        if (($householdWood / $householdSize) > 40 * $weeks) {

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

    public function provideCarSolutions($entryId, $goalId, $weeks)
    {
        $recommendations = [];

        $carToAnalyse = Car::find($entryId);
        $carMileage = $carToAnalyse->mileage;
        $carFuelType = $carToAnalyse->fuel_type;
        
        if (($carMileage) > 400 * $weeks && $carFuelType == 'diesel') {

            $recommendation = array('Title'=>'Solution to reduce car mileage', 'Description'=>'Transitioning to hybrid or electric cars can significantly reduce emissions, electric vehicles (EVs) produce zero tailpipe emissions and can be charged using renewable energy sources. Utilizing ride-sharing apps can help consolidate trips, reducing the total distance driven per person. For short distances, biking or walking not only eliminates emissions but also promotes physical health.');

            array_push($recommendations, $recommendation);
        }
        else if (($carMileage ) > 400 * $weeks) {

            $recommendation = array('Title'=>'Solution to reduce car mileage', 'Description'=>'Transitioning to hybrid or electric cars can significantly reduce emissions, electric vehicles (EVs) produce zero tailpipe emissions and can be charged using renewable energy sources. Utilizing ride-sharing apps can help consolidate trips, reducing the total distance driven per person. For short distances, biking or walking not only eliminates emissions but also promotes physical health.');

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

    public function provideFlightsSolutions($entryId, $goalId, $weeks)
    {
        $recommendations = [];

        $flightsToAnalyse = Flights::find($entryId);
        $flightsDistance = $flightsToAnalyse->distance;
        $flightPassengers = $flightsToAnalyse->num_passengers;
        
        if (($flightsDistance  / $flightPassengers) > 1500 * $weeks) {

            $recommendation = array('Title'=>'Solution to reduce flight co2e', 'Description'=>'Some airlines have more fuel-efficient fleets and better sustainability practices. Look for those with newer aircraft or carbon offset programs. Consider alternatives such as trains, buses, or cars for shorter distances, lighter luggage means less fuel consumption, try to pack minimally. Economy class seats have a lower carbon footprint per passenger compared to business or first class, which take up more space.');

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

    public function provideBusAndRailSolutions($entryId, $goalId, $weeks)
    {
        $recommendations = [];

        $busAndRailToAnalyse = BusAndRail::find($entryId);
        $busDistance = $busAndRailToAnalyse->bus_distance;
        $coachDistance = $busAndRailToAnalyse->coach_distance;
        $trainDistance = $busAndRailToAnalyse->train_distance;
        $tramDistance = $busAndRailToAnalyse->tram_distance;
        $subwayDistance = $busAndRailToAnalyse->subway_distance;
        $taxiDistance = $busAndRailToAnalyse->taxi_distance;
        
        if (($busDistance) > 100 * $weeks) {

            $recommendation = array('Title'=>'Solution to reduce flight co2e', 'Description'=>'Use route planning apps to find the most efficient routes, avoiding unnecessary transfers or longer travel times.
            Consider biking for shorter distances. It’s eco-friendly and can be faster than waiting for a bus.
            If using the bus frequently, consider purchasing a monthly or quarterly pass, which can be more economical than paying per trip.
            ');

            array_push($recommendations, $recommendation);
        }
        if (($coachDistance) > 100 * $weeks) {

            $recommendation = array('Title'=>'Solution to reduce coach co2e', 'Description'=>'Use route planning apps to find the most efficient routes, avoiding unnecessary transfers or longer travel times.
            Consider biking for shorter distances. It’s eco-friendly and can be faster than waiting for a bus.
            If using the bus frequently, consider purchasing a monthly or quarterly pass, which can be more economical than paying per trip.');

            array_push($recommendations, $recommendation);
        }
        if (($trainDistance) > 100 * $weeks) {

            $recommendation = array('Title'=>'Solution to reduce train co2e', 'Description'=>'Look for options like monthly or annual rail passes that offer unlimited travel or discounts for frequent riders.
            Use train schedule apps to monitor real-time departures, track trains, and book tickets efficiently.
            Schedule multiple appointments or activities in one trip to reduce the number of journeys.
            If the destination is close, walking is a healthy alternative.
            ');

            array_push($recommendations, $recommendation);
        }
        if (($tramDistance) > 100 * $weeks) {

            $recommendation = array('Title'=>'Solution to reduce tram co2e', 'Description'=>'Use apps or maps to find the most direct tram routes and avoid unnecessary transfers.
            For shorter distances, consider biking instead of taking the tram.
            Schedule multiple errands or activities in one trip to minimize the number of tram rides.
            ');

            array_push($recommendations, $recommendation);
        }
        if (($subwayDistance) > 100 * $weeks) {

            $recommendation = array('Title'=>'Solution to reduce subway co2e', 'Description'=>'Schedule multiple errands or activities in one trip to minimize the number of tram rides.
            For shorter distances, consider biking instead of taking the tram.
            Use apps or maps to find the most direct tram routes and avoid unnecessary transfers.

            ');

            array_push($recommendations, $recommendation);
        }
        if (($taxiDistance) > 100 * $weeks) {

            $recommendation = array('Title'=>'Solution to reduce taxi co2e', 'Description'=>'Use navigation apps to find the quickest routes and avoid traffic congestion, some apps offer route optimization features.
            Schedule multiple errands or appointments in one taxi ride to minimize the number of trips.
            For short trips, consider biking or using e-scooters, which can be more economical and environmentally friendly.
            ');

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

    public function provideSecondarySolutions($entryId, $goalId, $weeks)
    {
        $recommendations = [];

        $secondaryToAnalyse = Secondary::find($entryId);
        $secondaryFoodAndDrink = $secondaryToAnalyse->food_and_drink;
        $secondaryPharmaceuticals = $secondaryToAnalyse->food_and_drink;
        $secondaryClothing = $secondaryToAnalyse->food_and_drink;
        $secondaryItEquipment = $secondaryToAnalyse->food_and_drink;
        $secondaryTelephone = $secondaryToAnalyse->food_and_drink;
        $secondaryInsurance = $secondaryToAnalyse->food_and_drink;
        $secondaryEducational = $secondaryToAnalyse->food_and_drink;

        if (($secondaryFoodAndDrink) > 100 * $weeks) {

            $recommendation = array('Title'=>'Solution to reduce food and drink consumption', 'Description'=>'Create a weekly meal plan to avoid impulse purchases and ensure you buy only what you need.
            Determine a realistic budget for food and drink each week and stick to it.
            Cooking at home is often cheaper than eating out, try making larger batches and freezing portions for later.
            Stick to a list to avoid buying unnecessary items.
            ');

            array_push($recommendations, $recommendation);
        }
        if (($secondaryPharmaceuticals) > 200 * $weeks) {

            $recommendation = array('Title'=>'Solution to reduce pharmaceuticals consumption', 'Description'=>'Regularly review your medications with your healthcare provider to assess if all are necessary or if alternatives exist.
            Discuss the possibility of adjusting dosages or switching to lower-cost alternatives, such as generics.
            Many pharmacies offer discount programs or cards that can significantly reduce the cost of medications.
            Explore resources from nonprofit organizations that provide financial assistance for specific medications.
            ');

            array_push($recommendations, $recommendation);
        }
        if (($secondaryClothing) > 200 * $weeks) {

            $recommendation = array('Title'=>'Solution to reduce clothing consumption', 'Description'=>'Go through your existing clothing to identify items you no longer wear. This can help you understand what you truly need.
            Focus on versatile, timeless pieces that can be mixed and matched to create various outfits.
            Establish a monthly limit for clothing spending to help you stay within your financial means.
            Before shopping, create a list of specific items you need to avoid impulse buys.
            ');

            array_push($recommendations, $recommendation);
        }
        if (($secondaryItEquipment) > 500 * $weeks) {

            $recommendation = array('Title'=>'Solution to reduce IT equipment consumption', 'Description'=>'Determine what equipment is essential for your work or personal use, avoid purchasing unnecessary upgrades or features.
            Make a list of the most critical items you need and focus on acquiring those first.
            Establish a monthly or yearly budget specifically for IT equipment to help control spending.
            Consider purchasing certified refurbished items, which can be significantly cheaper than new products but still come with warranties.
            ');

            array_push($recommendations, $recommendation);
        }
        if (($secondaryTelephone) > 100 * $weeks) {

            $recommendation = array('Title'=>'Solution to reduce telecommunication consumption', 'Description'=>'Evaluate your usage patterns for data, calls, and texts to determine if your current plan meets your needs or if you’re overpaying.
            Research different plans available from various providers to find one that better fits your usage and budget.
            Consider bundling your phone, internet, and television services with one provider, which can often lead to discounts.
            If applicable, look into family or shared plans that allow multiple users to share data and costs.
            ');

            array_push($recommendations, $recommendation);
        }
        if (($secondaryInsurance) > 150 * $weeks) {

            $recommendation = array('Title'=>'Solution to reduce insurance consumption', 'Description'=>'Regularly review your insurance policies (auto, home, health, etc.) to ensure you have the appropriate coverage without unnecessary extras.
            Ensure you’re not paying for overlapping coverage across different policies.
            Obtain quotes from multiple insurers for the same coverage to find the best rates.
            Utilize online tools to compare insurance rates and coverage options from various providers.
            ');

            array_push($recommendations, $recommendation);
        }
        if (($secondaryEducational) > 400 * $weeks) {

            $recommendation = array('Title'=>'Solution to reduce education consumption', 'Description'=>'Determine what educational services or materials are essential and eliminate unnecessary expenses.
            Identify the most critical areas of spending (tuition, textbooks, supplies) and focus on those.
            Explore available scholarships, grants, and financial aid programs that can significantly reduce costs.
            Investigate work-study opportunities that allow you to earn money while attending school.
            ');

            array_push($recommendations, $recommendation);
        }
    }

    public function provideSolutions($lastEntryId, $goalId, $weeks)
    {
        switch($this->type){
            case 'household':
                $this->provideHouseholdSolutions($lastEntryId, $goalId, $weeks);
                break;
            case 'car':
                $this->provideCarSolutions($lastEntryId, $goalId, $weeks);
                break;
            case 'flights':
                $this->provideFlightsSolutions($lastEntryId, $goalId, $weeks);
                break;
            case 'bus & rail':
                $this->provideBusAndRailSolutions($lastEntryId, $goalId, $weeks);
                break;
            case 'secondary':
                $this->provideSecondarySolutions($lastEntryId, $goalId, $weeks);
                break;
        }
    }

    public function render()
    {
        return view('livewire.set-goals');
    }
}
