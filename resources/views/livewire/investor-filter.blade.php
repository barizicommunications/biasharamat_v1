<div class="lg:flex lg:space-x-10">
    <!-- Sidebar Filters -->
    <aside class="w-full lg:w-1/4 mb-6 lg:mb-0">
        <div class="space-y-6">
            <!-- Buyer Roles Filter -->
            <div>
                <h3 class="text-gray-400 mb-4 font-bold">Buyer Role</h3>
                @foreach(['Individual investor/buyer', 'Corporate investor/buyer'] as $role)
                    <label class="flex items-center mb-2">
                        <input type="checkbox" wire:model="buyerRoles" value="{{ $role }}" class="rounded-full text-gray-500">
                        <span class="ml-4 text-sm text-gray-600">{{ $role }}</span>
                    </label>
                @endforeach
            </div>

            <!-- Interested In Filter -->
            <div>
                <h3 class="text-gray-400 mb-4 font-bold">Interested In</h3>
                @foreach(['Acquiring / Buying a Business', 'Investing in a Business', 'Buying assets'] as $interest)
                    <label class="flex items-center mb-2">
                        <input type="checkbox" wire:model="interests" value="{{ $interest }}" class="rounded-full text-gray-500">
                        <span class="ml-4 text-sm text-gray-600">{{ $interest }}</span>
                    </label>
                @endforeach
            </div>

            <!-- Company Industry Filter -->
            <div>
                <h3 class="text-gray-400 mb-4 font-bold">Company Industry</h3>
                <select wire:model="companyIndustry" class="w-full border-gray-300 text-gray-500 py-3 rounded-md">
                    <option value="">All Industries</option>
                    @foreach(['Education', 'Technology', 'Healthcare', 'Finance', 'Retail'] as $industry)
                        <option value="{{ $industry }}">{{ $industry }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Buyer Interest Filter -->
            <div>
                <h3 class="text-gray-400 mb-4 font-bold">Buyer Interest</h3>
                <select wire:model="buyerInterest" class="w-full border-gray-300 text-gray-500 py-3 rounded-md">
                    <option value="">All Buyer Interests</option>
                    @foreach(['Technology', 'Healthcare', 'Finance', 'Retail'] as $interest)
                        <option value="{{ $interest }}">{{ $interest }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </aside>

    <!-- Results Section -->
    <section class="w-full lg:w-3/4">
        <!-- Search Input -->
        <div class="relative mb-6">
            <input type="text"
                   wire:model="search"
                   placeholder="Search by company name, buyer interest, or location"
                   class="border-gray-300 text-gray-500 py-3 pr-10 pl-4 rounded-md w-full focus:outline-none focus:ring-2 focus:ring-indigo-500">
            <div class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M21 21l-4.35-4.35m2.85-6.15a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
        </div>

        <!-- Investor Profiles Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @forelse ($investorProfiles as $profile)
                <div class="bg-white shadow-lg rounded-lg overflow-hidden border border-gray-100 hover:shadow-2xl transition-shadow duration-300">
                    <div class="p-6">
                        <!-- Header Section -->
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 flex-shrink-0">
                                <img src="{{ asset('images/investor-pic.png') }}" alt="Investor Logo" class="w-12 h-12 rounded-full object-cover">
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-bold text-gray-800">{{ $profile->company_name }}</h3>
                                <p class="text-sm text-gray-500">{{ $profile->current_location }}</p>
                            </div>
                        </div>

                        <!-- Industry and Interested In -->
                        <div class="mb-2">
                            <span class="inline-block bg-indigo-100 text-indigo-700 text-xs font-medium px-2 py-1 rounded">
                                {{ $profile->company_industry ?? 'Unspecified Industry' }}
                            </span>
                        </div>

                        <p class="text-sm text-gray-600 mb-2">
                            <span class="font-semibold">Interested In:</span>
                            {{ is_array($profile->interested_in) ? implode(', ', $profile->interested_in) : $profile->interested_in }}
                        </p>

                        <p class="text-sm text-gray-600 mb-2">
                            <span class="font-semibold">Buyer Interest:</span> {{ $profile->buyer_interest }}
                        </p>

                        <p class="text-sm text-gray-600 mb-4">
                            <span class="font-semibold">Location Interest:</span> {{ $profile->buyer_location_interest }}
                        </p>

                        <!-- Contact Button -->
                        <div>
                            <a href="{{ route('buyer.buyer-profile', ['id' => $profile->id]) }}"
                               class="inline-block bg-[#030e4f] text-white font-medium py-2 px-4 rounded hover:bg-[#1e2d7a] transition-colors duration-300">
                                Contact Investor
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-gray-600 col-span-full text-center">No investor profiles available.</p>
            @endforelse
        </div>

        <!-- Pagination -->
        @if ($investorProfiles->hasPages())
            <div class="mt-8 flex justify-center">
                {{ $investorProfiles->links() }}
            </div>
        @endif
    </section>
</div>
