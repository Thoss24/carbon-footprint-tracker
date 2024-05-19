<div x-data="{ modalOpen: false, postItemMenuOpen: false, deletePostModalOpen: false }">
<div class="flex flex-col bg-transparent gap-2">
    @foreach ($personal_posts as $post)
        <livewire:post-item :user_name="$post->user->name" :post_id="$post->id" :user_id="$post->user_id" :auth_user_id="$user_id" :post_content="$post->content" :key="$post->id"/>
    @endforeach
</div>
{{-- modal content --}}
<x-modal user_id="{{ $user_id }}"/>

</div>