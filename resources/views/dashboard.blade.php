<x-app-layout>
    <section>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 mb-5 ">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-20 pt-10 ">
                <div class="flex flex-col items-center shadow-lg rounded-md p-4">
                    <div class="h-20 flex items-center">
                        <h2 class="text-4xl">{{ $totalResidents }}</h2>
                    </div>
                    <p class="text-xl ">
                        TOTAL Residents
                    </p>
                </div>
                <div class="flex flex-col items-center shadow-lg rounded-md p-4">
                    <div class="h-20 flex items-center">
                        <h2 class="text-4xl">{{ $totalInGuests }}</h2>
                    </div>
                    <p class="text-xl ">
                        TOTAL Guests
                    </p>
                    <p class="text-sm">
                        Total Visitors: {{ $totalOutGuests }}
                    </p>
                </div>
                <div class="flex flex-col items-center shadow-lg rounded-md p-4">
                    <div class="h-20 flex items-center">
                        <h2 class="text-4xl">{{ $totalIn }}</h2>
                    </div>
                    <p class="text-xl ">
                        TOTAL IN
                    </p>
                </div>
                <div class="flex flex-col items-center shadow-lg rounded-md p-4">
                    <div class="h-20 flex items-center">
                        <h2 class="text-4xl">{{ $totalOut }}</h2>
                    </div>
                    <p class="text-xl">
                        TOTAL OUT
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Menus -->
    <div class="w-auto max-w-xs ml-auto mb-10">
        <label for="time-period" class="block text-sm font-medium text-center text-gray-700">Select Time Period</label>
        <select id="time-period" name="time-period"
            class="mt-1 ml-28 block w-28 p-2 border border-gray-300 bg-white-300 rounded-md shadow-sm focus:outline-none focus:border-gray-300 focus:ring focus:ring-blue-200">
            <option value="daily">Daily</option>
            <option value="weekly">Weekly</option>
            <option value="monthly">Monthly</option>
            <option value="yearly">Yearly</option>
        </select>
    </div>

    {{-- Bar Chart Here! --}}


</x-app-layout>
