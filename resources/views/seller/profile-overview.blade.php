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

                    <div class="bg-white p-8 mb-8">
                        <div class="mb-6">
                            @if (isset($documents['business_photos']))
                                @foreach ($documents['business_photos'] as $photo)
                                    <img src="{{ Storage::url($photo) }}" alt="">
                                @endforeach
                            @endif
                        </div>

                        <div class="grid grid-cols-1 gap-10 md:grid-cols-3">
                            <div class="col-span-2">
                                <h2 class="mb-3">{{ $applicationData['seller_interest'] }}</h2>

                                <p>{{ $applicationData['business_highlights'] ?? 'No highlights available' }}</p>
                                <h2 class="mb-3">Business overview</h2>
                                <p>{{ $applicationData['business_description'] }}</p>

                                <h2 class="mb-3">Products and services overview</h2>
                                <p>{{ $applicationData['product_services'] ?? 'No product services available' }}</p>

                                <h2 class="mb-3">Assets Overview</h2>
                                <p>{{ $documents['tangible_assets'] ?? 'No assets available' }}</p>

                                <h2 class="mb-3">Capitalization Overview</h2>
                                <p>{{ $applicationData['business_funds'] }}</p>
                            </div>

                            <div>
                                <h2 class="font-semibold text-primary mb-4">Overall rating</h2>

                                <div class="flex items-center mb-2">
                                    <div class="flex shrink-0 self-center space-x-2">
                                        <div><img src="{{ asset('images/star.png') }}" class="scale-150" alt=""></div>
                                        <div><img src="{{ asset('images/star.png') }}" class="scale-150" alt=""></div>
                                        <div><img src="{{ asset('images/star.png') }}" class="scale-150" alt=""></div>
                                        <div><img src="{{ asset('images/star.png') }}" class="scale-150" alt=""></div>
                                        <div><img src="{{ asset('images/star.png') }}" class="scale-150" alt=""></div>
                                    </div>
                                    <div class="self-center ml-4">
                                        <h3><span class="text-xl font-extrabold text-gray-400">4.5</span> /5</h3>
                                    </div>
                                </div>

                                <div class="mb-10">
                                    <a href="#" class="text-blue-400 text-sm">Compare with industry</a>
                                </div>

                                <div class="mb-3">
                                    <h3 class="mb-2">Name, phone, email</h3>
                                    <p class="text-sm">{{ $applicationData['name'] }}</p>
                                    <p class="text-sm">{{ $applicationData['mobile_number'] }}</p>
                                    <p class="text-sm">{{ $applicationData['email'] }}</p>
                                </div>

                                <div class="mb-16">
                                    <h3 class="mb-2">User verification</h3>
                                    <p class="text-sm flex mb-2">
                                        <span class="inline-block self-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                                            </svg>
                                        </span>
                                        <span class="ml-3">Phone</span>
                                    </p>
                                    <p class="text-sm flex">
                                        <span class="inline-block self-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                                            </svg>
                                        </span>
                                        <span class="ml-3">Email</span>
                                    </p>
                                </div>

                                <div>
                                    <h3 class="mb-4">Documents</h3>
                                    <div class="mb-3">
                                        @foreach(['certificate_of_incorporation', 'kra_pin', 'number_shareholders', 'liabilities', 'business_profile', 'valuation_report'] as $doc)
                                            @if (isset($documents[$doc]))
                                                <a href="{{ Storage::url($documents[$doc]) }}" target="_blank" class="underline text-[#c75126] block text-xs">{{ ucwords(str_replace('_', ' ', $doc)) }}</a>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right sidebar -->
                <div class="w-2/5 h-fit" x-data="{ showContent: false }">
                    <div class="bg-white p-6 mb-6">
                        <h3 class="text-semibold text-primary text-lg">{{ $applicationData['company_name'] }}</h3>
                        <hr class="mt-2 mb-6">

                        <div class="grid gap-4 grid-cols-1 md:grid-cols-3 mb-6">
                            <div class="col-span-2">
                                <h5 class="text-sm mb-1">Industry</h5>
                                <h2 class="font-bold text-gray-400">{{ $applicationData['business_industry'] }}</h2>
                            </div>
                            <div>
                                <h5 class="text-sm mb-1">Employees</h5>
                                <h2 class="font-bold text-gray-400">{{ $applicationData['number_employees'] }}</h2>
                            </div>
                        </div>
                    </div>





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
                                <button type="submit" class="text-white bg-primary py-3 px-8 rounded-md w-full">Contact business</button>
                            </div>
                        </div>
                    </form>
                @endif


                </div>
            </div>
        </article>
    </section>
</x-guest-layout>
