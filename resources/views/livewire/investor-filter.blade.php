<div class="lg:flex lg:space-x-10">
    <!-- Sidebar Filters -->
    <aside class="w-full lg:w-1/4 mb-6 lg:mb-0">
        <div class="space-y-6">
            <!-- Buyer Roles Filter -->
            <div>
                <h3 class="text-gray-400 mb-4 font-bold">Buyer Role</h3>
                @foreach ($buyerRolesOptions as $role)
                    <label class="flex items-center mb-2">
                        <input
                            type="checkbox"
                            wire:model.live="buyerRoles"
                            value="{{ $role }}"
                            class="rounded-full text-gray-500"
                        >
                        <span class="ml-4 text-sm text-gray-600">{{ $role }}</span>
                    </label>
                @endforeach
            </div>

            <!-- Company Industry Filter -->
            <div>
                <h3 class="text-gray-400 mb-4 font-bold">Company Industry</h3>
                <select
                    wire:model.live="companyIndustry"
                    class="w-full border-gray-300 text-gray-500 py-3 rounded-md"
                >
                    <option value="">All Industries</option>
                    @foreach ($industries as $industry)
                        <option value="{{ $industry }}">{{ $industry }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Buyer Interest Filter -->
            <div>
                <h3 class="text-gray-400 mb-4 font-bold">Buyer Interest</h3>
                <select
                    wire:model.live="buyerInterest"
                    class="w-full border-gray-300 text-gray-500 py-3 rounded-md"
                >
                    <option value="">All Buyer Interests</option>
                    <option value="Technology">Technology</option>
                    <option value="Healthcare">Healthcare</option>
                    <option value="Finance">Finance</option>
                    <option value="Retail">Retail</option>
                </select>
            </div>
        </div>
    </aside>

    <!-- Results Section -->
    <section class="w-full lg:w-3/4">
        <!-- Search Input -->
        <div class="relative mb-6">
            <input
                type="text"
                wire:model.live.debounce.300ms="search"
                placeholder="Search by company name"
                class="border-gray-300 text-gray-500 py-3 pr-10 pl-4 rounded-md w-full focus:outline-none focus:ring-2 focus:ring-indigo-500"
            >
            <div class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35m2.85-6.15a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
        </div>

        <!-- Investor Profiles Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
   @forelse ($investorProfiles as $profile)
       <div class="bg-white shadow-md rounded-lg overflow-hidden border border-gray-200 hover:shadow-lg transition-shadow duration-300 flex flex-col">
           <div class="p-6 flex-1">
               <!-- Header Section -->
               <div class="mb-4">
                   <div class="flex items-start space-x-3">
                       <div class="w-12 h-12 flex-shrink-0">
                           <div class="w-12 h-12 rounded-full bg-indigo-100 flex items-center justify-center">
                               <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                   <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-6m-8 0H3m2 0h6m0 0v-4a2 2 0 012-2h2a2 2 0 012 2v4" />
                               </svg>
                           </div>
                       </div>
                       <div class="flex-1 min-w-0">
                           <h3 class="text-base font-semibold text-gray-800 break-words leading-tight">{{ $profile->company_name }}</h3>
                           <p class="text-sm text-gray-500 mt-1">{{ $profile->current_location }}</p>
                       </div>
                   </div>
               </div>

               <!-- Industry Tag -->
               <div class="mb-3">
                   <span class="inline-block bg-indigo-100 text-indigo-700 text-xs font-medium px-2 py-1 rounded">
                       {{ $profile->company_industry ?? 'Unspecified Industry' }}
                   </span>
               </div>

               <!-- Profile Details -->
               <div class="space-y-2">
                   <p class="text-sm text-gray-600">
                       <span class="font-medium">Interested In:</span> <span class="break-words">{{ $profile->interested_in }}</span>
                   </p>
                   <p class="text-sm text-gray-600">
                       <span class="font-medium">Buyer Interest:</span> <span class="break-words">{{ $profile->buyer_interest }}</span>
                   </p>
                   <p class="text-sm text-gray-600">
                       <span class="font-medium">Location Interest:</span> <span class="break-words">{{ $profile->buyer_location_interest }}</span>
                   </p>
               </div>
           </div>

           <!-- Footer with Contact Button -->
           <div class="bg-gray-50 px-6 py-4 mt-auto">
               <a href="{{ route('buyer.buyer-profile', ['id' => $profile->id]) }}"
                  class="w-full flex items-center justify-center px-4 py-2 bg-[#030e4f] text-white text-sm font-medium rounded-md hover:bg-[#1e2d7a] transition-colors duration-300">
                   Contact Investor
               </a>
           </div>
       </div>
   @empty
       <p class="text-gray-600 col-span-full text-center">No investor profiles available.</p>
   @endforelse
</div>

        <!-- Pagination -->
        @if ($investorProfiles->hasPages())
            <div class="mt-8">
                {{ $investorProfiles->links() }}
            </div>
        @endif
    </section>
</div>