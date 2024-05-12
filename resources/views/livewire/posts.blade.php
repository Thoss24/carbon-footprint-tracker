<div class="flex flex-col gap-2 bg-transparent">
    @foreach ($posts as $post)
        <livewire:post-item :$post :user_name="$post->user->name" :post_content="$post->content" :key="$post->id" />
    @endforeach
</div>
