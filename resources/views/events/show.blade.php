<x-app-layout>
    <div class="pt-4 px-4"> <a href="/events"
            class=" w-fit px-4 py-2 flex items-center gap-2 bg-orange-200 hover:bg-orange-300 rounded-md "><svg
                xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left"
                viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                    d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8" />
            </svg></a>
    </div>
    <div class="py-12 border-solid">
        <div class=" max-w-7xl mx-auto sm:px-6 lg:px-8 flex flex-col gap-4 ">
            <p class="font-bold text-xxl"> Organizer: <span class="font-normal">{{ $event->organizer }}</span></p>
            <p class="font-bold text-xxl"> Address: <span class="font-normal">{{ $event->address }}</span></p>
            <p class="font-bold text-xxl"> Contact no: <span class="font-normal">{{ $event->contact_no }}</span></p>
            <p class="font-bold text-xxl"> Event Location: <span class="font-normal">{{ $event->event_location }}</span>
            </p>
            <p class="font-bold text-xxl"> Event Purpose: <span class="font-normal">{{ $event->event_purpose }}</span>
            </p>
            <p class="font-bold text-xxl"> Estimated Attendees: <span
                    class="font-normal">{{ $event->estimated_attendees }}</span></p>
            <p class="font-bold text-xxl"> Time: <span class="font-normal">{{ $event->time }}</span></p>
        </div>

        <div class=" flex items-end max-w-7xl mx-auto sm:px-10 lg:px-10 flex flex-col gap-4  ">
            <a href={{ route('events.guest.create', $event->id) }} class=" px-4 py-2 hover:bg-gray-200 rounded-md"><svg
                    xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor"
                    class="bi bi-person-fill-add" viewBox="0 0 16 16">
                    <path
                        d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Zm.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0Zm-2-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    <path
                        d="M2 13c0 1 1 1 1 1h5.256A4.493 4.493 0 0 1 8 12.5a4.49 4.49 0 0 1 1.544-3.393C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4Z" />
                </svg></a>
        </div>

        <div class=" max-w-7xl mx-auto sm:px-6 lg:px-8 flex flex-col gap-4 ">
            <table class="w-full  rounded-lg shadow-lg">
                <thead>
                    <tr class="bg-gray-300 rounded-lg">
                        <td class="px-2 text-center font-semibold rounded-tl-lg">In Charge</td>
                        <td class="px-2 text-center font-semibold ">IN</td>
                        <td class="px-2 text-center font-semibold ">OUT</td>
                        <td class="px-2 text-center font-semibold">Guest</td>
                        <td class="px-2 text-center font-semibold">Contact no.</td>
                        <td class="px-2 text-center font-semibold rounded-tr-lg">Actions</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($list as $guest)
                        <tr class="hover:bg-gray-200 rounded-md" rounded-md>
                            <td class="px-2 text-center">{{ $guest['guard'] }}</td>
                            <td class="px-2 text-center text-sm">
                                {{ $guest['created_at'] }}
                            </td>
                            <td class="px-2 text-center text-sm">
                                {{ $guest['out'] }}
                            </td>
                            <td class="px-2 text-center">{{ $guest['name'] }}</td>
                            <td class="px-2 text-center">{{ $guest['contact_no'] }}</td>
                            <td class="px-2 text-center">
                                <div class="flex justify-center gap-2">
                                    <a href={{ route('events.guest.show', [
                                        'id' => $event->id,
                                        'guest_id' => $guest['id'],
                                    ]) }}
                                        class=" px-2 py-2 hover:bg-gray-200 rounded-md"><svg
                                            xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
                                            <path
                                                d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                            <path
                                                d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
                                        </svg></a>
                                </div>
                            </td>
                        </tr>
                    @endforeach




        </div>
        </td>
        </tr>
        </tbody>
        </table>
        <div class="pt-4">
            {{ $guests->links() }}
        </div>
    </div>

    </div>
</x-app-layout>
