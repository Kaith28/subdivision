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
                        class="font-semibold text-black hover:text-gray-900  focus:outline-2 focus:outline-2 focus:rounded-sm focus:outline-gray-500 pt-10">Log
                        in</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                            class="ml-4 font-semibold text-black hover:text-gray-900  focus:outline-2  focus:outline-2 focus:rounded-sm focus:outline-gray-500 pt-10 pl-5">Register</a>
                    @endif
                @endauth
            </div>
        @endif
    </div>

    {{-- Hero Section --}}
    <section>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 ">
            <div class="flex items-center">
                <div class="flex flex-col gap-4">
                    <h1 class="text-3xl font-bold">
                        Smart Subdivision
                        <br>
                        <span class="text-green-700">Security</span>
                    </h1>
                    <p class="text-lg font-medium">
                        Where Security Meets Innovation: Your Community's Shield.
                    </p>
                    <a href="/register" class="bg-orange-200 shadow-md rounded-md px-4 py-2 hover:bg-orange-300 w-fit">
                        Get Started
                    </a>
                </div>

                <div class="flex-1 flex justify-center">
                    <img class="h-[400px]" src="/Hero.svg" alt="">
                </div>
            </div>
        </div>


    </section>


    {{-- Features Section --}}
    <section>
        <div class="text-center pb-20">
            <h2 class="text-4xl"><b>Our Features</b></h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 pb-10">
            <div class="flex flex-col items-center">
                <img class="w-52 h-52" src="/Personalized.svg" alt="">
                <p class="text-3xl ">
                    Personalized
                </p>
            </div>
            <div class="flex flex-col items-center pb-20">
                <img class="w-52 h-52" src="/QrCodes.png" alt="">
                <p class="text-3xl ">
                    Qr Codes
                </p>
            </div>
            <div class="flex flex-col items-center pb-20">
                <img class="w-52 h-52" src="/UserFriendly.svg" alt="">
                <p class="text-3xl">
                    User Friendly
                </p>
            </div>
            <div class="flex flex-col items-center pb-20">
                <img class="w-52 h-52" src="/DataPrivacy.svg" alt="">
                <p class="text-3xl ">
                    Data Privacy
                </p>
            </div>


        </div>

    </section>



    {{-- How to reach us section --}}
    <section>
        <div class="text-center pb-20 pt-5">
            <h2 class="text-4xl"><b>How to reach us?</b></h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 pb-20">
            <div class="flex flex-col items-center">
                <img class="w-20 h-20" src="/emaillogo.png" alt="">
                <p class="text-xl ">
                    smart_subdivisionsecurity@gmail.com
                </p>
            </div>
            <div class="flex flex-col items-center">
                <img class="w-20 h-20" src="" alt="">
                <p class="text-xl ">
                    Smart Subdivision Security
                </p>
            </div>
            <div class="flex flex-col items-center">
                <img class="w-20 h-20" src="" alt="">
                <p class="text-xl">
                    @smartsubdivision_security
                </p>
            </div>
            <div class="flex flex-col items-center">
                <img class="w-20 h-20" src="/calllogo.png" alt="">
                <p class="text-xl ">
                    +63 912 3456 789
                </p>
            </div>


        </div>

    </section>

</body>





{{-- footer --}}

<footer class="bg-gray-900 text-white p-4">
    <div class="container mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">

            <!-- System Information with Logo -->
            <div class="mb-4 flex items-center mt-6">
                <img src="/logo.png" alt="" class="h-10 mr-5">
                <div>
                    <h3 class="text-xl font-semibold mb-2">Smart Subdivision Security</h3>
                    <p style="font-style: italic;"> Where Security Meets Innovation: Your Community's Shield.</p>
                </div>
            </div>

            <!-- Contact Information -->
            <div class="mb-4 mt-6 pl-5">
                <h3 class="text-xl font-semibold mb-2">Contact Us</h3>
                <p class="text-sm">Email: info@smartsubdivisionsecurity.com</p>
                <p class="text-sm">Phone: +123 456 7890</p>
            </div>

            <!-- Social Media Links -->
            <div>
                <h3 class="text-xl font-semibold mb-2 mt-6">Follow Us</h3>
                <div class="flex space-x-2 mt-2">
                    <a href="#" class="text-white hover:text-gray-300"><i class="fab fa-facebook"></i></a>
                    <a href="#" class="text-white hover:text-gray-300"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="text-white hover:text-gray-300"><i class="fab fa-linkedin"></i></a>
                    <!-- Add more social media icons as needed -->
                </div>

                <!-- Menu -->

                <div>
                    <h3 class="text-xl font-semibold mb-2">Menu</h3>
                    <div class="flex space-x-2 mt-2">
                        <a href="#" class="text-white hover:text-gray-300"><i class="fab fa-facebook"></i></a>
                        <a href="#" class="text-white hover:text-gray-300"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-white hover:text-gray-300"><i class="fab fa-linkedin"></i></a>
                        <!-- Add more social media icons as needed -->
                    </div>
                </div>

            </div>
        </div>
        <!-- Copyright Notice -->
        <div class="mt-8 bg-gray- text-gray-500 py-4">
            <div class="container mx-auto text-center text-sm ">
                &copy; {{ now()->year }} Smart Subdivision Security. All rights reserved.
            </div>
</footer>



</html>
