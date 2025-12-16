<div x-data="{ previousEntriesDisplaying: false, conformationModalDisplaying: false }" class="p-4 flex flex-col w-screen sm:flex-row">
    <x-dialog-confirmation-modal title="Add Household Carbon Footprint Data"
        content="Are you sure you want to submit this data?" submitData='submitCarbonFootrpintData' />

    <div>
        @if (session()->has('message'))
            <div id="flash-message"
                class="bg-emerald-100 border border-emerald-400 text-emerald-700 px-4 py-3 rounded relative"
                role="alert">
                {{ session('message') }}
            </div>
        @endif
    </div>

    <section class="w-full sm:w-1/2">
        <h1 class="underline text-xl font-semibold text-black mb-4">Household Carbon Footprint</h1>
        <form>
            <fieldset class="mb-4">
                <label for="num_people_in_household" class="block text-lg font-medium text-black mb-2">How many people are in your household?</label>
                <input wire:model='num_people_in_household' id="num_people_in_household" type="number"
                    class="w-full p-2 border border-gray-300 rounded-md focus:ring-emerald-500 focus:border-emerald-500"
                    placeholder="Enter number of people">
            </fieldset>

            @foreach (['electricity', 'natural_gas', 'heating_oil', 'coal', 'lpg', 'propane', 'wood'] as $resource)
                <fieldset class="mb-4">
                    <label for="{{ $resource }}"
                        class="block text-lg font-medium text-black mb-2">{{ ucfirst(str_replace('_', ' ', $resource)) }}</label>
                    <div class="flex flex-col sm:flex-row items-center space-x-0 sm:space-x-2">
                        <input type="number" wire:model='{{ $resource }}' placeholder="0"
                            class="flex-1 w-full sm:w-auto p-2 mb-2 sm:mb-0 border border-gray-300 rounded-md focus:ring-emerald-500 focus:border-emerald-500" />
                        <select name="{{ $resource }}_metric" id="{{ $resource }}_metric"
                            wire:model='{{ $resource }}_metric'
                            class="mt-2 sm:mt-0 sm:w-auto border border-gray-300 rounded-md focus:ring-emerald-500 focus:border-emerald-500">
                            @if ($resource == 'electricity')
                                <option value="kWh" selected>kWh</option>
                            @elseif ($resource == 'natural_gas')
                                <option value="kWh">kWh</option>
                                <option value="therms">Therms</option>
                                <option value="GBP">GBP</option>
                            @elseif ($resource == 'heating_oil')
                                <option value="kWh" selected>kWh</option>
                                <option value="litres">Litres</option>
                                <option value="gallons">Gallons</option>
                            @elseif ($resource == 'coal')
                                <option value="kWh" selected>kWh</option>
                                <option value="kg">kg</option>
                            @elseif ($resource == 'lpg')
                                <option value="litres" selected>Litres</option>
                                <option value="therms">Therms</option>
                                <option value="gallons">Gallons</option>
                            @elseif ($resource == 'propane')
                                <option value="litres" selected>Litres</option>
                                <option value="gallons">Gallons</option>
                            @elseif ($resource == 'wood')
                                <option value="kg" selected>kg</option>
                            @endif
                        </select>
                    </div>
                </fieldset>
            @endforeach
        
            <div class="flex flex-col w-full sm:flex-row items-center mt-6">
                <button x-on:click='conformationModalDisplaying = true' type="button"
                    class="w-full sm:w-auto p-2 bg-emerald-500 text-white rounded hover:bg-emerald-600 transition">Add</button>
                <p id="response-message" class="mt-2 sm:mt-0 sm:ml-4 text-emerald-400">
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