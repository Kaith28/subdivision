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
            {{ __('Users') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
                <form action="{{ route('users') }}" method="GET">
                    <div class="flex gap-4">
                        <input class="rounded-md" type="text" name="name" placeholder="Search by name" value="{{ $name }}">
                        <select class="rounded-md"name="role" id="role">
                            <option value="">All</option>
                            <option {{ $role === 'admin' ? 'selected' : '' }} value="admin">Admin</option>
                            <option {{ $role === 'guard' ? 'selected' : '' }} value="guard">Guard</option>
                            <option {{ $role === 'resident' ? 'selected' : '' }} value="resident">Resident</option>
                            <option {{ $role === 'driver' ? 'selected' : '' }} value="driver">Tricycle Driver</option>
                        </select>
                        <button class="bg-blue-100 px-4 py-2 rounded-md">Search</button>
                    </div>
                </form>
                <a href="{{ route('users.create') }}" class="bg-blue px-4 py-2 rounded-md">Add</a>
            </div>
            <div class="pt-5 ">  
                <table class="w-full bg-gray-100 rounded-md ">
                    <thead class="bg-orange-200">
                        <tr>
                            <td>ID Picture</td>
                            <td>Name</td>
                            <td>Contact no.</td>
                            <td>Role</td>
                            <td class="text-center">Actions</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>Picture</td>
                                <td>{{ $user->name }}</td>
                                <td>Contact</td>
                                <td>{{ $user->role }}</td>
                                <td>
                                    <div class="flex justify-center gap-2">
                                        <a href={{ route('users.show', $user->id) }}
                                            class="bg-gray-300 px-2 py-2 rounded-md flex gap-2">View</a>
                                        <a href={{ route('users.edit', $user->id) }}
                                            class="bg-blue-300 px-4 py-2 rounded-md flex gap-2">Edit</a>
                                        <form action={{ route('users.destroy', $user->id) }} method="POST">
                                            @csrf
                                            <button class="bg-red-500 px-2 py-2 rounded-md">Delete</button>
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
