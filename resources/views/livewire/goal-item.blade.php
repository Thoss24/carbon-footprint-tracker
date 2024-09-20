<div class="flex flex-col rounded-full bg-slate-200 w-fit p-4 justify-center items-center" x-data="{ solutionsDisplaying: false }">
    {{ $targetDate }}
    {{ $goalSeen }}
    @if ($goalSeen == 1)
        @if ($goalAchieved)
            <p class="text-emerald-500">Goal Achieved</p>
            <h2>share</h2>
        @else
            <p class="text-red-500">Goal Not Achieved</p>
        @endif
    @endif
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

<script>
    // {{-- listen for post-modal-opened event (dispatched from PostItem.php) and pass event data to post item modal --}}
    document.addEventListener('livewire:init', () => {

        const responseMessageElement = document.getElementById('response-message');

        

    });
</script>