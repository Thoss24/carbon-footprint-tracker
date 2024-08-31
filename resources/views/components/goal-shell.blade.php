
<div class="flex justify-center rounded-full bg-slate-200 w-fit p-2">
  <p>{{$targetDate}}</p>
  
  @if ($goalAchieved != null)
    @if ($goalAchieved)
      <p class="text-emerald-500">Goal Achieved</p> 
    @else
      <p class="text-red-500">Goal Not Achieved</p>
    @endif
  @endif
</div>