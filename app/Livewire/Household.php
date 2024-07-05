<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Household as HouseholdModel;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On; 

class Household extends Component
{

    public $user_id;
    public $carbonFootrpintHistoryData;
    public $responseMessage = '';
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
            'user_id' => $this->user_id
        ]);

        if ($household) {
            $this->dispatch('entry-added');
            $this->responseMessage = 'Data inserted successfully!';
        } else {
            $this->responseMessage = 'Data could not be inserted.';
        }
    }
}
