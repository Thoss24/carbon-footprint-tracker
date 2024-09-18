<x-app-layout>
  <x-slot name="header" class="flex flex-row">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('Log Household Carbon Footprint Data') }}
      </h2>
  </x-slot>

  <div class="sm:flex sm:flex-row w-screen flex-col items-start">

    <div class="max-w-7xl mx-auto flex basis-8/12 w-full bg-transparent">
        <div class="overflow-hidden shadow-xl sm:rounded-lg w-full m-2 bg-white">
          <livewire:achievements>
        </div>
    </div>

  </div>
</x-app-layout>