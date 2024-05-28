@props(['user_id'])

<div class="w-full">
    <div x-show="modalOpen" x-transition class=" fixed inset-0 overflow-y-auto py-6 sm:px-0 z-50 w-full"
        
        style="display: none;">
        <div class="fixed inset-0 transform transition-all">
            <div id="backdrop" class="absolute inset-0 bg-gray-500 opacity-75 hover:cursor-pointer" x-on:click='postItemMenuOpen = false; modalOpen = false'>
        </div>
        </div>
        <div class="flex flex-col bg-white rounded-lg overflow-hidden shadow-xl transform transition-all m-4">
            <form wire:submit='submitForm' class="w-full">
                <fieldset class="flex flex-row justify-between">
                    <div class="flex flex-row gap-2 p-2">
                        <img src="" alt="Profile pic">
                        <h3 id="user_name"></h3>
                    </div>
                    <div class="flex gap-6 p-2 justify-center items-center">
                        {{-- conditionally render menu & delete button if post belongs to authenticated user --}}
                        <div id="post-dropdown-container" class="hidden relative items-center flex-col">
                            <i class="fa fa-caret-up ease-in-out transform duration-300 hover:cursor-pointer" id="arrow-icon" x-on:click="postItemMenuOpen = ! postItemMenuOpen"></i>
                            <div x-show="postItemMenuOpen" class="absolute bg-gray-200 hover:outline hover:outline-red-300 hover:bg-red-100 top-full rounded-xl shadow-xl transform mt-2" x-transition>
                                <button type="button" class="text-sm p-1" x-on:click='deletePostModalOpen = true'>Delete post?</button>
                            </div>
                        </div>
                        <i id="close-post" class="fa fa-times" x-on:click='postItemMenuOpen = false; modalOpen = false' aria-hidden="true"></i>

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

            const backdrop = document.getElementById('backdrop');
            backdrop.addEventListener('click', () => {
                commentsSection.innerHTML = '';
            });

            const closePostButton = document.getElementById('close-post');
            closePostButton.addEventListener('click', () => {
                commentsSection.innerHTML = '';
            });

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
