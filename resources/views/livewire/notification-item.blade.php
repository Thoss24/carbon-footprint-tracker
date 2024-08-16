  {{-- <div class=" w-full bg-white flex flex-col p-1">
      <div class="w-full bg-white flex flex-col items-center p-1">
          <p class="text-xs">Friend request from <strong class="text-sm">{{ $sender_name }} {{ $request_id }}</strong></p>
          <div>
            <button wire:click='acceptRequest'>TEST</button>
              <button wire:click='acceptRequest' class="text-sm hover:cursor-pointer">Accept <span
                      style="color: green"><i class="fa-solid fa-check fa-xs"></span></i></button>
              <button wire:click='rejectRequest' class="text-sm hover:cursor-pointer">Decline <span
                      style="color: red"><i class="fa-solid fa-x fa-xs"></i></span></button>
          </div>
          <div class=" w-full bg-black h-0.5 opacity-20 bottom-0 " />
      </div>
</div> --}}

<div class="flex flex-col">
    <p class="text-xs">Friend request from <strong class="text-sm">{{ $sender_name }} {{ $request_id }}</strong></p>
    <button wire:click='acceptRequest'>TEST</button>
</div>
