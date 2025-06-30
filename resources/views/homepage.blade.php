<x-guest-layout>
    <section class="bg-[#f4f4f4]  hero-bg">
        <article class="mx-auto max-w-screen-xl pt-20 md:pt-32 px-4 sm:px-6">

           <div class="grid gap-10 grid-cols-1 md:grid-cols-2 justify-items-center">
            <div class="pt-20 left-vector">
                <div id="sentence-wrapper">
                    <h1 class=" font-extrabold mb-10 sentence"> <span class="text-primary text-4xl md:text-5xl">Kenya’s No.1 business market place for </span>   <div class="words words-1 font-extrabold text-4xl md:text-5xl">
                        <span>selling</span>
                        <span>buying</span>
                        <span>funding</span>
                        <span>franchising</span>
                        <span>lending</span>
                    </div></h1>
                    <div class="flex bg-white p-8 rounded-md flex-wrap  xl:flex-nowrap shadow-md">
                        <div class="xl:mb-0 mb-8">
                            <h6 class="text-secondary text-sm">I am seeking </h6>
                            <h2 class="text-primary text-base font-bold">buyers or investors for my business <span><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 inline-block">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                              </svg>
                              </span></h2>
                        </div>
                        <div class=" self-end xl:ml-2 md:mt-0 mt-6 ">
                           <div class="w-full">
                               <a href="{{ route('investorsAndBuyers') }}"
                                  class="text-white bg-primary px-8 py-3 rounded-md inline-block w-full ">View buyers &
                                   investors</a>
                           </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="right-vector   md:mt-0 mt-10">
                <div>
                    <img src="{{ asset('images/business-setup.png') }}" class="md:pl-12" alt="sample">
                </div>

            </div>
           </div>

        </article>
    </section>
    <section class="bg-[#f4f4f4]">
        <article class="mx-auto max-w-screen-xl px-4 py-16 sm:px-6 lg:py-8">

            <h2 class="text-center text-primary font-bold text-xl md:text-3xl mb-16">Why choose BiasharaMart?</h2>

            <div class="grid gap-20 grid-cols-1 md:grid-cols-4 justify-items-center">
                <div class="flex flex-col">
                    <div>
                        <img src="{{ asset('images/service-icon.png') }}" alt="service icon">
                    </div>
                    <div>
                        <h5 class="font-bold text-2xl">Fair valuation</h5>
                    </div>
                    <div>
                        <p>Compare and benchmark your business with 100s of private companies in your location from the same industry</p>
                    </div>
                </div>
                <div class="flex flex-col">
                    <div>
                        <img src="{{ asset('images/service-icon.png') }}" alt="service icon">
                    </div>
                    <div>
                        <h5 class="font-bold text-2xl">Global Network</h5>
                    </div>
                    <div>
                        <p>Connect with businesses, investors, franchises, buyers and financial advisors across the globe</p>
                    </div>
                </div>
                <div class="flex flex-col">
                    <div>
                        <img src="{{ asset('images/service-icon.png') }}" alt="service icon">
                    </div>
                    <div>
                        <h5 class="font-bold text-2xl">Confidential</h5>
                    </div>
                    <div>
                        <p>Your privacy is of utmost importance to us. Selectively disclose identity to interested and genuine parties</p>
                    </div>
                </div>
                <div class="flex flex-col">
                    <div>
                        <img src="{{ asset('images/service-icon.png') }}" alt="service icon">
                    </div>
                    <div>
                        <h5 class="font-bold text-2xl">Pre-approved</h5>
                    </div>
                    <div>
                        <p>Every business, investor, buyer and advisor profile on BiasharaMart is pre-screened by our analysts</p>
                    </div>
                </div>
            </div>

        </article>
    </section>
   <section class="bg-[#f4f4f4] w-full py-16">
    <div class="grid gap-10 grid-cols-1 md:grid-cols-2 md:p-0 p-10">
        <div class="bg-[#FBE9E6] md:px-20 rounded-r-3xl flex py-10">
            <div class=" md:ml-36 ">
                <img src="{{ asset('images/business-for-sale.png') }}" alt="">
            </div>
        </div>
        <div class="self-center">
            <h2 class="text-primary font-bold text-xl md:text-5xl mb-6">Businesses for sale on BiasharaMart</h2>
            <p class="mb-8 max-w-lg">Explore pre-screened businesses for sale from over 100+ countries and across 900+ different industries. You can find businesses looking for full sale, raising capital through an investment or seeking business loan. Register as an Investor to buy a business or invest in them.</p>
            <div>
                <a href="{{ route('investorsAndBuyers') }}" class="bg-primary py-3 px-8 text-white rounded-md">View all
                    businesses</a>
            </div>

        </div>
    </div>
   </section>
   <section class="bg-[#f4f4f4] w-full pb-10">
    <div class="grid gap-10 grid-cols-1 md:grid-cols-2 md:p-0 p-10 ">
    <div class="self-center md:pl-48 ">
        <h2 class="text-primary font-bold text-xl md:text-5xl mb-6">Investors & business buyers on BiasharaMart</h2>
        <p class="mb-8 max-w-screen-2xl ">Get started by introducing yourself to an investor or a business buyer and send them your proposal today. Members on BiasharaMart include Individuals, Corporates, Private Equity Firms, VC Firms, Family Offices, and Banks.</p>
        <div>
            <a href="{{ route('investorsAndBuyers') }}" class="bg-primary py-3 px-8 text-white rounded-md">View all
                investors</a>
        </div>

    </div>
    <div class=" bg-[#e5e6ef] rounded-l-3xl py-10">
        <img src="{{ asset('images/investor-profile.png') }}" class=" md:pl-32 " alt="">
    </div>
</div>
   </section>
   {{-- <section class="bg-[#f4f4f4] w-full py-16">
    <div class="grid gap-10 grid-cols-1 md:grid-cols-2 md:p-0 p-10">
        <div class="bg-[#FBE9E6] md:px-20 rounded-r-3xl flex py-10">
            <div class=" md:ml-36 ">
                <img src="{{ asset('images/card-section3.png') }}" alt="">
            </div>
        </div>
        <div class="self-center">
            <h2 class="text-primary font-bold text-xl md:text-5xl mb-6 max-w-sm">Brands on BiasharaMart</h2>
            <p class="mb-8 max-w-lg">Partner with world class brands and grow together. Register as an Investor to get in touch directly with brand owners and take up franchises, distributorships and sales agencies.</p>
            <div>
                <a href="#" class="bg-primary py-3 px-8 text-white rounded-md">View all brands</a>
            </div>

        </div>
    </div>
   </section> --}}
   {{-- <section class="bg-[#f4f4f4] w-full pb-10">
    <div class="grid gap-10 grid-cols-1 md:grid-cols-2 md:p-0 p-10 ">
    <div class="self-center md:pl-48 ">
        <h2 class="text-primary font-bold text-xl md:text-5xl mb-6">Financial advisors on BiasharaMart</h2>
        <p class="mb-8 max-w-screen-2xl ">Join our list of top notch advisors who are experts in their respective domains and locations. Advisors on BiasharaMart include Business Brokers, M&A advisors, Investment Banks and Merchant Banks. These advisors are ready to work with a wide spectrum of businesses irrespective of size, caliber and growth stage.
            </p>
        <div>
            <a href="#" class="bg-primary py-3 px-8 text-white rounded-md">View all advisors</a>
        </div>

    </div>
    <div class=" bg-[#e5e6ef] rounded-l-3xl py-10">
        <img src="{{ asset('images/card-section3.png') }}" class=" md:pl-32 " alt="">
    </div>
</div>
   </section> --}}
   <section class="bg-[#e3e5ed]">
    <article class="mx-auto max-w-screen-xl px-8 py-16 sm:px-12 lg:py-8">
        <h2 class=" text-xl md:text-3xl text-primary font-bold mb-4">Included services</h2>
        <p class="text-primary max-w-lg mb-20">Compare and benchmark your business with 100s of private companies in your location from the same industry</p>

        <div class="grid gap-8 grid-cols-1 md:grid-cols-3">
            <div class=" border-[3px] border-primary/20 p-8  bg-white rounded-md hover:bg-white transition-all duration-300 ">
                <div>
                   <img src="{{ asset('images/icon-1.png') }}" class="mb-6" alt="">
                </div>
                <div>
                    <h5 class="font-bold text-primary text-2xl">Market analysis</h5>
                </div>
                <div>
                    <p class="text-primary py-4 max-w-xs text-base ">Compare and benchmark your business with 100s of private companies in your location from the same industry</p>
                </div>
                <div>
                  {{-- <a href="#" class="underline text-primary">Read more</a> --}}
                </div>
            </div>
            <div class=" border-[3px] border-primary/20 p-8 rounded-md bg-white hover:bg-white transition-all duration-300 ">
                <div>
                   <img src="{{ asset('images/icon-2.png') }}" class="mb-6" alt="">
                </div>
                <div>
                    <h5 class="font-bold text-primary text-2xl">Fundraising</h5>
                </div>
                <div>
                    <p class="text-primary pt-4 pb-10 max-w-xs text-base ">Raise a fund efficiently with data-informed peer groups, benchmarks and investors</p>
                </div>
                <div>
                  {{-- <a href="#" class="underline text-primary">Read more</a> --}}
                </div>
            </div>
            <div class=" border-[3px] border-primary/20 p-8 rounded-md bg-white hover:bg-white transition-all duration-300 ">
                <div>
                   <img src="{{ asset('images/icon-3.png') }}" class="mb-6" alt="">
                </div>
                <div>
                    <h5 class="font-bold text-primary text-2xl">Deal Sourcing</h5>
                </div>
                <div>
                    <p class="text-primary pt-4 pb-12 max-w-xs text-base ">Discover companies that are a strategic fit, seeking funding or primed for acquisition</p>
                </div>
                <div>
                  {{-- <a href="#" class="underline text-primary">Read more</a> --}}
                </div>
            </div>
            <div class=" border-[3px] border-primary/20 p-8 rounded-md bg-white hover:bg-white transition-all duration-300 ">
                <div>
                   <img src="{{ asset('images/icon-4.png') }}" class="mb-6" alt="">
                </div>
                <div>
                    <h5 class="font-bold text-primary text-2xl">Due Delligence</h5>
                </div>
                <div>
                    <p class="text-primary pt-4 pb-10 max-w-xs text-base ">Create the perfect pitch using valuable intel on companies, funds and financial sponsors</p>
                </div>
                <div>
                  {{-- <a href="#" class="underline text-primary">Read more</a> --}}
                </div>
            </div>
            <div class=" border-[3px] border-primary/20 p-8 rounded-md bg-white hover:bg-white transition-all duration-300 ">
                <div>
                   <img src="{{ asset('images/icon-5.png') }}" class="mb-6" alt="">
                </div>
                <div>
                    <h5 class="font-bold text-primary text-2xl">Business development</h5>
                </div>
                <div>
                    <p class="text-primary pt-4 pb-10 max-w-xs text-base ">Grow your business by targeting opportunities within the private and public markets
                    </p>
                </div>
                <div>
                  {{-- <a href="#" class="underline text-primary">Read more</a> --}}
                </div>
            </div>
            <div class=" border-[3px] border-primary/20 p-8 rounded-md bg-white hover:bg-white transition-all duration-300 ">
                <div>
                   <img src="{{ asset('images/icon-6.png') }}" class="mb-6" alt="">
                </div>
                <div>
                    <h5 class="font-bold text-primary text-2xl">Networking</h5>
                </div>
                <div>
                    <p class="text-primary pt-4 pb-16 max-w-xs text-base ">See how 1.9 million pros operate across the industry and grow your connections
                    </p>
                </div>
                <div>
                  {{-- <a href="#" class="underline text-primary">Read more</a> --}}
                </div>
            </div>
            <div class=" border-[3px] border-primary/20 p-8 rounded-md bg-white hover:bg-white transition-all duration-300 ">
                <div>
                   <img src="{{ asset('images/icon-7.png') }}" class="mb-6" alt="">
                </div>
                <div>
                    <h5 class="font-bold text-primary text-2xl">Deal Execution</h5>
                </div>
                <div>
                    <p class="text-primary pt-4 pb-10 max-w-xs text-base ">Build data-backed comps, buyer and investor lists with technology designed to save time
                    </p>
                </div>
                <div>
                  {{-- <a href="#" class="underline text-primary">Read more</a> --}}
                </div>
            </div>
            <div class=" border-[3px] border-primary/20 p-8 rounded-md bg-white hover:bg-white transition-all duration-300 ">
                <div>
                   <img src="{{ asset('images/icon-8.png') }}" class="mb-6" alt="">
                </div>
                <div>
                    <h5 class="font-bold text-primary text-2xl">Benchmarking</h5>
                </div>
                <div>
                    <p class="text-primary pt-4 pb-16 max-w-xs text-base ">Bring timely, transparent fund data into your analysis
                    </p>
                </div>
                <div>
                  {{-- <a href="#" class="underline text-primary">Read more</a> --}}
                </div>
            </div>
        </div>

    </article>
   </section>

   <section class="bg-[#f5f5f5] comment-section">
    <article class="mx-auto max-w-screen-xl px-8 py-16 sm:px-12 lg:py-24">
        <h2 class="text-center text-primary max-w-[19rem] mx-auto text-xl md:text-3xl font-bold mb-6">Trusted by the best in the business</h2>
<p class="text-center mb-20">Join more than 15,000+ connections around the country</p>

<div class="grid grid-cols-1 gap-8 md:grid-cols-3">
    <!-- James Otieno Testimonial -->
    <div class="bg-white py-6 px-10">
        <div>
           <p class="flex mb-6">
              <span class="text-[#f49f1c]">★★★★★</span>
           </p>
        </div>
        <div>
            <p class="mb-4 max-w-[20rem]">
                This platform made it incredibly easy to connect with serious investors.
                Within weeks, I secured the funding I needed to expand my business.
                The seamless communication tools and approval process gave me confidence throughout the journey.
            </p>
        </div>
        <div>
            <h5 class="font-bold text-[#030E4F]">James Otieno</h5>
            <p class="text-sm text-gray-600">Entrepreneur</p>
        </div>
    </div>

    <!-- Sarah Njoroge Testimonial -->
    <div class="bg-white py-6 px-10">
        <div>
           <p class="flex mb-6">
              <span class="text-[#f49f1c]">★★★★★</span>
           </p>
        </div>
        <div>
            <p class="mb-4 max-w-[20rem]">
                As an investor, finding high-potential businesses to invest in used to be time-consuming.
                This platform has simplified everything—I can easily browse vetted business opportunities and communicate directly with entrepreneurs.
            </p>
        </div>
        <div>
            <h5 class="font-bold text-[#030E4F]">Sarah Njoroge</h5>
            <p class="text-sm text-gray-600">Investor</p>
        </div>
    </div>

    <!-- Michael Wanjiru Testimonial -->
    <div class="bg-white py-6 px-10">
        <div>
           <p class="flex mb-6">
              <span class="text-[#f49f1c]">★★★★★</span>
           </p>
        </div>
        <div>
            <p class="mb-4 max-w-[20rem]">
                The approval system ensures that only credible businesses are listed, which gave me peace of mind when looking for investment opportunities.
                I've successfully invested in two startups through this platform and look forward to many more!
            </p>
        </div>
        <div>
            <h5 class="font-bold text-[#030E4F]">Michael Wanjiru</h5>
            <p class="text-sm text-gray-600">Investor</p>
        </div>
    </div>
</div>

    </article>
   </section>

</x-guest-layout>
