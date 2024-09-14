<div x-data="{ previousTransportEntriesDisplaying: false, conformationModalDisplaying: false }" class="p-2">

    <x-dialog-confirmation-modal title="Add Transport Carbon Footprint Data"
        content="Are you sure you want to submit this data?" submitData='addSecondaryData' />

    <h1 class="underline text-xl">Secondary carbon footprint</h1>

    {{-- Car transport data --}}
    <section>
        <h2 class="underline text-xl">Secondary Data</h2>
        <form action="">
            <fieldset class="flex flex-row">
                <label for="food_and_drink">Food and Drink: </label>
                <p>£ </p>
                <input wire:model='food_and_drink' id="food_and_drink" type="number">
                <select name="food_and_drink" wire:model='food_and_drink' id="food_and_drink">
                    <option value="miles" selected>Weekly</option>
                </select>
            </fieldset>
            <fieldset class="flex flex-row">
                <label for="pharmaceuticals">Pharmaceuticals: </label>
                <p>£ </p>
                <input wire:model='pharmaceuticals' id="pharmaceuticals" type="number">
                <select name="pharmaceuticals" wire:model='pharmaceuticals' id="pharmaceuticals">
                    <option value="miles" selected>Weekly</option>
                </select>
            </fieldset>
            <fieldset class="flex flex-row">
                <label for="clothing">Clothing: </label>
                <p>£ </p>
                <input wire:model='clothing' id="clothing" type="number">
                <select name="clothing" wire:model='clothing' id="clothing">
                    <option value="miles" selected>Weekly</option>
                </select>
            </fieldset>
            <fieldset class="flex flex-row">
                <label for="it_equipment">IT Equipment: </label>
                <p>£ </p>
                <input wire:model='it_equipment' id="it_equipment" type="number">
                <select name="it_equipment" wire:model='it_equipment' id="it_equipment">
                    <option value="miles" selected>Weekly</option>
                </select>
            </fieldset>
            <fieldset class="flex flex-row">
                <label for="telephone">Telephone: </label>
                <p>£ </p>
                <input wire:model='telephone' id="telephone" type="number">
                <select name="telephone" wire:model='telephone' id="telephone">
                    <option value="miles" selected>Weekly</option>
                </select>
            </fieldset>
            <fieldset class="flex flex-row">
                <label for="insurance">Insurance: </label>
                <p>£ </p>
                <input wire:model='insurance' id="insurance" type="number">
                <select name="insurance" wire:model='insurance' id="insurance">
                    <option value="miles" selected>Weekly</option>
                </select>
            </fieldset>
            <fieldset class="flex flex-row">
                <label for="educational">Educational: </label>
                <p>£ </p>
                <input wire:model='educational' id="educational" type="number">
                <select name="educational" wire:model='educational' id="insurance">
                    <option value="miles" selected>Weekly</option>
                </select>
            </fieldset>

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

    <livewire:carbon-footprint-data-visualisation />

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
