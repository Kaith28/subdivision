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
            {{ __('View Tricycle Driver') }}
        </h2>
    </x-slot>
    <div class="pt-4 px-4"> <a href="/tricycledriver"
            class=" w-fit px-4 py-2 flex items-center gap-2 bg-orange-200 hover:bg-orange-300 rounded-md "><svg
                xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                class="bi bi-arrow-left" viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                    d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8" />
            </svg></a>
    </div>

    <div class="flex justify-center gap-4 pt-5">
        <div class="w-fit shadow-md rounded-md">
            <img src="{{ $user->photo }}" alt="Photo" class="w-60 h-60">
            @if (Auth::user()->role == 'admin')
                <form action="{{ route('tricycledriver.change.photo', $user->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <label for="photo">
                        <div
                            class="w-full bottom-0 text-center cursor-pointer rounded-bl-lg rounded-br-lg bg-orange-300 text-white py-2 hover:bg-orange-200">
                            Change Photo
                        </div>
                    </label>
                    <input class="hidden" id="photo" type="file" name="photo" accept="image/*"
                        onchange="this.form.submit()">
                </form>
            @endif
        </div>
        <div>
            <img src="https://quickchart.io/chart?chs=200x200&cht=qr&chl={{ route('tricycledriver.show', $user->id) }}"
                alt="QR Code" class="w-60 h-60">
            @if (Auth::user()->role == 'admin')
                <button onclick="printImage('{{ route('tricycledriver.show', $user->id) }}', '{{ $user->name }}')"
                    class="w-full bottom-0 text-center cursor-pointer rounded-bl-lg rounded-br-lg bg-orange-300 text-white py-2 hover:bg-orange-200">
                    Download QR
                </button>
            @endif

        </div>
    </div>
    <div class="py-12">
        <div class="w-full flex justify-center">

            <div class="w-96 grid grid-cols-2">
                <p class="font-bold">Name:</p>
                <p>{{ $user->name }}</p>
                <p class="font-bold">Contact:</p>
                <p>{{ $user->contact_no }}</p>
                <p class="font-bold">Plate no:</p>
                <p>{{ $user->plate_no }}</p>
                {{-- </div>

                <button class="bg-orange-200 hover:bg-orange-300 text-black font-bold py-2 px-4 rounded">
                    Download
                </button>s
            </div>  --}}
            </div>
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
