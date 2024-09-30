<x-form-section submit="updateProfileInformation" class="bg-white rounded-lg shadow-md p-6">
    <x-slot name="title">
        <span class="text-emerald-500 font-bold text-xl">{{ __('Profile Information') }}</span>
    </x-slot>

    <x-slot name="description">
        <p class="text-gray-700">{{ __('Update your account\'s profile information and email address.') }}</p>
    </x-slot>

    <x-slot name="form">
        <!-- Profile Photo -->
        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
            <div x-data="{ photoName: null, photoPreview: null }" class="col-span-6 sm:col-span-4">
                <input type="file" id="photo" class="hidden"
                       wire:model.live="photo"
                       x-ref="photo"
                       x-on:change="
                           photoName = $refs.photo.files[0].name;
                           const reader = new FileReader();
                           reader.onload = (e) => {
                               photoPreview = e.target.result;
                           };
                           reader.readAsDataURL($refs.photo.files[0]);
                       " />

                <x-label for="photo" value="{{ __('Photo') }}" class="font-semibold text-gray-800" />

                <div class="mt-2" x-show="!photoPreview">
                    <img src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}" class="rounded-full h-24 w-24 object-cover border-2 border-emerald-500">
                </div>

                <div class="mt-2" x-show="photoPreview" style="display: none;">
                    <span class="block rounded-full w-24 h-24 bg-cover bg-no-repeat bg-center"
                          x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                    </span>
                </div>

                <x-secondary-button class="mt-2 me-2 bg-emerald-500 text-white" type="button" x-on:click.prevent="$refs.photo.click()">
                    {{ __('Select A New Photo') }}
                </x-secondary-button>

                @if ($this->user->profile_photo_path)
                    <x-secondary-button type="button" class="mt-2 bg-red-500 text-white" wire:click="deleteProfilePhoto">
                        {{ __('Remove Photo') }}
                    </x-secondary-button>
                @endif

                <x-input-error for="photo" class="mt-2" />
            </div>
        @endif

        <!-- Name -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="name" value="{{ __('Name') }}" class="font-semibold text-gray-800" />
            <x-input id="name" type="text" class="mt-1 block w-full border border-gray-300 rounded-md focus:border-emerald-500 focus:ring focus:ring-emerald-500" wire:model="state.name" required autocomplete="name" />
            <x-input-error for="name" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="email" value="{{ __('Email') }}" class="font-semibold text-gray-800" />
            <x-input id="email" type="email" class="mt-1 block w-full border border-gray-300 rounded-md focus:border-emerald-500 focus:ring focus:ring-emerald-500" wire:model="state.email" required autocomplete="username" />
            <x-input-error for="email" class="mt-2" />

            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::emailVerification()) && !$this->user->hasVerifiedEmail())
                <p class="text-sm mt-2 text-gray-600">
                    {{ __('Your email address is unverified.') }}

                    <button type="button" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500" wire:click.prevent="sendEmailVerification">
                        {{ __('Click here to re-send the verification email.') }}
                    </button>
                </p>

                @if ($this->verificationLinkSent)
                    <p class="mt-2 font-medium text-sm text-green-600">
                        {{ __('A new verification link has been sent to your email address.') }}
                    </p>
                @endif
            @endif
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-label for="bio" value="{{ __('Bio') }}" class="font-semibold text-gray-800" />
            <textarea id="bio" maxlength="255" class="mt-1 block w-full border border-gray-300 rounded-md focus:border-emerald-500 focus:ring focus:ring-emerald-500" wire:model="state.bio" required autocomplete="bio">
            </textarea>
            <x-input-error for="name" class="mt-2" />
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-action-message class="me-3" on="saved">
            <span class="text-emerald-500">{{ __('Saved.') }}</span>
        </x-action-message>

        <x-button wire:loading.attr="disabled" wire:target="photo" class="bg-emerald-500 text-white hover:bg-emerald-600">
            {{ __('Save') }}
        </x-button>
    </x-slot>
</x-form-section>