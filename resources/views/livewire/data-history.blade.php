<div x-data="{ comapreModal: false, comapreToModal: false }">
    <section class="flex flex-row gap-5 items-center">
        <div>
            <h3>Compare:
                @if ($compare_entry)
                    {{$compare_entry->created_at}}
                @endif
            </h3>
            <h3>Compare:
                @if ($compare_to_entry)
                    {{$compare_to_entry->created_at}}
                @endif
            </h3>    
        </div>
        <div>
            <h2>Select data type</h2>
            <select class="" name="" id="" wire:model.live='data_type' wire:change='selectDataType'>
                <option value="household" selected>Household</option>
                <option value="secondary">Secondary</option>
                <option value="car">Car</option>
                <option value="flights">Flights</option>
                <option value="bus & rail">Bus and Rail</option>
            </select>
        </div>
        <div class="flex flex-col">
            <div class="relative">
                <h2>Compare</h2>
                <button x-on:click="comapreModal = ! comapreModal" class="text-black outline outline-offset-1 outline-1 bg-white py-2 px-4 rounded">
                    {{ $compare_entry ? $compare_entry->created_at : 'Select an option' }}
                </button>
                <div x-show="comapreModal" class="absolute z-10 mt-1 w-full rounded-md bg-white shadow-lg">
                    @foreach ($data_history as $option)
                        <button wire:click="compare({{ $option->id }})" class="w-full text-left px-4 py-2 hover:bg-gray-100">
                            {{ $option->created_at }}
                        </button>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="flex flex-col">
            <div class="relative">
                <h2>Compare Against</h2>
                <button x-on:click="comapreToModal = ! comapreToModal" class="text-black outline outline-offset-1 outline-1 bg-white py-2 px-4 rounded">
                    {{ $compare_to_entry ? $compare_to_entry->created_at : 'Select an option' }}
                </button>
                <div x-show="comapreToModal" class="absolute z-10 mt-1 w-full rounded-md bg-white shadow-lg">
                    @foreach ($compare_to_entries as $option)
                        <button wire:click="compareAgainst({{ $option->id }})" class="w-full text-left px-4 py-2 hover:bg-gray-100">
                            {{ $option->created_at }}
                        </button>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="flex">
            <button class="bg-emerald-500 text-white p-1 rounded-xl" wire:click='clearComparison'>Clear comparison</button>
        </div>
    </section>
    @if ($data_type == 'household')
        <div class="container mt-4 overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-lg">
                <thead>
                    <tr class="bg-emerald-500 text-white">
                        <th class="py-3 px-5 border-b">Electricity</th>
                        <th class="py-3 px-5 border-b">Natural Gas</th>
                        <th class="py-3 px-5 border-b">Heating Oil</th>
                        <th class="py-3 px-5 border-b">Coal</th>
                        <th class="py-3 px-5 border-b">LPG</th>
                        <th class="py-3 px-5 border-b">Propane</th>
                        <th class="py-3 px-5 border-b">Wood</th>
                        <th class="py-3 px-5 border-b">Co2e</th>
                        <th class="py-3 px-5 border-b">Created at</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data_history as $history)
                        <tr class="hover:bg-gray-100">
                            <td class="py-3 px-5 border-b text-center">{{ $history->electricity }}
                                {{ $history->electricity_metric }}</td>
                            <td class="py-3 px-5 border-b text-center">{{ $history->natural_gas }}
                                {{ $history->natural_gas_metric }}</td>
                            <td class="py-3 px-5 border-b text-center">{{ $history->heating_oil }}
                                {{ $history->heating_oil_metric }}</td>
                            <td class="py-3 px-5 border-b text-center">{{ $history->coal }} {{ $history->coal_metric }}
                            </td>
                            <td class="py-3 px-5 border-b text-center">{{ $history->lpg }} {{ $history->lpg_metric }}
                            </td>
                            <td class="py-3 px-5 border-b text-center">{{ $history->propane }}
                                {{ $history->propane_metric }}</td>
                            <td class="py-3 px-5 border-b text-center">{{ $history->wood }}
                                {{ $history->wood_metric }}</td>
                            <td class="py-3 px-5 border-b text-center">{{ $history->total_co2e }}</td>
                            <td class="py-3 px-5 border-b text-center">{{ $history->created_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
    @if ($data_type == 'car')
        @foreach ($data_history as $history)
            <div class="container mt-4 overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-lg">
                    <thead class="">
                        <tr class="bg-emerald-500 text-white">
                            <th class="py-3 px-5 border-b">Mileage</th>
                            <th class="py-3 px-5 border-b">Fuel used</th>
                            <th class="py-3 px-5 border-b">Total Co2e</th>
                            <th class="py-3 px-5 border-b">Created at</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data_history as $history)
                            <tr class="hover:bg-gray-100">
                                <td class="py-3 px-5 border-b text-center">{{ $history->mileage }}
                                    {{ $history->mileage_metric }}</td>
                                <td class="py-3 px-5 border-b text-center">{{ $history->fuel_used }}
                                    {{ $history->fuel_metric }}</td>
                                <td class="py-3 px-5 border-b text-center">{{ $history->total_co2e }}</td>
                                <td class="py-3 px-5 border-b text-center">{{ $history->created_at }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endforeach
    @endif
</div>
