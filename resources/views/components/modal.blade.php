{{-- user_name="{{ $user_name }}" post_content="{{ $post_content }}" --}}

<div class="w-full">
    <div x-show="modalOpen" x-transition class=" fixed inset-0 overflow-y-auto py-6 sm:px-0 z-50 w-full"
        
        style="display: none;">
        <div class="fixed inset-0 transform transition-all">
            <div class="absolute inset-0 bg-gray-500 opacity-75 hover:cursor-pointer" x-on:click='modalOpen = false'>
            </div>
        </div>
        <div class="flex bg-white rounded-lg overflow-hidden shadow-xl transform transition-all m-4">
            <form wire:submit='submitForm' class="w-full">
                <fieldset class="flex flex-row justify-between">
                    <div class="flex flex-row gap-2 p-2">
                        <img src="" alt="Profile pic">
                        <h3 id="user_name"></h3>
                    </div>
                    <div class="p-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6 hover:cursor-pointer" x-on:click='modalOpen = false'>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                        </svg>
                    </div>
                </fieldset>
                <fieldset class="flex flex-col">
                    <p id="post_content"></p>
                </fieldset>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('livewire:init', () => {
        Livewire.on('post-modal-opened', (event) => {
            const postContentElement = document.getElementById('post_content');
            const userNameElement = document.getElementById('user_name'); 
            postContentElement.textContent = event.postContent;
            userNameElement.textContent = event.userName;
        });
    });
</script>
