<div class="bg-white p-1">
    <h1 class="text-xl underline">Find friends</h1>
    {{-- name, profile_photo_path --}}
    <div class="flex flex-col mt-2">
        <label for="search_friends">Search for friend</label>
        <input type="text"
            wire:model="query"
            class="border w-fit border-gray-300 rounded-md px-4 py-2 focus:ring-emerald-500 focus:border-emerald-500"
            placeholder="Search..."
            wire:keydown="searchForUser"
        >
    </div>
    <div class="flex p-2 items-start">
        @if (!empty($queried_users))
        @foreach ($queried_users as $user)
            <x-user-shell wire:key="{{ $user->id }}" id="{{ $user->id }}" name="{{ $user->name }}"
                profile_photo_path="{{ $user->profile_photo_path }}"/>
        @endforeach
        @endif
    </div>
</div>
