<div>
    @foreach ($posts as $post)
        <livewire:post-item :$post :key="$post->id" />
    @endforeach
</div>
