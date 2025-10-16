<div class="bg-white m-4 rounded-lg shadow-md">
    <h2 class="text-2xl font-semibold text-black underline">Find Friends</h2>

    <!-- {{print_r($users, true)}} -->
    
    <div class="flex flex-col mt-4">
        <label for="search_friends" class="text-sm font-medium text-gray-700">Search for a friend</label>
        <input type="text"
            wire:model="query"
            class="border w-full border-gray-300 rounded-md px-4 py-2 mt-1 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition duration-200"
            placeholder="Search..."
            wire:keydown="searchForUser"
        >
    </div>

    <div class="flex flex-col p-4 mt-2 space-y-2">
        @if (!empty($queried_users))
            @foreach ($queried_users as $user)
                <x-user-shell wire:key="{{ $user->id }}" id="{{ $user->id }}" name="{{ $user->name }}"
                    profile_photo_path="{{ $user->profile_photo_path }}"/>
            @endforeach
        @elseif (empty($queried_users) && $query != '')
            <p class="text-gray-500">No friends found.</p>
        @endif
    </div>
</div>