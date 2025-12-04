<div 
    x-cloak 
    x-show="conformationModalDisplaying"
    {{ $attributes }} 
    class="fixed inset-0 z-50 flex items-center justify-center"
    x-transition.opacity
>

    <div class="fixed inset-0 transform transition-all">
        <div x-on:click='conformationModalDisplaying = ! conformationModalDisplaying' id="backdrop" class="absolute inset-0 bg-gray-200 opacity-50 hover:cursor-pointer"></div>
    </div>

    <div 
        class="relative bg-white rounded-xl shadow-2xl w-[70%] max-w-5xl p-6 transform transition-all"
        x-transition.scale.origin.center
    >
        <h2 class="text-xl font-semibold text-gray-900 flex items-center gap-3">
            <span class="inline-block w-2 h-6 bg-emerald-600 rounded-full"></span>
            {{ $title }}
        </h2>

        <div class="mt-4 text-gray-700 leading-relaxed">
            {{ $content }}
        </div>

        <div class="mt-6 flex justify-end gap-3">
            
            <button 
                @click="conformationModalDisplaying = false"
                class="px-4 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-100 transition"
            >
                No
            </button>

            <button 
                @click="$wire.delete(); conformationModalDisplaying = false"
                class="px-4 py-2 rounded-lg bg-emerald-600 text-white font-medium hover:bg-emerald-700 transition"
            >
                Yes
            </button>
        </div>
    </div>

</div>

