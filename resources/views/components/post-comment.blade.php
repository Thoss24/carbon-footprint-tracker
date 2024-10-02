<div class="bg-slate-50 flex flex-col shadow-md p-1 transform transition-all duration-300">
    <div class="flex flex-row gap-2">
        <img class="w-12 h-12 rounded-full border-2 border-emerald-500" src="{{ $profilePhoto }}" alt="Profile Pic">
        {{ $userName }}
    </div>
    <div>
        {{ $content }}
    </div>
</div>
