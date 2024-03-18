<x-app-layout>

    @if (session('success'))
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-3 alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        </div>
    @endif

    @if (session('error'))
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pt-4">
            <div class="bg-red-200 border border-red-500 p-2 rounded-md" role="alert">
                {{ session('error') }}
            </div>
        </div>
    @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">

                <form action="{{ route('guest') }}" method="GET">
                    <div class="flex items-end gap-4">
                        <div class="flex flex-col">
                            <label>Search by Name</label>
                            <input class="rounded-md" type="text" name="name" placeholder="Search by name"
                                value="{{ $name }}">
                        </div>
                        <div class="flex flex-col">
                            <label>Start Date</label>
                            <input class="rounded-md" type="date" name="start_date" value="{{ $startDate }}">
                        </div>
                        <div class="flex flex-col">
                            <label>End Date</label>
                            <input class="rounded-md" type="date" name="end_date" value="{{ $endDate }}">
                        </div>
                        <div class="flex gap-4">
                            <button class="bg-orange-200 hover:bg-orange-300 px-4 py-2 rounded-md "><svg
                                    xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-search" viewBox="0 0 16 16">
                                    <path
                                        d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                </svg></button>
                            <a href="{{ route('guest') }}"
                                class="border border-black hover:bg-orange-200 px-2 py-2 rounded-md ">Clear</a>
                        </div>
                    </div>
                </form>
            </div>
            <div class="pt-8 ">
                <table class="w-full  rounded-lg shadow-lg">
                    <thead>
                        <tr class="bg-gray-300 rounded-lg">
                            <td class="px-2 text-center font-semibold rounded-tl-lg">In Charge</td>
                            <td class="px-2 text-center font-semibold ">IN</td>
                            <td class="px-2 text-center font-semibold">Current</td>
                            <td class="px-2 text-center font-semibold ">OUT</td>
                            <td class="px-2 text-center font-semibold">Resident in Charge</td>
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
                                <td id="current-{{ $guest['id'] }}" class="px-2 text-center text-sm">
                                    Loading...
                                </td>
                                <td class="px-2 text-center text-sm">
                                    {{ $guest['out'] }}
                                </td>
                                <td class="px-2 text-center">{{ $guest['user']->name }}</td>
                                <td class="px-2 text-center">{{ $guest['name'] }}</td>
                                <td class="px-2 text-center">{{ $guest['contact_no'] }}</td>
                                <td class="px-2 text-center">

                                    <div class="flex justify-center gap-2">
                                        <a href={{ route('guest.show', $guest['id']) }}
                                            class=" px-2 py-2 hover:bg-gray-200 rounded-md"><svg
                                                xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
                                                <path
                                                    d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                <path
                                                    d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
                                            </svg></a>
                                        @if (Auth::user()->role == 'admin')
                                            <form action={{ route('guest.destroy', $guest['id']) }} method="POST">
                                                @csrf
                                                <button class="px-2 py-2 hover:bg-gray-200 rounded-md "><svg
                                                        xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                        <path
                                                            d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z" />
                                                        <path
                                                            d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z" />
                                                    </svg></button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="pt-4">
                    {{ $guests->links() }}
                </div>
            </div>
        </div>
    </div>

    <script>
        const guests = @json($guests);

        function updateTimers() {
            guests.forEach(guest => {
                const timerElement = document.getElementById(`current-${guest["id"]}`);
                const createdAt = new Date(guest["created_at"]);

                if (guest["out"].length === 0) {
                    // run timer
                    setInterval(() => {
                        const currentTime = new Date()
                        const timeDifference = Math.floor((currentTime - createdAt) / 1000);

                        // Format the time difference as hours, minutes, and seconds
                        const hours = Math.floor(timeDifference / 3600);
                        const minutes = Math.floor((timeDifference % 3600) / 60);
                        const seconds = timeDifference % 60;

                        timerElement.innerText = `${hours}h ${minutes}m ${seconds}s`;
                    }, 1000);
                } else {
                    const out = new Date(guest["out"]);
                    const timeDifference = Math.floor((out - createdAt) / 1000);

                    // Format the time difference as hours, minutes, and seconds
                    const hours = Math.floor(timeDifference / 3600);
                    const minutes = Math.floor((timeDifference % 3600) / 60);
                    const seconds = timeDifference % 60;

                    timerElement.innerText = `${hours}h ${minutes}m ${seconds}s`;
                }

            });
        }

        // Run the updateTimers function when the page loads
        document.addEventListener('DOMContentLoaded', () => {
            updateTimers();
        });
    </script>
</x-app-layout>
