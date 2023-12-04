<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Resident') }}
        </h2>
    </x-slot>

    {{--  @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif --}}

    <div class="py-4">
        <div class="flex flex-col items-center shadow-lg rounded-md p-4">
            <form method="POST" action={{ route('resident.update', ['id' => $user->id]) }}>
                @csrf

                <!-- position -->
                <div class="mt-4">
                    <x-input-label for="position" :value="__('Position')" />
                    <select name="position" id="position">
                        <option {{ $user->position == 'owner' ? 'selected' : '' }} value="owner">Owner</option>
                        <option {{ $user->position == 'family_member' ? 'selected' : '' }} value="family_member">Family
                            Member
                        </option>
                    </select>
                    <x-input-error :messages="$errors->get('position')" class="mt-2" />
                </div>

                <!-- Name -->
                <div class="mt-4">
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name" class="block mt-1 w-96" type="text" name="name" :value="$user->name"
                        required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!--- contact -->
                <div class="mt-4">
                    <x-input-label for="contact_no" :value="__('Contact no.')" />
                    <x-text-input id="contact_no" class="block mt-1 w-96" type="text" name="contact_no"
                        :value="$user->contact_no" required autofocus autocomplete="contact_no" />
                    <x-input-error :messages="$errors->get('contact_no')" class="mt-2" />
                </div>

                <!--- vehicle type -->
                <div class="mt-4">
                    <x-input-label for="vehicle_type" :value="__('Vehicle Type')" />
                    <x-text-input id="vehicle_type" class="block mt-1 w-96" type="text" name="vehicle_type"
                        :value="$user->vehicle_type" required autofocus autocomplete="vehicle_type" />
                    <x-input-error :messages="$errors->get('vehicle_type')" class="mt-2" />
                </div>

                <!--- plate -->
                <div class="mt-4">
                    <x-input-label for="plate_no" :value="__('Plate no.')" />
                    <x-text-input id="plate_no" class="block mt-1 w-96" type="text" name="plate_no"
                        :value="$user->plate_no" required autofocus autocomplete="plate_no" />
                    <x-input-error :messages="$errors->get('plate_no')" class="mt-2" />
                </div>

                <!-- Address -->
                <div class="mt-4">
                    <x-input-label for="address" :value="__('Address')" />
                    <x-text-input id="address" class="block mt-1 w-96 " type="text" name="address"
                        :value="$user->address" required autofocus autocomplete="address" />
                    <x-input-error :messages="$errors->get('address')" class="mt-2" />
                </div>

                <!-- Relatives -->
                <div class="mt-4">
                    <x-input-label for="relatives" :value="__('Relatives')" />
                    <x-text-input id="relatives" class="block mt-1 w-96 " type="text" name="relatives"
                        :value="$user->relatives" required autofocus autocomplete="relatives" />
                    <x-input-error :messages="$errors->get('relatives')" class="mt-2" />
                </div>


                <div class="mt-4">
                    <button type="submit" class="bg-orange-200 px-4 py-2 rounded-md">Update</button>
                </div>

            </form>
        </div>
    </div>
</x-app-layout>
