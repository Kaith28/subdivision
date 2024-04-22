<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Smart Subdivision Security</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased">
    {{-- Hero Section --}}
    <section>
        <div class="flex flex-col gap-4 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
            {{-- Company name --}}
            <h1 class="text-4xl font-bold">{{ $company->name }}</h1>
            {{-- Announcements --}}
            <div class="flex flex-col gap-6">
                @foreach ($announcements as $announcement)
                    <a href="{{ route('bulletin-board.show', ['slug' => $announcement['slug'], 'id' => $announcement['id']]) }}"
                        class="rounded-md shadow-lg cursor-pointer">
                        <img class=" w-full justify-stretch h-24 sm:h-96 rounded-t-lg object-cover"
                            src="{{ $announcement['cover_photo'] }}" alt="">
                        <div class="flex flex-col gap-2 p-4">
                            <h3 class="text-lg font-bold">{{ $announcement['title'] }}</h3>
                            <p class="text-sm">{{ $announcement['created_at'] }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

</body>

</html>
