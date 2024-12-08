<x-guest-layout>
    <section class="bg-[#f4f4f4]">
        <article class="mx-auto max-w-screen-2xl px-4 py-16 sm:px-6 lg:py-8">
            <div class="flex items-center py-4 overflow-x-auto whitespace-nowrap mb-8">
                <a href="#" class="text-gray-600 dark:text-gray-200 hover:underline">
                    Home
                </a>
                <span class="mx-3 text-gray-500 dark:text-gray-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                </span>
                <a href="#" class="text-primary">
                    {{ $applicationData['business_industry'] }}
                </a>
            </div>

            <h2 class="text-primary font-bold text-xl md:text-3xl mb-8">{{ $applicationData['company_name'] }}</h2>

            <div class="flex flex-wrap md:flex-nowrap space-x-8">
                <div class="w-3/5">
                    <div class="bg-white p-8 mb-8 rounded-lg shadow-md">
                        <!-- Image Gallery -->
                        <div class="mb-6">
                            @if (isset($documents['business_photos']) && count($documents['business_photos']) > 0)
                                <div class="swiper">
                                    <div class="swiper-wrapper">
                                        @foreach ($documents['business_photos'] as $photo)
                                            <div class="swiper-slide">
                                                <img src="{{ Storage::url($photo) }}" alt="Business Photo" class="w-full h-auto rounded-md">
                                            </div>
                                        @endforeach
                                    </div>
                                    <!-- Pagination and Navigation -->
                                    <div class="swiper-pagination"></div>
                                    <div class="swiper-button-next"></div>
                                    <div class="swiper-button-prev"></div>
                                </div>
                            @else
                                <p class="text-gray-500 text-sm">No photos available.</p>
                            @endif
                        </div>

                        <!-- Business Details -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                            <!-- Main Content -->
                            <div class="col-span-2">
                                <h2 class="text-lg font-semibold text-primary mb-4">Business Details</h2>
                                <ul class="space-y-3 text-sm text-gray-600">
                                    <li><strong>Established:</strong> {{ $applicationData['business_start_date'] ?? 'Not specified' }}</li>
                                    <li><strong>Employees:</strong> {{ $applicationData['number_employees'] ?? 'Not specified' }}</li>
                                    <li><strong>Industry:</strong> {{ $applicationData['business_industry'] ?? 'Not specified' }}</li>
                                    <li><strong>Location:</strong> {{ $applicationData['city'] ?? 'Not specified' }}</li>
                                </ul>

                                <!-- Business Overview -->
                                <h2 class="text-lg font-semibold text-primary mt-6 mb-3">Business Overview</h2>
                                <p class="mb-6 text-sm text-gray-600">{{ $applicationData['business_description'] ?? 'No description available.' }}</p>

                                <!-- Products and Services -->
                                <h2 class="text-lg font-semibold text-primary mb-3">Products and Services Overview</h2>
                                <p class="mb-6 text-sm text-gray-600">{{ $applicationData['product_services'] ?? 'No product services available.' }}</p>

                                <!-- Assets Overview -->
                                <h2 class="text-lg font-semibold text-primary mb-3">Assets Overview</h2>
                                <p class="mb-6 text-sm text-gray-600">{{ $documents['tangible_assets'] ?? 'No tangible assets specified.' }}</p>

                                <!-- Capitalization Overview -->
                                <h2 class="text-lg font-semibold text-primary mb-3">Capitalization Overview</h2>
                                <p class="text-sm text-gray-600">{{ $applicationData['business_funds'] ?? 'No funds data available.' }}</p>
                            </div>

                            <!-- Sidebar -->
                            <div>
                                <!-- Rating -->
                                <h2 class="font-semibold text-primary mb-4">Overall Rating</h2>
                                <div class="flex items-center mb-4">
                                    <div class="flex shrink-0 self-center space-x-1">
                                        @for ($i = 0; $i < 5; $i++)
                                            <img src="{{ asset('images/star.png') }}" alt="Star Rating" class="h-6 w-6">
                                        @endfor
                                    </div>
                                    <div class="self-center ml-4">
                                        <h3><span class="text-xl font-bold text-gray-700">4.5</span> / 5</h3>
                                    </div>
                                </div>
                                <a href="#" class="text-blue-400 text-sm underline">Compare with industry</a>

                                <!-- Contact Information -->
                                <div class="mt-6">
                                    <h3 class="font-semibold text-primary mb-2">Contact Information</h3>
                                    <p class="text-sm text-gray-600"><strong>Name:</strong> {{ $applicationData['name'] ?? 'Not provided' }}</p>
                                    <p class="text-sm text-gray-600"><strong>Phone:</strong> {{ $applicationData['mobile_number'] ?? 'Not provided' }}</p>
                                    <p class="text-sm text-gray-600"><strong>Email:</strong> {{ $applicationData['email'] ?? 'Not provided' }}</p>
                                </div>

                                <!-- Documents -->
                                <div class="mt-6">
                                    <h3 class="font-semibold text-primary mb-2">Documents</h3>
                                    <div class="space-y-3">
                                        @if (isset($documents) && count($documents) > 0)
                                            @foreach (['certificate_of_incorporation', 'kra_pin', 'number_shareholders', 'liabilities', 'business_profile', 'valuation_report'] as $doc)
                                                @if (isset($documents[$doc]))
                                                    <div class="flex items-center space-x-4">
                                                        <!-- Lock Icon -->
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-red-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V7.5a4.5 4.5 0 00-9 0v3M7.5 10.5h9m-9 0a2.25 2.25 0 00-2.25 2.25v6.75A2.25 2.25 0 007.5 21h9a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25m-9 0h9" />
                                                        </svg>

                                                        <!-- File Link -->
                                                        <a href="{{ Storage::url($documents[$doc]) }}" target="_blank" class="text-blue-500 underline text-sm">
                                                            {{ ucwords(str_replace('_', ' ', $doc)) }}
                                                        </a>
                                                    </div>
                                                @endif
                                            @endforeach
                                        @else
                                            <p class="text-gray-500 text-sm">No documents available.</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>




                <!-- Right Sidebar -->
                <div class="w-2/5 h-fit">
                    @if(auth()->id() !== $sellerProfile->user_id)
                        <form action="{{ route('messages.send', ['recipient' => $sellerProfile->user_id]) }}" method="POST">
                            @csrf
                            <div class="bg-white p-6">
                                <h3 class="text-[#9D9D9D] mb-2">Introduce yourself and leave the business a message</h3>
                                <textarea name="message" id="message" class="w-full border border-[#D9D9D9] rounded-sm mb-6" style="height: 140px; resize: none;"></textarea>
                                @error('message')
                                    <p class="text-red-500 text-sm my-6">{{ $message }}</p>
                                @enderror
                                <div>
                                    <button type="submit" class="text-white bg-primary py-3 px-8 rounded-md w-full">Contact Business</button>
                                </div>
                            </div>
                        </form>
                    @else
                        <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 mb-6">
                            <p class="font-bold">Note:</p>
                            <p>Investors can contact you directly through this profile.</p>
                        </div>
                    @endif
                </div>

            </div>
        </article>
    </section>
</x-guest-layout>
