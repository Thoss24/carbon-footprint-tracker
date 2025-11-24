@props(['notifications'])

<div class="fixed gap-2 -right-25 top-4 flex flex-col m-4 bg-slate-50 rounded-lg overflow-y-auto shadow-xl transform transition-all min-h-96 w-60">
    @if (count($notifications) > 0)
        @foreach ($notifications as $notification)
            <livewire:notification-item :$notification :key="$notification->id" :sender_id="$notification->sender_id" :receiver_id="$notification->receiver_id"
                :request_id="$notification->id" :sender_name="$notification->sender_name" :receiver_name="$notification->receiver_name" />
        @endforeach
    @else 
        <h2 class="ml-4">You have no notifications.</h2>
    @endif
</div>
