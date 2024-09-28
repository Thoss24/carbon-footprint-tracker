<x-action-section class="bg-white rounded-lg shadow-md p-6">
    <x-slot name="title">
        <span class="text-emerald-500 font-bold text-xl">{{ __('Delete Account') }}</span>
    </x-slot>

    <x-slot name="description">
        <p class="text-gray-700">{{ __('Permanently delete your account.') }}</p>
    </x-slot>

    <x-slot name="content">
        <div class="max-w-xl text-sm text-gray-600">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </div>

        <div class="mt-5">
            <x-danger-button wire:click="confirmUserDeletion" wire:loading.attr="disabled" class="bg-red-500 hover:bg-red-600 text-white">
                {{ __('Delete Account') }}
            </x-danger-button>
        </div>

        <!-- Delete User Confirmation Modal -->
        <x-dialog-modal wire:model.live="confirmingUserDeletion" class="bg-white rounded-lg shadow-md">
            <x-slot name="title">
                <span class="text-emerald-500 font-bold">{{ __('Delete Account') }}</span>
            </x-slot>

            <x-slot name="content">
                <p>{{ __('Are you sure you want to delete your account? Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}</p>

                <div class="mt-4" x-data="{}" x-on:confirming-delete-user.window="setTimeout(() => $refs.password.focus(), 250)">
                    <x-input type="password" class="mt-1 block w-3/4 border border-gray-300 rounded-md focus:border-emerald-500 focus:ring focus:ring-emerald-500"
                                autocomplete="current-password"
                                placeholder="{{ __('Password') }}"
                                x-ref="password"
                                wire:model="password" 
                    />

                    <x-input-error for="password" class="mt-2" />
                </div>
            </x-slot>

            <x-slot name="footer">
                <x-secondary-button wire:click="$toggle('confirmingUserDeletion')" wire:loading.attr="disabled" class="bg-gray-300 text-gray-800 hover:bg-gray-400">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button class="ms-3 bg-red-500 hover:bg-red-600 text-white" wire:click="deleteUser" wire:loading.attr="disabled">
                    {{ __('Delete Account') }}
                </x-danger-button>
            </x-slot>
        </x-dialog-modal>
    </x-slot>
</x-action-section>