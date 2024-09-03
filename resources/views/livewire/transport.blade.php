<div x-data="{ previousTransportEntriesDisplaying: false, conformationModalDisplaying: false }" class="p-2">

    <x-dialog-confirmation-modal title="Add Transport Carbon Footprint Data"
        content="Are you sure you want to submit this data?" submitData='addCarData' />

    <h1 class="underline text-xl">Transport carbon footprint</h1>

    <section>
        <h2 class="underline text-xl">Car</h2>
        <form action="">
            <fieldset class="flex flex-row">
                <label for="mileage">Mileage: </label>
                <input wire:model='mileage' id="mileage" type="number">
                <select name="mileage_metric" wire:model='mileage_metric' id="mileage_metric">
                    <option value="miles" selected>Miles</option>
                    <option value="km">Km</option>
                </select>
            </fieldset>
            <fieldset>
                <label for="fuel_used">Fuel used: </label>
                <input wire:model='fuel_used' id="fuel_used" type="number">
                <select name="fuel_metric" wire:model='fuel_metric' id="fuel_metric">
                    <option value="gallons" selected>Gallons</option>
                </select>
            </fieldset>
        </form>
    </section>

    <div class="flex flex-row">
        <button x-on:click='conformationModalDisplaying = true' type="button" class=" p-1 m-1 rounded">Add</button>
        <p id="response-message" class="ml-4 text-emerald-400">
            @if ($responseMessage)
                {{ $responseMessage }}
            @endif
        </p>
    </div>



    {{-- <section class="flex flex-col justify-center">
        <button x-on:click="previousTransportEntriesDisplaying = ! previousTransportEntriesDisplaying"
            class="bg-emerald-400 p-1 m-1 rounded"
            x-text="previousTransportEntriesDisplaying ? 'Hide my previous entries' : 'See my previous entries'">
        </button>
        <div x-show="previousTransportEntriesDisplaying">
         
        </div>
    </section> --}}

</div>

<script>
    // {{-- listen for post-modal-opened event (dispatched from PostItem.php) and pass event data to post item modal --}}
    document.addEventListener('livewire:init', () => {

        const responseMessageElement = document.getElementById('response-message');

        Livewire.on('entry-added', (event) => {

            setTimeout(() => {
                responseMessageElement.style.display = "none";
            }, 3000);

        });


    });
</script>
