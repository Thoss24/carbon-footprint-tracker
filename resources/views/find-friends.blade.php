<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('Find Friends') }}
      </h2>
  </x-slot>

  <div class="sm:flex sm:flex-row w-screen flex-col items-start">

      <x-side-nav/>
  
      <div class="max-w-7xl mx-auto flex basis-8/12 w-full bg-transparent">
          <div class="overflow-hidden shadow-xl sm:rounded-lg w-full m-2">
             <h1>Find friends</h1>
          </div>
      </div>
  
    </div>
</x-app-layout>
