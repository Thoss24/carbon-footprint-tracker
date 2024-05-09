<div>
    <button class="bg-red-400 p-2 m-4 rounded" wire:click='openModal'>Make post</button>
    @if($post_modal_open)
    <div>
        <x-modal class="h-dvh">
            <div class="h-60">
                <form wire:submit='createPost' class="bg-red-500">
    
                    <img src="" alt="">
                    <h3>{{ $user_name }}</h3>
    
                    <input type="text" wire:model='post_content'>
    
                    <button type="submit">Post</button>
                    
                </form>
                <button wire:click='closeModal' class="m-5">Close</button>
            </div>
        </x-modal>
    </div>
    @endif
</div>
