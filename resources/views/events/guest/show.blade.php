<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Event Guest') }}
        </h2>
    </x-slot>

    <div class="pt-4 px-4"> <a href="/guest"
            class=" w-fit px-4 py-2 flex items-center gap-2 bg-orange-200 hover:bg-orange-300 rounded-md "><svg
                xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left"
                viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                    d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8" />
            </svg></a>
    </div>
    <div class="flex justify-center gap-4 pt-5">
        <div class="w-fit shadow-md rounded-md">
            <img src="{{ $guest->photo }}" alt="Photo" class="w-60 h-60">
        </div>
        <div>
            <img src="https://quickchart.io/chart?chs=200x200&cht=qr&chl={{ route('events.guest.show', ['id' => $event->id, 'guest_id' => $guest->id]) }}"
                alt="QR Code" class="w-60 h-60">
            <button
                onclick="printImage('{{ route('events.guest.show', ['id' => $event->id, 'guest_id' => $guest->id]) }}', '{{ $guest->name }}')"
                class="w-full bottom-0 text-center cursor-pointer rounded-bl-lg rounded-br-lg bg-orange-300 text-white py-2 hover:bg-orange-200">
                Download QR
            </button>
        </div>
    </div>

    <div class="py-12">
        <div class=" w-full flex justify-center">

            <div class="w-96 grid grid-cols-2">

                <p class="font-bold">Event Name:</p>
                <p>{{ $event->title }}</p>
                <p class="font-bold">Name:</p>
                <p>{{ $guest->name }}</p>
                <p class="font-bold">Contact:</p>
                <p>{{ $guest->contact_no }}</p>

                @if (Auth::user()->role == 'guard')
                    @if ($guest->out == null)
                        <form action="{{ route('events.guest.out', ['id' => $event->id, 'guest_id' => $guest->id]) }}"
                            method="POST">
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

<script>
    function printImage(url, name) {
        const qrCodeUrl = "https://quickchart.io/chart?chs=200x200&cht=qr&chl" + encodeURIComponent(url);
        fetch(qrCodeUrl)
            .then(response => response.blob())
            .then(blob => {
                // Create a temporary anchor element
                var link = document.createElement('a');
                link.href = URL.createObjectURL(blob);
                link.download = `${name}_QR.png`;
                // Programmatically click the anchor element
                link.click();
                // Clean up
                URL.revokeObjectURL(link.href);
            })
            .catch(error => console.error('Error downloading QR code image:', error));
    }
</script>
