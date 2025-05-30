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
                <a href="{{ route('investors') }}" class="text-gray-600 hover:underline">
                    Investors & buyers
                </a>
                <span class="mx-3 text-gray-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                </span>
                <a href="#" class="text-primary">
                    {{ $buyerProfile->buyer_interest }}
                </a>
            </div>

            <!-- Investor Header -->
            <div class="bg-white rounded-lg shadow-sm p-8 mb-8">
                <div class="flex items-start justify-between mb-6">
                    <div class="flex items-center">
                        <div class="w-16 h-16 bg-primary/10 rounded-full flex items-center justify-center mr-6">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-6m-8 0H3m2 0h6m0 0v-4a2 2 0 012-2h2a2 2 0 012 2v4" />
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-3xl md:text-4xl font-bold text-primary mb-2">
                                {{ $buyerProfile->company_name }}
                            </h1>
                            <div class="flex items-center space-x-4 text-gray-600">
                                <span class="inline-flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    {{ $buyerProfile->current_location }}
                                </span>
                                <span class="inline-flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-6m-8 0H3m2 0h6m0 0v-4a2 2 0 012-2h2a2 2 0 012 2v4" />
                                    </svg>
                                    {{ $buyerProfile->buyer_role }}
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="text-right">
                        <div class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800 mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Verified Investor
                        </div>
                        <div class="flex items-center">
                            <div class="flex space-x-1 mr-2">
                                @for ($i = 0; $i < 5; $i++)
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                @endfor
                            </div>
                            <span class="text-sm text-gray-600">4.8/5</span>
                        </div>
                    </div>
                </div>

                <!-- Key Investment Stats -->
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 pt-6 border-t border-gray-100">
                    <div class="text-center">
                        <div class="text-2xl font-bold text-primary">{{ str_replace('_', ' ', $buyerProfile->interested_in) }}</div>
                        <div class="text-sm text-gray-600">Investment Focus</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold text-primary">{{ $buyerProfile->buyer_interest }}</div>
                        <div class="text-sm text-gray-600">Sector Preference</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold text-primary">{{ $buyerProfile->buyer_location_interest }}</div>
                        <div class="text-sm text-gray-600">Location Interest</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold text-primary">KES {{ number_format($buyerProfile->investment_range) }}</div>
                        <div class="text-sm text-gray-600">Investment Range</div>
                    </div>
                </div>
            </div>

            <div class="flex flex-wrap lg:flex-nowrap gap-8">
                <!-- Main Content -->
                <div class="w-full lg:w-2/3">
                    <!-- About Investor -->
                    <div class="bg-white rounded-lg shadow-sm p-6 mb-8">
                        <h2 class="text-xl font-semibold text-primary mb-4">About This Investor</h2>
                        <p class="text-gray-700 leading-relaxed mb-6">
                            {{ $buyerProfile->about_company }}
                        </p>

                        <div class="mb-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-3">Investment Criteria</h3>
                            <p class="text-gray-700">{{ $buyerProfile->business_factors }}</p>
                        </div>
                    </div>

                    <!-- Investment Profile -->
                    <div class="bg-white rounded-lg shadow-sm p-6 mb-8">
                        <h2 class="text-xl font-semibold text-primary mb-4">Investment Profile</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-3 text-sm">
                                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                    <span class="text-gray-600">Investor Type:</span>
                                    <span class="font-medium">{{ $buyerProfile->buyer_role }}</span>
                                </div>
                                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                    <span class="text-gray-600">Industry Focus:</span>
                                    <span class="font-medium">{{ $buyerProfile->company_industry ?? 'Multiple Sectors' }}</span>
                                </div>
                                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                    <span class="text-gray-600">Contact Details:</span>
                                    <span class="text-gray-500">Available upon introduction</span>
                                </div>
                            </div>

                            <div>
                                <div class="mb-4">
                                    <span class="text-gray-600 block mb-2 font-medium">Current Status:</span>
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        Actively Investing
                                    </span>
                                </div>

                                <!-- Value Proposition -->
                                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                                    <h4 class="font-medium text-blue-900 mb-2">Connect Through Our Platform</h4>
                                    <ul class="text-xs text-blue-700 space-y-1">
                                        <li>• Verified investor credentials</li>
                                        <li>• Professional introduction service</li>
                                        <li>• Confidential initial discussions</li>
                                        <li>• Secure deal facilitation</li>
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
                        <div class="text-center text-white bg-green-500 py-2 -mt-6 -mx-6 rounded-t-lg mb-6">
                            <h5 class="text-white font-medium">Premium Verified Investor</h5>
                        </div>

                        <h3 class="text-lg font-semibold text-primary mb-4">Connect With This Investor</h3>

                        <div class="space-y-4 mb-6">
                            <p class="text-gray-600 text-sm">
                                Professional introduction service ensures verified connections and protects all parties involved.
                            </p>

                            <div class="bg-blue-50 border border-blue-200 rounded-lg p-3">
                                <div class="flex items-center mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-600 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span class="text-sm font-medium text-blue-800">Introduction Includes:</span>
                                </div>
                                <ul class="text-xs text-blue-700 space-y-1 ml-6">
                                    <li>• Direct contact with investor</li>
                                    <li>• Investment preferences details</li>
                                    <li>• Professional introduction email</li>
                                    <li>• Ongoing support during discussions</li>
                                </ul>
                            </div>

                            <!-- Investor Summary -->
                            <div class="bg-gray-50 p-4 rounded-lg space-y-2 text-sm">
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Investment Range:</span>
                                    <span class="font-medium">KES {{ number_format($buyerProfile->investment_range) }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Focus Area:</span>
                                    <span class="font-medium">{{ $buyerProfile->buyer_interest }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Location:</span>
                                    <span class="font-medium">{{ $buyerProfile->buyer_location_interest }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Contact Button -->
                        <a href="/contact" class="block w-full bg-primary text-white text-center py-3 px-4 rounded-lg font-medium hover:bg-primary/90 transition-colors duration-200">
                            Request Introduction - Small Fee Applies
                        </a>

                        <p class="text-xs text-gray-500 mt-3 text-center">
                            Get connected with this verified investor through our professional introduction service.
                        </p>
                    </div>


                </div>
            </div>
        </article>
    </section>
</x-guest-layout>