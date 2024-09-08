<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Household;
use App\Models\Car;

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
        switch($this->data_type){
            case 'household':
                $this->data_history = Household::all();
                break;
            case 'car':
                $this->data_history = Car::all();
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
