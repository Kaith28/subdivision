<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('View Guard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto text-center sm:px-6 lg:px-8 dark:text-gray ">
            <h2 class="font-bold">{{ $user->name }}</h2>
            <p class="font-bold">{{ $user->email }} </p>
            <p class="font-bold">{{ $user->contact_no }} </p>
            <p class="italic">{{ $user->role }}</p>
            <div>

                <img src="https://chart.googleapis.com/chart?chs=200x200&cht=qr&chl={{ route('guard.show', $user->id) }}"
                    alt="QR Code" style="display: block; margin: 0 auto;" width="300">

            </div>
            <div class="container bg-secondary p-4">
                <button class="bg-orange-200 hover:bg-orange-300 text-black font-bold py-2 px-4 rounded">
                    Download
                </button>
            </div>
        </div>
    </div>
</x-app-layout>
