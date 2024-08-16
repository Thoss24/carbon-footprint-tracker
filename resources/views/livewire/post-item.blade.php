<div class="flex flex-col bg-white overflow-hidden shadow-xl sm:rounded-lg hover:cursor-pointer">
    <div x-on:click="modalOpen = true" wire:click="openModal">
        <div class="flex flex-row gap-2 p-2">
            <img src="" alt="Profile pic">
            <h3>{{ $user_name }}</h3>
        </div>
        <div>
            <p>{{ $post_content }}</p>
        </div>
    </div>

    @if ($user_id == $auth_user_id)
        <button wire:click='deletePost'>Delete</button>
    @endif

</div>
