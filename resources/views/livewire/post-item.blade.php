<div class="flex flex-col bg-white overflow-hidden shadow-xl sm:rounded-lg sm:rounded-lg">
    <div class="flex flex-row gap-2 p-2">
        <img src="" alt="Profile pic">
        <h3>{{ $user_name }}</h3>
    </div>
    <div>
        <p>{{ $post_content }}</p>
    </div>
    @if($user_id == auth()->id())
        <button class="flex bg-emerald-400 w-fit rounded m-2" wire:click='deletePost'>Delete</button>
    @endif
</div>
