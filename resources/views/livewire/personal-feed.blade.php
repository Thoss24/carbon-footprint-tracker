<div>
    {{-- {"id":7,"created_at":"2024-05-12T12:13:42.000000Z","updated_at":"2024-05-12T12:13:42.000000Z","content":"New post","user_id":2} --}}
    {{-- @php
        echo json_encode($personal_posts) . "\n<br>";
    @endphp --}}

    @foreach ($personal_posts as $post)
        <livewire:post-item :user_name="$post->user->name" :post_id="$post->user_id" :post_content="$post->content"/>
    @endforeach
</div>
