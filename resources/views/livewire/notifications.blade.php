<div class="flex items-center" x-data="{ notificationsModal: false }">
    <div class="flex flex-row items-center">
        <i class="fa fa-bell" aria-hidden="true" x-on:click="notificationsModal = ! notificationsModal"></i>
        {{-- <div x-cloak class="relative" x-show="notificationsModal">
            <x-notifications-modal :notifications="$pending_friend_requests"/>
        </div> --}}
        @foreach ($pending_friend_requests as $notification)
            <livewire:notification-item :$notification :key="$notification->id" :request_id="$notification->id" :sender_name="$notification->sender_name" :receiver_name="$notification->receiver_name"/>
        @endforeach
*
        {{-- @foreach ($personal_posts as $post)
        <livewire:post-item :user_name="$post->user->name" :post_id="$post->id" :user_id="$post->user_id" :auth_user_id="$user_id" :post_content="$post->content" :key="$post->id"/>
        @endforeach --}}

        {{-- @php
            foreach ($pending_friend_requests as $item) {
                echo "Item: " . print_r($item->sender_name, true);
            }
        @endphp --}}
       
    </div>
    <div class="flex justify-center rounded-3xl  w-4 bg-red-600 text-white text-xs">
        {{ $pending_friend_requests_count }}
    </div>
</div>
