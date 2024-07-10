<div class="bg-white p-1">
    <h1 class="text-xl underline">Find friends</h1>
    {{-- name, profile_photo_path --}}
    <div class="flex flex-col mt-2">
        <label for="search_friends">Search for friend</label>
        <input type="text" class="border w-fit border-gray-300 rounded-md px-4 py-2 focus:ring-emerald-500 focus:border-emerald-500" placeholder="Search...">
    </div>
    <div>
        @foreach ($users as $user)
            {{-- create user-item laravel component --}}
        @endforeach
    </div>
</div>
