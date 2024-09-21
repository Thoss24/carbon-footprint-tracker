<div class="flex flex-col rounded-full bg-slate-200 w-fit p-4 justify-center items-center" x-data="{ solutionsDisplaying: false }">
    {{ $targetDate }}
    {{ $goalSeen }}
  
        <div class="{{!$goalAchieved && $goalSeen == 1 ? 'hidden' : 'visible'}}">
            <p class="text-emerald-500">Goal Achieved</p>
            <p value="{{$previousCo2e}}" class="prev-co2e">{{$previousCo2e}}</p>
            <p class="next-co2e">{{$nextCo2e}}</p>
            <p class="percentage-goal">{{$percentageGoal}}</p>
            <button wire:click='share' class="share">share</button>
        </div>
       
        <p class="{{$goalAchieved && $goalSeen == 1 ? 'hidden' : 'visible'}} text-red-500">Goal Not Achieved</p>
       

    @if ($goalSeen == 1 && $goalAchieved == 0)
        <button class="bg-emerald-300 p-1 rounded-xl" x-text="solutionsDisplaying ? 'Hide solutions' : 'Show solutions'"
            x-on:click="solutionsDisplaying = ! solutionsDisplaying"></button>
        <div x-show="solutionsDisplaying">
            @foreach ($solutions as $solution)
                <div class="flex flex-row gap-1">
                    <h2>{{ $solution->title }}:</h2>
                    <p>{{ $solution->description }}:</p>
                    <p>{{ $solution->id }}</p>
                </div>
            @endforeach
        </div>
    @endif
</div>
