@props(['user_id'])

<div class="w-full">
    <div x-show="modalOpen" x-transition.delay.50ms
        class="flex flex-col fixed inset-0 overflow-y-auto py-6 sm:px-0 z-50 w-full" style="display: none;">
        <div class="fixed inset-0 transform transition-all">
            <div id="backdrop" class="absolute inset-0 bg-gray-500 opacity-75 hover:cursor-pointer"
                wire:click='resetPerPage'
                x-on:click='postItemMenuOpen = false; commentsSectionOpen = false; modalOpen = false;'>
            </div>
        </div>
        <div class="flex flex-col m-4 bg-white rounded-lg overflow-y-auto shadow-xl transform transition-all min-h-96">
            <form wire:submit='submitForm' class="w-full h-full">
                <fieldset class="flex flex-row justify-between">
                    <div class="flex flex-row gap-2 p-2">
                        <img src="" alt="Profile pic">
                        <h3 id="user_name"></h3>
                    </div>
                    <div class="flex gap-6 p-2 justify-center items-center">
                        <i id="close-post" class="fa fa-times" wire:click='resetPerPage'
                            x-on:click='postItemMenuOpen = false; commentsSectionOpen = false; modalOpen = false'
                            aria-hidden="true"></i>
                    </div>
                </fieldset>
                <fieldset class="flex flex-col p-2">
                    <p id="post_content"></p>
                </fieldset>
            </form>
            <livewire:comments />
        </div>

    </div>
</div>

<script>
    // {{-- listen for post-modal-opened event (dispatched from PostItem.php) and pass event data to post item modal --}}
    document.addEventListener('livewire:init', () => {
        Livewire.on('post-modal-opened', (event) => {

            const commentsSection = document.getElementById('post-comments-section');

            // display post creator name and post content
            const postContentElement = document.getElementById('post_content');
            const userNameElement = document.getElementById('user_name');
            postContentElement.textContent = event.postContent;
            userNameElement.textContent = event.userName;

            // display menu & delete post button if post belongs to currently authenticated user
            const postDropdownContainer = document.getElementById('post-dropdown-container');
            if (event.authUserId === event.postUserId) {
                postDropdownContainer.classList.remove('hidden')
                postDropdownContainer.classList.add('inline-flex')
            } else {
                postDropdownContainer.classList.add('hidden')
                postDropdownContainer.classList.add('inline-flex')
            }
        });

        // add rotation animation to arrow icon
        const arrowIcon = document.getElementById('arrow-icon');
        arrowIcon.addEventListener('click', () => {
            arrowIcon.classList.toggle('rotate-180');
        });

        const backdrop = document.getElementById('backdrop');
        backdrop.addEventListener('click', () => {
            arrowIcon.classList.remove('rotate-180');
        });

        const closePostButton = document.getElementById('close-post');
        closePostButton.addEventListener('click', () => {
            arrowIcon.classList.remove('rotate-180');
        });
    });
</script>
