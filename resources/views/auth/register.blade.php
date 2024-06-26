<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Company name -->
        <div class="mt-4">
            <label class="text-sm">Company Name</label>
            <div class="font-bold text-xs justify text-gray-400 italic"> * It will
                be
                used in the
                URL of our
                Bulletin board
            </div>
            <x-text-input id="company_name" class="block mt-1 w-full" type="text" name="company_name"
                :value="old('company_name')" required autofocus autocomplete="company_name" />
            <x-input-error :messages="$errors->get('company_name')" class="mt-2" />
        </div>


        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>


        <!-- Contact no. -->
        <div class="mt-4">
            <x-input-label for="contact_no" :value="__('Contact No.')" />
            <x-text-input id="contact_no" class="block mt-1 w-full" type="text" name="contact_no" :value="old('contact_no')"
                required autofocus autocomplete="contact_no" />
            <x-input-error :messages="$errors->get('contact_no')" class="mt-2" />
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

        <!-- Upload photo -->

        <div class="mt-4">
            <x-input-label for="photo" :value="__('Upload Goverment ID')" />
            <input type="file" id="photo" name="photo"
                class="w-full mt-1 p-2 border border-gray-300 rounded focus:outline-none focus:border-orange-300">
        </div>

        {{-- Terms --}}
        <div class="mt-4 flex flex-col gap-2">
            <div class="flex items-center gap-2">
                <input name="terms" type="checkbox" class="rounded-md">
                <p class="text-sm">I agree to the <a href="/terms" class="underline">Terms of Service</a> and <a
                        href="/policy" class="underline">Privacy
                        Policy</a></p>
            </div>
            @if ($errors->has('terms'))
                <div class="bg-red-200 rounded-md p-2">
                    <p class="text-red-500 text-sm">{{ $errors->first('terms') }}</p>
                </div>
            @endif
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class=" bg-orange-300 hover:bg-orange-200 ml-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
