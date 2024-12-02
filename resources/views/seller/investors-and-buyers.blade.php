<x-guest-layout>
    <section class="bg-[#f4f4f4]">
        <article class="mx-auto max-w-screen-xl px-4 py-16 sm:px-6 lg:py-8">
            <!-- Breadcrumb -->
            <div class="flex items-center py-4 overflow-x-auto whitespace-nowrap mb-8">
                <a href="#" class="text-gray-600 dark:text-gray-200 hover:underline">Home</a>
                <span class="mx-3 text-gray-500 dark:text-gray-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                </span>
                <a href="#" class="text-primary">Businesses</a>
            </div>

            <!-- Page Title -->
            <h2 class="font-bold text-primary text-xl md:text-3xl mb-8">Businesses</h2>

            <!-- Layout Container -->
            <div class="lg:flex lg:space-x-10">
                <!-- Sidebar Filters -->
                <aside class="w-full lg:w-1/4 mb-6 lg:mb-0">
                    <!-- Filters Section -->
                    <div class="space-y-6">
                        <!-- Category Filter -->
                        <div>
                            <h3 class="text-gray-400 mb-4 font-bold">Category</h3>
                            <select name="category" class="w-full border-gray-300 text-gray-500 py-3 rounded-md">
                                <option value="">Investors and Buyers</option>
                            </select>
                        </div>

                        <!-- Investor Type Filter -->
                        <div>
                            <h3 class="text-gray-400 mb-4 font-bold">Investor Type</h3>
                            @foreach(['All', 'Individuals', 'Companies', 'Lenders', 'Financial advisors', 'Funds'] as $type)
                                <label class="flex items-center mb-2">
                                    <input type="checkbox" name="investor_type[]" value="{{ $type }}" class="rounded-full text-gray-500">
                                    <span class="ml-4 text-sm text-gray-600">{{ $type }}</span>
                                </label>
                            @endforeach
                        </div>

                        <!-- Interested In Filter -->
                        <div>
                            <h3 class="text-gray-400 mb-4 font-bold">Interested In</h3>
                            @foreach(['All transactions', 'Buying a business', 'Investing in a business', 'Lending to a business', 'Buying business assets', 'Buying'] as $interest)
                                <label class="flex items-center mb-2">
                                    <input type="checkbox" name="interest[]" value="{{ $interest }}" class="rounded-full text-gray-500">
                                    <span class="ml-4 text-sm text-gray-600">{{ $interest }}</span>
                                </label>
                            @endforeach
                        </div>

                        <!-- Location Filter -->
                        <div>
                            <h3 class="text-gray-400 mb-4 font-bold">Locations</h3>
                            <select name="location" class="w-full border-gray-300 text-gray-500 py-3 rounded-md mb-4">
                                <option value="">Filter</option>
                            </select>
                            @foreach(['Africa', 'Asia', 'Europe', 'North America', 'Oceania', 'South America'] as $location)
                                <label class="flex items-center mb-2">
                                    <input type="checkbox" name="locations[]" value="{{ $location }}" class="rounded-full text-gray-500">
                                    <span class="ml-4 text-sm text-gray-600">{{ $location }}</span>
                                </label>
                            @endforeach
                        </div>

                        <!-- Industry Filter -->
                        <div>
                            <h3 class="text-gray-400 mb-4 font-bold">Industries</h3>
                            <select name="industry" class="w-full border-gray-300 text-gray-500 py-3 rounded-md mb-4">
                                <option value="">Filter</option>
                            </select>
                            @foreach(['Building, construction & maintenance', 'Business services', 'Education', 'Energy', 'Finance', 'Food & beverage', 'Health care', 'Industrial', 'Logistics', 'Media', 'Retail shops', 'Technology', 'Textiles', 'Travel & leisure'] as $industry)
                                <label class="flex items-center mb-2">
                                    <input type="checkbox" name="industries[]" value="{{ $industry }}" class="rounded-full text-gray-500">
                                    <span class="ml-4 text-sm text-gray-600">{{ $industry }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                </aside>

                <!-- Results Section -->
                <section class="w-full lg:w-3/4">
                    <!-- Sort and Results Header -->
                    <div class="flex justify-between mb-6">
                        <h3 class="text-gray-400">Showing {{ $businessProfiles->count() }} results</h3>
                        <select name="sort" class="border-gray-300 text-gray-500 py-3 rounded-md">
                            <option value="rating">Sort by ratings</option>
                        </select>
                    </div>

                    <!-- Business Listings Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                        @forelse ($businessProfiles as $profile)
                            <article class="bg-white shadow-md rounded-lg overflow-hidden border border-gray-200">
                                <div class="p-4">
                                    <!-- Header -->
                                    <div class="flex items-start justify-between mb-4">
                                        <div>
                                            <div class="flex items-center">
                                                <img src="{{ asset('images/Logo.png') }}" alt="Business Logo" class="w-12 h-12 rounded-full object-cover">
                                                <div class="ml-4">
                                                    <h3 class="text-sm font-semibold text-gray-800">
                                                        {{ $profile->application_data['company_name'] ?? $profile->company_name ?? 'N/A' }}
                                                    </h3>
                                                    <p class="text-xs text-gray-500">
                                                        {{ $profile->application_data['city'] ?? 'Unknown Location' }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Description -->
                                    <p class="text-sm text-gray-600 mb-2 truncate">
                                        {{ $profile->application_data['business_description'] ?? 'No description available.' }}
                                    </p>

                                    <!-- Industry -->
                                    <div class="mb-4">
                                        <span class="bg-gray-200 text-gray-600 text-xs px-2 py-1 rounded">
                                            {{ $profile->application_data['business_industry'] ?? 'Unspecified Industry' }}
                                        </span>
                                    </div>

                                    <!-- Financial Details -->
                                    <div class="mb-4">
                                        <div class="flex justify-between items-center text-sm text-gray-600">
                                            <span>Selling Price:</span>
                                            <span class="font-bold text-lg text-[#030e4f]">
                                                KES {{ number_format($profile->tentative_selling_price ?? 0) }}
                                            </span>
                                        </div>
                                    </div>

                                    <!-- Ratings and Verification -->
                                    <div class="flex justify-between items-center mb-4 text-xs">
                                        <div class="flex items-center space-x-1">
                                            @for ($i = 0; $i < 5; $i++)
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-yellow-400" fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M12 .587l3.668 7.453 8.332 1.209-6.041 5.885 1.42 8.306L12 18.896l-7.379 3.874 1.42-8.306-6.041-5.885 8.332-1.209z" />
                                                </svg>
                                            @endfor
                                        </div>
                                        <div class="flex items-center text-green-600 font-semibold">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 00-1.414 0L8 12.586 4.707 9.293a1 1 0 00-1.414 1.414l4 4a1 1 0 001.414 0l8-8a1 1 0 000-1.414z" clip-rule="evenodd" />
                                            </svg>
                                            Verified Seller
                                        </div>
                                    </div>
                                </div>

                                <!-- Footer -->
                                <div class="bg-gray-50 p-4">
                                    <a href="{{ route('sellerProfileOverview', ['id' => $profile->id]) }}"
                                       class="block text-center text-sm py-2 rounded border-2 border-[#030e4f] text-[#030e4f] hover:bg-[#030e4f] hover:text-white transition duration-300">
                                        Contact Business
                                    </a>
                                </div>
                            </article>
                        @empty
                            <p class="text-gray-600">No business profiles available.</p>
                        @endforelse
                    </div>


                    <!-- Pagination -->
                    @if ($businessProfiles->isNotEmpty())
                        <div class="mt-8 flex justify-center">
                            {{ $businessProfiles->links() }}
                        </div>
                    @endif
                </section>
            </div>
        </article>
    </section>
</x-guest-layout>
