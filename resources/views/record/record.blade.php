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
            <div class="flex justify-between items-center">
                <form action="{{ route('record') }}" method="GET">
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
                            <a href="{{ route('record') }}"
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
                            <td class="px-2 text-center font-semibold">IN</td>
                            <td class="px-2 text-center font-semibold">OUT</td>
                            <td class="px-2 text-center font-semibold">Resident Name</td>
                            <td class="px-2 text-center font-semibold rounded-tr-lg">Actions</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($records as $record)
                            <tr class="hover:bg-gray-200 rounded-md" rounded-md>
                                <td class="px-2 text-center">{{ $record['guard'] }}</td>
                                <td class="px-2 text-center text-sm">
                                    {{ $record['in'] }}
                                </td>
                                <td class="px-2 text-center text-sm">
                                    {{ $record['out'] }}
                                </td>

                                <td class="px-2 text-center">{{ $record['user']->name }}</td>
                                <td class="px-2 text-center">
                                    <div class="flex justify-center gap-2">
                                        <a href={{ route($record['user']->role === 'resident' ? 'resident.show' : 'tricycledriver.show', $record['user']['id']) }}
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
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
