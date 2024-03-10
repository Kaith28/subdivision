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

            <h1 class="text-4xl font-bold">Company Name</h1>

            <div class="flex flex-col gap-6">
                {{-- Card --}}
                <div class="rounded-md shadow-lg cursor-pointer">
                    <img class="w-full h-44 sm:h-96 rounded-t-lg object-cover"
                        src="https://images.pexels.com/photos/1369476/pexels-photo-1369476.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
                        alt="">
                    <div class="flex flex-col gap-2 p-4">
                        <h3 class="text-lg font-bold">Announcement title</h3>
                        <p class="text-sm">Date here</p>
                    </div>
                </div>
                {{-- Card --}}
                <div class="rounded-md shadow-lg cursor-pointer">
                    <img class="w-full h-44 sm:h-96 rounded-t-lg object-cover"
                        src="https://images.pexels.com/photos/1369476/pexels-photo-1369476.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
                        alt="">
                    <div class="flex flex-col gap-2 p-4">
                        <h3 class="text-lg font-bold">Announcement title</h3>
                        <p class="text-sm">Date here</p>
                    </div>
                </div>
                {{-- Card --}}
                <div class="rounded-md shadow-lg cursor-pointer">
                    <img class="w-full h-44 sm:h-96 rounded-t-lg object-cover"
                        src="https://images.pexels.com/photos/1369476/pexels-photo-1369476.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
                        alt="">
                    <div class="flex flex-col gap-2 p-4">
                        <h3 class="text-lg font-bold">Announcement title</h3>
                        <p class="text-sm">Date here</p>
                    </div>
                </div>
            </div>

        </div>
    </section>

</body>

</html>
