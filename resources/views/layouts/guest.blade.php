<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@100;300;400;700;900&display=swap" rel="stylesheet">


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>

    <link rel="stylesheet" href="{{ asset('styles.css') }}">

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>



    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>

@filamentStyles

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-gray-900 antialiased">
    <nav x-data="{ isOpen: false }" class="bg-white shadow sticky top-0 z-50">
        <div class="container px-6 py-4 mx-auto">
            <div class="flex items-center justify-between">
                <!-- Logo -->
                <a href="/">
                    <img class="w-auto" src="{{ asset('images/logos/biasharamart_logo.png') }}" alt="">
                </a>

                <!-- Centered Menu Items -->
                <div class="hidden lg:flex lg:items-center lg:justify-center flex-grow">
                    <div class="flex space-x-6">
                        <a href="{{ route('faqs') }}" class="px-3 py-2 transition-colors duration-300 transform rounded-md hover:bg-gray-100 {{ Request::routeIs('faqs') ? 'bg-gray-100 text-primary font-semibold' : 'text-gray-700' }}">
                            FAQs
                        </a>
                        <a href="{{ route('investorsAndBuyers') }}" class="px-3 py-2 transition-colors duration-300 transform rounded-md hover:bg-gray-100 {{ Request::routeIs('investorsAndBuyers') ? 'bg-gray-100 text-primary font-semibold' : 'text-gray-700' }}">
                            Investment Opportunities
                        </a>
                        <a href="{{ route('investors') }}" class="px-3 py-2 transition-colors duration-300 transform rounded-md hover:bg-gray-100 {{ Request::routeIs('investors') ? 'bg-gray-100 text-primary font-semibold' : 'text-gray-700' }}">
                            Investors
                        </a>
                        <a href="{{ route('blog') }}" class="px-3 py-2 transition-colors duration-300 transform rounded-md hover:bg-gray-100 {{ Request::routeIs('blog') ? 'bg-gray-100 text-primary font-semibold' : 'text-gray-700' }}">
                            Blogs
                        </a>
                    </div>
                </div>

                <!-- Sign Up Dropdown and Login Button -->
                <div class="hidden lg:flex items-center space-x-4">
                    @if (!Auth::check())
                        <!-- Sign Up Dropdown -->
                        <div x-data="{ open: false }" class="relative inline-block">
                            <a href="#" @click="open = !open" class="px-4 py-2 text-white bg-primary rounded-md transition duration-300 hover:bg-primary-dark">
                                Sign Up
                            </a>
                            <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 divide-y divide-gray-100">
                                <a href="{{ route('business.create') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    As a Business Owner
                                </a>
                                <a href="{{ route('investor.create') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    As an Investor
                                </a>
                            </div>
                        </div>

                        <!-- Login Button -->
                        <a href="{{ route('login') }}" class="px-4 py-2 text-gray-700 border rounded-md transition duration-300 hover:bg-gray-100">
                            Login
                        </a>
                    @else
                        <a href="{{ route('activeIntro') }}" class="px-4 py-2 text-gray-700 transition duration-300 hover:bg-gray-100">Profile</a>
                        <form method="POST" action="{{ route('logout') }}" class="inline-block">
                            @csrf
                            <button type="submit" class="px-4 py-2 text-red-500 transition duration-300 hover:bg-gray-100 rounded-md">Logout</button>
                        </form>
                    @endif
                </div>

                <!-- Mobile Menu Button -->
                <div class="flex lg:hidden">
                    <button @click="isOpen = !isOpen" type="button" class="text-gray-500 hover:text-gray-600 focus:outline-none">
                        <svg x-show="!isOpen" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 8h16M4 16h16"/>
                        </svg>
                        <svg x-show="isOpen" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </nav>




<main>
    {{ $slot }}
</main>

<footer class="bg-[#262626] ">
    <article class="mx-auto max-w-screen-xl px-8 py-16 sm:px-12 lg:pt-24">
        <div class="grid gap-4 grid-cols-1 md:grid-cols-6 text-white">
            <div>
                <div>
                    <img src="{{ asset('images/logos/white-logo.png') }}" class="mb-6" alt="">
                </div>
                <div class="flex space-x-4 mb-8">
                    <div>
                        <ion-icon name="logo-instagram"></ion-icon>
                    </div>
                    <div>
                        <ion-icon name="logo-facebook"></ion-icon>
                    </div>
                    <div>
                        <ion-icon name="logo-twitter"></ion-icon>
                    </div>
                    <div>
                        <ion-icon name="logo-youtube"></ion-icon>
                    </div>
                </div>
                <div>
                    <h5 class="font-bold mb-2 text-lg">Contact us</h5>
                    <p class="text-sm mb-4">I&M Bank House,<br>5th Floor,2nd <br> Ngong avenue <br>Nairobi. </p>

                    <p class="text-sm">Phone: +254 714704440</p>
                    <p class="text-sm">Email: +254 714704440</p>
                </div>
            </div>
            <div class=" md:justify-self-center">
                <h5 class="font-bold mb-4 text-base">Get started</h5>
                <p class="text-sm">Sell your business</p>
                <p class="text-sm">Finance your Business</p>
                <p class="text-sm">Buy a Business</p>
                <p class="text-sm">Invest in a Business</p>
                <p class="text-sm">Value your Business</p>
                <p class="text-sm">Register as Advisor</p>
            </div>
            <div class="  md:justify-self-center">
                <h5 class="font-bold mb-4 text-base">Businesses</h5>
                <p class="text-sm">Businesses For Sale</p>
                <p class="text-sm">Investment Opportunities</p>
                <p class="text-sm">Businesses Seeking Loan</p>
                <p class="text-sm">Business Assets For Sale</p>
            </div>
            <div class="  md:justify-self-center">
                <h5 class="font-bold mb-4 text-base">Advisors</h5>
                <p class="text-sm">Businesses Seeking Advisors</p>
                <p class="text-sm">Investment Banks</p>
                <p class="text-sm">M&A Advisors</p>
                <p class="text-sm">Business Brokers</p>
                <p class="text-sm">CRE Brokers</p>
                <p class="text-sm">Financial Consultants</p>
                <p class="text-sm">Accountants</p>
                <p class="text-sm">Law Firms</p>
            </div>
            <div class="  md:justify-self-center">
                <h5 class="font-bold mb-4 text-base">Investors</h5>
                <p class="text-sm">Individual Investors</p>
                <p class="text-sm">Business Buyers</p>
                <p class="text-sm">Corporate Investors</p>
                <p class="text-sm">Venture Capital Firms</p>
                <p class="text-sm">Private Equity Firms</p>
                <p class="text-sm">Family Offices</p>
            </div>
            <div class="  md:justify-self-center">
                <h5 class="font-bold mb-4 text-base">Franchises</h5>
                <p class="text-sm">Franchises For Sale</p>
                <p class="text-sm">Franchise Investors</p>
            </div>
        </div>

    </article>
    <div class="mx-auto max-w-screen-xl px-8 pb-3">
        <div class="flex mt-4 text-white flex-wrap md:flex-nowrap">
            <div class="md:w-3/4 w-full self-center">
                <hr>
            </div>
            <div class="md:w-1/4 w-full md:ml-4 mt-6 md:-mt-2 ">
                <p class="text-sm"> &copy; <?php echo date("Y"); ?> BiasharaMart. All rights reserved </p>
            </div>
        </div>
    </div>

</footer>

@filamentScripts
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        new Swiper('.swiper', {
            loop: true,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });
    });
</script>

</body>
</html>
