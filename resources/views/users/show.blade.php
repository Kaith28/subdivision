<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('View User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto text-center sm:px-6 lg:px-8 dark:text-gray ">
            <h4 style="font-weight: bold;">{{ $user->name }} </h4>
            <p style="font-weight: bold;">{{ $user->address }} </p>
            <p style="font-style: italic;">{{ $user->role }}</p>
            <div>
                
                 <img src="https://chart.googleapis.com/chart?chs=200x200&cht=qr&chl={{ route('users.show', $user->id) }}" alt="QR Code" style="display: block; margin: 0 auto;" width="300">
                
            </div>
            <div class="container bg-secondary p-4">
                <button class="bg-gray-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Download
                  </button>
            </div>
        </div>
    </div>
</x-app-layout>
