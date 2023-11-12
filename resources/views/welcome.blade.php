<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>subdivision</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">


        {{-- Navbar --}}
        @if (Route::has('login'))
            <div class="flex justify-end">
                @auth
                    <a href="{{ url('/dashboard') }}"
                        class="font-semibold text-black hover:text-gray-900  focus:outline focus:outline-2 focus:rounded-sm focus:outline-gray-500">Dashboard</a>
                @else
                    <a href="{{ route('login') }}"
                        class="font-semibold text-black hover:text-gray-900  focus:outline focus:outline-2 focus:rounded-sm focus:outline-gray-500">Log
                        in</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                            class="ml-4 font-semibold text-black hover:text-gray-900  focus:outline focus:outline-2 focus:rounded-sm focus:outline-gray-500">Register</a>
                    @endif
                @endauth
            </div>
        @endif
    </div>

    {{-- Features Section --}}
    <section>
        <div class="text-center pb-5">
            <h2 class="text-4xl">Our Features</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4">
            <div class="flex flex-col items-center">
                <img class="w-52 h-52" src="/Personalized.svg" alt="">
                <p class="text-3xl ">
                    Personalized
                </p>
            </div>
            <div class="flex flex-col items-center">
                <img class="w-52 h-52" src="/QrCodes.png" alt="">
                <p class="text-3xl ">
                    Qr Codes
                </p>
            </div>
            <div class="flex flex-col items-center">
                <img class="w-52 h-52" src="/UserFriendly.svg" alt="">
                <p class="text-3xl">
                    User Friendly
                </p>
            </div>
            <div class="flex flex-col items-center">
                <img class="w-52 h-52" src="/DataPrivacy.svg" alt="">
                <p class="text-3xl ">
                    Data Privacy
                </p>
            </div>


        </div>

    </section>
         
</body>
<footer>
    <div class="p.10 bg-gray-800 text-gray-200">
        <div class="max-w-7x1 mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-2">
                <div class="mb-4">
                    <h4 class="text-2xl pb-4">Subdivision</h4>
                    <p class="text-gray-500">
                        VRG4+8V5, Malolos, Bulacan<br><br>
                    <strong>Phone:</strong>09198683529<br>
                    <strong>Email:</strong>Bertty@gmail.com<br>
                </div>
                <div class="mb-4">
                    <h4>Link</h4>
                    <ul class="text-gray-500">
                        <li class="pb-4"><a href="#" class="hover:text-green-500">Home</a> </li>
                        <li class="pb-4"><a href="#" class="hover:text-green-500">About Us</a></li>
                        <li class="pb-4"><a href="#" class="hover:text-green-500">Privacy Policy</a></li>
                    </ul> 
                </div>
                <div class="mb-4">
                    <h4>Join Our Subdivision</h4>
                    <p class="text-gray-500 pb-2"> 10,000+ resident in Our Subdivision</p>
                </div>
                <div class="w-full bg-gray-900 text-gray-500 px-10">
                    </div>
            </div>
        </div>
    </div>
    <div class="w-full bg-gray-900 text-gray-500 px-10">
        <div>
            <div>
                <div>
                    Copyright <strong><span> Subdivision </span></strong> . All rights Reserved
                </div>
                <div>
                    Designed By <a href="#" class="text-yellow-600">Berty</a>
                </div>
            </div>
        </div>
    </div>
            </footer> 
</html>
