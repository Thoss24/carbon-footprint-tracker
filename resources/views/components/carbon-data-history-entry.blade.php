@props(['tableRow' => null, 'wire:click'])

<div x-data="{ entryShowing: false }" class="flex flex-col p-2 m-1 shadow-xl rounded w-full bg-slate-100 outline-1 outline-black">
    {{-- See entry from :{{$tableRow->created_at}} --}}
    <button x-on:click="entryShowing = ! entryShowing"
        x-text="entryShowing ? 'Hide entry from : {{ $tableRow->created_at }}' : 'Show entry from : {{ $tableRow->created_at }}'"
        :class="{
            'text-emerald-600': entryShowing,
            'text-black': !entryShowing
        }"
        class="rounded p-1"
        ></button>
    {{-- [{"id":1,"created_at":"2024-06-22T14:00:13.000000Z","updated_at":"2024-06-22T14:00:13.000000Z","electricity":0,"electricity metric":"kWh","natural_gas":0,"natural gas metric":"kWh","heating_oil":0,"heating oil metric":"kWh","coal":0,"coal metric":"kWh","lpg":0,"lpg metric":"litres","propane":0,"propane metric":"litres","wood":0,"wood metric":"kg","user_id":1}] --}}
    <div x-show="entryShowing" class="flex flex-col mt-2">
        <div class="flex gap-2 flex-wrap">
            <p><strong>Electricity: </strong>{{ $tableRow->electricity }} {{ $tableRow->electricity_metric }}</p>
            <p><strong> | </strong></p>
            <p><strong>Natural Gas: </strong>{{ $tableRow->natural_gas }} {{ $tableRow->natural_gas_metric }}</p>
            <p><strong> | </strong></p>
            <p><strong>Heating Oil: </strong>{{ $tableRow->heating_oil }} {{ $tableRow->heating_oil_metric }}</p>
            <p><strong> | </strong></p>
            <p><strong>Heating Oil: </strong>{{ $tableRow->heating_oil }} {{ $tableRow->heating_oil_metric }}</p>
            <p><strong> | </strong></p>
            <p><strong>Coal: </strong>{{ $tableRow->coal }} {{ $tableRow->coal_metric }}</p>
            <p><strong> | </strong></p>
            <p><strong>LPG: </strong>{{ $tableRow->lpg }} {{ $tableRow->lpg_metric }}</p>
            <p><strong> | </strong></p>
            <p><strong>Propane: </strong>{{ $tableRow->propane }} {{ $tableRow->propane_metric }}</p>
            <p><strong> | </strong></p>
            <p><strong>Wood: </strong>{{ $tableRow->wood }} {{ $tableRow->wood_metric }}</p>
        </div>
        <button wire:click="deleteEntry({{ $tableRow->id }})">Delete</button>
    </div>
</div>
