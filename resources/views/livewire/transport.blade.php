<div x-data="{ previousTransportEntriesDisplaying: false, conformationModalDisplaying: false }" class="p-2">

    <x-dialog-confirmation-modal title="Add Transport Carbon Footprint Data"
        content="Are you sure you want to submit this data?" submitData='addTransportData' />

    <h1 class="underline text-xl">Transport carbon footprint</h1>

    
    @php
        echo "Count: " . count($achievements) . "\n"
    @endphp
   

    {{-- Car transport data --}}
    <section>
        <h2 class="underline text-xl">Car</h2>
        <form action="">
            <fieldset class="flex flex-row">
                <label for="mileage">Miles Travelled: </label>
                <input wire:model='mileage' id="mileage" type="number">
                <select name="mileage_metric" wire:model='mileage_metric' id="mileage_metric">
                    <option value="miles" selected>Miles</option>
                    <option value="km">Km</option>
                </select>
            </fieldset>
            <fieldset>
                <label for="fuel_used">Fuel Efficiency: </label>
                <input wire:model='fuel_used' id="fuel_used" type="number">
                <select name="fuel_metric" wire:model='fuel_metric' id="fuel_metric">
                    <option value="gallons" selected>Gallons</option>
                </select>
            </fieldset>
            <fieldset>
                <label for="fuel_used">Fuel Type: </label>
                <select name="fuel_type" wire:model='fuel_type' id="fuel_type">
                    <option value="diesel" selected>Diesel</option>
                    <option value="petrol">Petrol</option>
                </select>
            </fieldset>
    {{-- Flights transport data --}}
        <h2 class="underline text-xl">Flights</h2>
            <fieldset class="flex flex-row">
                <label for="distance">Distance Travelled in Miles: </label>
                <input wire:model='distance' id="distance" type="number">
            </fieldset>
            <fieldset>
                <label for="num_passengers">Number of passengers: </label>
                <input type="number" id="num_passengers" wire:model='num_passengers'>
            </fieldset>
    {{-- Bus & Rail transport data --}}
        <h2 class="underline text-xl">Bus & Rail</h2>
        <fieldset class="flex flex-row">
            <label for="bus_distance">Bus miles travelled </label>
            <input wire:model='bus_distance' id="bus_distance" type="number">
            <select name="bus_distance_metric" id="bus_distance_metric">
                <option value="bus_distance_metric" selected>Miles</option>
            </select>
        </fieldset>
        <fieldset class="flex flex-row">
            <label for="coach_distance">Coach miles travelled </label>
            <input wire:model='coach_distance' id="coach_distance" type="number">
            <select name="coach_distance_metric" id="coach_distance_metric">
                <option value="coach_distance_metric" selected>Miles</option>
            </select>
        </fieldset>
        <fieldset class="flex flex-row">
            <label for="train_distance">Train miles travelled </label>
            <input wire:model='train_distance' id="train_distance" type="number">
            <select name="train_distance_metric" id="train_distance_metric">
                <option value="train_distance_metric" selected>Miles</option>
            </select>
        </fieldset>
        <fieldset class="flex flex-row">
            <label for="tram_distance">Tram miles travelled </label>
            <input wire:model='tram_distance' id="tram_distance" type="number">
            <select name="tram_distance_metric" id="tram_distance_metric">
                <option value="tram_distance_metric" selected>Miles</option>
            </select>
        </fieldset>
        <fieldset class="flex flex-row">
            <label for="subway_distance">Subway miles travelled </label>
            <input wire:model='subway_distance' id="subway_distance" type="number">
            <select name="subway_distance_metric" id="subway_distance_metric">
                <option value="subway_distance_metric" selected>Miles</option>
            </select>
        </fieldset>
        <fieldset class="flex flex-row">
            <label for="taxi_distance">Taxi miles travelled </label>
            <input wire:model='taxi_distance' id="taxi_distance" type="number">
            <select name="taxi_distance_metric" id="taxi_distance_metric">
                <option value="taxi_distance_metric" selected>Miles</option>
            </select>
        </fieldset>
        </form>
    </section>

    <div class="flex flex-row">
        <button x-on:click='conformationModalDisplaying = true' type="button" class=" p-1 m-1 rounded">Add</button>
        <p id="response-message" class="ml-4 text-emerald-400">
            @if ($responseMessage)
                {{ $responseMessage }}
            @endif
        </p>
    </div>



    {{-- <section class="flex flex-col justify-center">
        <button x-on:click="previousTransportEntriesDisplaying = ! previousTransportEntriesDisplaying"
            class="bg-emerald-400 p-1 m-1 rounded"
            x-text="previousTransportEntriesDisplaying ? 'Hide my previous entries' : 'See my previous entries'">
        </button>
        <div x-show="previousTransportEntriesDisplaying">
         
        </div>
    </section> --}}

    <livewire:carbon-footprint-data-visualisation />

</div>

<script>
    // {{-- listen for post-modal-opened event (dispatched from PostItem.php) and pass event data to post item modal --}}
    document.addEventListener('livewire:init', () => {

        const responseMessageElement = document.getElementById('response-message');

        Livewire.on('entry-added', (event) => {

            setTimeout(() => {
                responseMessageElement.style.display = "none";
            }, 3000);

        });


    });
</script>
