
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
                    <div class="flex flex-row gap-2 p-2 items-center">
                        @if ($user)
                            <img class="w-12 h-12 rounded-full border-2 border-emerald-500" src="{{$user->profile_photo_url}}" alt="Profile pic">
                            <h3 id="user_name">{{$user->name}}</h3>
                        @endif
                    </div>
                    <div class="flex gap-6 p-2 justify-center items-center">
                        <i id="close-post" class="fa fa-times" wire:click='resetPerPage'
                            x-on:click='postItemMenuOpen = false; commentsSectionOpen = false; modalOpen = false'
                            aria-hidden="true"></i>
                    </div>
                </fieldset>
                <fieldset class="flex flex-col p-2">
                    <p id="post_content">{{$postContent}}</p>
                </fieldset>
            </form>
            <livewire:comments />

        </div>

    </div>
</div>

<script>
    document.addEventListener('livewire:init', () => {
        Livewire.on('post-modal-opened', (event) => {
            // Add event listeners for dynamic elements
            const arrowIcon = document.getElementById('arrow-icon');
            if (arrowIcon) {
                arrowIcon.addEventListener('click', () => {
                    arrowIcon.classList.toggle('rotate-180');
                });
            }

            const backdrop = document.getElementById('backdrop');
            if (backdrop) {
                backdrop.addEventListener('click', () => {
                    if (arrowIcon) {
                        arrowIcon.classList.remove('rotate-180');
                    }
                });
            }

            const closePostButton = document.getElementById('close-post');
            if (closePostButton) {
                closePostButton.addEventListener('click', () => {
                    if (arrowIcon) {
                        arrowIcon.classList.remove('rotate-180');
                    }
                });
            }

            // Display menu & delete post button if post belongs to currently authenticated user
            const postDropdownContainer = document.getElementById('post-dropdown-container');
            if (event.authUserId === event.postUserId) {
                if (postDropdownContainer) {
                    postDropdownContainer.classList.remove('hidden');
                    postDropdownContainer.classList.add('inline-flex');
                }
            } else {
                if (postDropdownContainer) {
                    postDropdownContainer.classList.add('hidden');
                    postDropdownContainer.classList.remove('inline-flex');
                }
            }
        });
    });
</script>
