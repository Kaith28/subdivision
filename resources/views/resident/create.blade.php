<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Resident') }}
        </h2>
    </x-slot>
    <div class="pt-4 px-4"> <a href="/resident"
            class=" w-fit px-4 py-2 flex items-center gap-2 bg-orange-200 hover:bg-orange-300 rounded-md "><svg
                xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left"
                viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                    d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8" />
            </svg></a>
    </div>

    <div class="py-12">
        <div class="flex flex-col items-center shadow-lg rounded-md p-4">
            <form method="POST" action="" enctype="multipart/form-data">
                @csrf

                <!-- Position -->
                <div>
                    <x-input-label for="position" :value="__('Resident Type')" />
                    <select name="position" id="position">
                        <option value="owner">Owner</option>
                        <option value="family_member">Family
                            Member
                        </option>
                    </select>
                    <x-input-error :messages="$errors->get('position')" class="mt-2" />
                </div>
                <!-- Name -->
                <div>
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                        :value="old('name')" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Contact no. -->
                <div class="mt-4">
                    <x-input-label for="contact_no" :value="__('Contact no.')" />
                    <x-text-input id="contact_no" class="block mt-1 w-full" type="text" name="contact_no"
                        :value="old('contact_no')" required autofocus autocomplete="contact_no" />
                    <x-input-error :messages="$errors->get('contact_no')" class="mt-2" />
                </div>

                <!-- vehicle type -->
                <div class="mt-4">
                    <x-input-label for="vehicle_type" :value="__('Vehicle Type')" />
                    <x-text-input id="vehicle_type" class="block mt-1 w-full" type="text" name="vehicle_type"
                        placeholder="Brand | Model | Color" :value="old('vehicle_type')" required autofocus
                        autocomplete="vehicle_type" />
                    <x-input-error :messages="$errors->get('vehicle_type')" class="mt-2" />
                </div>
                <!-- Plate no. -->
                <div class="mt-4">
                    <x-input-label for="plate_no" :value="__('Plate no.')" />
                    <x-text-input id="plate_no" class="block mt-1 w-full" type="text" name="plate_no"
                        :value="old('plate_no')" required autofocus autocomplete="plate_no" />
                    <x-input-error :messages="$errors->get('plate_no')" class="mt-2" />
                </div>


                <!-- Address -->
                <div class="mt-4">
                    <x-input-label for="address" :value="__('Address')" />
                    <x-text-input id="address" class="block mt-1 w-full" type="text" name="address"
                        :value="old('address')" required autofocus autocomplete="address" />
                    <x-input-error :messages="$errors->get('address')" class="mt-2" />
                </div>

                <!-- Relatives -->
                <div class="mt-4">
                    <label class="text-sm">Relatives</label>
                    <div class="font-bold text-xs justify text-red-400 italic">Specify only those who are allowed to use
                        your vehicle.
                    </div>
                    <x-text-input id="relatives" class="block mt-1 w-full" type="text" name="relatives"
                        :value="old('relatives')" required autofocus autocomplete="relatives" />
                    <x-input-error :messages="$errors->get('relatives')" class="mt-2" />
                </div>

                <!-- Upload photo -->

                <div class="mt-4">
                    <label class="text-sm">Add Picture</label>
                    <div class="font-bold text-xs justify text-red-400 italic">We will use this to identify if you are
                        really the one using your car.
                    </div>
                    <input type="file" id="photo" name="photo"
                        class="w-full mt-1 p-2 border border-gray-300 rounded focus:outline-none focus:border-orange-300">
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
