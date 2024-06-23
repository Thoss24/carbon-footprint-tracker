<div>
    <form action="" wire:submit='submitCarbonFootrpintData'>
        <legend>Household carbon footprint</legend>
        <fieldset>
            <label for="electricity">Electricity</label>
            <div>
                <input type="number" wire:model='electricity' placeholder="0">
                <select name="electricity_metric" id="electricity_metric" wire:model='electricity_metric'>
                    <option value="kWh" selected>kWh</option>
                </select>
            </div>
        </fieldset>
        <fieldset>
            <label for="natural-gas">Natural gas</label>
            <div>
                <input type="number" wire:model='natural_gas' placeholder="0">
                <select name="natural_gas_metric" id="natural_gas_metric" wire:model='natural_gas_metric'>
                    <option value="kWh">kWh</option>
                    <option value="therms">Therms</option>
                    <option value="GBP">GBP</option>
                </select>
            </div>
        </fieldset>
        <fieldset>
            <label for="heating-oil">Heating oil</label>
            <div>
                <input type="number" wire:model='heating_oil' placeholder="0">
                <select name="heating_oil_metric" id="heating_oil_metric" wire:model='heating_oil_metric'>
                    <option value="kWh" selected="selected">kWh</option>
                    <option value="litres">Litres</option>
                    <option value="gallons">Gallons</option>
                </select>
            </div>
        </fieldset>
        <fieldset>
            <label for="Coal">Coal</label>
            <div>
                <input type="number" wire:model='coal' placeholder="0">
                <select name="coal_metric" id="coal_metric" wire:model='coal_metric'>
                    <option value="kWh" selected>kWh</option>
                    <option value="kg">kg</option>
                </select>
            </div>
        </fieldset>
        <fieldset>
            <label for="lpg">LPG (liquified Petroleum Gas)</label>
            <div>
                <input type="number" wire:model='lpg' placeholder="0">
                <select name="lpg_metric" id="lpg_metric" wire:model='lpg_metric'>
                    <option value="litres" selected>Litres</option>
                    <option value="therms">Therms</option>
                    <option value="gallons">Gallons</option>
                </select>
            </div>
        </fieldset>
        <fieldset>
            <label for="propane">Propane</label>
            <div>
                <input type="number" wire:model='propane' placeholder="0">
                <select name="propane_metric" id="propane_metric" wire:model='propane_metric'>
                    <option value="litres" selected>Litres</option>
                    <option value="gallons">Gallons</option>
                </select>
            </div>
        </fieldset>
        <fieldset>
            <label for="wood">Wood</label>
            <div>
                <input type="number" wire:model='wood' placeholder="0">
                <select name="wood_metric" id="wood_metric" wire:model='wood_metric'>
                    <option value="kg" selected>kg</option>
                </select>
            </div>
        </fieldset>
        <button type="submit">Add</button>
    </form>

    <section>
        <button wire:click='togglePreviousEntriesDisplay'>{{$previousEntriesShowing ? 'Hide' : 'Show'}} previous entries</button>
        @if ($previousEntriesShowing)
        <div>
            @if ($carbonFootrpintHistoryData != null)
                @foreach ($carbonFootrpintHistoryData as $entry)
                <x-carbon-data-history-entry :tableRow="$entry" :wire:click="'deleteEntry'"/>
                @endforeach
            @endif
        </div>
        @endif
    </section>
</div>
