
<div x-data="{ modalOpen: false, postItemMenuOpen: false, commentsSectionOpen: false }">
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

    <div class="flex flex-col gap-4 mt-4">
        {{-- {{$posts}} --}}
        @foreach ($posts as $post)
            <livewire:post-item :$post :profile_photo="$post->user->profile_photo_url" :user_name="$post->user->name" :post_id="$post->id" :user_id="$post->user_id" :auth_user_id="$user_id" :post_content="$post->content" :key="$post->id" />
        @endforeach
    </div>

    <livewire:post-item-modal user_id="{{ $user_id }}"/>

    @foreach ($data_types as $url)
        <livewire:carbon-footprint-data-visualisation :friend_page="true" :data_type="$url"/>
    @endforeach

    {{-- <livewire:carbon-footprint-data-visualisation :friend_page="true" /> --}}


</div>