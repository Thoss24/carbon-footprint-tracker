<div class="bg-white m-4 rounded-lg shadow-md p-4">
    <h2 class="text-2xl font-semibold text-black underline mb-4">My Friends</h2>


    
    @foreach ($friends as $friend)
        <livewire:friend 
            :key="$friend->id" 
            :auth_user_id="$user_id" 
            :user_name="$friend->user_name"
            :friend_name="$friend->friend_name" 
            :user_id="$friend->user_id" 
            :friend_id="$friend->friend_id" 
            :friendship_id="$friend->id" 
            class="mb-2" />
    @endforeach

    @if ($friends->isEmpty())
        <p class="text-gray-500 text-center">No friends found.</p>
    @endif
</div>