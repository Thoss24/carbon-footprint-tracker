<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Secondary as SecondaryModel;
use Illuminate\Support\Facades\Auth;
use App\Services\MyServices;
use App\Models\AchievementMet;
use App\Models\Achievements;
use App\Models\User;

class Secondary extends Component
{

    public $responseMessage;
    public $user_id;
    public $food_and_drink = 0;
    public $pharmaceuticals = 0;
    public $clothing = 0;
    public $it_equipment = 0;
    public $telephone = 0;
    public $insurance = 0;
    public $educational = 0;
    public $carbonFootrpintHistoryData;
    public $achievements;

    public function mount()
    {
        $user = Auth::user();
        $this->user_id = $user->id;

        $service = new MyServices();
        $service->clearFlash();

        $user = Auth::user();
        $this->user_id = $user->id;
        $this->carbonFootrpintHistoryData = SecondaryModel::where('user_id', $this->user_id)->get();
        // check if achievement has been met here
        // get all achievements by type submit_data & household - loop through achievements and check if count($this->carbonFootrpintHistoryData) >= achievement count (count == times added)
        $this->achievements = Achievements::where('carbon_footprint_type', 'secondary')->where('achievement_type', 'submit_data')->get();
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

                    session()->flash('message', 'Achievement met! - Submit Secondary related data 4 times!');

                }
            }
        }
    }

    public function addSecondaryData()
    {

        if ($this->food_and_drink == 0 && $this->pharmaceuticals == 0 && $this->clothing == 0 && $this->it_equipment == 0 && $this->telephone == 0 && $this->insurance == 0 && $this->educational == 0) {
            return;
        };

        $food_and_drink_co2e = $this->food_and_drink * 2.5;
        $pharmaceuticals_co2e = $this->pharmaceuticals * 1.8;
        $clothing_co2e = $this->clothing * 3.0;
        $it_equipment_co2e = $this->it_equipment * 5.0;
        $telephone_co2e = $this->telephone * 1.2;
        $insurance_co2e = $this->insurance * 0.5;
        $educational_co2e = $this->educational * 1.0;

        $total_co2e_in_kg = $food_and_drink_co2e + $pharmaceuticals_co2e + $clothing_co2e + $it_equipment_co2e + $telephone_co2e + $insurance_co2e + $educational_co2e;

        if (SecondaryModel::create([
        'user_id' => $this->user_id,
        'food_and_drink' => $this->food_and_drink,
        'pharmaceuticals' => $this->pharmaceuticals,
        'clothing' => $this->clothing,
        'it_equipment' => $this->it_equipment,
        'telephone' => $this->telephone,
        'insurance' => $this->insurance,
        'educational' => $this->educational,
        'total_co2e' => $total_co2e_in_kg
        ])) {
            $this->dispatch('entry-added');
            $this->responseMessage = 'Data inserted successfully!';
        } else {
            $this->responseMessage = 'Data could not be inserted.';
        };
    }

    public function render()
    {
        return view('livewire.secondary');
    }
}
