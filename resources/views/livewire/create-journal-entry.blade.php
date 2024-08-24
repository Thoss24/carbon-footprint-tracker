<div class="p-2">
    <form wire:submit='createEntry' action="">
        <fieldset class="flex flex-col justify-start">
        <label for="">Add entry</label>
        <input wire:model='entry' class="w-fit" type="text" placeholder="Journal..">
        <button class="w-fit" type="submit">Add</button>
        </fieldset>
    </form>
    <div class="flex flex-col h-96 overflow-y-auto">
        <h2 class="underline text-lg">Previous journal entries</h2>
        @foreach ($all_entries as $entry)
            <livewire:journal-entry :time="$entry->created_at" :entry_data="$entry->entry"/>
        @endforeach
    </div>
</div>
