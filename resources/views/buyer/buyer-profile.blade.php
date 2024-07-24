<x-guest-layout>
    <section class="bg-[#f4f4f4]">
        <article class="mx-auto max-w-screen-xl px-4 py-16 sm:px-6 lg:py-8">
            <div class="flex items-center py-4 overflow-x-auto whitespace-nowrap mb-8">


                <a href="#" class="text-gray-600 dark:text-gray-200 hover:underline">
                    Investors & buyers
                </a>
                <span class="mx-3 text-gray-500 dark:text-gray-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                </span>
                <a href="#" class="text-gray-600 dark:text-gray-200 hover:underline">
                    Kenya
                </a>
                <span class="mx-3 text-gray-500 dark:text-gray-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                </span>

                <a href="#" class="text-primary">
                    {{ $buyerProfile->buyer_interest }}
                </a>
            </div>


            <div class="flex flex-wrap md:flex-nowrap space-x-8">
                <div class="w-3/5">

                    <div class=" bg-white p-8 mb-8" >

                       <div class="mb-8">
                        <h2 class="text-primary font-semibold text-lg mb-2">{{ $buyerProfile->buyer_role }}</h2>

                        {{-- <p>Live business  |  Software development company for sale in Nairobi, Kenya</p> --}}
                        <p>Live business  |  {{ $buyerProfile->company_name }}</p>
                       </div>


                        <div class="mb-4">
                        <h2 class="text-primary font-semibold">Name, phone, email</h2>
                        <p>{{ $buyerProfile->user->full_name }}</p>
                        <p>{{ $buyerProfile->mobile_number }}</p>
                        <p>{{ $buyerProfile->email }}</p>
                        </div>

                        <div class="mb-4">
                            <h2 class="text-primary font-semibold">Business name</h2>
                            <p>{{ $buyerProfile->company_name }}</p>
                        </div>
                        <div class="mb-6">
                            <h2 class="text-primary font-semibold mb-4">User verification</h2>
                           <div class="flex space-x-4">
                            <div><a href="#"><img src="{{ asset('images/gmail.png') }}" alt=""></a></div>
                            <div><a href="#"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                <path fill-rule="evenodd" d="M1.5 4.5a3 3 0 013-3h1.372c.86 0 1.61.586 1.819 1.42l1.105 4.423a1.875 1.875 0 01-.694 1.955l-1.293.97c-.135.101-.164.249-.126.352a11.285 11.285 0 006.697 6.697c.103.038.25.009.352-.126l.97-1.293a1.875 1.875 0 011.955-.694l4.423 1.105c.834.209 1.42.959 1.42 1.82V19.5a3 3 0 01-3 3h-2.25C8.552 22.5 1.5 15.448 1.5 6.75V4.5z" clip-rule="evenodd" />
                              </svg>
                              </a></div>

                           </div>
                        </div>
                        <div class="mb-4">
                            <h2 class="text-primary font-semibold">Professional summary</h2>
                            {{-- <p>We are 65 years old company. Grown into a multinational and multidisciplinary electrical engineering and contracting organization with established offices in many parts of the African continent and is still growing.
                            </p> --}}
                            <p>{{ $buyerProfile->about_company }}</p>
                        </div>
                        <div class="mb-4">
                            <h2 class="text-primary font-semibold">Transaction preferences</h2>
                            {{-- <p>50-55 hotel projects inside 1500 sq km of National Park. It is the most favourite natural wildlife reserve in the world.
                            </p> --}}

                            <p>{{ $buyerProfile->business_factors }}</p>
                        </div>
                        <div class="mb-4">
                            <h2 class="text-primary font-semibold">Investment Size</h2>
                            {{-- <p>Between 80 million - 500 million KES.
                            </p> --}}
                            <p>{{ $buyerProfile->investment_range }}</p>
                        </div>

                        <div class="mb-4">
                            <h2 class="text-primary font-semibold">Overall Rating</h2>
                            {{-- <p>50-55 hotel projects inside 1500 sq km of National Park. It is the most favourite natural wildlife reserve in the world.
                            </p> --}}
                            <p class="mb-4"><img src="{{ asset('images/rating.png') }}" alt=""></p>
                        </div>

                        <div class="mb-4">
                            <h2 class="text-primary font-semibold">Status</h2>
                            {{-- <p>50-55 hotel projects inside 1500 sq km of National Park. It is the most favourite natural wildlife reserve in the world.
                            </p> --}}

                            <p class="text-green-600">Active</p>
                        </div>
                        <div class="mb-4">
                            <h2 class="text-primary font-semibold">Local time</h2>
                            {{-- <p>50-55 hotel projects inside 1500 sq km of National Park. It is the most favourite natural wildlife reserve in the world.
                            </p> --}}
                            <p>{{ date('H:i:s:a') }}</p>
                        </div>
                        <div class="mb-4">
                            <h2 class="text-primary font-semibold">Sector Prefence</h2>
                            {{-- <p>50-55 hotel projects inside 1500 sq km of National Park. It is the most favourite natural wildlife reserve in the world.
                            </p> --}}
                            <p>{{ $buyerProfile->buyer_interest }}</p>
                        </div>
                        <div class="mb-4">
                            <h2 class="text-primary font-semibold">Location Prefence</h2>
                            {{-- <p>50-55 hotel projects inside 1500 sq km of National Park. It is the most favourite natural wildlife reserve in the world.
                            </p> --}}
                            <p>{{ $buyerProfile->buyer_location_interest }}</p>
                        </div>
                        <div class="mb-4">
                            <h2 class="text-primary font-semibold">Recent Activity</h2>
                            {{-- <p>50-55 hotel projects inside 1500 sq km of National Park. It is the most favourite natural wildlife reserve in the world.
                            </p> --}}
                            <p>3hrs ago Connected with Allan Sang</p>
                        </div>
                        <div class="mb-4">
                            <h2 class="text-primary font-semibold">Preferences</h2>
                            {{-- <p>50-55 hotel projects inside 1500 sq km of National Park. It is the most favourite natural wildlife reserve in the world.
                            </p> --}}
                            <p>{{ str_replace('_', ' ', $buyerProfile->interested_in) }}</p>
                        </div>

                    </div>


                </div>


               <div class="w-2/5  h-fit" x-data="{ showContent:false }">

                <div class="bg-white pb-6 mb-6">
                    <div class="text-center text-white bg-green-500 py-2 -mt-8 rounded-t-md h-10 w-full">
                        <h5 class="text-white ">This investor is on a premium plan</h5>
                    </div>
                   <div class="p-6 rounded-t-md">
                    <h5 class="text-primary font-semibold mb-4">Overall rating</h5>
                    <div class="mb-4"><img src="{{ asset('images/rating.png') }}" alt=""></div>
                    <div class="mb-4"><a href="#" class="text-sm text-indigo-700">Compare with industry</a></div>
                    <div class="mb-4">
                    <h5 class="mb-4 font-semibold">Preferences</h5>
                    <ul class="list-disc ml-4 max-w-xs">
                        <li>{{ str_replace('_', ' ', $buyerProfile->interested_in) }}</li>
                    </ul>
                    </div>
                    <div>
                        <h5 class="mb-4 font-semibold">Recent activity</h5>

<ol class="relative text-gray-500 border-l border-gray-700 ml-4">
    <li class="mb-10 ml-6">
        <span class="absolute flex items-center justify-center w-2 h-2 bg-green-600 rounded-full -left-1 ring-4 ring-white dark:ring-gray-900 dark:bg-green-900">

        </span>
        <h3 class="font-medium leading-tight text-sm text-gray-400">3hrs ago</h3>
        <p class="text-sm">Connected with investor Allan Sang</p>
    </li>
    <li class="mb-10 ml-6">
        <span class="absolute flex items-center justify-center w-2 h-2 bg-green-600 rounded-full -left-1 ring-4 ring-white dark:ring-gray-900 dark:bg-gray-700">

        </span>
        <h3 class="font-medium leading-tight text-sm text-gray-400">3hrs ago</h3>
        <p class="text-sm">Connected with investor Jackie Wong</p>
    </li>
    <li class="mb-10 ml-6 last:border-none">
        <span class="absolute flex items-center justify-center w-2 h-2 bg-green-600 rounded-full -left-1 ring-4 ring-white dark:ring-gray-900 dark:bg-gray-700">

        </span>
        <h3 class="font-medium leading-tight text-sm text-gray-400">3hrs ago</h3>
        <p class="text-sm">Connected with Allan Sang</p>
    </li>

</ol>


                    </div>
                   </div>

                </div>


               </div>



            </div>



        </article>

        <div  class=" ml-28 max-w-screen-2xl px-4 py-16 sm:px-10 lg:py-8">
            <div class="flex flex-wrap md:flex-nowrap space-x-20">

                <div class="w-3/4">
                <h2 class="text-primary text-xl md:text-2xl font-bold mb-10">Recommended investors/buyers</h2>

                <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                    <div class="bg-white p-6 rounded-sm">
                        <div class="flex  mb-4">
                            <div class=" flex-shrink-0 ">
                                <img src="{{ asset('images/Logo.png') }}" alt="">
                            </div>
                            <div class="font-bold text-primary ml-2 flex-shrink">
                                <h3 class="text-sm">Edutech Company Investment Opportunity </h3>
                            </div>
                        </div>
                        <p class="text-xs mb-4">Online homeschooling platform with students and teachers logging in from across the globe. We are a virtual school with students from all over the world...</p>
                       <div class="mb-8">
                        <a href="#" class="bg-[#e9e9e9] text-xs py-2 px-6">Edutech</a>
                        <a href="#" class="bg-[#e9e9e9] text-xs py-2 px-6 ml-2">Nairobi</a>
                       </div>

                       <div class="flex justify-between items-center mb-6">
                        <div class="flex shrink-0">
                            <div><img src="{{ asset('images/star.png') }}" alt=""></div>
                            <div><img src="{{ asset('images/star.png') }}" alt=""></div>
                            <div><img src="{{ asset('images/star.png') }}" alt=""></div>
                            <div><img src="{{ asset('images/star.png') }}" alt=""></div>
                            <div><img src="{{ asset('images/star.png') }}" alt=""></div>

                        </div>

                        <div class="flex items-center">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-green-400">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
                                  </svg>
                            </div>
                            <div class="self-center ml-2">
                                <h3 class="text-xs">Verified seller</h3>
                            </div>
                        </div>



                       </div>
                       <div class="flex items-center justify-between mb-4">
                        <div>
                            <h5 class="text-xs text-gray-600">Run rate sales</h5>
                        </div>
                        <div>
                            <h5 class="text-xs ml-10 text-gray-600">Ksh</h5>
                        </div>
                        <div>
                            <h5 class="text-primary font-bold">18 Mil</h5>
                        </div>
                    </div>
                    <div class="flex items-center justify-between mb-6">
                        <div class="self-center">
                            <h5 class="text-xs text-gray-600">Financial investment <br> required (for 60%)</h5>
                        </div>
                        <div class="self-center">
                            <h5 class="text-xs text-gray-600">Ksh</h5>
                        </div>
                        <div>
                            <h5 class="text-primary font-bold">8 Mil</h5>
                        </div>
                    </div>
                    <div>
                        <a href="#" class="uppercase text-xs px-8 py-2  outline outline-2 block text-center rounded-sm">Send proposal</a>
                    </div>
                    </div>
                    <div class="bg-white p-6 rounded-sm">
                        <div class="flex  mb-4">
                            <div class=" flex-shrink-0 ">
                                <img src="{{ asset('images/Logo.png') }}" alt="">
                            </div>
                            <div class="font-bold text-primary ml-2 flex-shrink">
                                <h3 class="text-sm">Edutech Company Investment Opportunity </h3>
                            </div>
                        </div>
                        <p class="text-xs mb-4">Online homeschooling platform with students and teachers logging in from across the globe. We are a virtual school with students from all over the world...</p>
                       <div class="mb-8">
                        <a href="#" class="bg-[#e9e9e9] text-xs py-2 px-6">Edutech</a>
                        <a href="#" class="bg-[#e9e9e9] text-xs py-2 px-6 ml-2">Nairobi</a>
                       </div>

                       <div class="flex justify-between items-center mb-6">
                        <div class="flex shrink-0">
                            <div><img src="{{ asset('images/star.png') }}" alt=""></div>
                            <div><img src="{{ asset('images/star.png') }}" alt=""></div>
                            <div><img src="{{ asset('images/star.png') }}" alt=""></div>
                            <div><img src="{{ asset('images/star.png') }}" alt=""></div>
                            <div><img src="{{ asset('images/star.png') }}" alt=""></div>

                        </div>

                        <div class="flex items-center">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-green-400">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
                                  </svg>
                            </div>
                            <div class="self-center ml-2">
                                <h3 class="text-xs">Verified seller</h3>
                            </div>
                        </div>



                       </div>
                       <div class="flex items-center justify-between mb-4">
                        <div>
                            <h5 class="text-xs text-gray-600">Run rate sales</h5>
                        </div>
                        <div>
                            <h5 class="text-xs ml-10 text-gray-600">Ksh</h5>
                        </div>
                        <div>
                            <h5 class="text-primary font-bold">18 Mil</h5>
                        </div>
                    </div>
                    <div class="flex items-center justify-between mb-6">
                        <div class="self-center">
                            <h5 class="text-xs text-gray-600">Financial investment <br> required (for 60%)</h5>
                        </div>
                        <div class="self-center">
                            <h5 class="text-xs text-gray-600">Ksh</h5>
                        </div>
                        <div>
                            <h5 class="text-primary font-bold">8 Mil</h5>
                        </div>
                    </div>
                    <div>
                        <a href="#" class="uppercase text-xs px-8 py-2  outline outline-2 block text-center rounded-sm">Send proposal</a>
                    </div>
                    </div>
                    <div class="bg-white p-6 rounded-sm">
                        <div class="flex  mb-4">
                            <div class=" flex-shrink-0 ">
                                <img src="{{ asset('images/Logo.png') }}" alt="">
                            </div>
                            <div class="font-bold text-primary ml-2 flex-shrink">
                                <h3 class="text-sm">Edutech Company Investment Opportunity </h3>
                            </div>
                        </div>
                        <p class="text-xs mb-4">Online homeschooling platform with students and teachers logging in from across the globe. We are a virtual school with students from all over the world...</p>
                       <div class="mb-8">
                        <a href="#" class="bg-[#e9e9e9] text-xs py-2 px-6">Edutech</a>
                        <a href="#" class="bg-[#e9e9e9] text-xs py-2 px-6 ml-2">Nairobi</a>
                       </div>

                       <div class="flex justify-between items-center mb-6">
                        <div class="flex shrink-0">
                            <div><img src="{{ asset('images/star.png') }}" alt=""></div>
                            <div><img src="{{ asset('images/star.png') }}" alt=""></div>
                            <div><img src="{{ asset('images/star.png') }}" alt=""></div>
                            <div><img src="{{ asset('images/star.png') }}" alt=""></div>
                            <div><img src="{{ asset('images/star.png') }}" alt=""></div>

                        </div>

                        <div class="flex items-center">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-green-400">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
                                  </svg>
                            </div>
                            <div class="self-center ml-2">
                                <h3 class="text-xs">Verified seller</h3>
                            </div>
                        </div>



                       </div>
                       <div class="flex items-center justify-between mb-4">
                        <div>
                            <h5 class="text-xs text-gray-600">Run rate sales</h5>
                        </div>
                        <div>
                            <h5 class="text-xs ml-10 text-gray-600">Ksh</h5>
                        </div>
                        <div>
                            <h5 class="text-primary font-bold">18 Mil</h5>
                        </div>
                    </div>
                    <div class="flex items-center justify-between mb-6">
                        <div class="self-center">
                            <h5 class="text-xs text-gray-600">Financial investment <br> required (for 60%)</h5>
                        </div>
                        <div class="self-center">
                            <h5 class="text-xs text-gray-600">Ksh</h5>
                        </div>
                        <div>
                            <h5 class="text-primary font-bold">8 Mil</h5>
                        </div>
                    </div>
                    <div>
                        <a href="#" class="uppercase text-xs px-8 py-2  outline outline-2 block text-center rounded-sm">Send proposal</a>
                    </div>
                    </div>


                </div>
                </div>

                <div class="w-1/4 self-center">
                    <a href="#" class="text-primary underline font-bold text-lg">View more</a>
                </div>

            </div>
        </div>

    </section>
</x-guest-layout>