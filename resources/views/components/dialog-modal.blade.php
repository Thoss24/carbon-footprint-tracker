@props(['title' => null, 'content' => null])

<div class="w-full">
    <div class="fixed inset-0 transform transition-all">
        <div id="backdrop" class="absolute inset-0 bg-gray-200 opacity-50 hover:cursor-pointer"></div>
    </div>

    <div class="flex flex-col m-4 bg-white rounded-lg overflow-y-auto shadow-xl transform transition-all min-h-96 fixed">
        <div class="text-lg font-medium text-gray-900">
            {{ $title }}
        </div>

        <div class="mt-4 text-sm text-gray-600">
            {{ $content }}
        </div>
    </div>

</div>
