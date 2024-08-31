<div class="flex flex-col mt-4 justify-between bg-white shadow-xl" x-data="{ prevEntriesModal: false }">
    <h2>Last entry id{{$test_last_entry_id}}</h2>
    <h2>Last goal id{{$test_last_goal_id}}</h2>
    <section class="mt-2">
    <h2 class="text-2xl">All active goals: goals that havent been met yet</h2>
    @foreach ($active_goals as $active_goal)
        <x-goal-shell key="{{$active_goal}}" targetDate="{{$active_goal->target_date}}" goalAchieved="{{null}}" previousCo2e="{{$active_goal->previous_co2e}}" type="{{$active_goal->type}}"/>
    @endforeach
    <h2 class="text-2xl">All previous goals: acheived or failed goals</h2>
    @foreach ($past_goals as $past_goal)
        <livewire:goal-item :key="$past_goal->id" :goal_id="$past_goal->id" :targetDate="$past_goal->target_date" :goalAchieved="$past_goal->goal_met" :previousCo2e="$past_goal->previous_co2e" :type="$past_goal->type" /> 
    @endforeach
    </section>
    <h2>Set new goal</h2>
    <form action="" wire:submit='setGoal'>
        <fieldset>
            <label for="type">Energy category</label>
            <select name="energy_type" id="energy_type" wire:model='type' wire:change='getPreviousEntryData'
                class="border w-fit border-gray-300 rounded-md focus:ring-emerald-500 focus:border-emerald-500">
                <option value="household" selected>Household</option>
                <option value="transport" selected>Transport</option>
                <option value="secondary" selected>Secondary</option>
            </select>
        </fieldset>
        <fieldset>
            <button x-text="prevEntriesModal ? 'Hide previous entries' : 'Show previous entries to comapre to'" type="button" x-on:click="prevEntriesModal = ! prevEntriesModal" for="type" class=" rounded-xl p-1"></button>
            <div x-show="prevEntriesModal" name="" id="">
                @foreach ($previous_entries as $entry)
                    <div class="hover:cursor-pointer" wire:click="selectPrevCo2e('{{ $entry->total_household_co2e }}', '{{ $entry->id }}')">{{$entry->created_at}} : {{$entry->total_household_co2e}}</div>
                @endforeach
            </div>
        </fieldset>
        <fieldset>
            <label for="improve_percentage_goal">Target amount to reduce by</label>
            <input wire:model='improve_percentage_goal' type="number">
            <select name="improve_percentage_goal_metric" id="improve_percentage_goal_metric"
                class="border w-fit border-gray-300 rounded-md focus:ring-emerald-500 focus:border-emerald-500">
                <option selected>%</option>
            </select>
        </fieldset>
        <fieldset>
            <label for="target_date">Target Date</label>
            <input wire:model='target_date' id="target_date" type="date">
        </fieldset>
        <button type="submit">Submit goal</button>
    </form>
</div>
