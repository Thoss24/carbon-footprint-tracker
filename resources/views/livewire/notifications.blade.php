<div class="flex items-center" x-data="{ notificationsModal: false }">
    <div class="flex flex-row items-center" x-on:click="notificationsModal = ! notificationsModal">
        <div class="relative">
            <i class="fa fa-bell" aria-hidden="true"></i>
            <div class="absolute" x-show="notificationsModal">
                <x-notifications-modal :notifications="$pending_friend_requests"/>
            </div>
        </div>
        <div class="flex justify-center rounded-3xl  w-4 bg-red-600 text-white text-xs">
            {{ $pending_friend_requests_count }}
        </div>
    </div>
</div>
