<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="sm:flex sm:flex-row w-screen flex-col items-start">
        <div class="flex flex-col p-4 gap-4">
            <livewire:find-friends>
            <x-side-nav />
        </div>

        <div class="max-w-7xl mx-auto flex basis-8/12 w-full bg-transparent">
            <div class="overflow-hidden shadow-xl sm:rounded-lg w-full m-2">
                <livewire:personal-feed />
                <livewire:notifications />
            </div>
        </div>

    </div>
</x-app-layout>
