
{{-- Where this component is used, the parent needs to have an x-data property called "conformationModalDisplaying" to toggle this modal's display --}}
{{-- <div x-cloak class="w-full h-full flex justify-center relative" {{ $attributes }} x-show='conformationModalDisplaying'>
    <div class="fixed inset-0 transform transition-all">
        <div x-on:click='conformationModalDisplaying = ! conformationModalDisplaying' id="backdrop" class="absolute inset-0 bg-gray-200 opacity-50 hover:cursor-pointer"></div>
    </div>

    <div class="flex flex-col m-4 bg-white rounded-lg overflow-y-auto shadow-xl transform transition-all p-2 fixed top-20 ">
        <div class="text-lg font-medium text-gray-900">
            {{ $title }}
        </div>

        <div class="mt-4 text-sm text-gray-600">
            {{ $content }}
        </div>

        <div class="flex flex-row gap-2">
        <button x-on:click='$wire.delete(); conformationModalDisplaying = ! conformationModalDisplaying'>Yes</button>
        <button x-on:click='conformationModalDisplaying = ! conformationModalDisplaying'>No</button>
        </div>
    </div>
</div> --}}



{{-- Parent must define: x-data="{ conformationModalDisplaying:false }" --}}
<div 
    x-cloak 
    x-show="conformationModalDisplaying"
    {{ $attributes }} 
    class="fixed inset-0 z-50 flex items-center justify-center"
    x-transition.opacity
>

    {{-- Backdrop --}}
    <div class="fixed inset-0 transform transition-all">
        <div x-on:click='conformationModalDisplaying = ! conformationModalDisplaying' id="backdrop" class="absolute inset-0 bg-gray-200 opacity-50 hover:cursor-pointer"></div>
    </div>

    {{-- Modal Panel --}}
    <div 
        class="relative bg-white rounded-xl shadow-2xl w-[70%] max-w-5xl p-6 transform transition-all"
        x-transition.scale.origin.center
    >
        {{-- Title --}}
        <h2 class="text-xl font-semibold text-gray-900 flex items-center gap-3">
            <span class="inline-block w-2 h-6 bg-emerald-600 rounded-full"></span>
            {{ $title }}
        </h2>

        {{-- Content --}}
        <div class="mt-4 text-gray-700 leading-relaxed">
            {{ $content }}
        </div>

        {{-- Footer Buttons --}}
        <div class="mt-6 flex justify-end gap-3">
            
            {{-- Cancel --}}
            <button 
                @click="conformationModalDisplaying = false"
                class="px-4 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-100 transition"
            >
                No
            </button>

            {{-- Confirm --}}
            <button 
                @click="$wire.delete(); conformationModalDisplaying = false"
                class="px-4 py-2 rounded-lg bg-emerald-600 text-white font-medium hover:bg-emerald-700 transition"
            >
                Yes
            </button>
        </div>
    </div>

</div>

