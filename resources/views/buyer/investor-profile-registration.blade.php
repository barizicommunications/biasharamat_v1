<x-guest-layout>
    <section class="bg-[#f4f4f4]">
        @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

        <article class="mx-auto max-w-screen-xl px-4 py-16 sm:px-6 lg:py-8">
            <div class="flex items-center py-4 overflow-x-auto whitespace-nowrap mb-8">
                <a href="#" class="text-gray-600 dark:text-gray-200 hover:underline">
                    Home
                </a>
                <span class="mx-3 text-gray-500 dark:text-gray-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                          d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                          clip-rule="evenodd"/>
                </svg>
            </span>

                <a href="#" class="text-primary">
                    Business buyer registration
                </a>
            </div>

            <h2 class="text-primary font-bold text-xl md:text-3xl mb-8">Business buyer registration</h2>

            <div class="flex flex-wrap md:flex-nowrap space-x-20">
                <div class="w-3/4">
                    <form method="post" action="{{ route('investor.profile.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class=" bg-white p-8 mb-8">
                            <h3 class="text-primary font-semibold mb-4"><span class="text-xl">a. </span><span
                                        class="text-2xl">Confidential information</span></h3>
                            <p class="text-[#9D9D9D]">Please enter your own details here. Information entered here is
                                not publicly displayed.</p>
                            <hr class="my-8 border-t-[1px] border-gray-300">

                            <div class="section-a">

                                <div class="grid gap-8 grid-cols-1 md:grid-cols-2 mb-4">
                                    <div class="mb-4">
                                        <label for="name" class="block mb-3 text-sm">Your name</label>
                                        <input type="text" id="name" name="name"
                                               class=" w-full bg-[#f5f5f5] border-0 py-4 text-gray-700 text-sm"
                                               placeholder="Enter your full name" disabled
                                               value="{{ Auth::user()->full_name }}">
                                               <input type="hidden" id="name" name="name" value="{{ Auth::user()->full_name }}">
                                    </div>
                                    <div class="mb-4">
                                        <label for="email" class="block mb-3 text-sm">Official email for quick
                                            verification</label>
                                        <input value="{{ old('email') ?? Auth::user()->email }}" type="email" id="email"
                                               class=" w-full bg-[#f5f5f5] border-0 py-4 text-gray-700 text-sm"
                                               placeholder="Enter your email" name="email">
                                        @error('email') <span class="text-red-600">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label for="mobile_number" class="block mb-3 text-sm">Your mobile number</label>
                                        <input value="{{ old('mobile_number') }}" type="text" id="mobile_number"
                                               class=" w-full bg-[#f5f5f5] border-0 py-4 text-gray-700 text-sm"
                                               placeholder="Enter your mobile number" name="mobile_number">
                                        @error('mobile_number') <span
                                                class="text-red-600">{{ $message }}</span> @enderror
                                    </div>

                                </div>


                            </div>
                        </div>
                        <div class=" bg-white p-8 mb-10">
                            <h3 class="text-primary font-semibold mb-4"><span class="text-xl">b. </span><span
                                        class="text-2xl">Your requirements</span></h3>
                            <p class="text-[#9D9D9D]">Information entered here will be publicly displayed to match you with the right set of businesses. Fields specifically marked as 'Private' will not be publicly displayed.</p>
                            <hr class="my-8 border-t-[1px] border-gray-300">

                            <div class="section-b">
                                <div class="mb-4">
                                    <label for="interested_in" class="block mb-3 text-sm">You are interested in</label>
                                    <div class="flex">
                                        <div class="flex">
                                        <input type="radio" class="rounded-sm self-center" name="interested_in" value="acquiring_business" @if (old('interested_in')) checked @endif> <span
                                                class="inline-flex ml-4 text-[#828282] text-sm" >Acquiring / Buying a Business </span>
                                    </div>
                                </div>
                                <div class="flex">
                                    <div class="flex">
                                    <input type="radio" class="rounded-sm self-center" name="interested_in" value="investing_in_a_business" @if (old('interested_in')) checked @endif> <span
                                            class="inline-flex ml-4 text-[#828282] text-sm" >Investing in a Business </span>
                                </div>
                            </div>
                            <div class="flex">
                                <div class="flex">
                                <input type="radio" class="rounded-sm self-center" name="interested_in" value="lending_to_a_business" @if (old('interested_in')) checked @endif> <span
                                        class="inline-flex ml-4 text-[#828282] text-sm" >Lending to a Business </span>
                            </div>
                        </div>
                        <div class="flex">
                            <div class="flex">
                            <input type="radio" class="rounded-sm self-center" name="interested_in" value="buying_property_plant_machinery" @if (old('interested_in')) checked @endif> <span
                                    class="inline-flex ml-4 text-[#828282] text-sm" >Buying Property / Plant / Machinery </span>
                        </div>
                    </div>
                    <div class="flex">
                        <div class="flex">
                        <input type="radio" class="rounded-sm self-center" name="interested_in" value="taking_up_franchise" @if (old('interested_in')) checked @endif> <span
                                class="inline-flex ml-4 text-[#828282] text-sm" >Taking up a Franchise / Distributorship / Sales Agency </span>
                    </div>
                </div>

                                </div>

                                <div class="grid gap-8 grid-cols-1 md:grid-cols-2 mb-4">
                                    <div class="mb-4">
                                        <label for="buyer_role" class="block mb-3 text-sm">Your are a(n)</label>
                                        <select name="buyer_role" id="buyer_role" class="w-full bg-[#f5f5f5] border-0 py-4 text-sm">
                                          <option value="">&mdash; select &mdash;</option>
                                          @foreach (['Individual investor/buyer', 'Corporate investor/buyer'] as $role)
                                            <option value="{{ $role }}" @if (old('buyer_role') == $role) selected @endif>{{ $role }}</option>
                                          @endforeach
                                        </select>
                                        @error('buyer_role') <span class="text-red-600">{{ $message }}</span> @enderror
                                      </div>

                                      <div class="mb-4">
                                        <label for="buyer_interest" class="block mb-3 text-sm">Select industries you are interested in. </label>
                                        <select name="buyer_interest" id="buyer_interest" class="w-full bg-[#f5f5f5] border-0 py-4 text-sm">
                                          <option value="">&mdash; select &mdash;</option>
                                          @foreach (['Select all','Education', 'Technology', 'Building construction and maintenance'] as $interest)
                                            <option value="{{ $interest }}" @if (old('buyer_interest') == $interest) selected @endif>{{ $interest }}</option>
                                          @endforeach
                                        </select>
                                        @error('buyer_interest') <span class="text-red-600">{{ $message }}</span> @enderror
                                      </div>
                                      <div class="mb-4">
                                        <label for="buyer_location_interest" class="block mb-3 text-sm">Select locations you are interested in.  </label>
                                        <select name="buyer_location_interest" id="buyer_location_interest" class="w-full bg-[#f5f5f5] border-0 py-4 text-sm">
                                          <option value="">&mdash; select &mdash;</option>
                                          @foreach (['Nairobi','Mombasa', 'Kisumu', 'Eldoret','Nakuru'] as $interest)
                                            <option value="{{ $interest }}" @if (old('buyer_interest') == $interest) selected @endif>{{ $interest }}</option>
                                          @endforeach
                                        </select>
                                        @error('buyer_location_interest') <span class="text-red-600">{{ $message }}</span> @enderror
                                      </div>

                                      <div class="mb-4">
                                        <label for="investment_range" class="block mb-3 text-sm">Provide your investment range.</label>
                                        <input type="number"
                                               class="bg-[#f5f5f5] border-0 py-4 text-gray-700 text-sm w-full"
                                               id="investment_range" placeholder="KES  |" name="investment_range"
                                               value="{{ old('investment_range') }}">
                                        @error('investment_range') <span
                                                class="text-red-600">{{ $message }}</span> @enderror
                                    </div>


                                </div>


                                <div class="grid grid-cols-1 gap-10 md:grid-cols-2 mb-4">
                                    <div>

                                            <div class="mb-4">
                                                <label for="current_location" class="block mb-3 text-sm">Your current location.</label>
                                                <input type="text"
                                                       class="bg-[#f5f5f5] border-0 py-4 text-gray-700 text-sm w-full"
                                                       id="current_location" value="{{ old('current_location') }}" name="current_location">
                                                @error('current_location') <span
                                                        class="text-red-600">{{ $message }}</span> @enderror
                                            </div>
                                    </div>
                                    <div class="mb-4">
                                        <label for="company_name" class="block mb-3 text-sm">Name of company.</label>
                                        <input type="text"
                                               class="bg-[#f5f5f5] border-0 py-4 text-gray-700 text-sm w-full"
                                               id="company_name" value="{{ old('company_name') }}" name="company_name">
                                        @error('company_name') <span
                                                class="text-red-600">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label for="linkedin_profile" class="block mb-3 text-sm">Company LinkedIn profile. Private</label>
                                        <input type="url"
                                               class="bg-[#f5f5f5] border-0 py-4 text-gray-700 text-sm w-full"
                                               id="linkedin_profile" value="{{ old('linkedin_profile') }}" name="linkedin_profile">
                                        @error('linkedin_profile') <span
                                                class="text-red-600">{{ $message }}</span> @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label for="website_link" class="block mb-3 text-sm">Link to company website</label>
                                        <input type="url"
                                               class="bg-[#f5f5f5] border-0 py-4 text-gray-700 text-sm w-full"
                                               id="website_link" value="{{ old('website_link') }}" name="website_link">
                                        @error('website_link') <span
                                                class="text-red-600">{{ $message }}</span> @enderror
                                    </div>


                                </div>



                            </div>
                        </div>

                        <div class="mb-10 bg-white p-8">
                            <h3 class="text-primary font-semibold mb-4"><span class="text-xl">c. </span><span
                                        class="text-2xl">Additional information</span></h3>
                            <p class="text-[#9D9D9D]">Documents help us verify and approve your profile faster. Document names entered here are publicly visible but are accessible only to introduced members.</p>
                            <hr class="my-8 border-t-[1px] border-gray-300">

                            <div class="grid gap-10 grid-cols-1 md:grid-cols-2 mb-4">
                                <div class="mb-4">
                                    <label for="business_funds" class="block mb-3 text-sm">Factors the company looks for in a business.</label>
                                    <textarea id="business_factors" class="w-full bg-[#f5f5f5] border-0"
                                              style="height:140px; resize:none;"
                                              name="business_factors">{{ old('business_factors') }}</textarea>
                                    @error('business_factors') <span class="text-red-600">{{ $message }}</span> @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="about_company" class="block mb-3 text-sm ">About the company </label>
                                    <textarea id="about_company" class="w-full bg-[#f5f5f5] border-0"
                                              style="height:140px; resize:none;"
                                              name="about_company">{{ old('about_company') }}</textarea>
                                    @error('about_company') <span
                                            class="text-red-600">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <h5 class="mb-4 text-sm">Attach Corporate Profile and/or Terms of Engagement if any .</h5>
                                    <div class="py-20 pl-20  border-2 border-dashed flex items-center ">
                                        {{-- <img src="{{ asset('images/upload-document.png') }}" alt=""> --}}
                                        <input type="file" name="corporate_profile" id="corporate_profile"
                                               accept=".pdf, .docx, .pptx, .xlsx, .txt">
                                    </div>
                                    @error('corporate_profile') <span
                                    class="text-red-600"> {{ $message }}</span> @enderror
                                </div>





                            </div>

                        </div>

                        <div class="mb-10 bg-white p-8">
                            <h3 class="text-primary font-semibold mb-4"><span class="text-xl">d. </span><span
                                        class="text-2xl">Documents & proof</span></h3>
                            <p class="text-[#9D9D9D]">Documents help us verify and approve your profile faster. Document names entered here are publicly visible but are accessible only to introduced members.</p>
                            <hr class="my-8 border-t-[1px] border-gray-300">

                            <div class="grid gap-4 grid-cols-1 md:grid-cols-2">
                                <div>
                                    <h5 class="mb-4">Company logo</h5>

                                    <div class="py-20 pl-20  border-2 border-dashed flex items-center ">
                                        {{-- <img src="{{ asset('images/upload-document.png') }}" alt=""> --}}
                                        <input type="file" name="company_logo" id="company_logo"
                                               accept=".jpg, .jpeg, .png">
                                    </div>
                                    @error('company_logo') <span
                                            class="text-red-600"> {{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <h5 class="mb-4">Attach proof of business for faster verification</h5>
                                    <div class="py-20 pl-20  border-2 border-dashed flex items-center ">
                                        {{-- <img src="{{ asset('images/upload-document.png') }}" alt=""> --}}
                                        <input type="file" name="proof_of_business" id="proof_of_business"
                                               accept=".pdf, .docx, .pptx, .xlsx, .txt">
                                    </div>
                                    @error('proof_of_business') <span
                                    class="text-red-600"> {{ $message }}</span> @enderror
                                </div>

                            </div>

                        </div>
                        <div class="mb-10 bg-white p-8">
                            <div class="flex justify-between">
                                <h3 class="text-primary font-semibold mb-4"><span class="text-xl">e. </span><span
                                            class="text-2xl">Select a plan</span></h3>

                            </div>
                            <hr class="my-4 border-t-[1px] border-gray-300">

                            <div class="flex justify-between mb-6">
                                <h3 class="text-[#828282]">Plan</h3>
                                <h3 class="text-[#828282]">Price</h3>
                            </div>

                            <div class="plan-1 mb-4" x-data=" {isOpen : false}">
                                <div class="flex justify-between cursor-pointer" @click="isOpen = !isOpen">
                                    <div class="flex space-x-8 items-center">
                                        <div>
                                            <input type="radio" name="active_business" id="active_business" value="active business"
                                                   class="text-sm rounded-sm h-3 w-3"  @if (old('active_business')) checked @endif>
                                        </div>
                                        <div>
                                            <h5>Active plan</h5>
                                        </div>
                                    </div>
                                    <div>
                                        <h5 class="font-bold">KES 17,000</h5>
                                    </div>
                                </div>



                            </div>
                            <div class="plan-2 mb-4" x-data=" {isOpen : false}">
                                <div class="flex justify-between cursor-pointer" @click="isOpen = !isOpen">
                                    <div class="flex space-x-8 items-center">
                                        <div>
                                            <input type="radio" name="active_business" id="active_business" value="premium plan"
                                                   class="text-sm rounded-sm h-3 w-3"  @if (old('active_business')) checked @endif>
                                        </div>
                                        <div>
                                            <h5><span>Premium plan</span> <span class="text-green-400">(Recommended)</span>
                                            </h5>
                                        </div>
                                    </div>
                                    <div>
                                        <h5 class="font-bold">KES 20,500</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="plan-2 mb-4" x-data=" {isOpen : false}">
                                <div class="flex justify-between cursor-pointer" @click="isOpen = !isOpen">
                                    <div class="flex space-x-8 items-center">
                                        <div>
                                            <input type="radio" name="active_business" id="active_business" value="yearly plan"
                                                   class="text-sm rounded-sm h-3 w-3"  @if (old('active_business')) checked @endif>
                                        </div>
                                        <div>
                                            <h5><span>Yearly</span>
                                            </h5>
                                        </div>
                                    </div>
                                    <div>
                                        <h5 class="font-bold">KES 205,000</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="flex">
                                <input type="checkbox" class="rounded-sm self-center" name="terms_of_engagement"> <span class="inline-flex ml-4">I accept terms of engagement. </span>
                            </div>
                        </div>

                        <div class="flex justify-end">
                            <button type="submit"
                                    class="bg-primary text-white px-8 py-3 rounded-md hover:bg-secondary transition-all duration-300">
                                Submit
                                and proceed
                            </button>
                        </div>
                    </form>
                </div>
                <div class="w-1/4">

                    <ol class=" text-gray-500 border-l border-[#c4c4c4] sticky top-10">
                        <li class="mb-10 ml-6">
                <span class="absolute flex items-center justify-center w-10 h-10 bg-green-200 rounded-full -left-5">
                    <svg class="w-3.5 h-3.5 text-green-500 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                         fill="none" viewBox="0 0 16 12">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M1 5.917 5.724 10.5 15 1.5"/>
                    </svg>
                </span>
                            <div class="ml-3"><h3 class="font-medium leading-tight">Provide details</h3>
                                <p class="text-sm">Step details here</p></div>
                        </li>
                        <li class="mb-10 ml-6">
              <span class="absolute flex items-center justify-center w-10 h-10 bg-[#c4c4c4] rounded-full -left-5">
                <svg class="w-3.5 h-3.5 text-white " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                     viewBox="0 0 16 12">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M1 5.917 5.724 10.5 15 1.5"/>
                </svg>
            </span>
                            <div class="ml-3"><h3 class="font-medium leading-tight">Verification call</h3>
                                <p class="text-sm">Step details here</p></div>
                        </li>
                        <li class="mb-10 ml-6">
              <span class="absolute flex items-center justify-center w-10 h-10 bg-[#c4c4c4] rounded-full -left-5">
                <svg class="w-3.5 h-3.5 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                     viewBox="0 0 16 12">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M1 5.917 5.724 10.5 15 1.5"/>
                </svg>
            </span>
                            <div class="ml-3"><h3 class="font-medium leading-tight">Approval</h3>
                                <p class="text-sm">Step details here</p></div>
                        </li>

                    </ol>

                </div>

            </div>



        </article>
    </section>
</x-guest-layout>