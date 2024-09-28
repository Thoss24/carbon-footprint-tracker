<div class="p-4 bg-white rounded-lg shadow-md">
    <h2 class="text-2xl font-semibold text-black underline mb-2">My Journal</h2>
    <form wire:submit='createEntry' action="">
        <fieldset class="flex flex-col mb-4">
            <label for="entry" class="text-sm font-medium text-gray-700">Add Entry</label>
            <textarea wire:model='entry' class="border border-gray-300 rounded-md px-3 py-2 mt-1 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500" 
                   type="text" placeholder="Journal..." required></textarea>
            <button class="mt-2 bg-emerald-500 text-white rounded-md px-4 py-2 hover:bg-emerald-600 transition duration-200" type="submit">
                Add
            </button>
        </fieldset>
    </form>

    <div class="flex flex-col h-96 overflow-y-auto mt-4">
        <h2 class="underline text-lg font-semibold text-black">Previous Journal Entries</h2>
        @foreach ($all_entries as $entry)
            <livewire:journal-entry :time="$entry->created_at" :entry_data="$entry->entry" />
        @endforeach
    </div>
</div>