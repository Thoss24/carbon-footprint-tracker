<div x-data="{ comapreModal: false, comapreToModal: false }">
    <section class="flex flex-row gap-5 items-center">
        <div>
            {{-- <h3>Compare:
                @if ($compare_entry)
                    {{$compare_entry->created_at}}
                @endif
            </h3>
            <h3>Compare:
                @if ($compare_to_entry)
                    {{$compare_to_entry->created_at}}
                @endif
            </h3>    --}}
        </div>
        <div>
            <h2>Select data type</h2>
            <select class="" name="" id="" wire:model.live='data_type' wire:change='selectDataType'>
                <option value="household" selected>Household</option>
                <option value="secondary">Secondary</option>
                <option value="car">Car</option>
                <option value="flights">Flights</option>
                <option value="bus&rail">Bus and Rail</option>
            </select>
        </div>
        <div class="flex flex-col">
            <div class="relative">
                <h2>Compare</h2>
                <button x-on:click="comapreModal = ! comapreModal"
                    class="text-black outline outline-offset-1 outline-1 bg-white py-2 px-4 rounded">
                    {{ $compare_entry ? $compare_entry->created_at : 'Select an option' }}
                </button>
                <div x-show="comapreModal" class="absolute z-10 mt-1 w-full rounded-md bg-white shadow-lg">
                    @foreach ($data_history as $option)
                        <button wire:click="compare({{ $option->id }})"
                            class="w-full text-left px-4 py-2 hover:bg-gray-100">
                            {{ $option->created_at }}
                        </button>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="flex flex-col">
            <div class="relative">
                <h2>Compare Against</h2>
                <button x-on:click="comapreToModal = ! comapreToModal"
                    class="text-black outline outline-offset-1 outline-1 bg-white py-2 px-4 rounded">
                    {{ $compare_to_entry ? $compare_to_entry->created_at : 'Select an option' }}
                </button>
                <div x-show="comapreToModal" class="absolute z-10 mt-1 w-full rounded-md bg-white shadow-lg">
                    @foreach ($compare_to_entries as $option)
                        <button wire:click="compareAgainst({{ $option->id }})"
                            class="w-full text-left px-4 py-2 hover:bg-gray-100">
                            {{ $option->created_at }}
                        </button>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="flex">
            <button class="bg-emerald-500 text-white p-1 rounded-xl" wire:click='clearComparison'>Clear
                comparison</button>
        </div>
    </section>
    <section>
    </section>

    {{-- Household carbon footrpint area --}}

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
                    @if (count($comparison_entries) < 2)
                        @foreach ($data_history as $history)
                            <tr class="hover:bg-gray-100">
                                <td class="py-3 px-5 border-b text-center">{{ $history->electricity }}
                                    {{ $history->electricity_metric }}</td>
                                <td class="py-3 px-5 border-b text-center">{{ $history->natural_gas }}
                                    {{ $history->natural_gas_metric }}</td>
                                <td class="py-3 px-5 border-b text-center">{{ $history->heating_oil }}
                                    {{ $history->heating_oil_metric }}</td>
                                <td class="py-3 px-5 border-b text-center">{{ $history->coal }}
                                    {{ $history->coal_metric }}
                                </td>
                                <td class="py-3 px-5 border-b text-center">{{ $history->lpg }}
                                    {{ $history->lpg_metric }}
                                </td>
                                <td class="py-3 px-5 border-b text-center">{{ $history->propane }}
                                    {{ $history->propane_metric }}</td>
                                <td class="py-3 px-5 border-b text-center">{{ $history->wood }}
                                    {{ $history->wood_metric }}</td>
                                <td class="py-3 px-5 border-b text-center">{{ $history->total_co2e }}</td>
                                <td class="py-3 px-5 border-b text-center">{{ $history->created_at }}</td>
                            </tr>
                        @endforeach
                    @else
                        @foreach ($comparison_entries as $comparison_entry)
                            <tr class="hover:bg-gray-100">
                                <td class="py-3 px-5 border-b text-center">{{ $comparison_entry->electricity }}
                                    {{ $comparison_entry->electricity_metric }}
                                    <strong
                                        class="{{ substr($comparison_entry->electricity_diff, 0, 1) == '-' ? 'text-emerald-400' : 'text-red-400' }}">{{ $comparison_entry->electricity_diff }}</strong>
                                </td>
                                <td class="py-3 px-5 border-b text-center">{{ $comparison_entry->natural_gas }}
                                    {{ $comparison_entry->natural_gas_metric }}
                                    <strong class="{{ substr($comparison_entry->natural_gas_diff, 0, 1) == '-' ? 'text-emerald-400' : 'text-red-400' }}">{{ $comparison_entry->natural_gas_diff }}</strong>
                                </td>
                                <td class="py-3 px-5 border-b text-center">{{ $comparison_entry->heating_oil }}
                                    {{ $comparison_entry->heating_oil_metric }}
                                    <strong class="{{ substr($comparison_entry->heating_oil_diff, 0, 1) == '-' ? 'text-emerald-400' : 'text-red-400' }}">{{ $comparison_entry->heating_oil_diff }}</strong>
                                </td>
                                <td class="py-3 px-5 border-b text-center">{{ $comparison_entry->coal }}
                                    {{ $comparison_entry->coal_metric }}
                                    <strong class="{{ substr($comparison_entry->coal_diff, 0, 1) == '-' ? 'text-emerald-400' : 'text-red-400' }}">{{ $comparison_entry->coal_diff }}</strong>
                                </td>
                                <td class="py-3 px-5 border-b text-center">{{ $comparison_entry->lpg }}
                                    {{ $comparison_entry->lpg_metric }}
                                    <strong class="{{ substr($comparison_entry->lpg_diff, 0, 1) == '-' ? 'text-emerald-400' : 'text-red-400' }}">{{ $comparison_entry->lpg_diff }}</strong>
                                </td>
                                <td class="py-3 px-5 border-b text-center">{{ $comparison_entry->propane }}
                                    {{ $comparison_entry->propane_metric }}
                                    <strong class="{{ substr($comparison_entry->propane_diff, 0, 1) == '-' ? 'text-emerald-400' : 'text-red-400' }}">{{ $comparison_entry->propane_diff }}</strong>
                                </td>
                                <td class="py-3 px-5 border-b text-center">{{ $comparison_entry->wood }}
                                    {{ $comparison_entry->wood_metric }}
                                    <strong class="{{ substr($comparison_entry->wood_diff, 0, 1) == '-' ? 'text-emerald-400' : 'text-red-400' }}">{{ $comparison_entry->wood_diff }}</strong>
                                </td>
                                <td class="py-3 px-5 border-b text-center">{{ $comparison_entry->total_co2e }}
                                    <strong class="{{ substr($comparison_entry->co2e_diff, 0, 1) == '-' ? 'text-emerald-400' : 'text-red-400' }}">{{ $comparison_entry->co2e_diff }}</strong>
                                </td>
                                <td class="py-3 px-5 border-b text-center">{{ $comparison_entry->created_at }}</td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    @endif

    {{-- Car carbon footprint data area --}}

    @if ($data_type == 'car')
    <div class="container mt-4 overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-lg">
            <thead>
                <tr class="bg-emerald-500 text-white">
                    <th class="py-3 px-5 border-b">Mileage</th>
                    <th class="py-3 px-5 border-b">Fuel Used</th>
                    <th class="py-3 px-5 border-b">Total Co2e</th>
                    <th class="py-3 px-5 border-b">Created at</th>
                </tr>
            </thead>
            <tbody>
                @if (count($comparison_entries) < 2)
                    @foreach ($data_history as $history)
                        <tr class="hover:bg-gray-100">
                            <td class="py-3 px-5 border-b text-center">{{ $history->mileage }}
                                {{ $history->mileage_metric }}</td>
                            <td class="py-3 px-5 border-b text-center">{{ $history->fuel_used }}
                                {{ $history->fuel_used_metric }}</td>
                            <td class="py-3 px-5 border-b text-center">{{ $history->total_co2e }}</td>
                            <td class="py-3 px-5 border-b text-center">{{ $history->created_at }}</td>
                        </tr>
                    @endforeach
                @else
                    @foreach ($comparison_entries as $comparison_entry)
                        <tr class="hover:bg-gray-100">
                            <td class="py-3 px-5 border-b text-center">{{ $comparison_entry->mileage }}
                                {{ $comparison_entry->mileage_metric }}
                                <strong
                                    class="{{ substr($comparison_entry->mileage_diff, 0, 1) == '-' ? 'text-emerald-400' : 'text-red-400' }}">{{ $comparison_entry->mileage_diff }}</strong>
                            </td>
                            <td class="py-3 px-5 border-b text-center">{{ $comparison_entry->fuel_used }}
                                {{ $comparison_entry->fuel_used_metric }}
                                <strong class="{{ substr($comparison_entry->fuel_used_diff, 0, 1) == '-' ? 'text-emerald-400' : 'text-red-400' }}">{{ $comparison_entry->fuel_used_diff }}</strong>
                            </td>
                            <td class="py-3 px-5 border-b text-center">{{ $comparison_entry->total_co2e }}
                                <strong class="{{ substr($comparison_entry->total_co2e_diff, 0, 1) == '-' ? 'text-emerald-400' : 'text-red-400' }}">{{ $comparison_entry->total_co2e_diff }}</strong>
                            </td>
                            <td class="py-3 px-5 border-b text-center">{{ $comparison_entry->created_at }}</td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
@endif

    {{-- Flights carbon footprint data area --}}

@if ($data_type == 'flights')
    <div class="container mt-4 overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-lg">
            <thead>
                <tr class="bg-emerald-500 text-white">
                    <th class="py-3 px-5 border-b">Distance - Miles</th>
                    <th class="py-3 px-5 border-b">Total Co2e</th>
                    <th class="py-3 px-5 border-b">Created at</th>
                </tr>
            </thead>
            <tbody>
                @if (count($comparison_entries) < 2)
                    @foreach ($data_history as $history)
                        <tr class="hover:bg-gray-100">
                            <td class="py-3 px-5 border-b text-center">{{ $history->distance }}
                                {{ $history->mileage_metric }}</td>
                            <td class="py-3 px-5 border-b text-center">{{ $history->total_co2e }}</td>
                            <td class="py-3 px-5 border-b text-center">{{ $history->created_at }}</td>
                        </tr>
                    @endforeach
                @else
                    @foreach ($comparison_entries as $comparison_entry)
                        <tr class="hover:bg-gray-100">
                            <td class="py-3 px-5 border-b text-center">{{ $comparison_entry->distance }}
                                <strong
                                    class="{{ substr($comparison_entry->distance_diff, 0, 1) == '-' ? 'text-emerald-400' : 'text-red-400' }}">{{ $comparison_entry->distance_diff }}</strong>
                            </td>
                            <td class="py-3 px-5 border-b text-center">{{ $comparison_entry->total_co2e }}
                                {{ $comparison_entry->total_co2e_metric }}
                                <strong class="{{ substr($comparison_entry->total_co2e_diff, 0, 1) == '-' ? 'text-emerald-400' : 'text-red-400' }}">{{ $comparison_entry->total_co2e_diff }}</strong>
                            </td>
                            <td class="py-3 px-5 border-b text-center">{{ $comparison_entry->created_at }}</td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
@endif

    {{-- Bus & rail carbon footprint data area --}}

@if ($data_type == 'bus&rail')
    <div class="container mt-4 overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-lg">
            <thead>
                <tr class="bg-emerald-500 text-white">
                    <th class="py-3 px-5 border-b">Bus distance</th>
                    <th class="py-3 px-5 border-b">Coach distance</th>
                    <th class="py-3 px-5 border-b">Train distance</th>
                    <th class="py-3 px-5 border-b">Tram distance</th>
                    <th class="py-3 px-5 border-b">Subway distance</th>
                    <th class="py-3 px-5 border-b">Taxi distance</th>
                    <th class="py-3 px-5 border-b">Total Co2e</th>
                    <th class="py-3 px-5 border-b">Created at</th>
                </tr>
            </thead>
            <tbody>
                @if (count($comparison_entries) < 2)
                    @foreach ($data_history as $history)
                        <tr class="hover:bg-gray-100">
                            <td class="py-3 px-5 border-b text-center">{{ $history->bus_distance }}</td>
                            <td class="py-3 px-5 border-b text-center">{{ $history->coach_distance }}</td>
                            <td class="py-3 px-5 border-b text-center">{{ $history->train_distance }}</td>
                            <td class="py-3 px-5 border-b text-center">{{ $history->tram_distance }}</td>
                            <td class="py-3 px-5 border-b text-center">{{ $history->subway_distance }}</td>
                            <td class="py-3 px-5 border-b text-center">{{ $history->taxi_distance }}</td>
                            <td class="py-3 px-5 border-b text-center">{{ $history->total_co2e }}</td>
                            <td class="py-3 px-5 border-b text-center">{{ $history->created_at }}</td>
                        </tr>
                    @endforeach
                @else
                    @foreach ($comparison_entries as $comparison_entry)
                        <tr class="hover:bg-gray-100">
                            <td class="py-3 px-5 border-b text-center">{{ $comparison_entry->bus_distance }}
                                <strong
                                    class="{{ substr($comparison_entry->bus_distance_diff, 0, 1) == '-' ? 'text-emerald-400' : 'text-red-400' }}">{{ $comparison_entry->bus_distance_diff }}</strong>
                            </td>
                            <td class="py-3 px-5 border-b text-center">{{ $comparison_entry->coach_distance }}
                                <strong
                                    class="{{ substr($comparison_entry->coach_distance_diff, 0, 1) == '-' ? 'text-emerald-400' : 'text-red-400' }}">{{ $comparison_entry->coach_distance_diff }}</strong>
                            </td>
                            <td class="py-3 px-5 border-b text-center">{{ $comparison_entry->train_distance }}
                                <strong
                                    class="{{ substr($comparison_entry->train_distance_diff, 0, 1) == '-' ? 'text-emerald-400' : 'text-red-400' }}">{{ $comparison_entry->train_distance_diff }}</strong>
                            </td>
                            <td class="py-3 px-5 border-b text-center">{{ $comparison_entry->tram_distance }}
                                <strong
                                    class="{{ substr($comparison_entry->tram_distance_diff, 0, 1) == '-' ? 'text-emerald-400' : 'text-red-400' }}">{{ $comparison_entry->tram_distance_diff }}</strong>
                            </td>
                            <td class="py-3 px-5 border-b text-center">{{ $comparison_entry->subway_distance }}
                                <strong
                                    class="{{ substr($comparison_entry->subway_distance_diff, 0, 1) == '-' ? 'text-emerald-400' : 'text-red-400' }}">{{ $comparison_entry->subway_distance_diff }}</strong>
                            </td>
                            <td class="py-3 px-5 border-b text-center">{{ $comparison_entry->taxi_distance }}
                                <strong
                                    class="{{ substr($comparison_entry->taxi_distance_diff, 0, 1) == '-' ? 'text-emerald-400' : 'text-red-400' }}">{{ $comparison_entry->taxi_distance_diff }}</strong>
                            </td>
                            <td class="py-3 px-5 border-b text-center">{{ $comparison_entry->total_co2e }}
                                {{ $comparison_entry->total_co2e_metric }}
                                <strong class="{{ substr($comparison_entry->total_co2e_diff, 0, 1) == '-' ? 'text-emerald-400' : 'text-red-400' }}">{{ $comparison_entry->total_co2e_diff }}</strong>
                            </td>
                            <td class="py-3 px-5 border-b text-center">{{ $comparison_entry->created_at }}</td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
@endif

    {{-- Secondary carbon footprint data area --}}

@if ($data_type == 'secondary')
    <div class="container mt-4 overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-lg">
            <thead>
                <tr class="bg-emerald-500 text-white">
                    <th class="py-3 px-5 border-b">Food and Drink</th>
                    <th class="py-3 px-5 border-b">Pharmaceuticals</th>
                    <th class="py-3 px-5 border-b">Clothing</th>
                    <th class="py-3 px-5 border-b">IT equipment</th>
                    <th class="py-3 px-5 border-b">Telephone</th>
                    <th class="py-3 px-5 border-b">Insurance</th>
                    <th class="py-3 px-5 border-b">Educational</th>
                    <th class="py-3 px-5 border-b">Total Co2e</th>
                    <th class="py-3 px-5 border-b">Created at</th>
                </tr>
            </thead>
            <tbody>
                @if (count($comparison_entries) < 2)
                    @foreach ($data_history as $history)
                        <tr class="hover:bg-gray-100">
                            <td class="py-3 px-5 border-b text-center">{{ $history->food_and_drink }}</td>
                            <td class="py-3 px-5 border-b text-center">{{ $history->pharmaceuticals }}</td>
                            <td class="py-3 px-5 border-b text-center">{{ $history->clothing }}</td>
                            <td class="py-3 px-5 border-b text-center">{{ $history->it_equipment }}</td>
                            <td class="py-3 px-5 border-b text-center">{{ $history->telephone }}</td>
                            <td class="py-3 px-5 border-b text-center">{{ $history->insurance }}</td>
                            <td class="py-3 px-5 border-b text-center">{{ $history->educational }}</td>
                            <td class="py-3 px-5 border-b text-center">{{ $history->total_co2e }}</td>
                            <td class="py-3 px-5 border-b text-center">{{ $history->created_at }}</td>
                        </tr>
                    @endforeach
                @else
                    @foreach ($comparison_entries as $comparison_entry)
                        <tr class="hover:bg-gray-100">
                            <td class="py-3 px-5 border-b text-center">{{ $comparison_entry->food_and_drink }}
                                <strong
                                    class="{{ substr($comparison_entry->food_and_drink_diff, 0, 1) == '-' ? 'text-emerald-400' : 'text-red-400' }}">{{ $comparison_entry->food_and_drink_diff }}</strong>
                            </td>
                            <td class="py-3 px-5 border-b text-center">{{ $comparison_entry->pharmaceuticals }}
                                <strong
                                    class="{{ substr($comparison_entry->pharmaceuticals_diff, 0, 1) == '-' ? 'text-emerald-400' : 'text-red-400' }}">{{ $comparison_entry->pharmaceuticals_diff }}</strong>
                            </td>
                            <td class="py-3 px-5 border-b text-center">{{ $comparison_entry->clothing }}
                                <strong
                                    class="{{ substr($comparison_entry->clothing_diff, 0, 1) == '-' ? 'text-emerald-400' : 'text-red-400' }}">{{ $comparison_entry->clothing_diff }}</strong>
                            </td>
                            <td class="py-3 px-5 border-b text-center">{{ $comparison_entry->it_equipment }}
                                <strong
                                    class="{{ substr($comparison_entry->it_equipment_diff, 0, 1) == '-' ? 'text-emerald-400' : 'text-red-400' }}">{{ $comparison_entry->it_equipment_diff }}</strong>
                            </td>
                            <td class="py-3 px-5 border-b text-center">{{ $comparison_entry->telephone }}
                                <strong
                                    class="{{ substr($comparison_entry->telephone_diff, 0, 1) == '-' ? 'text-emerald-400' : 'text-red-400' }}">{{ $comparison_entry->telephone_diff }}</strong>
                            </td>
                            <td class="py-3 px-5 border-b text-center">{{ $comparison_entry->insurance }}
                                <strong
                                    class="{{ substr($comparison_entry->insurance_diff, 0, 1) == '-' ? 'text-emerald-400' : 'text-red-400' }}">{{ $comparison_entry->insurance_diff }}</strong>
                            </td>
                            <td class="py-3 px-5 border-b text-center">{{ $comparison_entry->educational }}
                                <strong
                                    class="{{ substr($comparison_entry->educational_diff, 0, 1) == '-' ? 'text-emerald-400' : 'text-red-400' }}">{{ $comparison_entry->educational_diff }}</strong>
                            </td>
                            <td class="py-3 px-5 border-b text-center">{{ $comparison_entry->total_co2e }}
                                {{ $comparison_entry->total_co2e_metric }}
                                <strong class="{{ substr($comparison_entry->total_co2e_diff, 0, 1) == '-' ? 'text-emerald-400' : 'text-red-400' }}">{{ $comparison_entry->total_co2e_diff }}</strong>
                            </td>
                            <td class="py-3 px-5 border-b text-center">{{ $comparison_entry->created_at }}</td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
@endif

</div>
