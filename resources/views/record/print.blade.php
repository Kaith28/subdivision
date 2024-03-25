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

    <div>
        <table class="w-full">
            <thead>
                <tr class="bg-gray-300 rounded-lg">
                    <td class="px-2 text-center font-semibold rounded-tl-lg">In Charge</td>
                    <td class="px-2 text-center font-semibold">IN</td>
                    <td class="px-2 text-center font-semibold">OUT</td>
                    <td class="px-2 text-center font-semibold">Resident Name</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($list as $record)
                    <tr class="hover:bg-gray-200 rounded-md" rounded-md>
                        <td class="px-2 text-center">{{ $record['guard'] }}</td>
                        <td class="px-2 text-center text-sm">
                            {{ $record['in'] }}
                        </td>
                        <td class="px-2 text-center text-sm">
                            {{ $record['out'] }}
                        </td>
                        <td class="px-2 text-center">{{ $record['user']->name }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        window.print();
    </script>

</body>
