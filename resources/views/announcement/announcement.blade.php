<x-app-layout>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="mt-4">
            <a class="bg-orange-200 hover:bg-orange-300 shadow-lg w-fit px-4 py-2 rounded-md"
                href="{{ $bulletinBoardUrl }}" target="_blank">
                <button>
                    Go to Bulletin Board
                </button>
            </a>
        </div>
    </div>
    <div class="py-4">
        <div class=" max-w-7xl mx-auto sm:px-6 lg:px-8 ">
            <div class="flex justify-between items-center">
                <form action="{{ route('announcement') }}" method="GET">
                    <div class="flex gap-4">
                        <input class="rounded-md" type="text" name="title" placeholder="Search by title"
                            value="{{ $title }}">
                        <button class="bg-orange-200 hover:bg-orange-300 px-4 py-2 rounded-md "><svg
                                xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-search" viewBox="0 0 16 16">
                                <path
                                    d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                            </svg></button>
                        <a href="{{ route('announcement') }}"
                            class="border border-black hover:bg-orange-200 px-2 py-2 rounded-md ">Clear</a>
                    </div>
                </form>

                @if (Auth::user()->role == 'owner' || Auth::user()->role == 'admin')
                    <a href="{{ route('announcement.create') }}"
                        class=" px-4 py-2 flex items-center gap-2 bg-orange-200 hover:bg-orange-300 rounded-md "><svg
                            xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-person-add" viewBox="0 0 16 16">
                            <path
                                d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Zm.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0Zm-2-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4Z" />
                            <path
                                d="M8.256 14a4.474 4.474 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10c.26 0 .507.009.74.025.226-.341.496-.65.804-.918C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4s1 1 1 1h5.256Z" />
                        </svg>Add</a>
                @endif

            </div>
            <div class="pt-8 ">
                <table class="w-full rounded-lg shadow-lg">
                    <thead>
                        <tr class="bg-gray-300 rounded-lg">
                            <td class="px-2 text-center font-semibold rounded-tl-lg">Title</td>
                            <td class="px-2 text-center font-semibold ">Date</td>
                            <td class="px-2 text-center font-semibold rounded-tr-lg">Actions</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($announcements as $announcement)
                            <tr class="hover:bg-gray-200 rounded-md" rounded-md>
                                <td class="px-2 text-center">{{ $announcement['title'] }}</td>
                                <td class="px-2 text-center">{{ $announcement['created_at'] }}</td>
                                <td class="px-2 text-center">

                                    <div class="flex justify-center gap-2">
                                        @if (Auth::user()->role == 'owner' || Auth::user()->role == 'admin')
                                            <a href={{ route('announcement.edit', $announcement['id']) }}
                                                class=" px-4 py-2 hover:bg-gray-200 rounded-md"><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                    <path
                                                        d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                    <path fill-rule="evenodd"
                                                        d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                                </svg></a>
                                            <form action={{ route('announcement.destroy', $announcement['id']) }}
                                                method="POST">
                                                @csrf
                                                <button class="px-2 py-2 hover:bg-gray-200 rounded-md "><svg
                                                        xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-ban" viewBox="0 0 16 16">
                                                        <path
                                                            d="M15 8a6.973 6.973 0 0 0-1.71-4.584l-9.874 9.875A7 7 0 0 0 15 8M2.71 12.584l9.874-9.875a7 7 0 0 0-9.874 9.874ZM16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0" />
                                                    </svg></button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</x-app-layout>
