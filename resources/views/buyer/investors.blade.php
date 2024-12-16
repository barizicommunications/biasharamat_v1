<x-guest-layout>
    <section class="bg-[#f4f4f4]">
        <article class="mx-auto max-w-screen-xl px-4 py-16 sm:px-6 lg:py-8">
            <!-- Breadcrumb -->
            <div class="flex items-center py-4 overflow-x-auto whitespace-nowrap mb-8">
                <a href="#" class="text-gray-600 hover:underline">Home</a>
                <span class="mx-3 text-gray-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                </span>
                <a href="#" class="text-primary">Investors</a>
            </div>

            <!-- Page Title -->
            <h2 class="font-bold text-primary text-xl md:text-3xl mb-8">Investors</h2>

            <!-- Layout Container -->
            {{-- <div class="lg:flex lg:space-x-10">
                <!-- Sidebar Filters -->
                <aside class="w-full lg:w-1/4 mb-6 lg:mb-0">
                    <!-- Filters Section -->
                    <div class="space-y-6">
                        <!-- Category Filter -->
                        <div>
                            <h3 class="text-gray-400 mb-4 font-bold">Category</h3>
                            <select name="category" class="w-full border-gray-300 text-gray-500 py-3 rounded-md">
                                <option value="">Investors</option>
                            </select>
                        </div>

                        <!-- Buyer Role Filter -->
                        <div>
                            <h3 class="text-gray-400 mb-4 font-bold">Buyer Role</h3>
                            @foreach(['Individual', 'Company'] as $role)
                                <label class="flex items-center mb-2">
                                    <input type="checkbox" name="buyer_role[]" value="{{ $role }}" class="rounded-full text-gray-500">
                                    <span class="ml-4 text-sm text-gray-600">{{ $role }}</span>
                                </label>
                            @endforeach
                        </div>

                        <!-- Interested In Filter -->
                        <div>
                            <h3 class="text-gray-400 mb-4 font-bold">Interested In</h3>
                            @foreach(['Buying a business', 'Investing in a business', 'Buying assets'] as $interest)
                                <label class="flex items-center mb-2">
                                    <input type="checkbox" name="interested_in[]" value="{{ $interest }}" class="rounded-full text-gray-500">
                                    <span class="ml-4 text-sm text-gray-600">{{ $interest }}</span>
                                </label>
                            @endforeach
                        </div>

                        <!-- Location Interest Filter -->
                        <div>
                            <h3 class="text-gray-400 mb-4 font-bold">Location Interest</h3>
                            @foreach(['Africa', 'Asia', 'Europe', 'North America', 'South America', 'Oceania'] as $location)
                                <label class="flex items-center mb-2">
                                    <input type="checkbox" name="buyer_location_interest[]" value="{{ $location }}" class="rounded-full text-gray-500">
                                    <span class="ml-4 text-sm text-gray-600">{{ $location }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                </aside>

                <!-- Results Section -->
                <section class="w-full lg:w-3/4">
                    <!-- Sort and Results Header -->
                    <div class="flex justify-between mb-6">
                        <h3 class="text-gray-400">Showing {{ $investorProfiles->count() }} results</h3>
                        <select name="sort" class="border-gray-300 text-gray-500 py-3 rounded-md">
                            <option value="investment_range">Sort by Investment Range</option>
                        </select>
                    </div>

                    <!-- Investor Listings Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                        @forelse ($investorProfiles as $profile)
                            <article class="bg-white shadow-md rounded-lg overflow-hidden border border-gray-200">
                                <div class="p-4">
                                    <!-- Header -->
                                    <div class="flex items-start justify-between mb-4">
                                        <div>
                                            <div class="flex items-center">
                                                <img src="{{ asset('images/investor-pic.png') }}" alt="Investor Logo" class="w-12 h-12 rounded-full object-cover">
                                                <div class="ml-4">
                                                    <h3 class="text-sm font-semibold text-gray-800">
                                                        {{ $profile->name }}
                                                    </h3>
                                                    <p class="text-xs text-gray-500">
                                                        {{ $profile->current_location }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- About Company -->
                                    <p class="text-sm text-gray-600 mb-2 truncate">
                                        {{ $profile->about_company }}
                                    </p>

                                    <!-- Industry -->
                                    <div class="mb-4">
                                        <span class="bg-gray-200 text-gray-600 text-xs px-2 py-1 rounded">
                                            {{ $profile->company_industry ?? 'Unspecified Industry' }}
                                        </span>
                                    </div>

                                    <!-- Investment Range -->
                                    <div class="mb-4">
                                        <div class="flex justify-between items-center text-sm text-gray-600">
                                            <span>Investment Range:</span>
                                            <span class="font-bold text-lg text-[#030e4f]">
                                                {{ $profile->investment_range }}
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Footer -->
                                <div class="bg-gray-50 p-4">
                                    <a href="{{ route('buyer.buyer-profile', ['id' => $profile->id]) }}"
                                       class="block text-center text-sm py-2 rounded border-2 border-[#030e4f] text-[#030e4f] hover:bg-[#030e4f] hover:text-white transition duration-300">
                                        Contact Investor
                                    </a>
                                </div>
                            </article>
                        @empty
                            <p class="text-gray-600">No investor profiles available.</p>
                        @endforelse
                    </div>

                    <!-- Pagination -->
                    @if ($investorProfiles->isNotEmpty())
                        <div class="mt-8 flex justify-center">
                            {{ $investorProfiles->links() }}
                        </div>
                    @endif
                </section>
            </div> --}}

            @livewire('investor-filter')
        </article>
    </section>
</x-guest-layout>
