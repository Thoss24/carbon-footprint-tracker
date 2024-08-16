<div class="flex items-center" x-data="{ notificationsModal: false }">
    <div class="flex flex-row items-center">
        <div class="flex">
            <i class="fa fa-bell" aria-hidden="true" x-on:click="notificationsModal = ! notificationsModal"></i>
            {{-- <div x-cloak class="relative" x-show="notificationsModal">
                <x-notifications-modal :notifications="$pending_friend_requests"/>
            </div> --}}
            <p>NOTIFICATION ID{{$notification_id}}</p>
            @foreach ($pending_friend_requests as $notification)
                <livewire:notification-item :$notification :request_id="$notification->id" :sender_name="$notification->sender_name" :receiver_name="$notification->receiver_name" :key="$notification->id"/>
            @endforeach
            @php
                foreach ($pending_friend_requests as $item) {
                    echo "Item: " . print_r($item->sender_name, true);
                }
            @endphp
        </div>
    </div>
    <div class="flex justify-center rounded-3xl  w-4 bg-red-600 text-white text-xs">
        {{ $pending_friend_requests_count }}
    </div>
</div>
