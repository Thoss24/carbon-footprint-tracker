<div>
    <form wire:submit='createComment'>
        <h2>{{ $post_id }}</h2>
        <textarea type="text" wire:model='comment_content'
            class="resize-none h-36 border-none m-1 p-1 focus:outline-emerald-300 focus:ring focus:ring-emerald-200"
            placeholder="Write a reply...">
        </textarea>
        <button class="bg-emerald-400" type="submit">Comment</button>
    </form>
</div>
