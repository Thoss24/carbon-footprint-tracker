<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="flex flex-row w-screen">

        <x-side-nav/>
    
        <div class="max-w-7xl mx-auto flex basis-8/12 w-full bg-transparent">
            <div class="overflow-hidden shadow-xl sm:rounded-lg sm:rounded-lg w-full m-2">
               <livewire:personal-feed />
            </div>
        </div>
    
      </div>
</x-app-layout>
