<x-app-layout>
  <x-slot name="header">
    <div class="flex items-center justify-between">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('My Feed') }}
      </h2>
    </div>
  </x-slot>
  
  <div class="py-6 px-4 sm:px-6 lg:px-8">
    <div class="max-w-full mx-auto">

      {{-- <div class="p-4 bg-red-200 outline outline-black">Div 1</div>

      <div class="p-4 bg-red-200 outline outline-black">Div 2</div> --}}

      <div class="flex flex-col gap-6 sm:flex-row">
        <!-- Posts Section - Takes 2/3 width on large screens -->
        <div class="w-full lg:w-2/3 bg-white overflow-hidden shadow-lg rounded-lg border border-gray-200 hover:shadow-xl transition-shadow duration-300">
          <div class="px-6 py-4 bg-gradient-to-r from-blue-50 to-indigo-50 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-800 flex items-center">
              <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h10M4 18h7" />
              </svg>
              My Feed
            </h3>
          </div>
          <div class="p-6">
            <livewire:CreatePost />
          </div>
          <div class="p-6">
            <livewire:posts />
          </div>
        </div>
        
        <!-- Side nav Section - Takes 1/3 width on large screens -->
        <div class="w-full lg:w-1/3 bg-white overflow-hidden shadow-lg rounded-lg border border-gray-200 hover:shadow-xl transition-shadow duration-300">
          <div class="px-6 py-4 bg-gradient-to-r from-green-50 to-emerald-50 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-800 flex items-center">
            <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
            </svg>
              Friends
            </h3>
          </div>
          <div class="p-6">
            <x-side-nav/>
          </div>
        </div>
        
      </div>
    </div>
  </div>
</x-app-layout>