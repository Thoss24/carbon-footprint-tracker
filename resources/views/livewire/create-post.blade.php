<div x-data="{ postModalOpen: @entangle('postModalOpen') }" class="w-full">
    <div class="flex flex-col m-4">
        <h3 class="text-xl font-semibold text-black">Say what's on your mind...</h3>
        <button class="bg-emerald-500 text-white flex w-fit p-2 rounded-md shadow hover:bg-emerald-600 transition duration-300" 
                x-on:click='postModalOpen = true'>
            New Post
        </button>
    </div>

    <div x-show="postModalOpen" x-transition class="fixed inset-0 overflow-y-auto py-6 sm:px-0 z-50 w-full" 
         style="display: none;">
        <div class="fixed inset-0 transform transition-all">
            <div class="absolute inset-0 bg-black opacity-50 hover:cursor-pointer" 
                 x-on:click='postModalOpen = false'>
            </div>
        </div>

        <div class="flex bg-white rounded-lg overflow-hidden shadow-xl transform transition-all ml-4 mr-4 max-w-md mx-auto">
            <form wire:submit='createPost' class="w-full p-4">
                <fieldset class="flex flex-row justify-between items-center mb-4">
                    <div class="flex flex-row gap-2">
                        <img class="w-12 h-12 rounded-full border-2 border-emerald-500" src="{{$user->profile_photo_url}}" alt="Profile pic" class="w-10 h-10 rounded-full">
                        <h3 class="text-lg font-medium text-black">{{ $user_name }}</h3>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="w-6 h-6 text-black hover:cursor-pointer hover:text-emerald-500 transition duration-300"
                             x-on:click='postModalOpen = false'>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                        </svg>
                    </div>
                </fieldset>

                <textarea wire:model='post_content'
                          class="resize-none w-full h-36 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent"
                          placeholder="What's on your mind...">
                </textarea>

                <div class="flex w-full justify-end mt-4">
                    <button type="submit" class="bg-emerald-500 text-white flex w-fit p-2 rounded-md shadow hover:bg-emerald-600 transition duration-300">
                        Create Post
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>