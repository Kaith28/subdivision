<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('View Guest') }}
        </h2>
    </x-slot>
    <div class="flex justify-center gap-4 pt-5">
        <div class="w-fit shadow-md rounded-md">
            <img src="{{ $user->photo }}" alt="Photo" class="w-60 h-60">
        </div>
        <img src="https://chart.googleapis.com/chart?chs=200x200&cht=qr&chl={{ route('guest.show', $user->id) }}"
            alt="QR Code" class="w-60 h-60">
    </div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto text-center sm:px-6 lg:px-8 dark:text-gray ">
            <h2 class="font-bold">{{ $user->name }}</h2>
            <p class="font-bold">{{ $user->contact_no }} </p>
            <p class="italic">{{ $user->role }}</p>
            <p class="px-2 text-center text-sm font-bold">
                IN:{{ date('F jS, Y,  g:i a', strtotime($user->created_at)) }}

            </p>
            <div>
                @if (Auth::user()->role == 'admin')
                    @if ($user->out == null)
                        <form action="{{ route('guest.out', $user->id) }}" method="POST">
                            @csrf
                            <button class="bg-orange-200 hover:bg-orange-300 text-black font-bold py-2 px-4 rounded">
                                OUT
                            </button>
                        </form>
                    @endif
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
