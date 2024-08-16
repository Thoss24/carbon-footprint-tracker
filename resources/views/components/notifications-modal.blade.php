@props(['notifications'])

<div class="absolute gap-2 -right-20 top-4 flex flex-col m-4 bg-slate-50 rounded-lg overflow-y-auto shadow-xl transform transition-all min-h-96 w-60">
  @foreach ($notifications as $notification)
    <livewire:notification-item :$notification :key="$notification->id" :request_id="$notification->id" :sender_name="$notification->sender_name" :receiver_name="$notification->receiver_name"/>
  @endforeach
</div>
