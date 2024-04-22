<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Smart Subdivision Security</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased">
    {{-- Hero Section --}}
    <section>
        <div class="flex flex-col gap-4 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
            {{-- Company name --}}
            <h1 class="text-4xl font-bold">{{ $company->name }}</h1>
            {{-- Announcement --}}
            <div class="rounded-md shadow-lg">
                <img class="w-full rounded-t-lg object-cover" src="{{ $announcement['cover_photo'] }}" alt="">
                <div class="flex flex-col gap-2 p-4">
                    <h3 class="text-lg font-bold">{{ $announcement['title'] }}</h3>
                    <div id="body" style="border: none;"></div>
                    <p class="text-sm">{{ $announcement['created_at'] }}</p>
                </div>
            </div>
        </div>
    </section>


    <script>
        // Example Quill content
        var quillContent = `{!! $announcement['body'] !!}`;

        // Initialize Quill in read-only mode
        var quill = new Quill('#body', {
            readOnly: true,
            theme: 'snow',
            modules: {
                toolbar: false // Disable toolbar
            }
        });

        // Set the HTML content
        quill.root.innerHTML = quillContent;
    </script>

</body>

</html>
