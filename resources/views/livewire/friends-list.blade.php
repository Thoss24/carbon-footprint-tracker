<div class="bg-white m-4 w-96">
    <h2 class="text-xl underline">My Friends</h2>
    @foreach ($friends as $friend)
        <livewire:friend :key="$friend->id" :auth_user_id="$user_id" :user_name="$friend->user_name"
        :friend_name="$friend->friend_name" :user_id="$friend->user_id" :friend_id="$friend->friend_id" :friendship_id="$friend->id" />
    @endforeach
</div>
