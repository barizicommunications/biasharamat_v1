<x-guest-layout>
    <section class="bg-[#f4f4f4]">
        <article class="mx-auto max-w-screen-2xl px-4 py-16 sm:px-6 lg:py-8">
            <!-- Breadcrumb -->
            <div class="flex items-center py-4 overflow-x-auto whitespace-nowrap mb-8">
                <a href="/" class="text-gray-600 hover:underline">
                    Home
                </a>
                <span class="mx-3 text-gray-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                </span>
                <a href="{{ route('investorsAndBuyers') }}" class="text-gray-600 hover:underline">
                    Businesses
                </a>
                <span class="mx-3 text-gray-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                </span>
                <a href="#" class="text-primary">
                    {{ $applicationData['business_industry'] }}
                </a>
            </div>



            <!-- Business Header -->
            <div class="bg-white rounded-lg shadow-sm p-8 mb-8">
                <div class="flex items-start justify-between mb-6">
                    <div>
                        <h1 class="text-3xl md:text-4xl font-bold text-primary mb-2">
                            {{ $applicationData['company_name'] }}
                        </h1>
                        <div class="flex items-center space-x-4 text-gray-600">
                            <span class="inline-flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                {{ $applicationData['city'] ?? 'Location not specified' }}, {{ $applicationData['country'] ?? '' }}
                            </span>
                            <span class="inline-flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-6m-8 0H3m2 0h6m0 0v-4a2 2 0 012-2h2a2 2 0 012 2v4" />
                                </svg>
                                {{ $applicationData['business_industry'] }}
                            </span>
                        </div>
                    </div>
                    <div class="text-right">
                        <div class="flex items-center mb-2">
                            <div class="flex space-x-1 mr-2">
                                @for ($i = 0; $i < 5; $i++)
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                @endfor
                            </div>
                            <span class="text-sm text-gray-600">4.5/5</span>
                        </div>
                        <div class="flex items-center text-green-600 text-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Verified Business
                        </div>
                    </div>
                </div>

                <!-- Key Stats -->
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 pt-6 border-t border-gray-100">
                    <div class="text-center">
                        <div class="text-2xl font-bold text-primary">{{ $applicationData['business_start_date'] ?? 'N/A' }}</div>
                        <div class="text-sm text-gray-600">Established</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold text-primary">{{ $applicationData['number_employees'] ?? 'N/A' }}</div>
                        <div class="text-sm text-gray-600">Employees</div>
                    </div>
                    @auth
                        @if($applicationData['seller_interest'] === 'Sale of shares' && isset($sellerProfile->tentative_selling_price))
                        <div class="text-center">
                            <div class="text-2xl font-bold text-primary">KES {{ number_format($sellerProfile->tentative_selling_price) }}</div>
                            <div class="text-sm text-gray-600">Asking Price</div>
                        </div>
                        @elseif($applicationData['seller_interest'] === 'Partial sale of shares' && isset($applicationData['investment_amount']))
                        <div class="text-center">
                            <div class="text-2xl font-bold text-primary">KES {{ number_format($applicationData['investment_amount']) }}</div>
                            <div class="text-sm text-gray-600">Investment Sought</div>
                        </div>
                        @elseif($applicationData['seller_interest'] === 'Financing' && isset($applicationData['loan_amount']))
                        <div class="text-center">
                            <div class="text-2xl font-bold text-primary">KES {{ number_format($applicationData['loan_amount']) }}</div>
                            <div class="text-sm text-gray-600">Loan Amount</div>
                        </div>
                        @endif
                    @else
                        <div class="text-center">
                            <div class="text-2xl font-bold text-gray-400">•••</div>
                            <div class="text-sm text-gray-500">Register to View</div>
                        </div>
                    @endauth
                    <div class="text-center">
                        <div class="text-2xl font-bold text-primary">{{ $applicationData['seller_interest'] ?? 'N/A' }}</div>
                        <div class="text-sm text-gray-600">Interest Type</div>
                    </div>
                </div>
            </div>

            <div class="flex flex-wrap lg:flex-nowrap gap-8">
                <!-- Main Content -->
                <div class="w-full lg:w-2/3">
                    <!-- Image Gallery -->
                    @auth
                        @if (isset($documents['business_photos']) && count($documents['business_photos']) > 0)
                        <div class="bg-white rounded-lg shadow-sm p-6 mb-8">
                            <h2 class="text-xl font-semibold text-primary mb-4">Business Photos</h2>
                            <div class="swiper">
                                <div class="swiper-wrapper">
                                    @foreach ($documents['business_photos'] as $photo)
                                    <div class="swiper-slide">
                                        <img src="{{ Storage::url($photo) }}" alt="Business Photo" class="w-full h-64 object-cover rounded-lg">
                                    </div>
                                    @endforeach
                                </div>
                                <div class="swiper-pagination"></div>
                                <div class="swiper-button-next"></div>
                                <div class="swiper-button-prev"></div>
                            </div>
                        </div>
                        @endif
                    @else
                        <!-- Limited Photo Preview for Guests -->
                        @if (isset($documents['business_photos']) && count($documents['business_photos']) > 0)
                        <div class="bg-white rounded-lg shadow-sm p-6 mb-8 relative">
                            <h2 class="text-xl font-semibold text-primary mb-4">Business Photos</h2>
                            <div class="relative">
                                <img src="{{ Storage::url($documents['business_photos'][0]) }}" alt="Business Photo" class="w-full h-64 object-cover rounded-lg blur-sm">
                                <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center rounded-lg">
                                    <div class="text-center text-white">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 0h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                        </svg>
                                        <p class="text-lg font-medium mb-2">{{ count($documents['business_photos']) }} Photos Available</p>
                                        <p class="text-sm">Register to view all business photos</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    @endauth

                    <!-- Business Overview -->
                    <div class="bg-white rounded-lg shadow-sm p-6 mb-8">
                        <h2 class="text-xl font-semibold text-primary mb-4">About This Business</h2>

                        @auth
                            <p class="text-gray-700 leading-relaxed mb-6">
                                {{ $applicationData['business_description'] ?? 'No description available.' }}
                            </p>

                            @if(!empty($applicationData['business_highlights']))
                            <div class="mb-6">
                                <h3 class="text-lg font-medium text-gray-900 mb-3">Business Highlights</h3>
                                <p class="text-gray-700">{{ $applicationData['business_highlights'] }}</p>
                            </div>
                            @endif

                            @if(!empty($applicationData['product_services']))
                            <div>
                                <h3 class="text-lg font-medium text-gray-900 mb-3">Products & Services</h3>
                                <p class="text-gray-700">{{ $applicationData['product_services'] }}</p>
                            </div>
                            @endif
                        @else
                            <!-- Limited description for guests -->
                            <p class="text-gray-700 leading-relaxed mb-6">
                                {{ Str::limit($applicationData['business_description'] ?? 'No description available.', 200) }}
                                @if(strlen($applicationData['business_description'] ?? '') > 200)
                                    <span class="text-gray-500">...</span>
                                @endif
                            </p>

                            <div class="bg-gray-50 rounded-lg p-4">
                                <p class="text-sm text-gray-600">
                                    <span class="font-medium">Additional details available:</span> Business highlights, detailed services, and more information for registered users.
                                </p>
                            </div>
                        @endauth
                    </div>

                    <!-- Financial Information (Registered users only) -->
                    @auth
                        @if(!empty($applicationData['monthly_turnover']) || !empty($applicationData['yearly_turnover']))
                        <div class="bg-white rounded-lg shadow-sm p-6 mb-8">
                            <h2 class="text-xl font-semibold text-primary mb-4">Financial Highlights</h2>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                @if(!empty($applicationData['monthly_turnover']))
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <div class="text-sm text-gray-600 mb-1">Monthly Turnover</div>
                                    <div class="text-xl font-bold text-primary">KES {{ number_format($applicationData['monthly_turnover']) }}</div>
                                </div>
                                @endif
                                @if(!empty($applicationData['yearly_turnover']))
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <div class="text-sm text-gray-600 mb-1">Annual Turnover</div>
                                    <div class="text-xl font-bold text-primary">KES {{ number_format($applicationData['yearly_turnover']) }}</div>
                                </div>
                                @endif
                            </div>
                        </div>
                        @endif
                    @else
                        <!-- Financial information locked for guests -->
                        <div class="bg-white rounded-lg shadow-sm p-6 mb-8">
                            <h2 class="text-xl font-semibold text-primary mb-4">Financial Information</h2>
                            <div class="bg-gray-50 rounded-lg p-6 text-center">
                                <div class="text-gray-400 mb-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 0h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                    </svg>
                                </div>
                                <p class="text-gray-600">Financial data available to registered users</p>
                            </div>
                        </div>
                    @endauth

                    <!-- Business Details -->
                    <div class="bg-white rounded-lg shadow-sm p-6 mb-8">
                        <h2 class="text-xl font-semibold text-primary mb-4">Business Details</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-3 text-sm">
                                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                    <span class="text-gray-600">Legal Entity:</span>
                                    <span class="font-medium">{{ $applicationData['business_legal_entity'] ?? 'Not specified' }}</span>
                                </div>
                                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                    <span class="text-gray-600">Website:</span>
                                    <span class="text-gray-500">Available upon introduction</span>
                                </div>
                                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                    <span class="text-gray-600">Contact Details:</span>
                                    <span class="text-gray-500">Available upon introduction</span>
                                </div>
                            </div>

                            <div>
                                @if(!empty($applicationData['facility_description']))
                                <div class="mb-4">
                                    <span class="text-gray-600 block mb-2 font-medium">Facility Information:</span>
                                    @auth
                                        <span class="text-sm text-gray-700">{{ $applicationData['facility_description'] }}</span>
                                    @else
                                        <span class="text-sm text-gray-500">Details available to registered users</span>
                                    @endauth
                                </div>
                                @endif

                                <!-- Value Proposition -->
                                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                                    <h4 class="font-medium text-blue-900 mb-2">Professional Introduction Service</h4>
                                    <ul class="text-xs text-blue-700 space-y-1">
                                        <li>• Pre-verified business information</li>
                                        <li>• Confidential initial discussions</li>
                                        <li>• Professional due diligence support</li>
                                        <li>• Secure transaction facilitation</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="w-full lg:w-1/3">
                    <!-- Contact Card -->
                    <div class="bg-white rounded-lg shadow-sm p-6 mb-6 sticky top-4">
                        @auth
                            <h3 class="text-lg font-semibold text-primary mb-4">Interested in This Business?</h3>

                            <div class="space-y-4 mb-6">
                                <p class="text-gray-600 text-sm">
                                    All connections are facilitated through our platform with professional introduction services.
                                </p>

                                <!-- Business Details Summary -->
                                <div class="bg-gray-50 p-4 rounded-lg space-y-2 text-sm">
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Industry:</span>
                                        <span class="font-medium">{{ $applicationData['business_industry'] }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Location:</span>
                                        <span class="font-medium">{{ $applicationData['city'] ?? 'N/A' }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Opportunity:</span>
                                        <span class="font-medium">{{ $applicationData['seller_interest'] ?? 'N/A' }}</span>
                                    </div>
                                </div>
                            </div>

                           <!-- Contact Button -->
@if(auth()->id() !== $sellerProfile->user_id)
    <a href="{{ route('request.introduction', ['type' => 'business', 'id' => $sellerProfile->id]) }}" class="block w-full bg-primary text-white text-center py-3 px-4 rounded-lg font-medium hover:bg-primary/90 transition-colors duration-200">
        Request Introduction
    </a>

    <p class="text-xs text-gray-500 mt-3 text-center">
        Professional introduction service with small fee
    </p>
@else
    <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 mb-6">
        <p class="font-bold">Note:</p>
        <p>This is your business profile. Investors can request introductions to connect with you.</p>
    </div>
@endif

                            <p class="text-xs text-gray-500 mt-3 text-center">
                                Professional introduction service with small fee
                            </p>
                        @else
                            <h3 class="text-lg font-semibold text-primary mb-4">Connect with This Business</h3>

                            <div class="space-y-4 mb-6">
                                <p class="text-gray-600 text-sm">
                                    Join our platform to access complete business information and request professional introductions.
                                </p>

                                <!-- Business Summary -->
                                <div class="bg-gray-50 p-4 rounded-lg space-y-2 text-sm">
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Industry:</span>
                                        <span class="font-medium">{{ $applicationData['business_industry'] }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Location:</span>
                                        <span class="font-medium">{{ $applicationData['city'] ?? 'N/A' }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Opportunity:</span>
                                        <span class="font-medium">{{ $applicationData['seller_interest'] ?? 'N/A' }}</span>
                                    </div>
                                </div>
                            </div>

                                                  <!-- Registration Options for Guests -->
<div class="space-y-3">
    <p class="text-sm font-medium text-gray-700 text-center">Join as:</p>

    <!-- Business Seller Option -->
    <a href="{{ route('business.create') }}" class="block w-full bg-primary text-white text-center py-3 px-4 rounded-lg font-medium hover:bg-primary/90 transition-colors duration-200">
        <div class="flex items-center justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-6m-8 0H3m2 0h6m0 0v-4a2 2 0 012-2h2a2 2 0 012 2v4" />
            </svg>
            Join as Business Seller
        </div>
        <span class="text-xs opacity-90">Sell your business or seek investment</span>
    </a>

    <!-- Business Investor Option -->
    <a href="{{ route('investor.create') }}" class="block w-full bg-green-600 text-white text-center py-3 px-4 rounded-lg font-medium hover:bg-green-700 transition-colors duration-200">
        <div class="flex items-center justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1" />
            </svg>
            Join as Investor/Buyer
        </div>
        <span class="text-xs opacity-90">Invest in or acquire businesses</span>
    </a>

    <!-- Alternative: Dropdown Style -->
    <div class="pt-2 border-t border-gray-200">
        <p class="text-xs text-gray-500 text-center">
            Or <a href="{{ route('register') }}" class="text-primary hover:underline">create general account</a>
        </p>
    </div>
</div>
                            <p class="text-xs text-gray-500 mt-3 text-center">
                                Free registration • Professional introductions
                            </p>
                        @endauth
                    </div>
                </div>
            </div>
        </article>
    </section>

    <!-- Add Swiper CSS and JS if not already included -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
    <script>
        if (document.querySelector('.swiper')) {
            const swiper = new Swiper('.swiper', {
                loop: true,
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                autoplay: {
                    delay: 5000,
                },
            });
        }
    </script>
</x-guest-layout>