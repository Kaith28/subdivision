<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Admin') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="flex flex-col items-center shadow-lg rounded-md p-4">
            <form method="POST" action={{ route('admin.update', $user->id) }}>
                @csrf

                <!-- Name -->
                <div class="mt-4">
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="$user->name"
                        required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email Address -->
                <div class="mt-4">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                        :value="$user->email" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!--- contact -->
                <div class="mt-4">
                    <x-input-label for="contact_no" :value="__('Contact no.')" />
                    <x-text-input id="contact_no" class="block mt-1 w-full" type="text" name="contact_no"
                        :value="$user->contact_no" required autofocus autocomplete="contact_no" />
                    <x-input-error :messages="$errors->get('contact_no')" class="mt-2" />
                </div>


                {{--   <!-- Upload photo -->
                <div class="mt-4">
                    <x-input-label for="photo" :value="__('Add Photo')" />
                    <x-text-input id="photo" class="block mt-1 w-full" type="file" name="photo" required
                        autofocus autocomplete="photo" />
                    <x-input-error :messages="$errors->get('photo')" class="mt-2" />
                </div> --}}

                <!-- Add -->
                <div class="mt-4">
                    <button type="submit" class="bg-orange-200 px-4 py-2 rounded-md">Update</button>
                </div>

            </form>
        </div>
    </div>
</x-app-layout>
