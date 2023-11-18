<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('View Tricycle Driver') }}
        </h2>
    </x-slot>

    <div class="flex justify-center gap-4 pt-5">
        <div class="w-fit shadow-md rounded-md">
            <img src="{{ $user->photo }}" alt="Photo" class="w-60 h-60">
        </div>
        <img src="https://chart.googleapis.com/chart?chs=200x200&cht=qr&chl={{ route('tricycledriver.show', $user->id) }}"
            alt="QR Code" class="w-60 h-60">
    </div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto text-center sm:px-6 lg:px-8 dark:text-gray ">
            <h2 class="font-bold">{{ $user->name }}</h2>
            <p class="font-bold">{{ $user->contact_no }} </p>
            <p class="font-bold">{{ $user->plate_no }} </p>
            <p class="italic">{{ $user->role }}</p>

            {{-- <div class="container bg-secondary p-4 flex flex-col gap-5">
                <div>
                    <button class="bg-orange-200 hover:bg-orange-300 text-black font-bold py-2 px-4 rounded">
                        Download
                    </button>
                </div>
                <div> --}}
            @if (Auth::user()->role == 'guard')
                @if ($user->status == 'in')
                    <form action="{{ route('tricycledriver.out', $user->id) }}" method="POST">
                        @csrf
                        <button class="bg-orange-200 hover:bg-orange-300 text-black font-bold py-2 px-4 rounded">
                            OUT
                        </button>
                    </form>
                @endif
                @if ($user->status == 'out')
                    <form action="{{ route('tricycledriver.in', $user->id) }}" method="POST">
                        @csrf
                        <button class="bg-orange-200 hover:bg-orange-300 text-black font-bold py-2 px-4 rounded">
                            IN
                        </button>
                    </form>
                @endif
            @endif
        </div>
    </div>
    </div>
    </div>
</x-app-layout>
