<x-guest-layout>
    <section class="bg-[#f4f4f4]">
        <article class="mx-auto max-w-screen-xl px-4 py-16 sm:px-6 lg:py-8">
            <div class="flex items-center py-4 overflow-x-auto whitespace-nowrap mb-8">
                <a href="#" class="text-gray-600 dark:text-gray-200 hover:underline">Home</a>
                <span class="mx-3 text-gray-500 dark:text-gray-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                </span>
                <a href="#" class="text-primary">Businesses</a>
            </div>

            <h2 class="font-bold text-primary text-xl md:text-3xl mb-8">Businesses</h2>

            <div class="flex space-x-10 mb-6">
                <!-- Sidebar Filters -->
                <div class="w-1/4">
                    <h3 class="text-gray-400 mb-4 font-bold">Category</h3>
                    <form class="w-full mb-6">
                        <select name="category" class="w-full border-0 text-gray-400 py-3">
                            <option value="">Investors and Buyers</option>
                        </select>
                    </form>

                    <!-- Investor Type Filter -->
                    <div class="mb-6">
                        <h3 class="text-gray-400 mb-4 font-bold">Investor Type</h3>
                        @foreach(['All', 'Individuals', 'Companies', 'Lenders', 'Financial advisors', 'Funds'] as $type)
                        <div class="flex items-center mb-2">
                            <input type="checkbox" name="investor_type[]" value="{{ $type }}" class="rounded-full">
                            <span class="block ml-4 text-sm text-gray-400">{{ $type }}</span>
                        </div>
                        @endforeach
                    </div>

                    <!-- Interested In Filter -->
                    <div class="mb-6">
                        <h3 class="text-gray-400 mb-4 font-bold">Interested In</h3>
                        @foreach(['All transactions', 'Buying a business', 'Investing in a business', 'Lending to a business', 'Buying business assets', 'Buying'] as $interest)
                        <div class="flex items-center mb-2">
                            <input type="checkbox" name="interest[]" value="{{ $interest }}" class="rounded-full">
                            <span class="block ml-4 text-sm text-gray-400">{{ $interest }}</span>
                        </div>
                        @endforeach
                    </div>

                    <!-- Location Filter -->
                    <div class="mb-6">
                        <h3 class="text-gray-400 mb-4 font-bold">Locations</h3>
                        <form class="w-full mb-6">
                            <select name="location" class="w-full border-0 text-gray-400 py-3">
                                <option value="">Filter</option>
                            </select>
                        </form>
                        @foreach(['Africa', 'Asia', 'Europe', 'North America', 'Oceania', 'South America'] as $location)
                        <div class="flex items-center mb-2">
                            <input type="checkbox" name="locations[]" value="{{ $location }}" class="rounded-full">
                            <span class="block ml-4 text-sm text-gray-400">{{ $location }}</span>
                        </div>
                        @endforeach
                    </div>

                    <!-- Industry Filter -->
                    <div class="mb-6">
                        <h3 class="text-gray-400 mb-4 font-bold">Industries</h3>
                        <form class="w-full mb-6">
                            <select name="industry" class="w-full border-0 text-gray-400 py-3">
                                <option value="">Filter</option>
                            </select>
                        </form>
                        @foreach(['Building, construction & maintenance', 'Business services', 'Education', 'Energy', 'Finance', 'Food & beverage', 'Health care', 'Industrial', 'Logistics', 'Media', 'Retail shops', 'Technology', 'Textiles', 'Travel & leisure'] as $industry)
                        <div class="flex items-center mb-2">
                            <input type="checkbox" name="industries[]" value="{{ $industry }}" class="rounded-full">
                            <span class="block ml-4 text-sm text-gray-400">{{ $industry }}</span>
                        </div>
                        @endforeach
                    </div>

                    <!-- Investment Size and Rating Filters -->
                    <div class="mb-6">
                        <h3 class="text-gray-400 mb-4 font-bold">Investment Size</h3>
                        <div x-data="{ sliderValue: 0 }">
                            <label for="investment-range" class="block mb-2 text-sm font-medium text-gray-900" x-text="'KES ' + sliderValue + ' thousand'"></label>
                            <input id="investment-range" type="range" x-bind:value="sliderValue" x-on:input="sliderValue = $event.target.value" class="w-full h-2 bg-gray-200 rounded-lg cursor-pointer">
                        </div>
                    </div>

                    <div class="mb-6">
                        <h3 class="text-gray-400 mb-4 font-bold">Rating</h3>
                        <div x-data="{ sliderValue: 0 }">
                            <label for="rating-range" class="block mb-2 text-sm font-medium text-gray-900" x-text="'Greater than ' + sliderValue"></label>
                            <input id="rating-range" type="range" x-bind:value="sliderValue" x-on:input="sliderValue = $event.target.value" class="w-full h-2 bg-gray-200 rounded-lg cursor-pointer">
                        </div>
                    </div>
                </div>

                <!-- Results Display -->
                <div class="w-3/4">
                    <div class="flex justify-between mb-8">
                        <div>
                            <h3 class="text-gray-400">Showing 1 - 15 of 19400+ results</h3>
                        </div>
                        <form>
                            <select name="sort" class="border-0 text-gray-400 py-3">
                                <option value="rating">Sort by ratings</option>
                            </select>
                        </form>
                    </div>

                    <!-- Business Listings Grid -->
                    <div class="grid grid-cols-3 gap-4">
                        @forelse ($businessProfiles as $profile)
                            <div class="bg-white p-6 rounded-sm">
                                <!-- Profile Header -->
                                <div class="flex mb-4">
                                    <img src="{{ asset('images/Logo.png') }}" alt="Business Image" class="w-12 h-12 rounded-full flex-shrink-0">
                                    <div class="font-bold text-primary ml-2">
                                        <h3 class="text-sm">{{ $profile->application_data['company_name'] ?? 'Company Name' }}</h3>
                                    </div>
                                </div>

                                <!-- Profile Description -->
                                <p class="text-xs mb-4">{{ $profile->application_data['business_description'] ?? 'No description available.' }}</p>

                                <!-- Tags and Labels -->
                                <div class="mb-8">
                                    <a href="#" class="bg-[#e9e9e9] text-xs py-2 px-6">{{ $profile->application_data['business_industry'] ?? 'Industry' }}</a>
                                    <a href="#" class="bg-[#e9e9e9] text-xs py-2 px-6 ml-2">{{ $profile->application_data['city'] ?? 'Location' }}</a>
                                </div>

                                <!-- Financial Details -->
                                <div class="flex justify-between items-center mb-6">
                                    <span class="text-xs text-gray-600">Physical Asset Value</span>
                                    <span class="text-primary font-bold">KES {{ number_format($profile->application_data['value_of_physical_assets'] ?? 0) }}</span>
                                </div>

                                <div class="flex justify-between items-center mb-6">
                                    <span class="text-xs text-gray-600">Selling Price</span>
                                    <span class="text-primary font-bold">KES {{ number_format($profile->application_data['asset_selling_price'] ?? 0) }}</span>
                                </div>

                                <!-- Contact Business Button -->
                                <a href="{{ route('sellerProfileOverview', ['id' => $profile->id]) }}" class="uppercase text-xs px-8 py-2 border-2 border-gray-300 block text-center rounded-sm">Contact Business</a>

                            </div>
                        @empty
                            <p>No business profiles available.</p>
                        @endforelse
                    </div>


                    <!-- Pagination -->
                    <div class="flex mt-8 justify-center">
                        <nav class="flex space-x-2">
                            <a href="#" class="px-3 py-2 rounded-md bg-[#e9e9e9]">1</a>
                            <a href="#" class="px-3 py-2 text-gray-700 hover:bg-gray-300">2</a>
                            <a href="#" class="px-3 py-2 text-gray-700 hover:bg-gray-300">3</a>
                            <span class="px-3 py-2">...</span>
                            <a href="#" class="flex items-center px-3 py-2 rounded-md text-gray-700 hover:bg-gray-300">
                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                                </svg>
                            </a>
                        </nav>
                    </div>
                </div>
            </div>
        </article>
    </section>
</x-guest-layout>
