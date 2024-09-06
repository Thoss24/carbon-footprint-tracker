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
   public $comparison_entries;

   public $test_id;

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
        $this->test_id = $entryId;

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

    public function compareAgainst($entryId)
    {
        switch($this->data_type){
            case 'household':
                $this->compare_to_entry = Household::find($entryId);
                break;
            case 'car':
                $this->compare_to_entry = Car::find($entryId);
                break;
        }
    }

    public function clearComparison()
    {
        unset($this->compare_entry);
        unset($this->compare_to_entry);
        $this->compare_to_entries = [];
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
