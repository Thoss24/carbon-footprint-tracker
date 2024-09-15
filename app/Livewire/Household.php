<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Household as HouseholdModel;
use App\Models\Achievements;
use App\Models\User;
use App\Models\AchievementMet;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On; 

class Household extends Component
{

    public $user_id;
    public $carbonFootrpintHistoryData;
    public $responseMessage = '';
    public $num_people_in_household = 1;

    //achievements variables
    public $achievements;
    public $test;

    // carbon footrpint data properties
    public $electricity = 0;
    public $electricity_metric = 'kWh';
    public $natural_gas = 0;
    public $natural_gas_metric = 'kWh';
    public $heating_oil = 0;
    public $heating_oil_metric = 'kWh';
    public $coal = 0;
    public $coal_metric = 'kg';
    public $lpg = 0;
    public $lpg_metric = 'lpg';
    public $propane = 0;
    public $propane_metric = 'litres';
    public $wood = 0;
    public $wood_metric = 'kg';

    // emission factors according to the UK Government's Department for Business, Energy & Industrial Strategy (BEIS)
    public $electricity_factor = 0.2;
    public $natural_gas_factor = 0.2;
    public $heating_oil_factor = 2.53;
    public $coal_factor = 0.3;
    public $lpg_factor = 0.2;
    public $propane_factor = 0.2;
    public $wood_factor = 0.1;

    public function render()
    {
        return view('livewire.household');
    }

    #[On('entry-deleted')]
    #[On('entry-added')]
    public function mount() 
    {
        $user = Auth::user();
        $this->user_id = $user->id;
        $this->carbonFootrpintHistoryData = HouseholdModel::where('user_id', $this->user_id)->get();
        // check if achievement has been met here
        // get all achievements by type submit_data & household - loop through achievements and check if count($this->carbonFootrpintHistoryData) >= achievement count (count == times added)
        $this->achievements = Achievements::where('carbon_footprint_type', 'household')->where('achievement_type', 'submit_data')->get();
        foreach ($this->achievements as $achievement) {
            if (count($this->carbonFootrpintHistoryData) >= $achievement->count_requirement) {
                $achievement_already_met = AchievementMet::where('user_id', $this->user_id)->where('achievement_id', $achievement->id)->get();
                if (count($achievement_already_met) == 0) {

                    AchievementMet::create([
                        'user_id' => $this->user_id,
                        'achievement_id' => $achievement->id
                    ]);

                    $user_request = User::find($this->user_id);

                    $user_request->points += $achievement->points;

                    $user_request->save();

                    session()->flash('message', 'Achievement met!.');
                    //$this->test = "Achievement met!";
                }
            }
        }
    }

    public function deleteEntry($id)
    {
        // delete row where row['user_id'] == Auth()user_id
        HouseholdModel::where('id', $id)->delete();
        $this->dispatch('entry-deleted', id: $id);
        $this->responseMessage = '';
    }

    public function submitCarbonFootrpintData() 
    {

        $electricity_co2e_per_member = ($this->electricity / $this->num_people_in_household) * $this->electricity_factor / 1000;  # tonnes
        $natural_gas_co2e_per_member = ($this->natural_gas / $this->num_people_in_household) * $this->natural_gas_factor / 1000;  # tonnes
        $heating_oil_co2e_per_member = ($this->heating_oil / $this->num_people_in_household) * $this->heating_oil_factor / 1000;  # tonnes
        $coal_co2e_per_member = ($this->coal / $this->num_people_in_household) * $this->coal_factor / 1000;  # tonnes
        $lpg_co2e_per_member = ($this->lpg / $this->num_people_in_household) * $this->lpg_factor / 1000;  # tonnes
        $propane_co2e_per_member = ($this->propane / $this->num_people_in_household) * $this->propane_factor / 1000;  # tonnes
        $wood_co2e_per_member = ($this->wood / $this->num_people_in_household) * $this->wood_factor / 1000;  # tonnes

        $total_co2e_per_member = $electricity_co2e_per_member + $natural_gas_co2e_per_member + $heating_oil_co2e_per_member + $coal_co2e_per_member +
        $lpg_co2e_per_member + $propane_co2e_per_member + $wood_co2e_per_member;

        $total_household_co2e = $total_co2e_per_member * $this->num_people_in_household;

        $household = HouseholdModel::create([
            'electricity' => $this->electricity,
            'electricity metric' => $this->electricity_metric,
            'natural_gas' => $this->natural_gas,
            'natural gas metric' => $this->natural_gas_metric,
            'heating_oil' => $this->heating_oil,
            'heating oil metric' => $this->heating_oil_metric,
            'coal' => $this->coal,
            'coal metric' => $this->coal_metric,
            'lpg' => $this->lpg,
            'lpg metric' => $this->lpg_metric,
            'propane' => $this->propane,
            'propane metric' => $this->propane_metric,
            'wood' => $this->wood,
            'wood metric' => $this->wood_metric,
            'user_id' => $this->user_id,
            'num_people_in_household' => $this->num_people_in_household,
            'total_co2e' => $total_household_co2e
        ]);

        if ($household) {
            $this->dispatch('entry-added');
            $this->responseMessage = 'Data inserted successfully!';
        } else {
            $this->responseMessage = 'Data could not be inserted.';
        }
    }
}
