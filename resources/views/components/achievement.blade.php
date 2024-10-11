<div class="relative flex flex-col items-center text-center p-2">
  <img class="w-20 h-20 {{ !$met ? 'opacity-20' : 'opacity-100' }} transition-opacity duration-300" 
       src="/storage/images/{{$icon}}" 
       alt="Achievement Icon">
  <p class="mt-2 text-gray-800 font-semibold">
      @if ($achieveType == 'goals')
          Meet {{ $count }} {{ str_contains($type, "&") ? 'bus and rail' : $type }} goal
      @elseif ($achieveType == 'submit_data')
          Submit {{ $type }} data {{ $count }} times
      @endif
  </p>
</div>