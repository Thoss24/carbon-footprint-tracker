<div class="flex flex-col bg-white overflow-hidden shadow-xl sm:rounded-lg sm:rounded-lg">
    {{-- {"id":1,"created_at":"2024-05-08T19:00:40.000000Z","updated_at":"2024-05-08T19:00:40.000000Z","content":"test","user_id":1,"user":{"id":1,"name":"Thomas S Fogarty","email":"t.fogarty24@outlook.com","email_verified_at":null,"two_factor_confirmed_at":null,"current_team_id":null,
    "profile_photo_path":null,"created_at":"2024-05-03T10:15:06.000000Z","updated_at":"2024-05-03T10:15:06.000000Z","profile_photo_url":"https:\/\/ui-avatars.com\/api\/?name=T+S+F&color=7F9CF5&background=EBF4FF"}} --}}
    <div class="flex flex-row gap-2 p-2">
        <img src="" alt="Profile pic">
        <h3>{{ $user_name }}</h3>
    </div>
    <div>
        <p>{{ $post_content }}</p>
    </div>
    {{-- get post id and compare it to currently authenticated user id --}}
    @if($post_id == auth()->id())
        <button class="flex bg-emerald-400 w-fit rounded m-2" wire:click='deletePost'>Delete</button>
    @endif
</div>
