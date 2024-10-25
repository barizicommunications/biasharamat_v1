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
<nav x-data="{ isOpen: false }" class="relative bg-white shadow   dark:bg-gray-800">
    <div class="container px-6 py-6 mx-auto">
        <div class="lg:flex lg:items-center lg:justify-between">
            <div class="flex items-center justify-between">
                <a href="/">
                    <img class="w-auto" src="{{ asset('images/logos/biasharamart_logo.png') }}" alt="">
                </a>

                <div class=" hidden relative md:block mt-4 md:mt-0 md:ml-10  ">


                    <input type="text"
                           class=" md:w-96 py-2 pl-4 pr-4 text-gray-700 bg-white border rounded-lg dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-primary/50 dark:focus:border-blue-300 focus:outline-none focus:ring focus:ring-opacity-40 focus:ring-primary/50"
                           placeholder="Search">
                    <span class="absolute  inset-y-0 right-0  flex items-center p-3 rounded-md bg-primary ">
                                    <svg class="w-5 h-5   text-white" viewBox="0 0 24 24" fill="none">
                                        <path d="M21 21L15 15M17 10C17 13.866 13.866 17 10 17C6.13401 17 3 13.866 3 10C3 6.13401 6.13401 3 10 3C13.866 3 17 6.13401 17 10Z"
                                              stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                              stroke-linejoin="round"></path>
                                    </svg>
                                </span>
                </div>

                <!-- Mobile menu button -->
                <div class="flex lg:hidden">
                    <button x-cloak @click="isOpen = !isOpen" type="button"
                            class="text-gray-500 dark:text-gray-200 hover:text-gray-600 dark:hover:text-gray-400 focus:outline-none focus:text-gray-600 dark:focus:text-gray-400"
                            aria-label="toggle menu">
                        <svg x-show="!isOpen" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 8h16M4 16h16"/>
                        </svg>

                        <svg x-show="isOpen" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Mobile Menu open: "block", Menu closed: "hidden" -->
            <div x-cloak :class="[isOpen ? 'translate-x-0 opacity-100 ' : 'opacity-0 -translate-x-full']"
                 class="absolute inset-x-0 z-20 w-full px-6 py-4 transition-all duration-300 ease-in-out bg-white dark:bg-gray-800 lg:mt-0 lg:p-0 lg:top-0 lg:relative lg:bg-transparent lg:w-auto lg:opacity-100 lg:translate-x-0 lg:flex lg:items-center">
                <div class="flex flex-col -mx-6 lg:flex-row lg:items-center lg:mx-8">
                    <a href="{{ route('about') }}"
                       class="px-3 py-2 mx-3 mt-2 text-gray-700 transition-colors duration-300 transform rounded-md lg:mt-0 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">About
                        us</a>

                        <a href="{{ route('blog') }}"
                       class="px-3 py-2 mx-3 mt-2 text-gray-700 transition-colors duration-300 transform rounded-md lg:mt-0 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">Blogs</a>
                        <a href="{{ route('investorsAndBuyers') }}"
                       class="px-3 py-2 mx-3 mt-2 text-gray-700 transition-colors duration-300 transform rounded-md lg:mt-0 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">Investors and Buyers</a>

                        @if (Auth::check())
                        @if(auth()->user()->registration_type == "Business Seller" && \App\Models\BusinessProfile::where('user_id',auth()->user()->id)->first())

                        <a href="{{ route('sellerProfileOverview',auth()->user()->businessProfile->id) }}"
                       class="px-3 py-2 mx-3 mt-2 text-gray-700 transition-colors duration-300 transform rounded-md lg:mt-0 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">Business profile</a>

                        @endif

                        @if(auth()->user()->registration_type == "Business Buyer" && \App\Models\InvestorProfile::where('user_id',auth()->user()->id)->first())

                        <a href="{{ route('buyer.buyer-profile',auth()->user()->investorProfile->id) }}"
                       class="px-3 py-2 mx-3 mt-2 text-gray-700 transition-colors duration-300 transform rounded-md lg:mt-0 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">Buyer profile</a>

                        @endif


                        @endif
                    {{-- <a href="#"
                       class="px-3 py-2 mx-3 mt-2 text-gray-700 transition-colors duration-300 transform rounded-md lg:mt-0 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">FAQs</a> --}}
                    {{-- <a href="#" class="px-3 py-2 mx-3 mt-2 text-gray-700 transition-colors duration-300 transform rounded-md lg:mt-0 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">My profile</a> --}}
                    <div x-data="{ open: false }" class="relative inline-block">
                        <!-- Dropdown trigger using click -->
                        @if (Auth::guest() || (Auth::check() && (!Auth::user()->businessProfile && !Auth::user()->investorProfile)))

                        <a href="#" @click="open = !open"
                           class="px-3 py-2 mx-3 mt-2 text-white transition-colors duration-300 transform rounded-md lg:mt-0 dark:text-gray-200 bg-primary  ">
                          Sign up
                        </a>

                      @endif

                        <!-- Dropdown content -->
                        <div x-show="open" @click.away="open = false"
                             class="origin-top-right absolute right-0 mt-6 w-48 rounded-md shadow-lg bg-white dark:bg-gray-800 ring-1 ring-black ring-opacity-5 divide-y divide-gray-100 dark:divide-gray-700 focus:outline-none">
                            @if(!Auth::check())
                                <a href="{{ route('business.create') }}"
                                   class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">
                                   As a business owner
                                </a>
                                <a href="{{ route('investor.create') }}"
                                   class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">
                                    Investor
                                </a>
                            @else
                               @if(auth()->user()->registration_type == "Business Seller" && !\App\Models\BusinessProfile::where('user_id',auth()->user()->id)->first())
                               <a href="{{ route('business.profile.create') }}"
                               class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">
                               As a business owner
                            </a>

                               @endif
                                @if(auth()->user()->registration_type == "Business Buyer" && !\App\Models\InvestorProfile::where('user_id',auth()->user()->id)->first())

                                <a href="{{ route('investor.profile.create') }}"
                                class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">
                                 Investor
                             </a>


                                @endif





                            @endif
                        </div>
                    </div>

                    @if(!Auth::check())
                        <a href="{{ route('login') }}"
                           class="px-3 py-2 mx-3 mt-2 text-gray-700 transition-colors duration-300 transform rounded-md lg:mt-0 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 border">Login</a>
                        {{-- <a href="{{ route('register') }}"
                           class="px-4 py-3 mx-3 mt-2 text-white transition-colors duration-300 transform rounded-md lg:mt-0 dark:text-gray-200 hover:bg-primary/95 dark:hover:bg-gray-700 bg-primary">Sign
                            up</a> --}}
                    @else
                        <a href="{{ route('activeIntro') }}"
                           class="px-3 py-2 mx-3 mt-2 text-gray-700 transition-colors duration-300 transform rounded-md lg:mt-0 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">
                            My Profile
                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="inline-block ml-4">
                            @csrf
                            <button type="submit" class="text-red-500 hover:underline px-3 py-2 mx-3 mt-2  transition-colors duration-300 transform rounded-md lg:mt-0  hover:bg-gray-100">Logout</button>
                          </form>
                    @endif
                </div>
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
</body>
</html>
