<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Household;
use App\Models\Car;
use App\Models\Flights;
use App\Models\Secondary;
use App\Models\BusAndRail;
use Illuminate\Support\Facades\Auth;

class CarbonFootprintDataVisualisation extends Component
{

    public $user_id;
    public $entries;
    public $chart_type = 'bar';
    public $labels;
    public $url_test;
    public $transport_type = 'car';
    public $url;
    public $friend_page = false;
    public $data_type;

    public function updateChartType()
    {
        $this->dispatch('updateChart');
    }

    public function updateTransportType()
    {
        $this->getTransportData();
        $this->dispatch('updateChart');
    }

    public function getHouseholdData()
    {
        $this->entries = Household::where('user_id', $this->user_id)
        ->pluck('total_co2e')
        ->toArray();

        $this->labels = Household::where('user_id', $this->user_id)
        ->pluck('created_at')
        ->toArray();
    }

    public function getTransportData()
    {   
        switch($this->transport_type)
        {
            case 'car':
                $this->entries = Car::where('user_id', $this->user_id)
                ->pluck('total_co2e')
                ->toArray();
        
                $this->labels = Car::where('user_id', $this->user_id)
                ->pluck('created_at')
                ->toArray();
                break;
            case 'flights':
                $this->entries = Flights::where('user_id', $this->user_id)
                ->pluck('total_co2e')
                ->toArray();
        
                $this->labels = Flights::where('user_id', $this->user_id)
                ->pluck('created_at')
                ->toArray();
                break;
            case 'bus&rail':
                $this->entries = BusAndRail::where('user_id', $this->user_id)
                ->pluck('total_co2e')
                ->toArray();
        
                $this->labels = BusAndRail::where('user_id', $this->user_id)
                ->pluck('created_at')
                ->toArray();
                break;
        }
    }

    public function getSecondaryData()
    {
        $this->entries = Secondary::where('user_id', $this->user_id)
        ->pluck('total_co2e')
        ->toArray();

        $this->labels = Secondary::where('user_id', $this->user_id)
        ->pluck('created_at')
        ->toArray();
    }

    public function mount()
    {
        $user = Auth::user();
        $this->user_id = $user->id;

        $url = explode("/", url()->current());
        $carbon_footrpint_type_url = $url[count($url) - 1];

        $this->url = $carbon_footrpint_type_url;

        if ($this->friend_page)
        {   
            switch($this->data_type)
            {
                case 'log-household-carbon-footprint':
                    $this->getHouseholdData();
                    break;
                case 'log-transport-carbon-footprint':
                    $this->getTransportData();
                    break;
                case 'log-secondary-carbon-footprint':
                    $this->getSecondaryData();
                    break;
            }
        } else {
            switch($this->url)
            {
                case 'log-household-carbon-footprint':
                    $this->getHouseholdData();
                    break;
                case 'log-transport-carbon-footprint':
                    $this->getTransportData();
                    break;
                case 'log-secondary-carbon-footprint':
                    $this->getSecondaryData();
                    break;
            }
        }
   
    }

    public function render()
    {
        return view('livewire.carbon-footprint-data-visualisation');
    }
}
