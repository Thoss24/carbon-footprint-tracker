@props(['notifications'])

<div class="flex fixed flex-col m-4 bg-slate-50 rounded-lg overflow-y-auto shadow-xl transform transition-all min-h-96 w-40">
  @foreach ($notifications as $notification)
    <x-notification-shell senderName="{{$notification->sender_name}}" receiverName="{{$notification->receiver_name}}"/>
  @endforeach
</div>
