<div x-data="{ previousEntriesDisplaying: false, conformationModalDisplaying: false }" class="p-2">
    
    <x-dialog-confirmation-modal title="Add Household Carbon Footprint Data" content="Are you sure you want to submit this data?"
        submitData='submitCarbonFootrpintData'/>
  
    <h1 class="underline text-xl">Household carbon footprint</h1>
    <form class="mt-2">
        <p>Num: {{$num_people_in_household}}</p>
        <fieldset>
            <label for="num_people_in_household">How many people are in your household?</label>
            <input wire:model='num_people_in_household' id="num_people_in_household" type="number">
        </fieldset>
        <fieldset>
            <label for="electricity">Electricity</label>
            <div>
                <input type="number" wire:model='electricity' placeholder="0" class="border w-fit border-gray-300 rounded-md px-4 py-2 focus:ring-emerald-500 focus:border-emerald-500">
                <select name="electricity_metric" id="electricity_metric" wire:model='electricity_metric' class="border w-fit border-gray-300 rounded-md focus:ring-emerald-500 focus:border-emerald-500">
                    <option value="kWh" selected>kWh</option>
                </select>
            </div>
        </fieldset>
        <fieldset>
            <label for="natural-gas">Natural gas</label>
            <div>
                <input type="number" wire:model='natural_gas' placeholder="0" class="border w-fit border-gray-300 rounded-md px-4 py-2 focus:ring-emerald-500 focus:border-emerald-500">
                <select name="natural_gas_metric" id="natural_gas_metric" wire:model='natural_gas_metric' class="border w-fit border-gray-300 rounded-md focus:ring-emerald-500 focus:border-emerald-500">
                    <option value="kWh">kWh</option>
                    <option value="therms">Therms</option>
                    <option value="GBP">GBP</option>
                </select>
            </div>
        </fieldset>
        <fieldset>
            <label for="heating-oil">Heating oil</label>
            <div>
                <input type="number" wire:model='heating_oil' placeholder="0" class="border w-fit border-gray-300 rounded-md px-4 py-2 focus:ring-emerald-500 focus:border-emerald-500">
                <select name="heating_oil_metric" id="heating_oil_metric" wire:model='heating_oil_metric' class="border w-fit border-gray-300 rounded-md focus:ring-emerald-500 focus:border-emerald-500">
                    <option value="kWh" selected="selected">kWh</option>
                    <option value="litres">Litres</option>
                    <option value="gallons">Gallons</option>
                </select>
            </div>
        </fieldset>
        <fieldset>
            <label for="Coal">Coal</label>
            <div>
                <input type="number" wire:model='coal' placeholder="0" class="border w-fit border-gray-300 rounded-md px-4 py-2 focus:ring-emerald-500 focus:border-emerald-500">
                <select name="coal_metric" id="coal_metric" wire:model='coal_metric' class="border w-fit border-gray-300 rounded-md focus:ring-emerald-500 focus:border-emerald-500">
                    <option value="kWh" selected>kWh</option>
                    <option value="kg">kg</option>
                </select>
            </div>
        </fieldset>
        <fieldset>
            <label for="lpg">LPG (liquified Petroleum Gas)</label>
            <div>
                <input type="number" wire:model='lpg' placeholder="0" class="border w-fit border-gray-300 rounded-md px-4 py-2 focus:ring-emerald-500 focus:border-emerald-500">
                <select name="lpg_metric" id="lpg_metric" wire:model='lpg_metric' class="border w-fit border-gray-300 rounded-md focus:ring-emerald-500 focus:border-emerald-500">
                    <option value="litres" selected>Litres</option>
                    <option value="therms">Therms</option>
                    <option value="gallons">Gallons</option>
                </select>
            </div>
        </fieldset>
        <fieldset>
            <label for="propane">Propane</label>
            <div>
                <input type="number" wire:model='propane' placeholder="0" class="border w-fit border-gray-300 rounded-md px-4 py-2 focus:ring-emerald-500 focus:border-emerald-500">
                <select name="propane_metric" id="propane_metric" wire:model='propane_metric' class="border w-fit border-gray-300 rounded-md focus:ring-emerald-500 focus:border-emerald-500">
                    <option value="litres" selected>Litres</option>
                    <option value="gallons">Gallons</option>
                </select>
            </div>
        </fieldset>
        <fieldset>
            <label for="wood">Wood</label>
            <div>
                <input type="number" wire:model='wood' placeholder="0" class="border w-fit border-gray-300 rounded-md px-4 py-2 focus:ring-emerald-500 focus:border-emerald-500">
                <select name="wood_metric" id="wood_metric" wire:model='wood_metric' class="border w-fit border-gray-300 rounded-md focus:ring-emerald-500 focus:border-emerald-500" >
                    <option value="kg" selected>kg</option>
                </select>
            </div>
        </fieldset>
        <div class="flex flex-row">
            <button x-on:click='conformationModalDisplaying = true' type="button" class=" p-1 m-1 rounded">Add</button>
            <p id="response-message" class="ml-4 text-emerald-400">
                @if ($responseMessage)
                    {{ $responseMessage }}
                @endif
            </p>
        </div>
    </form>

    <section class="flex flex-col justify-center">
        <button x-on:click="previousEntriesDisplaying = ! previousEntriesDisplaying"
            class="bg-emerald-400 p-1 m-1 rounded"
            x-text="previousEntriesDisplaying ? 'Hide my previous entries' : 'See my previous entries'">
        </button>
        <div x-show="previousEntriesDisplaying">
            @if ($carbonFootrpintHistoryData != null)
                @foreach ($carbonFootrpintHistoryData as $entry)
                    <x-household-data-history-entry :tableRow="$entry" :wire:click="'deleteEntry'" />
                @endforeach
            @endif
        </div>
    </section>
    <livewire:household-visualisation />
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
