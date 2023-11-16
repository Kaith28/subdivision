<x-app-layout>

    @if (session('success'))
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-3 alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        </div>
    @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- <div class="flex justify-between items-center">
                <form action="{{ route('guest') }}" method="GET">
                    <div class="flex gap-4">
                        <input class="rounded-md" type="text" name="name" placeholder="Search by name"
                            value="{{ $name }}">
                        <button class="bg-orange-200 hover:bg-orange-300 px-4 py-2 rounded-md "><svg
                                xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-search" viewBox="0 0 16 16">
                                <path
                                    d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                            </svg></button>
                        <a href="{{ route('guest') }}"
                            class="border border-black hover:bg-orange-200 px-2 py-2 rounded-md ">Clear</a>
                    </div>
                </form>
            </div> --}}
            <div class="pt-8 ">
                <table class="w-full  rounded-lg shadow-lg">
                    <thead>
                        <tr class="bg-gray-300 rounded-lg">
                            <td class="px-2 text-center font-semibold rounded-tl-lg">IN</td>
                            <td class="px-2 text-center font-semibold ">OUT</td>
                            <td class="px-2 text-center font-semibold">Resident Name</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($records as $record)
                            <tr class="hover:bg-gray-200 rounded-md" rounded-md>
                                <td class="px-2 text-center text-sm">
                                    {{ $record['in'] }}
                                </td>
                                <td class="px-2 text-center text-sm">
                                    {{ $record['out'] }}
                                </td>

                                <td class="px-2 text-center">{{ $record['user']->name }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
