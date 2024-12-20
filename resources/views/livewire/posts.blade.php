<div x-data="{ modalOpen: false, postItemMenuOpen: false, commentsSectionOpen: false }" class="px-4 py-6 bg-white shadow-lg rounded-lg mt-2">

    <h2 class="text-2xl font-semibold text-black underline mb-2">My Feed</h2>
    
    <div class="mb-4">
        <label for="post_type" class="block text-gray-700 font-semibold mb-2">Filter posts</label>
        <select name="post_type" id="post_type" wire:model='post_type' wire:change='togglePosts'
                class="border border-gray-300 rounded-md p-2 w-full focus:outline-none focus:ring-2 focus:ring-emerald-400 transition duration-200">
            <option value="all" >All posts</option>
            <option value="personal">My posts only</option>
        </select>
    </div>

    {{-- <div class="flex flex-col gap-4">
        @foreach ($posts as $post)
            <livewire:post-item :$post :profile_photo="$post->user->profile_photo_url" :user_name="$post->user->name" :post_id="$post->id" :user_id="$post->user_id" :auth_user_id="$user_id" :post_content="$post->content" :key="$post->id" />
        @endforeach
    </div> --}}

    
    @foreach ($bookedRanges as $range) {
       <p>Start Date: {{$range['start_date']}} - End Date: {{$range['end_date']}} - Booked: {{$range['booked']}} - Nights: {{$range['nights']}}</p>
    }
    @endforeach

    <livewire:post-item-modal :user_id="$user_id"/>
</div>