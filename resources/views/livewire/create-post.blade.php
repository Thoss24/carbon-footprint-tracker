<div x-data="{ modalOpen: false }" class="w-full">
    {{-- @if($post_modal_open) --}}
    <but`ton class="bg-emerald-400 p-2 m-4 rounded" x-on:click='modalOpen = true'>New Post</button>

    <div
    x-show="modalOpen"
    x-transition
    class=" fixed inset-0 overflow-y-auto py-6 sm:px-0 z-50 w-full"
    style="display: none;">

    <div class="fixed inset-0 transform transition-all">
        <div class="absolute inset-0 bg-gray-500 opacity-75 hover:cursor-pointer" x-on:click='modalOpen = false'></div>
    </div>

    <div class="flex bg-white rounded-lg overflow-hidden shadow-xl transform transition-all ml-4 mr-4">
       
            <form wire:submit='createPost' class="w-full">

                <fieldset class="flex flex-row justify-between">
                    <div class="flex flex-row gap-2 p-2">
                        <img src="" alt="Profile pic">
                        <h3>{{ $user_name }}</h3>
                    </div>
                    <div class="p-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 hover:cursor-pointer" x-on:click='modalOpen = false'>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                        </svg>                                                          
                    </div>
                </fieldset>
                
                <fieldset class="flex flex-col">
                <textarea type="text" wire:model='post_content' class="resize-none h-36 border-none m-1 p-1 focus:outline-emerald-300 focus:ring focus:ring-emerald-200" placeholder="What's on your mind..." ></textarea>
                <button type="submit" class="flex justify-end p-4">Create Post</button>
                </fieldset>
                
            </form>
      
    </div>
    
    </div>

 
    {{-- @endif --}}
</div>
