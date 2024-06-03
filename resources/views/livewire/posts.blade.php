<div x-data="{ modalOpen: false, postItemMenuOpen: false, commentsSectionOpen: false }">

<div class="flex flex-col gap-2 bg-transparent">
    @foreach ($posts as $post)
        <livewire:post-item :$post :user_name="$post->user->name" :post_id="$post->id" :user_id="$post->user_id" :auth_user_id="$user_id" :post_content="$post->content" :key="$post->id" />
    @endforeach
</div>

<livewire:post-item-modal user_id="{{ $user_id }}"/>

</div>


