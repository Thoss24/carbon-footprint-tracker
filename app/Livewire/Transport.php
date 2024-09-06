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
    public $fuel_used;
    public $fuel_metric = 'gallons';

    public function mount()
    {
        $user = Auth::user();
        $this->user_id = $user->id;
    }

    public function addCarData()
    {
        // add claculations here for total_co2e
        Car::create([
            'user_id' => $this->user_id,
            'mileage' => $this->mileage,
            'mileage_metric' => $this->mileage_metric,
            'fuel_used' => $this->fuel_used,
            'fuel_metric' => $this->fuel_metric,
        ]);
    }

    public function render()
    {
        return view('livewire.transport');
    }
}
