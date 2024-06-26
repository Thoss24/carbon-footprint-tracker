@props(['title' => null, 'content' => null])

<div class="flex flex-col fixed inset-0 overflow-y-auto py-6 sm:px-0 z-50 w-full">
    <div class="flex flex-col fixed inset-0 overflow-y-auto py-6 sm:px-0 z-50 w-full">
        <div class="fixed inset-0 transform transition-all">
            <div id="backdrop" class="absolute inset-0 bg-gray-500 opacity-75 hover:cursor-pointer"></div>
        </div>
        <div class="flex flex-col m-4 bg-white rounded-lg overflow-y-auto shadow-xl transform transition-all min-h-96">
            <div>{{ $title }}</div>
            <div>{{ $content }}</div>
        </div>
    </div>
</div>
