<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create GUard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form method="POST" action="">
                @csrf

                <!-- Name -->
                <div>
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"
                        required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email Address -->
                <div class="mt-4">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                        :value="old('email')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" />

                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                        autocomplete="new-password" />

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div class="mt-4">
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                    <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                        name="password_confirmation" required autocomplete="new-password" />

                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <!-- Contact no. -->
                <div class="mt-4">
                    <x-input-label for="contact_no" :value="__('Contact no.')" />
                    <x-text-input id="contact_no" class="block mt-1 w-full" type="text" name="contact_no"
                        :value="old('contact_no')" required autofocus autocomplete="contact_no" />
                    <x-input-error :messages="$errors->get('contact_no')" class="mt-2" />
                </div>

                <!-- Upload photo -->
                {{-- <div class="mt-4">
                    <x-input-label for="photo" :value="__('Photo')" />
                    <x-text-input id="photo" class="block mt-1 w-full" type="file" name="photo"
                        :value="old('photo')" required autofocus autocomplete="photo" />
                    <x-input-error :messages="$errors->get('photo')" class="mt-2" />
                </div> --}}

                <!-- Add -->
                <div class=" mt-4">
                    <x-primary-button>
                        {{ __('Add') }}
                    </x-primary-button>
                </div>

            </form>
        </div>
    </div>
</x-app-layout>