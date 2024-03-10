<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create announcement') }}
        </h2>
    </x-slot>

    <div class="pt-4 px-4"> <a href="/announcement"
            class=" w-fit px-4 py-2 flex items-center gap-2 bg-orange-200 hover:bg-orange-300 rounded-md "><svg
                xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left"
                viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                    d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8" />
            </svg></a>
    </div>
    <div class="py-12">
        <div class="flex flex-col items-center shadow-lg rounded-md p-4">
            <form method="POST" action=""enctype="multipart/form-data">
                @csrf
                <!-- Title -->
                <div>
                    <x-input-label for="title" :value="__('Title')" />
                    <x-text-input id="title" class="block mt-1 w-full" type="text" name="title"
                        :value="old('title')" required autofocus autocomplete="title" />
                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                </div>

                <!-- Body -->
                <div class="mt-4">
                    <x-input-label for="body" :value="__('Body')" />
                    <x-text-input id="body" class="block mt-1 w-full" type="text" name="body"
                        :value="old('body')" required autofocus autocomplete="body" />
                    <x-input-error :messages="$errors->get('body')" class="mt-2" />
                </div>

                <!-- Upload photo Cover -->

                <div class="mb-4">
                    <label for="photo" class="block text-sm font-semibold text-gray-600">Add Photo</label>
                    <input type="file" id="photo" name="photo"
                        class="w-full mt-1 p-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500">
                </div>



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
