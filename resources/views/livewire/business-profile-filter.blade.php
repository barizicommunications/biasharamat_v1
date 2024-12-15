<div class="lg:flex lg:space-x-10">
    <!-- Sidebar Filters -->

<aside class="w-full lg:w-1/4 mb-6 lg:mb-0">
    <div class="space-y-6">
        <!-- Country Filter -->
        <div>
            <h3 class="text-gray-400 mb-4 font-bold">Country</h3>
            <select wire:model.live="country" class="w-full border-gray-300 text-gray-500 py-3 rounded-md">
                <option value="">All Countries</option>
                @foreach($countries as $countryOption)
                    <option value="{{ $countryOption }}">{{ $countryOption }}</option>
                @endforeach
            </select>
        </div>

        <!-- City Filter -->
        @if (!empty($cities))
            <div>
                <h3 class="text-gray-400 mb-4 font-bold">City</h3>
                <select wire:model.live="city" class="w-full border-gray-300 text-gray-500 py-3 rounded-md">
                    <option value="">All Cities</option>
                    @foreach($cities as $cityOption)
                        <option value="{{ $cityOption }}">{{ $cityOption }}</option>
                    @endforeach
                </select>
            </div>
        @endif

        <!-- Seller Interest Filter -->
        <div>
            <h3 class="text-gray-400 mb-4 font-bold">Seller Interest</h3>
            @foreach($sellerInterests as $interest)
                <label class="flex items-center mb-2">
                    <input type="checkbox"
                           wire:model.live="sellerInterest"
                           value="{{ $interest }}"
                           class="rounded-full text-gray-500">
                    <span class="ml-4 text-sm text-gray-600">{{ $interest }}</span>
                </label>
            @endforeach
        </div>

        <!-- Business Legal Entity Filter -->
        <div>
            <h3 class="text-gray-400 mb-4 font-bold">Business Legal Entity</h3>
            <select wire:model.live="businessLegalEntity" class="w-full border-gray-300 text-gray-500 py-3 rounded-md">
                <option value="">All Entities</option>
                @foreach($legalEntities as $entity)
                    <option value="{{ $entity }}">{{ $entity }}</option>
                @endforeach
            </select>
        </div>

        <!-- Industry Filter -->
        <div>
            <h3 class="text-gray-400 mb-4 font-bold">Industries</h3>
            <select wire:model.live="industry" class="w-full border-gray-300 text-gray-500 py-3 rounded-md mb-4">
                <option value="">All Industries</option>
                @foreach($industries as $industryOption)
                    <option value="{{ $industryOption }}">{{ $industryOption }}</option>
                @endforeach
            </select>
        </div>
    </div>
</aside>



    <!-- Results Section -->
    <section class="w-full lg:w-3/4">
        <!-- Sort and Results Header -->
        <div class="flex justify-between mb-6">
            <input type="text"
                   wire:model.live="search"
                   placeholder="Search by company name, industry, or legal entity"
                   class="border-gray-300 text-gray-500 py-3 rounded-md w-3/4 mr-4">

                   <select wire:model="sort" wire:key="sort-select" class="border-gray-300 text-gray-500 py-3 rounded-md">
                    <option value="rating">Sort by rating</option>
                    <option value="pricing_asc">Price: Low to High</option>
                    <option value="pricing_desc">Price: High to Low</option>
                </select>
        </div>


        <!-- Business Listings Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @forelse ($businessProfiles as $profile)


                <article class="bg-white shadow-md rounded-lg overflow-hidden border border-gray-200">
                    <div class="p-4">
                        <!-- Header with Logo and Name -->
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex items-center">
                                <img src="{{ asset('images/Logo.png') }}" alt="Business Logo" class="w-12 h-12 rounded-full object-cover">
                                <div class="ml-4">
                                    <h3 class="text-sm font-semibold text-gray-800">
                                        {{ $profile->application_data['company_name'] ?? 'N/A' }}
                                    </h3>
                                    <p class="text-xs text-gray-500">
                                        {{ $profile->application_data['city'] ?? 'Unknown Location' }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Description -->
                        <p class="text-sm text-gray-600 mb-2 truncate">
                            {{ $profile->application_data['business_description'] ?? 'No description available.' }}
                        </p>

                        <!-- Industry Tag -->
                        <div class="mb-4">
                            <span class="bg-gray-200 text-gray-600 text-xs px-2 py-1 rounded">
                                {{ $profile->application_data['business_industry'] ?? 'Unspecified Industry' }}
                            </span>
                        </div>

                        <!-- Conditional Pricing Display -->
                        @php
                            $interest = $profile->application_data['seller_interest'] ?? null;
                        @endphp

                        @if ($interest === 'Sale of shares' && !empty($profile->tentative_selling_price))
                            <div class="mb-4">
                                <div class="flex justify-between items-center text-sm text-gray-600">
                                    <span>Selling Price:</span>
                                    <span class="font-bold text-lg text-[#030e4f]">
                                        KES {{ number_format($profile->tentative_selling_price) }}
                                    </span>
                                </div>
                            </div>
                        @elseif ($interest === 'Partial sale of shares' && !empty($profile->application_data['investment_amount']))
                            <div class="mb-4">
                                <div class="flex justify-between items-center text-sm text-gray-600">
                                    <span>Investment Amount:</span>
                                    <span class="font-bold text-lg text-[#030e4f]">
                                        KES {{ number_format($profile->application_data['investment_amount']) }}
                                    </span>
                                </div>
                            </div>
                        @elseif ($interest === 'Sale of assets' && !empty($profile->application_data['asset_selling_price']))
                            <div class="mb-4">
                                <div class="flex justify-between items-center text-sm text-gray-600">
                                    <span>Asset Selling Price:</span>
                                    <span class="font-bold text-lg text-[#030e4f]">
                                        KES {{ number_format($profile->application_data['asset_selling_price']) }}
                                    </span>
                                </div>
                            </div>
                        @elseif ($interest === 'Financing' && !empty($profile->application_data['loan_amount']))
                            <div class="mb-4">
                                <div class="flex justify-between items-center text-sm text-gray-600">
                                    <span>Loan Amount:</span>
                                    <span class="font-bold text-lg text-[#030e4f]">
                                        KES {{ number_format($profile->application_data['loan_amount']) }}
                                    </span>
                                </div>
                            </div>
                        @else
                            <div class="mb-4">
                                <div class="text-sm text-gray-500 italic">
                                    Pricing information not provided.
                                </div>
                            </div>
                        @endif

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


                    <!-- Footer with Contact Button -->
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
        @if ($businessProfiles->hasPages())
            <div class="mt-8 flex justify-center">
                {{ $businessProfiles->links() }}
            </div>
        @endif
    </section>
</div>
