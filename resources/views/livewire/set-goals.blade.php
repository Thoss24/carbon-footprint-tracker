<div  x-data="{ prevEntriesModal: false }">
    <section>
    <h2>All active goals</h2>
    @foreach ($previous_goals as $goal)
        <div>{{$goal->target_date}}</div>
    @endforeach
    <h2>All achieved goals</h2>
    {{-- @foreach ($previous_goals as $goal)
        <div>{{$goal->target_date}}</div>
    @endforeach --}}
    </section>
    <h2>GOAL REACHED TEST: {{$goal_reached_feedback}}</h2>
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
