
<div class="flex shadow flex-col p-1">
    <div class="notification-area">
    <p class="text-xs">Friend request from <strong class="text-sm">{{ $sender_name }}</strong></p>
      <div>
          <button wire:click='acceptRequest' class="text-sm hover:cursor-pointer">Accept <span style="color: green"><i
                      class="fa-solid fa-check fa-xs"></span></i></button>
          <button wire:click='rejectRequest' class="text-sm hover:cursor-pointer">Decline <span style="color: red"><i
                      class="fa-solid fa-x fa-xs"></i></span></button>
      </div>
    </div>
</div>
