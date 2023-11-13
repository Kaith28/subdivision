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
                    @if (Auth::user()->role == 'admin')
                        <a href="{{ route('admin.dashboard') }}"
                            class="font-semibold text-black hover:text-gray-900  focus:outline focus:outline-2 focus:rounded-sm focus:outline-gray-500">Dashboard</a>
                    @endif
                    @if (Auth::user()->role == 'guard')
                        <a href="{{ route('guard.dashboard') }}"
                            class="font-semibold text-black hover:text-gray-900  focus:outline focus:outline-2 focus:rounded-sm focus:outline-gray-500">Dashboard</a>
                    @endif
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
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 mb-20 ">
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
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 ">
            <div class="text-center pb-10">
                <h2 class="text-4xl"><b>Our Features</b></h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="flex flex-col items-center shadow-lg rounded-md p-4">
                    <img class="w-52 h-52" src="/Personalized.svg" alt="">
                    <p class="text-3xl ">
                        Personalized
                    </p>
                </div>
                <div class="flex flex-col items-center shadow-lg rounded-md p-4">
                    <img class="w-52 h-52" src="/QrCodes.png" alt="">
                    <p class="text-3xl ">
                        Qr Codes
                    </p>
                </div>
                <div class="flex flex-col items-center shadow-lg rounded-md p-4">
                    <img class="w-52 h-52" src="/UserFriendly.svg" alt="">
                    <p class="text-3xl">
                        User Friendly
                    </p>
                </div>
                <div class="flex flex-col items-center shadow-lg rounded-md p-4">
                    <img class="w-52 h-52" src="/DataPrivacy.svg" alt="">
                    <p class="text-3xl ">
                        Data Privacy
                    </p>
                </div>


            </div>
        </div>
    </section>


    </div>

    </section>



    {{-- How to reach us section --}}
    <section>
        <div class="text-center pb-20 pt-5">
            <h2 class="text-4xl"><b>How to reach us?</b></h2>
        </div>
        <div class="text-center pb-20 pt-1 pl-64 pr-64 ">
            <p class="text-2xl text-white shadow-xl rounded-xl bg-gray-500 pr-4 pl-4 pt-10 pb-10"> Explore various convenient ways to connect with Smart Subdivision Security.
                Our team is dedicated to ensuring the safety and security of your community, and we welcome the opportunity to address any questions or concerns you may have. Additionally, feel free to visit our physical location during business hours to speak with our experts in person. We value open communication and look forward to assisting you in any way we can. Your safety is our priority, and we're just a message or call away.</p>
        </div>


        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 pb-20">
            <div class="flex flex-col items-center">
                <img class="w-20 h-20 shadow-md" src="/emaillogo.png" alt="">
                <p class="text-xl ">
                    smart_subdivisionsecurity@gmail.com
                </p>
            </div>
            <div class="flex flex-col items-center">
                <img class="w-20 h-20 shadow-md" src="/fblogo.png" alt="">
                <p class="text-xl ">
                    Smart Subdivision Security
                </p>
            </div>
            <div class="flex flex-col items-center">
                <img class="w-20 h-20 shadow-md" src="/iglogo.png" alt="">
                <p class="text-xl">
                    @smartsubdivision_security
                </p>
            </div>
            <div class="flex flex-col items-center">
                <img class="w-20 h-20 shadow-md" src="/calllogo.png" alt="">
                <p class="text-xl ">
                    +63 912 3456 789
                </p>
            </div>


        </div>

    </section>


    {{--Privacy Policy--}}
    <div class="text-center pb-20 pt-5">
        <h2 class="text-4xl"><b>Privacy Policy</b></h2>
    </div>
    <div class="text-center pb-20 pt-1 pl-64 pr-64 ">
        <p class="text-1xl text-justify shadow-xl text-white rounded-xl bg-gray-500 pr-4 pl-4 pt-10 pb-10">  We prioritize the protection and confidentiality of your personal information. This document outlines our commitment to safeguarding your privacy while utilizing our services.

            Our Privacy Policy details the types of information we collect, how we use it, and the measures we take to ensure its security. We respect your right to privacy and adhere to the highest standards when handling your data.
            
            Information gathered may include personal details, contact information, and usage patterns. Rest assured, this information is utilized solely for improving our services, enhancing user experience, and ensuring the security of your community.
            
            Smart Subdivision Security is committed to transparency. Our Privacy Policy explains your rights regarding the information you share with us, and we encourage you to review it thoroughly. We continually update our practices to align with the latest industry standards and legal requirements.
            
            Should you have any questions or concerns about our Privacy Policy or the way we handle your data, please feel free to reach out to us. Your trust is of utmost importance to us, and we are dedicated to maintaining a secure and trustworthy environment for all users.
            
            Thank you for entrusting Smart Subdivision Security with your privacy. We appreciate your cooperation in fostering a safe and secure community.
            
            
            
            
            </p>
    </div>

    

</body>





{{-- footer --}}

<footer class="bg-black text-white p-1">
    <div class="container mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

            <!-- System Information with Logo -->
            <div class="mb-6 flex items-center mt-6">
                <img src="/logo1.png" alt="" class="h-16 mr-10">
                <div>
                    <h3 class="text-xl font-semibold mb-2 ">Smart Subdivision Security</h3>
                    <p class="italic"> Where Security Meets Innovation:Your Community's Shield.</p>
                </div>
            </div>

            <!-- Contact Information -->
            <div class="mb-4 mt-4 pl-20">
                <h3 class="text-xl font-semibold mb-2 pl-20">Contact Us</h3>
                <a href="" class="italic"> smart_subdivisionsecurity@gmail.com</a>
                <p class="italic">+63 912 3456 789</p>
            </div>

            <!-- Social Media Links -->
            <div>
                <h3 class="text-xl font-semibold mb-1 mt-4 pl-32">Follow Us</h3>
                <div class="flex space-x-2 mt-2 pl-16">
                    <a href="#" class="cursor-pointer">
                        <img src="/fblogo4.png" alt=""  class="h-8 mt-2 mr-10">
                      </a>
                      <a href="#" class="cursor-pointer">
                        <img src="/iglogo2.png" alt="" class="h-8 mt-2 mr-10">
                      </a>
                      <a href="#" class="cursor-pointer">
                        <img src="/twitterlogo.png" alt=""  class="h-10 mt-1 mr-12">
                      </a>
                    <!-- Add more social media icons as needed -->
                    </div>
            </div>
        </div>
        <!-- Copyright Notice -->
        <div class="mt-1 py-4">
            <div class="container text-gray-300 mx-auto text-center text-sm ">
                &copy; {{ now()->year }} Smart Subdivision Security. All rights reserved.
            </div>
</footer>



</html>
