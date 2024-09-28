<x-form-section submit="updatePassword" class="bg-white rounded-lg shadow-md p-6">
    <x-slot name="title">
        <span class="text-emerald-500 font-bold text-xl">{{ __('Update Password') }}</span>
    </x-slot>

    <x-slot name="description">
        <p class="text-gray-700">{{ __('Ensure your account is using a long, random password to stay secure.') }}</p>
    </x-slot>

    <x-slot name="form">
        <div class="col-span-6 sm:col-span-4">
            <x-label for="current_password" value="{{ __('Current Password') }}" class="font-semibold text-gray-800" />
            <x-input id="current_password" type="password" class="mt-1 block w-full border border-gray-300 rounded-md focus:border-emerald-500 focus:ring focus:ring-emerald-500" wire:model="state.current_password" autocomplete="current-password" />
            <x-input-error for="current_password" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-label for="password" value="{{ __('New Password') }}" class="font-semibold text-gray-800" />
            <x-input id="password" type="password" class="mt-1 block w-full border border-gray-300 rounded-md focus:border-emerald-500 focus:ring focus:ring-emerald-500" wire:model="state.password" autocomplete="new-password" />
            <x-input-error for="password" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" class="font-semibold text-gray-800" />
            <x-input id="password_confirmation" type="password" class="mt-1 block w-full border border-gray-300 rounded-md focus:border-emerald-500 focus:ring focus:ring-emerald-500" wire:model="state.password_confirmation" autocomplete="new-password" />
            <x-input-error for="password_confirmation" class="mt-2" />
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-action-message class="me-3" on="saved">
            <span class="text-emerald-500">{{ __('Saved.') }}</span>
        </x-action-message>

        <x-button class="bg-emerald-500 text-white hover:bg-emerald-600 focus:ring-2 focus:ring-emerald-300">
            {{ __('Save') }}
        </x-button>
    </x-slot>
</x-form-section>