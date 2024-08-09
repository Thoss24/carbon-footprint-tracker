<div class="flex items-center" x-data="{ notificationsModal: false}">
    <x-modal x-show="notificationsModal"/>
    <div class="flex flex-row items-center">
    <i class="fa fa-bell" aria-hidden="true"></i>
    <div class="flex justify-center rounded-3xl  w-4 bg-red-600 text-white text-xs">{{$pending_friend_requests_count}}</div>
    </div>
</div>
