<div class="flex flex-col rounded-lg bg-slate-200 w-fit p-2 justify-center items-center shadow-md m-2"
    x-data="{ solutionsDisplaying: false }">

    <div id="flash-container" class="fixed top-10 left-1/2 transform -translate-x-1/2 z-50 flex flex-col items-center"></div>

    <div class="flex flex-col">
        <p class="text-base font-semibold text-gray-800 mb-2">{{ $targetDate }}</p>
        <p class="text-sm font-semibold text-gray-600 mb-2">Reduce co2e of {{$previousCo2e}} by %{{$percentageGoal}}</p>
        <p class="text-sm font-semibold text-gray-600 mb-2">Target date: {{$targetDate}}</p>
    </div>

    @if ($goalSeen == 1 && !$goalAchieved == 0)
        {{-- hidden html - to copy to clipboard start --}}
        <div id="htmlToCopy" style="display: none;">
            {!! $sharedGoalHtmlData !!}
        </div>
        {{-- hidden html - to copy to clipboard end --}}

        {{-- @php 
            echo "Shared goal data" . $sharedGoalHtmlData;
        @endphp --}}

        <div class="mb-4">
            <p class="text-emerald-600 font-medium text-lg">Goal Achieved</p>
            <button class="copyBtn" class="bg-emerald-500 text-white rounded-md px-4 py-2 mt-2 hover:bg-emerald-600 transition duration-200">
                Share
            </button>
        </div>
    @endif

    @if ($goalSeen == 1 && $goalAchieved == 0)
        <div class="mb-4">
            <p class="text-red-600 font-medium text-lg mt-2">Goal Not Achieved</p>
            <button class="bg-emerald-300 text-black rounded-md px-4 py-2 mt-2 hover:bg-emerald-400 transition duration-200"
                    x-on:click="solutionsDisplaying = true">
                Show Solutions
            </button>
        </div>
    @endif

    <!-- Solutions Modal -->
    <div x-show="solutionsDisplaying"
        class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-25 z-50"
        x-on:click.away="solutionsDisplaying = false" style="display: none;">
        <div class="bg-white rounded-lg p-6 w-11/12 md:w-1/3 relative opacity-100">
            <div class="flex flex-row justify-between">
                <h2 class="text-xl font-semibold mb-4">Solutions</h2>
                <button class="text-gray-500 hover:text-gray-800 text-2xl"
                    x-on:click="solutionsDisplaying = false">&times;</button>
            </div>
            <div class="mt-4">
                @foreach ($solutions as $solution)
                    <div
                        class="flex flex-col bg-gray-100 p-4 rounded-lg shadow-sm mb-4 transition-transform transform hover:scale-105">
                        <h2 class="font-semibold text-lg text-gray-800 mb-1">{{ $solution->title }}</h2>
                        <p class="text-gray-700">{{ $solution->description }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>


<script>

if (!window.__copyListenerAttached) {
    window.__copyListenerAttached = true;

    document.addEventListener('click', async (e) => {
        const button = e.target.closest('.copyBtn');
        if (!button) return;

        const el = button.closest('.flex')?.querySelector('#htmlToCopy');
        if (!el) return;

        const blob = new Blob([el.innerHTML], { type: "text/html" });
        const item = [new ClipboardItem({ "text/html": blob })];

        try {
            await navigator.clipboard.write(item);
            showFlashMessage("Goal data copied to clipboard!");
        } catch (err) {
            console.error(err);
            showFlashMessage("Copy failed!");
        }
    });
}


function showFlashMessage(message, duration = 2000) {
    // Create flash div
    const flash = document.createElement('div');
    flash.className = `
        bg-emerald-500 text-white font-semibold px-6 py-3 rounded-lg shadow-lg
        mb-2 opacity-0 transition-opacity duration-300
    `;
    flash.innerText = message;

    // Append to container
    const container = document.getElementById('flash-container');
    container.appendChild(flash);

    // Trigger fade in
    requestAnimationFrame(() => {
        flash.classList.add('opacity-100');
    });

    // Fade out and remove after duration
    setTimeout(() => {
        flash.classList.remove('opacity-100');
        setTimeout(() => flash.remove(), 300); // matches CSS transition duration
    }, duration);
}

document.getElementById('copyBtn').addEventListener('click', async () => {
    const html = document.getElementById('htmlToCopy').innerHTML;

    const blob = new Blob([html], { type: "text/html" });
    const item = [new ClipboardItem({ "text/html": blob })];

    try {
        await navigator.clipboard.write(item);
        console.log("Copied HTML to clipboard", html);
        showFlashMessage("Goal data copied to clipboard!", 2000);
    } catch (err) {
        console.error("Copy failed:", err);
        showFlashMessage("Copy failed!", 2000);
    }
});


</script>