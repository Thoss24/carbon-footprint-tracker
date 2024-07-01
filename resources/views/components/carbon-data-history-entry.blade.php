@props(['tableRow' => null, 'wire:click'])

<div x-data="{ entryShowing: false }" class="flex flex-col p-2 m-1">
    {{-- See entry from :{{$tableRow->created_at}} --}}
    <button x-on:click="entryShowing = ! entryShowing"
        x-text="entryShowing ? 'Hide entry from : {{ $tableRow->created_at }}' : 'Show entry from : {{ $tableRow->created_at }}'"
        class="rounded"
        ></button>
    {{-- [{"id":1,"created_at":"2024-06-22T14:00:13.000000Z","updated_at":"2024-06-22T14:00:13.000000Z","electricity":0,"electricity metric":"kWh","natural_gas":0,"natural gas metric":"kWh","heating_oil":0,"heating oil metric":"kWh","coal":0,"coal metric":"kWh","lpg":0,"lpg metric":"litres","propane":0,"propane metric":"litres","wood":0,"wood metric":"kg","user_id":1}] --}}
    <div x-show="entryShowing" class="flex flex-col">
        <button wire:click="deleteEntry({{ $tableRow->id }})">Delete</button>
    </div>
</div>
