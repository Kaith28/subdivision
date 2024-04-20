<x-app-layout>
    <div class="py-12 border-solid">
        <div class=" max-w-7xl mx-auto sm:px-6 lg:px-8 flex flex-col gap-4 ">
            <p class="font-bold text-xxl"> Organizer: <span class="font-normal">{{ $event->organizer }}</span></p>
            <p class="font-bold text-xxl"> Address: {{ $event->address }}</p>
            <p class="font-bold text-xxl"> Contact no: {{ $event->contact_no }}</p>
            <p class="font-bold text-xxl"> Event Location: {{ $event->event_location }}</p>
            <p class="font-bold text-xxl"> Event Purpose: {{ $event->event_purpose }}</p>
            <p class="font-bold text-xxl"> Estimated Attendees: {{ $event->estimated_attendees }}</p>
        </div>

        <div class=" max-w-7xl mx-auto sm:px-6 lg:px-8 flex flex-col gap-4 ">
            <a href={{ route('events.guest.create', $event->id) }} class=" px-4 py-2 hover:bg-gray-200 rounded-md"><svg
                    xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-person-fill-add" viewBox="0 0 16 16">
                    <path
                        d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Zm.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0Zm-2-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    <path
                        d="M2 13c0 1 1 1 1 1h5.256A4.493 4.493 0 0 1 8 12.5a4.49 4.49 0 0 1 1.544-3.393C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4Z" />
                </svg></a>
        </div>

    </div>
</x-app-layout>
