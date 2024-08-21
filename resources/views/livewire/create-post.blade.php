<div x-data="{ postModalOpen: false }" class="w-full">
    {{-- @if ($post_modal_open) --}}
    <div class="flex flex-col p-2 m-4">
    <h3>Say whats on your mind...</h3>
    <button class="bg-emerald-400 flex w-fit p-1 rounded" x-on:click='postModalOpen = true'>New Post</button>
    </div>

    <div x-show="postModalOpen" x-transition class=" fixed inset-0 overflow-y-auto py-6 sm:px-0 z-50 w-full"
        style="display: none;">

        <div class="fixed inset-0 transform transition-all">
            <div class="absolute inset-0 bg-gray-500 opacity-75 hover:cursor-pointer"
                x-on:click='postModalOpen = ! postModalOpen'></div>
        </div>

        <div class="flex bg-white rounded-lg overflow-hidden shadow-xl transform transition-all ml-4 mr-4">

            <form wire:submit='createPost' class="w-full">

                <fieldset class="flex flex-row justify-between">
                    <div class="flex flex-row gap-2 p-2">
                        <img src="" alt="Profile pic">
                        <h3>{{ $user_name }}</h3>
                    </div>
                    <div class="p-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6 hover:cursor-pointer"
                            x-on:click='postModalOpen = ! postModalOpen'>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                        </svg>
                    </div>
                </fieldset>


                <textarea type="text" wire:model='post_content'
                    class="resize-none h-36 border-none m-1 p-1 focus:outline-emerald-300 focus:ring focus:ring-emerald-200"
                    placeholder="What's on your mind..."></textarea>
                <div class="flex w-full justify-end">
                    <button type="submit" class="flex w-fit p-4">Create Post</button>
                </div>
            </form>

        </div>

    </div>


    {{-- @endif --}}
</div>
