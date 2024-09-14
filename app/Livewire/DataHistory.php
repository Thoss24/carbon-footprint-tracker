<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Household;
use App\Models\Car;
use App\Models\Flights;
use App\Models\BusAndRail;
use App\Models\Secondary;

class DataHistory extends Component
{

    public $data_type;
    public $data_history;
    public $compare_to_entries = [];
    public $compare_entry;
    public $compare_to_entry;
    public $comparison_entries = [];

    public function mount()
    {
        $url_arr = explode("/", url()->current()); 
        $this->data_type = end($url_arr);
        // get all data for a certain data type
        $this->switchType();
    }

    public function selectDataType()
    {
        unset($this->compare_entry);
        unset($this->compare_to_entry);
        $this->compare_to_entries = [];
        $this->switchType();
    }

    public function switchType()
    {

        $this->clearComparison();

        switch($this->data_type){
            case 'household':
                $this->data_history = Household::all();
                break;
            case 'car':
                $this->data_history = Car::all();
                break;
            case 'flights':
                $this->data_history = Flights::all();
                break;
            case 'bus&rail':
                $this->data_history = BusAndRail::all();
                break;
            case 'secondary':
                $this->data_history = Secondary::all();
                break;
        }
    }

    public function compare($entryId)
    {
        if ($this->compare_entry) return;

        switch($this->data_type){
            case 'household':
                $this->compare_entry = Household::find($entryId);
                $this->compare_to_entries = Household::where('id', '!=', $entryId)->get();
                break;
            case 'car':
                $this->compare_entry = Car::find($entryId);
                $this->compare_to_entries = Car::where('id', '!=', $entryId)->get();
                break;
            case 'flights':
                $this->compare_entry = Flights::find($entryId);
                $this->compare_to_entries = Flights::where('id', '!=', $entryId)->get();
                break;
            case 'bus&rail':
                $this->compare_entry = BusAndRail::find($entryId);
                $this->compare_to_entries = BusAndRail::where('id', '!=', $entryId)->get();
                break;
            case 'secondary':
                $this->compare_entry = Secondary::find($entryId);
                $this->compare_to_entries = Secondary::where('id', '!=', $entryId)->get();
                break;
        }
        // select entry from filtered list 
        // render list of comparison entries 
        // show diff between the two
    }

    public function calculateHouseholdDiff()
    {   
        // electricity
        $electricity_absolute_diff = $this->compare_entry->electricity - $this->compare_to_entry->electricity;
        $electricity_average = ($this->compare_entry->electricity + $this->compare_to_entry->electricity) / 2;
        $this->compare_entry->electricity_diff = round(($electricity_absolute_diff / $electricity_average) * 100, 2) . '%';

        // natural gas
        $natural_gas_absolute_diff = $this->compare_entry->natural_gas - $this->compare_to_entry->natural_gas;
        $natural_gas_average = ($this->compare_entry->natural_gas + $this->compare_to_entry->natural_gas) / 2;
        $this->compare_entry->natural_gas_diff = round(($natural_gas_absolute_diff / $natural_gas_average) * 100, 2) . '%';

        // heating oil
        $heating_oil_absolute_diff = $this->compare_entry->heating_oil - $this->compare_to_entry->heating_oil;
        $heating_oil_average = ($this->compare_entry->heating_oil + $this->compare_to_entry->heating_oil) / 2;
        $this->compare_entry->heating_oil_diff = round(($heating_oil_absolute_diff / $heating_oil_average) * 100, 2) . '%';

        // coal
        $coal_absolute_diff = $this->compare_entry->coal - $this->compare_to_entry->coal;
        $coal_average = ($this->compare_entry->coal + $this->compare_to_entry->coal) / 2;
        $this->compare_entry->coal_diff = round(($coal_absolute_diff / $coal_average) * 100, 2) . '%';

        // lpg
        $lpg_absolute_diff = $this->compare_entry->lpg - $this->compare_to_entry->lpg;
        $lpg_average = ($this->compare_entry->lpg + $this->compare_to_entry->lpg) / 2;
        $this->compare_entry->lpg_diff = round(($lpg_absolute_diff / $lpg_average) * 100, 2) . '%';

        // propane
        $propane_absolute_diff = $this->compare_entry->propane - $this->compare_to_entry->propane;
        $propane_average = ($this->compare_entry->propane + $this->compare_to_entry->propane) / 2;
        $this->compare_entry->propane_diff = round(($propane_absolute_diff / $propane_average) * 100, 2) . '%';

        // wood
        $wood_absolute_diff = $this->compare_entry->wood - $this->compare_to_entry->wood;
        $wood_average = ($this->compare_entry->wood + $this->compare_to_entry->wood) / 2;
        $this->compare_entry->wood_diff = round(($wood_absolute_diff / $wood_average) * 100, 2) . '%';

        // co2e
        $co2e_absolute_diff = $this->compare_entry->total_co2e - $this->compare_to_entry->total_co2e;
        $co2e_average = ($this->compare_entry->total_co2e + $this->compare_to_entry->total_co2e) / 2;
        $this->compare_entry->co2e_diff = round(($co2e_absolute_diff / $co2e_average) * 100, 2) . '%';

        array_push($this->comparison_entries,  $this->compare_entry);
    }

    public function calculateCarDiff()
    {   
        // mileage
        $mileage_absolute_diff = $this->compare_entry->mileage - $this->compare_to_entry->mileage;
        $mileage_average = ($this->compare_entry->mileage + $this->compare_to_entry->mileage) / 2;
        $this->compare_entry->mileage_diff = round(($mileage_absolute_diff / $mileage_average) * 100, 2) . '%';

        // fuel used
        $fuel_used_absolute_diff = $this->compare_entry->fuel_used - $this->compare_to_entry->fuel_used;
        $fuel_used_average = ($this->compare_entry->fuel_used + $this->compare_to_entry->fuel_used) / 2;
        $this->compare_entry->fuel_used_diff = round(($fuel_used_absolute_diff / $fuel_used_average) * 100, 2) . '%';

        // total co2e used
        $total_co2e_absolute_diff = $this->compare_entry->total_co2e - $this->compare_to_entry->total_co2e;
        $total_co2e_average = ($this->compare_entry->total_co2e + $this->compare_to_entry->total_co2e) / 2;
        $this->compare_entry->total_co2e_diff = round(($total_co2e_absolute_diff / $total_co2e_average) * 100, 2) . '%';

        array_push($this->comparison_entries,  $this->compare_entry);
    }

    public function calculateFlightsDiff()
    {   
        // distance
        $distance_absolute_diff = $this->compare_entry->distance - $this->compare_to_entry->distance;
        $distance_average = ($this->compare_entry->distance + $this->compare_to_entry->distance) / 2;
        $this->compare_entry->distance_diff = round(($distance_absolute_diff / $distance_average) * 100, 2) . '%';

        // total co2e used
        $total_co2e_absolute_diff = $this->compare_entry->total_co2e - $this->compare_to_entry->total_co2e;
        $total_co2e_average = ($this->compare_entry->total_co2e + $this->compare_to_entry->total_co2e) / 2;
        $this->compare_entry->total_co2e_diff = round(($total_co2e_absolute_diff / $total_co2e_average) * 100, 2) . '%';

        array_push($this->comparison_entries,  $this->compare_entry);
    }

    public function calculateSecondaryDiff()
    {   
        // food and drink
        if ($this->compare_to_entry->food_and_drink != 0) {
            $food_and_drink_absolute_diff = $this->compare_entry->food_and_drink - $this->compare_to_entry->food_and_drink;
            $food_and_drink_average = ($this->compare_entry->food_and_drink + $this->compare_to_entry->food_and_drink) / 2;
            $this->compare_entry->food_and_drink_diff = round(($food_and_drink_absolute_diff / $food_and_drink_average) * 100, 2) . '%';
        }
        
        // pharmaceuticals
        if ($this->compare_to_entry->pharmaceuticals != 0) {
            $pharmaceuticals_absolute_diff = $this->compare_entry->pharmaceuticals - $this->compare_to_entry->pharmaceuticals;
            $pharmaceuticals_average = ($this->compare_entry->pharmaceuticals + $this->compare_to_entry->pharmaceuticals) / 2;
            $this->compare_entry->pharmaceuticals_diff = round(($pharmaceuticals_absolute_diff / $pharmaceuticals_average) * 100, 2) . '%';
        }

        // clothing
        if ($this->compare_to_entry->clothing != 0) {
            $clothing_absolute_diff = $this->compare_entry->clothing - $this->compare_to_entry->clothing;
            $clothing_average = ($this->compare_entry->clothing + $this->compare_to_entry->clothing) / 2;
            $this->compare_entry->clothing_diff = round(($clothing_absolute_diff / $clothing_average) * 100, 2) . '%';
        }

        // it_equipment
        if ($this->compare_to_entry->it_equipment != 0) {
            $it_equipment_absolute_diff = $this->compare_entry->it_equipment - $this->compare_to_entry->it_equipment;
            $it_equipment_average = ($this->compare_entry->it_equipment + $this->compare_to_entry->it_equipment) / 2;
            $this->compare_entry->it_equipment_diff = round(($it_equipment_absolute_diff / $it_equipment_average) * 100, 2) . '%';
        }

        // telephone
        if ($this->compare_to_entry->telephone != 0) {
            $telephone_absolute_diff = $this->compare_entry->telephone - $this->compare_to_entry->telephone;
            $telephone_average = ($this->compare_entry->telephone + $this->compare_to_entry->telephone) / 2;
            $this->compare_entry->telephone_diff = round(($telephone_absolute_diff / $telephone_average) * 100, 2) . '%';
        }

        // insurance
        if ($this->compare_to_entry->insurance != 0) {
            $insurance_absolute_diff = $this->compare_entry->insurance - $this->compare_to_entry->insurance;
            $insurance_average = ($this->compare_entry->insurance + $this->compare_to_entry->insurance) / 2;
            $this->compare_entry->insurance_diff = round(($insurance_absolute_diff / $insurance_average) * 100, 2) . '%';
        }

        // educational
        if ($this->compare_to_entry->educational != 0) {
            $educational_absolute_diff = $this->compare_entry->educational - $this->compare_to_entry->educational;
            $educational_average = ($this->compare_entry->educational + $this->compare_to_entry->educational) / 2;
            $this->compare_entry->educational_diff = round(($educational_absolute_diff / $educational_average) * 100, 2) . '%';
        }

        // total co2e used
        if ($this->compare_to_entry->total_co2e != 0) {
            $total_co2e_absolute_diff = $this->compare_entry->total_co2e - $this->compare_to_entry->total_co2e;
            $total_co2e_average = ($this->compare_entry->total_co2e + $this->compare_to_entry->total_co2e) / 2;
            $this->compare_entry->total_co2e_diff = round(($total_co2e_absolute_diff / $total_co2e_average) * 100, 2) . '%';
        }

        array_push($this->comparison_entries,  $this->compare_entry);
    }

    public function calculateBusAndRailDiff()
    {   
        // bus distance
        $bus_distance_absolute_diff = $this->compare_entry->bus_distance - $this->compare_to_entry->bus_distance;
        $bus_distance_average = ($this->compare_entry->bus_distance + $this->compare_to_entry->bus_distance) / 2;
        $this->compare_entry->bus_distance_diff = round(($bus_distance_absolute_diff / $bus_distance_average) * 100, 2) . '%';

        // coach distance
        $coach_distance_absolute_diff = $this->compare_entry->coach_distance - $this->compare_to_entry->coach_distance;
        $coach_distance_average = ($this->compare_entry->coach_distance + $this->compare_to_entry->coach_distance) / 2;
        $this->compare_entry->coach_distance_diff = round(($coach_distance_absolute_diff / $coach_distance_average) * 100, 2) . '%';

        // train distance
        $train_distance_absolute_diff = $this->compare_entry->train_distance - $this->compare_to_entry->train_distance;
        $train_distance_average = ($this->compare_entry->train_distance + $this->compare_to_entry->train_distance) / 2;
        $this->compare_entry->train_distance_diff = round(($train_distance_absolute_diff / $train_distance_average) * 100, 2) . '%';

        // tram distance
        $tram_distance_absolute_diff = $this->compare_entry->tram_distance - $this->compare_to_entry->tram_distance;
        $tram_distance_average = ($this->compare_entry->tram_distance + $this->compare_to_entry->tram_distance) / 2;
        $this->compare_entry->tram_distance_diff = round(($tram_distance_absolute_diff / $tram_distance_average) * 100, 2) . '%';

        // subway distance
        $subway_distance_absolute_diff = $this->compare_entry->subway_distance - $this->compare_to_entry->subway_distance;
        $subway_distance_average = ($this->compare_entry->subway_distance + $this->compare_to_entry->subway_distance) / 2;
        $this->compare_entry->subway_distance_diff = round(($subway_distance_absolute_diff / $subway_distance_average) * 100, 2) . '%';

        // taxi distance
        $taxi_distance_absolute_diff = $this->compare_entry->taxi_distance - $this->compare_to_entry->taxi_distance;
        $taxi_distance_average = ($this->compare_entry->taxi_distance + $this->compare_to_entry->taxi_distance) / 2;
        $this->compare_entry->taxi_distance_diff = round(($taxi_distance_absolute_diff / $taxi_distance_average) * 100, 2) . '%';

        // total co2e used
        $total_co2e_absolute_diff = $this->compare_entry->total_co2e - $this->compare_to_entry->total_co2e;
        $total_co2e_average = ($this->compare_entry->total_co2e + $this->compare_to_entry->total_co2e) / 2;
        $this->compare_entry->total_co2e_diff = round(($total_co2e_absolute_diff / $total_co2e_average) * 100, 2) . '%';

        array_push($this->comparison_entries,  $this->compare_entry);
    }

    public function compareAgainst($entryId)
    {
        if ($this->compare_to_entry) return;

        switch($this->data_type){
            case 'household':
                $this->compare_to_entry = Household::find($entryId);
                $this->calculateHouseholdDiff();
                array_push($this->comparison_entries,  $this->compare_to_entry);
                break;
            case 'car':
                $this->compare_to_entry = Car::find($entryId);
                $this->calculateCarDiff();
                array_push($this->comparison_entries,  $this->compare_to_entry);
                break;
            case 'flights':
                $this->compare_to_entry = Flights::find($entryId);
                $this->calculateFlightsDiff();
                array_push($this->comparison_entries,  $this->compare_to_entry);
                break;
            case 'bus&rail':
                $this->compare_to_entry = BusAndRail::find($entryId);
                $this->calculateBusAndRailDiff();
                array_push($this->comparison_entries,  $this->compare_to_entry);
                break;
            case 'secondary':
                $this->compare_to_entry = Secondary::find($entryId);
                $this->calculateSecondaryDiff();
                array_push($this->comparison_entries,  $this->compare_to_entry);
                break;
        }
    }

    public function clearComparison()
    {
        unset($this->compare_entry);
        unset($this->compare_to_entry);
        $this->compare_to_entries = [];
        $this->comparison_entries = [];
    }

    public function orderBy()
    {
        // implement sorting of table
    }

    public function render()
    {
        return view('livewire.data-history');
    }
}
