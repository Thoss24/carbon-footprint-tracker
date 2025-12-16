<div x-data="{ previousTransportEntriesDisplaying: false, conformationModalDisplaying: false }" class="p-4 flex flex-col w-screen sm:flex-row">
    <x-dialog-confirmation-modal 
        title="Add Transport Carbon Footprint Data"
        content="Are you sure you want to submit this data?" 
        submitData='addTransportData' />

    <div>
        @if (session()->has('message'))
            <div id="flash-message" class="bg-emerald-100 border border-emerald-400 text-emerald-700 px-4 py-3 rounded relative" role="alert">
                {{ session('message') }}
            </div>
        @endif
    </div>

    <section class="w-full sm:w-1/2">
        <h1 class="underline text-xl font-semibold text-black mb-4">Transport Carbon Footprint</h1>
        <form>
            <h2 class="underline text-xl">Car</h2>
            <fieldset class="mb-4">
                <label for="mileage" class="block text-lg font-medium text-black mb-2">Miles Travelled:</label>
                <div class="flex flex-col sm:flex-row items-center space-x-0 sm:space-x-2">
                    <input wire:model='mileage' id="mileage" type="number" class="flex-1 p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-emerald-500" placeholder="Enter miles">
                    <select name="mileage_metric" wire:model='mileage_metric' id="mileage_metric" class="border border-gray-300 rounded-md focus:ring-emerald-500 focus:border-emerald-500">
                        <option value="miles" selected>Miles</option>
                        <option value="km">Km</option>
                    </select>
                </div>
            </fieldset>

            <fieldset class="mb-4">
                <label for="fuel_used" class="block text-lg font-medium text-black mb-2">Fuel Efficiency:</label>
                <div class="flex flex-col sm:flex-row items-center space-x-0 sm:space-x-2">
                    <input wire:model='fuel_used' id="fuel_used" type="number" class="flex-1 p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-emerald-500" placeholder="Enter fuel used">
                    <select name="fuel_metric" wire:model='fuel_metric' id="fuel_metric" class="border border-gray-300 rounded-md focus:ring-emerald-500 focus:border-emerald-500">
                        <option value="gallons" selected>Gallons</option>
                    </select>
                </div>
            </fieldset>
            
            <fieldset class="mb-6">
                <label for="fuel_type" class="block text-lg font-medium text-black mb-2">Fuel Type:</label>
                <select name="fuel_type" wire:model='fuel_type' id="fuel_type" class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-emerald-500">
                    <option value="diesel" selected>Diesel</option>
                    <option value="petrol">Petrol</option>
                </select>
            </fieldset>
            
            <h2 class="underline text-xl">Flights</h2>
            <fieldset class="mb-4">
                <label for="distance" class="block text-lg font-medium text-black mb-2">Distance Travelled in Miles:</label>
                <div class="flex flex-col sm:flex-row items-center space-x-0 sm:space-x-2">
                    <input wire:model='distance' id="distance" type="number" class="flex-1 p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-emerald-500" placeholder="Enter distance">
                </div>
            </fieldset>
            
            <fieldset class="mb-4">
                <label for="num_passengers" class="block text-lg font-medium text-black mb-2">Number of Passengers:</label>
                <div class="flex flex-col sm:flex-row items-center space-x-0 sm:space-x-2">
                    <input type="number" id="num_passengers" wire:model='num_passengers' class="flex-1 p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-emerald-500" placeholder="Enter number of passengers">
                </div>
            </fieldset>
            
            <h2 class="underline text-xl">Bus & Rail</h2>
            @foreach (['bus_distance', 'coach_distance', 'train_distance', 'tram_distance', 'subway_distance', 'taxi_distance'] as $transport)
                <fieldset class="mb-4">
                    <label for="{{ $transport }}" class="block text-lg font-medium text-black mb-2">{{ ucfirst(str_replace('_', ' ', $transport)) }}:</label>
                    <div class="flex flex-col sm:flex-row items-center space-x-0 sm:space-x-2">
                        <input wire:model='{{ $transport }}' id="{{ $transport }}" type="number" class="flex-1 p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-emerald-500" placeholder="Enter distance">
                        <select name="{{ $transport }}_metric" id="{{ $transport }}_metric" class="border border-gray-300 rounded-md focus:ring-emerald-500 focus:border-emerald-500">
                            <option value="miles" selected>Miles</option>
                        </select>
                    </div>
                </fieldset>
            @endforeach
            <div class="flex flex-row mt-6">
                <button x-on:click='conformationModalDisplaying = true' type="button" class="p-2 bg-emerald-500 text-white rounded hover:bg-emerald-600 transition">Add</button>
                <p id="response-message" class="ml-4 text-emerald-400">
                    @if ($responseMessage)
                        {{ $responseMessage }}
                    @endif
                </p>
            </div>
        </form>
    </section>


    <livewire:carbon-footprint-data-visualisation />
</div>

<script>
    document.addEventListener('livewire:init', () => {
        const responseMessageElement = document.getElementById('response-message');

        Livewire.on('entry-added', (event) => {
            setTimeout(() => {
                responseMessageElement.style.display = "none";
            }, 3000);
        });
    });
</script>