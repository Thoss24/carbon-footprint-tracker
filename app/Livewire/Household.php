<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Household as HouseholdModel;
use Illuminate\Support\Facades\Auth;

class Household extends Component
{

    public $user_id;
    public $electricity = 0;
    public $electricity_metric = 'kWh'; // default value
    public $natural_gas = 0;
    public $natural_gas_metric = 'kWh'; // default value
    public $heating_oil = 0;
    public $heating_oil_metric = 'kWh'; // default value
    public $coal = 0;
    public $coal_metric = 'kg'; // default value
    public $lpg = 0;
    public $lpg_metric = 'lpg'; // default value
    public $propane = 0;
    public $propane_metric = 'litres'; // default value
    public $wood = 0;
    public $wood_metric = 'kg'; // default value

    public function render()
    {
        return view('livewire.household');
    }

    public function mount() 
    {
        $user = Auth::user();
        $this->user_id = $user->id;
    }

    public function submitCarbonFootrpintData() 
    {

        HouseholdModel::create([
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
            'user_id' => $this->user_id
        ]);
    }
}
