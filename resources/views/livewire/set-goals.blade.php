<div>
    <h1>SET GOALS</h1>
    <form action="">
        <fieldset>
            <label for="type">Energy category</label>
            <select name="energy_type" id="energy_type" wire:model='type' wire:change=''
                class="border w-fit border-gray-300 rounded-md focus:ring-emerald-500 focus:border-emerald-500">
                <option value="household" selected>Household</option>
                <option value="transport" selected>Transport</option>
                <option value="secondary" selected>Secondary</option>
            </select>
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
            <label for="num_people_in_household">Target Date</label>
            <input wire:model='target_date' id="target_date" type="date">
        </fieldset>
    </form>
</div>
