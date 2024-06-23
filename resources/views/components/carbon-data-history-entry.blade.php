@props(['tableRow' => null, 'wire:click'])

<div>
  <div>
         {{-- [{"id":1,"created_at":"2024-06-22T14:00:13.000000Z","updated_at":"2024-06-22T14:00:13.000000Z","electricity":0,"electricity metric":"kWh","natural_gas":0,"natural gas metric":"kWh","heating_oil":0,"heating oil metric":"kWh","coal":0,"coal metric":"kWh","lpg":0,"lpg metric":"litres","propane":0,"propane metric":"litres","wood":0,"wood metric":"kg","user_id":1}] --}}
    @php 
      echo "Data:" . json_decode($tableRow->id, true) . "\n<br>";
    @endphp 
    <button wire:click="deleteEntry({{ $tableRow->id }})">Delete</button>
  </div>
</div>