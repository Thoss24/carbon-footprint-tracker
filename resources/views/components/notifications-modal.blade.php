<div class="flex fixed flex-col m-4 bg-slate-50 rounded-lg overflow-y-auto shadow-xl transform transition-all min-h-96 w-40">
  @php
    echo json_encode($notifications, true);
  @endphp
</div>
