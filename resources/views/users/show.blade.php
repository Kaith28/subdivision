<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('View User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 text-white">
            <p>Name: {{ $user->name }}</p>
            <p>Email: {{ $user->email }}</p>
            <p>Role: {{ $user->role }}</p>
            <div>
                <img src="https://chart.googleapis.com/chart?chs=200x200&cht=qr&chl={{ route('users.show', $user->id) }}"
                    alt="">
            </div>
        </div>
    </div>
</x-app-layout>
