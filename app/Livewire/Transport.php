<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Car;
use Illuminate\Support\Facades\Auth;

class Transport extends Component
{

    public $responseMessage;
    public $user_id;
    // car variables
    public $mileage;
    public $mileage_metric = 'miles';
    public $fuel_used; // fuel used MPG
    public $fuel_type = 'diesel';
    public $fuel_metric = 'gallons';

    public $test;

    public function mount()
    {
        $user = Auth::user();
        $this->user_id = $user->id;
    }

    public function addCarData()
    {

       # $car_co2e_total = $this->mileage 

       $fuelUsed = $this->mileage / $this->fuel_used;

       $emissionFactors = [
        'petrol' => 8887,  // grams of CO2 per gallon for petrol
        'diesel' => 10180, // grams of CO2 per gallon for diesel
        ];

        if (!array_key_exists($this->fuel_type, $emissionFactors)) {
            return response()->json(['error' => 'Invalid fuel type'], 400);
        };

        // Calculate CO2e emissions
        $co2e = $fuelUsed * $emissionFactors[$this->fuel_type]; // in grams

        // Convert to kilograms
        $co2eInKg = round($co2e / 1000, 2);

        // convert to tonnes
        $co2eInTonnes = round($co2eInKg / 1000, 2);

        $this->test = $co2eInTonnes;

        // add claculations here for total_co2e
        Car::create([
            'user_id' => $this->user_id,
            'mileage' => $this->mileage,
            'mileage_metric' => $this->mileage_metric,
            'fuel_used' => $this->fuel_used,
            'fuel_type' => $this->fuel_type,
            'fuel_metric' => $this->fuel_metric,
            'total_co2e' => $co2eInKg
        ]);
    }

    public function render()
    {
        return view('livewire.transport');
    }
}
