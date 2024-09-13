<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Car;
use App\Models\Flights;
use App\Models\BusAndRail;
use Illuminate\Support\Facades\Auth;

class Transport extends Component
{

    public $responseMessage;
    public $user_id;
    // car variables
    public $mileage = 0;
    public $mileage_metric = 'miles';
    public $fuel_used = 0; // fuel used MPG
    public $fuel_type = 'diesel';
    public $fuel_metric = 'gallons';
    // flights variables
    public $distance  = 0;
    public $num_passengers = 0;
    // bus & rail variables
    public $bus_distance = 0;
    public $coach_distance = 0;
    public $train_distance = 0;
    public $tram_distance = 0;
    public $subway_distance = 0;
    public $taxi_distance = 0;

    public function mount()
    {
        $user = Auth::user();
        $this->user_id = $user->id;
    }

    public function addFlightsData()
    {

        if ($this->distance == 0) {
            return;
        }

        $emission_factor = 0.14;
        $total_co2e =  $this->distance * $emission_factor * $this->num_passengers;

        Flights::create([
            'user_id' => $this->user_id,
            'distance' => $this->distance,
            'num_passengers' => $this->num_passengers,
            'total_co2e' => $total_co2e
        ]);
    }

    public function addBusAndRailData()
    {

        if ($this->train_distance == 0 && $this->bus_distance = 0 && $this->coach_distance == 0 && $this->tram_distance = 0 && $this->taxi_distance = 0 && $this->subway_distance) {
            return;
        }

        $train_emission_factor = 41;
        $bus_emission_factor = 100;
        $coach_emission_factor = 70;
        $tram_emission_factor = 50;
        $taxi_emission_factor = 200;
        $subway_emission_factor = 30;

        $train_co2e =  $this->train_distance * $train_emission_factor;
        $bus_co2e =  $this->bus_distance * $bus_emission_factor;
        $coach_co2e =  $this->coach_distance * $coach_emission_factor;
        $tram_co2e =  $this->tram_distance * $tram_emission_factor;
        $taxi_co2e =  $this->taxi_distance * $taxi_emission_factor;
        $subway_co2e =  $this->subway_distance * $subway_emission_factor;

        $total_co2e = ($train_co2e + $bus_co2e + $coach_co2e + $tram_co2e + $taxi_co2e + $subway_co2e) / 1000; // convert grams to kg

        BusAndRail::create([
            'user_id' => $this->user_id,
            'coach_distance' => $this->coach_distance,
            'bus_distance' => $this->bus_distance,
            'train_distance' => $this->train_distance,
            'tram_distance' => $this->tram_distance,
            'subway_distance' => $this->subway_distance,
            'taxi_distance' => $this->taxi_distance,
            'total_co2e' => $total_co2e // in kg
        ]);
    }

    public function addTransportData()
    {

        if ($this->mileage == 0 || $this->fuel_used == 0) { // if no car data to submit
            $this->addFlightsData();
            $this->addBusAndRailData();
            return;
        } 

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

        // add claculations here for total_co2e
        if (Car::create([
            'user_id' => $this->user_id,
            'mileage' => $this->mileage,
            'mileage_metric' => $this->mileage_metric,
            'fuel_used' => $this->fuel_used,
            'fuel_type' => $this->fuel_type,
            'fuel_metric' => $this->fuel_metric,
            'total_co2e' => $co2eInKg
        ])) {
            $this->addFlightsData();
            $this->addBusAndRailData();
        };
    }

    public function render()
    {
        return view('livewire.transport');
    }
}
