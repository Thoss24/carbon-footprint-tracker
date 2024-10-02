<div x-transition.delay.50ms x-data="{ comment: @entangle('comment_content') }">
    <form wire:submit='createComment' class="flex flex-col justify-center items-end p-3 gap-4">
        <textarea type="text" wire:model='comment_content'
            class="flex resize-none h-16 border-none p-1 focus:outline-emerald-300 focus:ring focus:ring-emerald-200 w-full"
            placeholder="Write a reply...">
        </textarea>
        <button id="create-comment-btn"
        x-bind:disabled="!comment.length > 0"
        
        class="p-1 rounded-xl"
        x-bind:class="comment.length > 0 ? 'bg-emerald-500 cursor-pointer' : 'bg-red-400 cursor-not-allowed'" 
        type="submit">Comment</button>
    </form>
    <div class="flex flex-col justify-end p-3 flex-grow">
        {{-- loading data  --}}
        <div wire:loading wire:target="$post_comments">
            <div class="flex items-center justify-center">
                <div class="animate-spin rounded-full h-8 w-8 border-t-2 border-b-2 border-gray-900"></div>
                <span class="ml-2">Loading...</span>
            </div>
        </div>
        <div wire:loading.remove wire:target="$post_comments" id="post-comments-section" x-show="commentsSectionOpen"
            class="flex flex-col h-96 gap-2"
            >

            @if (is_object($comments) && count($comments) > 0)
                @foreach ($comments as $post_comment)
                    <x-post-comment content="{{ $post_comment->content }}" userName="{{ $post_comment->user->name }}"
                        profilePhoto="{{ $post_comment->user->profile_photo_url }}" />
                @endforeach
                <div wire:loading.delay>
                    Loading more items...
                </div>
                
                @if (count($comments) >= $perPage)
                <div
                    id="infinite-scroll-trigger"
                    wire:click="loadMore"
                    class="w-full p-2"
                >See more comments</div>
                @endif
            @else
                <h3>No comments to show...</h3>
            @endif

        </div>
        {{-- displaying data --}}
        <button x-on:click='commentsSectionOpen = ! commentsSectionOpen'>See comments</button>
    </div>
</div>



