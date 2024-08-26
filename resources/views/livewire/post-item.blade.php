<div class="flex flex-row justify-between bg-white overflow-hidden shadow-xl sm:rounded-lg hover:cursor-pointer">
    <div class="w-11/12" x-on:click="modalOpen = true" wire:click="openModal">
        <div class="flex flex-row justify-between p-2">
            <div class="flex flex-row gap-2">
                <img src="" alt="Profile pic">
                <p>{{ $user_name }}</p>
            </div>
        </div>
        <div class="p-2">
            <p>{{ $post_content }}</p>
        </div>
    </div>
    <div class="flex justify-center p-2 w-1/12">
    @if ($user_id == $auth_user_id)
    <i wire:click='deletePost' class="fa-solid fa-trash"></i>
    @endif
    </div>
</div>
