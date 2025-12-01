<div class="bg-gray-50 rounded-lg p-5 hover:border-gray-300 transition-colors duration-200 mb-3">
    <!-- Header with Date and Actions -->
    <div class="flex items-start justify-between mb-3">
        <div class="flex-1">
            <p class="text-xs text-gray-500">
                {{ $time->format('F j, Y \a\t g:i A') }}
            </p>
        </div>
        
        <!-- Action Buttons -->
        <div class="flex items-center space-x-2 ml-4">
            <!-- Edit Button -->
            <button 
                wire:click="edit"
                class="p-2 text-gray-400 hover:text-blue-600 hover:bg-blue-50 rounded-md transition-colors duration-200"
                title="Edit entry"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
            </button>
            
            <!-- Delete Button -->
            <button 
                wire:click="delete"
                wire:confirm="Are you sure you want to delete this journal entry?"
                class="p-2 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-md transition-colors duration-200"
                title="Delete entry"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                </svg>
            </button>
        </div>
    </div>
    
    <!-- Entry Content -->
    <div class="text-gray-700 text-sm leading-relaxed">
        {{ $entry_data }}
    </div>
</div>