@props(['title' => null, 'content' => null, 'submitData' => function () {}])
{{-- Where this component is used, the parent needs to have an x-data property called "conformationModalDisplaying" to toggle this modal's display --}}
<div class="w-full flex justify-center">
    <div class="fixed inset-0 transform transition-all">
        <div x-on:click='conformationModalDisplaying = ! conformationModalDisplaying' id="backdrop" class="absolute inset-0 bg-gray-200 opacity-50 hover:cursor-pointer"></div>
    </div>

    <div class="flex flex-col m-4 bg-white rounded-lg overflow-y-auto shadow-xl transform transition-all p-2 fixed">
        <div class="text-lg font-medium text-gray-900">
            {{ $title }}
        </div>

        <div class="mt-4 text-sm text-gray-600">
            {{ $content }}
        </div>

        <div class="flex flex-row gap-2">
        <button wire:click='{{$submitData}}' x-on:click='conformationModalDisplaying = ! conformationModalDisplaying'>Yes</button>
        <button x-on:click='conformationModalDisplaying = ! conformationModalDisplaying'>No</button>
        </div>
    </div>
</div>
