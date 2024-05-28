<div>
    <form wire:submit='createComment' class="flex flex-col justify-center items-end p-3 gap-4">
        <textarea type="text" wire:model='comment_content'
            class="flex resize-none h-16 border-none p-1 focus:outline-emerald-300 focus:ring focus:ring-emerald-200 w-full"
            placeholder="Write a reply...">
        </textarea>
        <button class="bg-emerald-400 p-1 rounded-xl type="submit">Comment</button>
    </form>
    <div class="p-3" >
        {{-- loading data  --}}
        <div wire:loading wire:target="getPostId">
            <div class="flex items-center justify-center">
                <div class="animate-spin rounded-full h-8 w-8 border-t-2 border-b-2 border-gray-900"></div>
                <span class="ml-2">Loading...</span>
            </div>
        </div>
        {{-- displaying data --}}
        <h2>Comments</h2>
        <div wire:loading.remove wire:target="getPostId" id="post-comments-section" class="flex flex-col gap-2" x-init="">
            
                @if (is_object($post_comments) && count($post_comments) > 0)
                    @foreach ($post_comments as $post_comment)
                        <x-post-comment content="{{ $post_comment->content }}"
                            userName="{{ $post_comment->user->name }}"
                            profilePhoto="{{ $post_comment->user->profile_photo_path }}" />
                    @endforeach
                @else
                    <h3>No comments to show...</h3>
                @endif
           
        </div>
    </div>
</div>

{{-- <script>
    document.addEventListener('livewire:init', () => {
        Livewire.on('post-modal-opened', (event) => {

            const commentsSection = document.getElementById('post-comments-section');

            commentsSection.classList.remove('flex');
            // commentsSection.classList.add('hidden');
        });
    });
</script> --}}
