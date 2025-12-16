<div x-data="{ previousTransportEntriesDisplaying: false, conformationModalDisplaying: false }" class="p-4 flex flex-col w-screen sm:flex-row">
    <x-dialog-confirmation-modal title="Add Transport Carbon Footprint Data"
        content="Are you sure you want to submit this data?" submitData='addSecondaryData' />

    <div>
        @if (session()->has('message'))
            <div id="flash-message" class="bg-emerald-100 border border-emerald-400 text-emerald-700 px-4 py-3 rounded relative" role="alert">
                {{ session('message') }}
            </div>
        @endif
    </div>

    <section class="w-full sm:w-1/2">
        <h1 class="underline text-xl font-semibold text-black mb-4">Secondary Carbon Footprint</h1>
        <form action="" >
            @foreach (['food_and_drink', 'pharmaceuticals', 'clothing', 'it_equipment', 'telephone', 'insurance', 'educational'] as $item)
                <fieldset class="mb-4">
                    <label for="{{ $item }}" class="block text-lg font-medium text-black mb-2">{{ ucfirst(str_replace('_', ' ', $item)) }}:</label>
                    <div class="flex flex-col sm:flex-row items-center justify-center space-y-2 sm:space-y-0 sm:space-x-2">
                        <i class="fa-solid fa-sterling-sign"></i>
                        <input wire:model='{{ $item }}' id="{{ $item }}" type="number" class="flex-1 p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-emerald-500" placeholder="Enter amount">
                        <select name="{{ $item }}_metric" wire:model='{{ $item }}' id="{{ $item }}_metric" class="border border-gray-300 rounded-md focus:ring-emerald-500 focus:border-emerald-500">
                            <option value="weekly" selected>Weekly</option>
                        </select>
                    </div>
                </fieldset>
            @endforeach

            <div class="flex flex-col sm:flex-row items-center mt-6">
                <button x-on:click='conformationModalDisplaying = true' type="button" class="w-full sm:w-auto p-2 bg-emerald-500 text-white rounded hover:bg-emerald-600 transition">Add</button>
                <p id="response-message" class="mt-2 sm:mt-0 sm:ml-4 text-emerald-400">
                    @if ($responseMessage)
                        {{ $responseMessage }}
                    @endif
                </p>
            </div>
        </form>
    </section>

    <livewire:carbon-footprint-data-visualisation />
</div>

<script>
    document.addEventListener('livewire:init', () => {
        const responseMessageElement = document.getElementById('response-message');

        Livewire.on('entry-added', (event) => {
            setTimeout(() => {
                responseMessageElement.style.display = "none";
            }, 3000);
        });
    });
</script>