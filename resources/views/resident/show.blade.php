<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('View Admin') }}
        </h2>
    </x-slot>

    <div class="flex justify-center gap-4 pt-5">
        <div class="w-fit shadow-md rounded-md">
            <img src="{{ $user->photo }}" alt="Photo" class="w-60 h-60">
        </div>
        <img src="https://chart.googleapis.com/chart?chs=200x200&cht=qr&chl={{ route('resident.show', $user->id) }}"
            alt="QR Code" class="w-60 h-60">
    </div>
    <div class="py-12">
        <div class=" w-full flex justify-center">

            <div class="w-96 grid grid-cols-2">
                <p class="font-bold">Name:</p>
                <p>{{ $user->name }}</p>
                <p class="font-bold">Contact:</p>
                <p>{{ $user->contact_no }}</p>
                <p class="font-bold">Plate no:</p>
                <p>{{ $user->plate_no }}</p>
                <p class="font-bold">Address:</p>
                <p>{{ $user->address }}</p>
                <p class="font-bold">Role:</p>
                <p>{{ $user->role }}</p>
                {{-- </div>

                <button class="bg-orange-200 hover:bg-orange-300 text-black font-bold py-2 px-4 rounded">
                    Download
                </button>s
            </div>  --}}
            </div>
            <div>
                @if (Auth::user()->role == 'guard')
                    @if ($user->status == 'in')
                        <form action="{{ route('resident.out', $user->id) }}" method="POST">
                            @csrf
                            <button class="bg-orange-200 hover:bg-orange-300 text-black font-bold py-2 px-4 rounded">
                                OUT
                            </button>
                        </form>
                    @endif
                    @if ($user->status == 'out')
                        <form action="{{ route('resident.in', $user->id) }}" method="POST">
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
</x-app-layout>
