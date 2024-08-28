<div>
    <h1>SET GOALS</h1>
    <h2>PREV {{ $previous_co2e }}</h2>
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
            <label for="type">Select previous entry you want to comapre to</label>


            @if (!empty($previous_entries))
                @foreach ($previous_entries as $entry)
                    <button type="button" class="p-2 bg-red-500"
                        wire:click="selectPrevCo2e('{{ $entry->total_household_co2e }}', '{{ $entry->id }}')">{{ $entry->created_at }}-{{ $entry->total_household_co2e }}
                    </button>
                @endforeach
            @endif

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
