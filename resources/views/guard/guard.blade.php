<x-app-layout>

    @if (session('success'))
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-3 alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        </div>
    @endif

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Guard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
                <form action="{{ route('guard') }}" method="GET">
                    <div class="flex gap-4">
                        <input class="rounded-md" type="text" name="name" placeholder="Search by name"
                            value="{{ $name }}">
                        <button class="bg-orange-200 hover:bg-orange-300 px-4 py-2 rounded-md "><svg
                                xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-search" viewBox="0 0 16 16">
                                <path
                                    d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                            </svg></button>
                        <a href="{{ route('guard') }}"
                            class="border border-black hover:bg-orange-200 px-2 py-2 rounded-md ">Clear</a>
                    </div>
                </form>
                <a href="{{ route('guard.create') }}"
                    class=" px-4 py-2 flex items-center gap-2 bg-orange-200 hover:bg-orange-300 rounded-md "><svg
                        xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-person-add" viewBox="0 0 16 16">
                        <path
                            d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Zm.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0Zm-2-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4Z" />
                        <path
                            d="M8.256 14a4.474 4.474 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10c.26 0 .507.009.74.025.226-.341.496-.65.804-.918C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4s1 1 1 1h5.256Z" />
                    </svg>Add</a>
            </div>
            <div class="pt-8 ">
                <table class="w-full  rounded-lg shadow-lg">
                    <thead>
                        <tr class="bg-gray-300 rounded-lg">
                            <td class="px-2 rounded-tl-lg">ID Picture</td>
                            <td class="px-2">Name</td>
                            <td class="px-2">Email</td>
                            <td class="px-2">Contact no.</td>
                            <td class="px-2">Role</td>
                            <td class="px-2 rounded-tr-lg text-center">Actions</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr class="hover:bg-gray-200 rounded-md" rounded-md>
                                <td class="px-2 ">Picture</td>
                                <td class="px-2">{{ $user->name }}</td>
                                <td class="px-2">{{ $user->email }}</td>
                                <td class="px-2">{{ $user->contact_no }}</td>
                                <td class="px-2">{{ ucfirst($user->role) }}</td>
                                <td class="px-2">
                                     <div class="flex justify-center gap-2">
                                        <a href={{ route('users.show', $user->id) }}
                                            class=" px-2 py-2 hover:bg-gray-200 rounded-md"><svg
                                                xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
                                                <path
                                                    d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                <path
                                                    d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
                                            </svg></a>
                                     </div>
                                        </form>
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
