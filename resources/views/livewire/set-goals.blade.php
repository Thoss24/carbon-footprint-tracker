<div class="flex flex-col mt-4 justify-between bg-gray-50 p-6 rounded-xl shadow-xl" x-data="{ prevEntriesModal: false }">
    <section class="mt-2 ">
        <div>
            @if (session()->has('message'))
                <div id="flash-message" class="text-green-700 bg-green-100 border-green-500 p-4 mb-4 border rounded-md">
                    {{ session('message') }}
                </div>
            @endif
        </div>

        <h2 class="text-2xl font-semibold mt-4">All Active Goals</h2>
        <p class="text-gray-600 text-sm mb-4">Goals that haven't been met yet</p>
        <div class="flex flex-row flex-wrap">
        @foreach ($active_goals as $active_goal)
            <livewire:goal-item :key="$active_goal->id" 
                :goalId="$active_goal->id" 
                :goalSeen="$active_goal->goal_seen"
                :targetDate="$active_goal->target_date" 
                :goalAchieved="$active_goal->goal_met" 
                :nextCo2e="$active_goal->co2e_time_of_goal_met"
                :previousCo2e="$active_goal->previous_co2e" 
                :percentageGoal="$active_goal->improve_percentage_goal" 
                :type="$active_goal->type" />
        @endforeach
        </div>

        <h2 class="text-2xl font-semibold mt-4">All Previous Goals</h2>
        <p class="text-gray-600 text-sm mb-4">Achieved or failed goals</p>
        <div class="flex flex-row flex-wrap">
            @foreach ($past_goals as $past_goal)
                <livewire:goal-item :key="$past_goal->id" 
                    :goal="$past_goal" 
                    :goalSeen="$past_goal->goal_seen" 
                    :goalId="$past_goal->id" 
                    :targetDate="$past_goal->target_date"
                    :goalAchieved="$past_goal->goal_met" 
                    :percentageGoal="$past_goal->improve_percentage_goal" 
                    :previousCo2e="$past_goal->previous_co2e" 
                    :nextCo2e="$past_goal->co2e_time_of_goal_met" 
                    :type="$past_goal->type" /> 
            @endforeach
        </div>
    </section>

    <h2 class="text-2xl font-semibold mt-6">Set New Goal</h2>
    <form action="" wire:submit='setGoal' class="mt-4">
        <fieldset class="mb-4">
            <label for="energy_type" class="block text-gray-700">Energy Category</label>
            <select name="energy_type" id="energy_type" 
                    wire:model='type' 
                    wire:change='getPreviousEntryData'
                    class="border w-full border-gray-300 rounded-md focus:ring-emerald-500 focus:border-emerald-500 mt-1">
                <option value="household">Household</option>
                <option value="car">Car</option>
                <option value="flights">Flights</option>
                <option value="bus & rail">Bus & Rail</option>
                <option value="secondary">Secondary</option>
            </select>
        </fieldset>

        <fieldset class="mb-4">
            <button type="button" class="bg-emerald-300 p-2 rounded-xl text-black hover:bg-emerald-400 transition duration-200" 
                    x-text="prevEntriesModal ? 'Hide Previous Entries' : 'Show Previous Entries to Compare'" 
                    x-on:click="prevEntriesModal = !prevEntriesModal"></button>
            <div x-show="prevEntriesModal" class="mt-2">
                <div x-data="{ selectedEntry: null }">
                    @foreach ($previous_entries as $entry)
                        <div class="hover:cursor-pointer text-gray-700 p-2 rounded-md transition duration-200" 
                             :class="selectedEntry === '{{ $entry->id }}' ? 'bg-emerald-500 text-white' : 'bg-white'"
                             x-on:click="selectedEntry = (selectedEntry === '{{ $entry->id }}') ? null : '{{ $entry->id }}'; 
                                          $wire.selectPrevCo2e('{{ $entry->total_co2e }}', '{{ $entry->id }}')">
                            {{$entry->created_at}} : {{$entry->total_co2e}}
                        </div>
                    @endforeach
                </div>
            </div>
        </fieldset>

        <fieldset class="mb-4">
            <label for="improve_percentage_goal" class="block text-gray-700">Target Amount to Reduce By</label>
            <input wire:model='improve_percentage_goal' type="number" class="border border-gray-300 rounded-md p-2 mt-1 w-full" required>
            <select name="improve_percentage_goal_metric" id="improve_percentage_goal_metric" 
                    class="border w-full border-gray-300 rounded-md focus:ring-emerald-500 focus:border-emerald-500 mt-2">
                <option selected>%</option>
            </select>
        </fieldset>

        <fieldset class="mb-4">
            <label for="target_date" class="block text-gray-700">Target Date</label>
            <input wire:model='target_date' id="target_date" type="date" class="border border-gray-300 rounded-md p-2 mt-1 w-full" required>
        </fieldset>

        <button type="submit" class="bg-emerald-500 text-white rounded-md px-4 py-2 hover:bg-emerald-600 transition duration-200">Submit Goal</button>
    </form>
</div>