
<div>
    <div class="max-w-md mx-auto bg-white shadow-md rounded-lg overflow-hidden mt-6">
        <div class="flex items-center p-6">
            <img src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}" class="w-24 h-24 rounded-full border-2 border-emerald-500">
            <div class="ml-4">
                <h2 class="text-2xl font-bold text-gray-800">{{ $user->name }}</h2>
                <p class="text-gray-600">{{ $user->email }}</p>
            </div>
        </div>
        <div class="bg-gray-100 p-4">
            <h3 class="text-lg font-semibold text-gray-800">About</h3>
            <p class="text-gray-600">{{$user->bio}}</p>
        </div>
    </div>

<div>
    <h1>feed section of all users posts</h1>
</div>

</div>