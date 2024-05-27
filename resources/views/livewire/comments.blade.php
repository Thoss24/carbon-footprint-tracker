<div>
    <form wire:submit='createComment' class="flex flex-col justify-center items-end p-3 gap-4">
        <textarea type="text" wire:model='comment_content'
            class="flex resize-none h-12 border-none p-1 focus:outline-emerald-300 focus:ring focus:ring-emerald-200 w-full"
            placeholder="Write a reply...">
        </textarea>
        <button class="bg-emerald-400 p-1 rounded-xl type="submit">Comment</button>
    </form>
    <div class="p-3">
    {{-- [{"id":1,"content":"test","user_id":1,"post_id":46,"created_at":"2024-05-27T12:05:06.000000Z","updated_at":"2024-05-27T12:05:06.000000Z"}] --}}
    <h2>Comments</h2>
    <div id="post-comments-section">
        @if ($post_comments)
            @if (is_object($post_comments) && count($post_comments) > 0)
                @foreach ($post_comments as $post_comment)
                <x-post-comment content="{{$post_comment->content}}" />
                @endforeach 
            @else
                <h3>No comments to show...</h3>
            @endif
        @endif
    </div>
    </div>
</div>

<script>

    document.addEventListener('livewire:init', () => {
        Livewire.on('post-modal-opened', (event) => {
            document.getElementById('post-comments-section').innerHTML = ''
        });
    });

</script>