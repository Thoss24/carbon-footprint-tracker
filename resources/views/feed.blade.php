<x-app-layout>
  <x-slot name="header" class="flex flex-row">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('My Feed') }}
      </h2>
  </x-slot>

  <div class="flex flex-row w-screen m-2">

    <x-side-nav/>

    <div class="max-w-7xl mx-auto sm:px-6  flex basis-8/12 w-full">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg sm:rounded-lg w-full">
           <livewire:posts />
        </div>
    </div>

  </div>
</x-app-layout>
