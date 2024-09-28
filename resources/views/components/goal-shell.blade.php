<div class="flex flex-col items-center justify-center rounded-full bg-slate-200 w-fit p-4 shadow-md">
  <p class="text-lg font-semibold text-gray-800 mb-1">{{$targetDate}}</p>
  
  @if ($goalAchieved != null)
      @if ($goalAchieved)
          <p class="text-emerald-600 font-medium">Goal Achieved</p> 
      @else
          <p class="text-red-600 font-medium">Goal Not Achieved</p>
      @endif
  @endif
</div>