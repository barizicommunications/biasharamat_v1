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

<div class="my-8 bg-green-400">
    @livewire('sellerComponents.register-seller')
</div>

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
                    Register business profile
                </a>
            </div>

            <h2 class="text-primary font-bold text-xl md:text-3xl mb-8">Business profile registration</h2>

            <div class="flex flex-wrap md:flex-nowrap space-x-20">
                <div class="w-3/4">
                    <form method="post" action="{{ route('business.profile.store') }}" enctype="multipart/form-data">
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
                                        <label for="company_name" class="block mb-3 text-sm">Company name</label>
                                        <input value="{{ old('company_name') }}" type="text" id="company_name"
                                               class=" w-full bg-[#f5f5f5] border-0 py-4 text-gray-700 text-sm"
                                               placeholder="Enter your company name" name="company_name">
                                        @error('company_name')
                                        <span class="text-red-600">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label for="mobile_number" class="block mb-3 text-sm">Your mobile number</label>
                                        <input value="{{ old('mobile_number') }}" type="tel" id="mobile_number"
                                               class=" w-full bg-[#f5f5f5] border-0 py-4 text-gray-700 text-sm"
                                               placeholder="Enter your mobile number" name="mobile_number" maxlength="10" pattern="[0-9]{10}">
                                        @error('mobile_number') <span
                                                class="text-red-600">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label for="email" class="block mb-3 text-sm">Official email for quick
                                            verification</label>
                                        <input value="{{ old('email') ?? Auth::user()->email }}" type="email" id="email"
                                               class=" w-full bg-[#f5f5f5] border-0 py-4 text-gray-700 text-sm"
                                               placeholder="Enter your email" name="email">
                                        @error('email') <span class="text-red-600">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <div class="flex">
                                    <input type="checkbox"
                                           id="display_company_details"
                                           aria-label="display"
                                           name="display_company_details"
                                           class="rounded-sm self-center"
                                           @if (old('display_company_details')) checked @endif
                                    >
                                    <span class="inline-flex ml-4 text-[#828282]">Display company details to introduced members so that they can know about my company</span>
                                  </div>
                            </div>
                        </div>
                        <div class=" bg-white p-8 mb-10">
                            <h3 class="text-primary font-semibold mb-4"><span class="text-xl">b. </span><span
                                        class="text-2xl">Business information</span></h3>
                            <p class="text-[#9D9D9D]">Information entered here is displayed publicly to match you with
                                the right set of investors and buyers. Do not mention business name/information which
                                can identify the business.</p>
                            <hr class="my-8 border-t-[1px] border-gray-300">

                            <div class="section-b">
                                <div class="grid gap-8 grid-cols-1 md:grid-cols-2 mb-4">
                                    <div class="mb-4">
                                        <label for="seller_role" class="block mb-3 text-sm">Your are a(n)</label>
                                        <select name="seller_role" id="seller_role" class="w-full bg-[#f5f5f5] border-0 py-4 text-sm">
                                          <option value="">&mdash; select &mdash;</option>
                                          @foreach (['Director', 'Adviser', 'Shareholder', 'Other'] as $role)
                                            <option value="{{ $role }}" @if (old('seller_role') == $role) selected @endif>{{ $role }}</option>
                                          @endforeach
                                        </select>
                                        @error('seller_role') <span class="text-red-600">{{ $message }}</span> @enderror
                                      </div>

                                      <div class="mb-4">
                                        <label for="seller_interest" class="block mb-3 text-sm">What are you interested in?</label>
                                        <select name="seller_interest" id="seller_interest" class="w-full bg-[#f5f5f5] border-0 py-4 text-sm">
                                          <option value="">&mdash; select &mdash;</option>
                                          @foreach (['Full sale of business', 'Partial stake sale of business/investment', 'Loan for business'] as $interest)
                                            <option value="{{ $interest }}" @if (old('seller_interest') == $interest) selected @endif>{{ $interest }}</option>
                                          @endforeach
                                        </select>
                                        @error('seller_interest') <span class="text-red-600">{{ $message }}</span> @enderror
                                      </div>
                                      <div class="mb-4">
                                        <label for="business_start_date" class="block mb-3 text-sm">When was the business established? (dd/mm/yyyy)</label>
                                        <input value="{{ old('business_start_date') }}" type="date" id="business_start_date"
                                               class="w-full bg-[#f5f5f5] border-0 py-4 text-gray-700 text-sm"
                                               placeholder="dd/mm/yyyy" name="business_start_date">
                                               @error('business_start_date') <span class="text-red-600">{{ $message }}</span> @enderror
                                      </div>

                                    <div class="mb-4">
                                        <label for="business_industry" class="block mb-3 text-sm">Select business industry</label>
                                        <select name="business_industry" id="business_industry" class="w-full bg-[#f5f5f5] border-0 py-4 text-sm">
                                          <option value="">&mdash; select &mdash;</option>
                                          @foreach (['Technology', 'Building, Contruction and Maintenance', 'Education'] as $industry)
                                            <option value="{{ $industry }}" @if (old('business_industry') == $industry) selected @endif>{{ $industry }}</option>
                                          @endforeach
                                        </select>
                                        @error('business_industry') <span class="text-red-600">{{ $message }}</span> @enderror
                                      </div>


                                </div>


                                <div class="grid grid-cols-1 gap-10 md:grid-cols-2 mb-4">
                                    <div>
                                        <label for="business_location" class="block mb-3 text-sm">Where is the business
                                            located / headquartered?</label>
                                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                                <div class="col-span-1">
                                                    <input type="text" class="bg-[#f5f5f5] border py-4 text-gray-700 text-sm w-full" placeholder="Country" value="{{ old('country') }}" name="country">
                                                    @error('country') <span class="text-red-600">{{ $message }}</span> @enderror
                                                </div>

                                                <div class="col-span-1">
                                                    <input type="text" class="bg-[#f5f5f5] border-0 py-4 text-gray-700 text-sm w-full" placeholder="City" name="city" value="{{ old('city') }}">
                                                    @error('city') <span class="text-red-500">{{ $message }}</span> @enderror
                                                </div>

                                                <div class="col-span-1">
                                                    <input type="text" class="bg-[#f5f5f5] border-0 py-4 text-gray-700 text-sm w-full" placeholder="County" name="county" value="{{ old('county') }}">
                                                    @error('county') <span class="text-red-600">{{ $message }}</span> @enderror
                                                </div>
                                            </div>
                                    </div>
                                    <div>
                                        <label for="number_employees" class="block mb-3 text-sm">How many employees
                                            does the business have?</label>
                                        <input value="{{ old('number_employees') }}" id="number_employees" type="number"
                                               name="number_employees"
                                               class="bg-[#f5f5f5] border-0 py-4 text-gray-700 text-sm w-full">
                                        @error('number_employees') <span
                                                class="text-red-600">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label for="business_legal_entity" class="block mb-3 text-sm">Select business legal entity type</label>
                                        <select name="business_legal_entity" id="business_legal_entity" class="w-full bg-[#f5f5f5] border-0 py-4 text-sm" >
                                            <option value="">&mdash; select &mdash;</option>
                                          @foreach ([
                                            'Sole Proprietorship/Sole Trader',
                                            'General Partnership',
                                            'Limited liability partnership (LLP)',
                                          ] as $entity)
                                            <option value="{{ $entity }}" @if (old('business_legal_entity') == $entity) selected @endif>{{ $entity }}</option>
                                          @endforeach
                                        </select>
                                        @error('business_legal_entity') <span class="text-red-600">{{ $message }}</span> @enderror
                                      </div>

                                    <div class="mb-4">
                                        <label for="website_link" class="block mb-3 text-sm">Link to your business
                                            website</label>
                                        <input type="text"
                                               class="bg-[#f5f5f5] border-0 py-4 text-gray-700 text-sm w-full"
                                               id="website_link" value="{{ old('website_link') }}" name="website_link">
                                        @error('website_link') <span
                                                class="text-red-600">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label for="business_description" class="block mb-3 text-sm">Describe the
                                            business</label>
                                        <textarea class="w-full bg-[#f5f5f5] border-0"
                                                  style="height:140px; resize:none;"
                                                  id="business_description"
                                                  name="business_description">{{ old('business_description') }}</textarea>
                                        @error('business_description') <span
                                                class="text-red-600">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label for="product_services" class="block mb-3 text-sm">List products and
                                            services of the business</label>
                                        <textarea class="w-full bg-[#f5f5f5] border-0"
                                                  style="height:140px; resize:none;"
                                                  id="product_services"
                                                  name="product_services">{{ old('product_services') }}</textarea>
                                        @error('product_services') <span
                                                class="text-red-600">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label for="business_highlights" class="block mb-3 text-sm">Mention highlights of
                                        the
                                        business including number of clients, growth rate, promoter experience, business
                                        relationships, awards, etc</label>
                                    <textarea id="business_highlights" class="w-full bg-[#f5f5f5] border-0"
                                              style="height:140px; resize:none;"
                                              name="business_highlights">{{ old('business_highlights') }}</textarea>
                                    @error('business_highlights') <span
                                            class="text-red-600">{{ $message }}</span> @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="facility_description" class="block mb-3 text-sm">Describe your facility
                                        such as built-up area, number of floors, rental/lease details</label>
                                    <textarea class="w-full bg-[#f5f5f5] border-0"
                                              style="height:140px; resize:none;" id="facility_description"
                                              name="facility_description">{{ old('facility_description') }}</textarea>
                                    @error('facility_description') <span
                                            class="text-red-600">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-10 bg-white p-8">
                            <h3 class="text-primary font-semibold mb-4"><span class="text-xl">c. </span><span
                                        class="text-2xl">Transactional information</span></h3>
                            <p class="text-[#9D9D9D]">Please enter your own details here. Information entered here is
                                not publicly displayed.</p>
                            <hr class="my-8 border-t-[1px] border-gray-300">

                            <div class="grid gap-10 grid-cols-1 md:grid-cols-2 mb-4">
                                <div class="mb-4">
                                    <label for="business_funds" class="block mb-3 text-sm">How is the business funded
                                        presently? Mention all debts, securities registered, equity funding,
                                        etc.</label>
                                    <textarea id="business_funds" class="w-full bg-[#f5f5f5] border-0"
                                              style="height:140px; resize:none;"
                                              name="business_funds">{{ old('business_funds') }}</textarea>
                                    @error('business_funds') <span class="text-red-600">{{ $message }}</span> @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="number_shareholders" class="block mb-8 text-sm ">Current number of
                                        shareholders and shareholding </label>
                                    <textarea id="number_shareholders" class="w-full bg-[#f5f5f5] border-0"
                                              style="height:140px; resize:none;"
                                              name="number_shareholders">{{ old('number_shareholders') }}</textarea>
                                    @error('number_shareholders') <span
                                            class="text-red-600">{{ $message }}</span> @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="monthly_turnover" class="block mb-3 text-sm">At present, what is your
                                        average monthly turnover?</label>
                                    <input type="number"
                                           class="bg-[#f5f5f5] border-0 py-4 text-gray-700 text-sm w-full"
                                           id="monthly_turnover" placeholder="KES  |" name="monthly_turnover"
                                           value="{{ old('monthly_turnover') }}">
                                    @error('monthly_turnover') <span
                                            class="text-red-600">{{ $message }}</span> @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="yearly_turnover" class="block mb-3 text-sm">Indicate turnover for the
                                        preceding year</label>
                                    <input type="number"
                                           class="bg-[#f5f5f5] border-0 py-4 text-gray-700 text-sm w-full"
                                           id="yearly_turnover" placeholder="KES  |" name="yearly_turnover"
                                           value="{{ old('yearly_turnover') }}">
                                    @error('yearly_turnover') <span class="text-red-600">{{ $message }}</span> @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="profit_margin" class="block mb-3 text-sm">What is the EBITDA / Operating
                                        Profit Margin Percentage/Last reported profit/loss</label>
                                    <input type="text" class="bg-[#f5f5f5] border-0 py-4 text-gray-700 text-sm w-full"
                                           id="profit_margin" name="profit_margin" value="{{ old('profit_margin') }}">
                                    @error('profit_margin') <span class="text-red-600">{{ $message}} </span> @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="tangible_assets" class="block mb-8 text-sm">List all tangible and
                                        intangible assets the business owns. </label>
                                    <input type="text" class="bg-[#f5f5f5] border-0 py-4 text-gray-700 text-sm w-full"
                                           id="tangible_assets" name="tangible_assets"
                                           value="{{ old('tangible_assets') }}">
                                    @error('tangible_assets') <span class="text-red-600">{{ $message }}</span> @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="liabilities" class="block mb-8 text-sm">List all liabilities the
                                        business owns </label>
                                    <input type="text" class="bg-[#f5f5f5] border-0 py-4 text-gray-700 text-sm w-full"
                                           id="liabilities" name="liabilities" value="{{ old('liabilities')}}">
                                    @error('liabilities') <span class="text-red-600">{{ $message }}</span> @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="physical_assets" class="block mb-3 text-sm">What is the value of
                                        physical assets owned by the business that would be part of the
                                        transaction? </label>
                                    <input type="text" class="bg-[#f5f5f5] border-0 py-4 text-gray-700 text-sm w-full"
                                           id="physical_assets" placeholder="KES |" name="physical_assets"
                                           value="{{ old('physical_assets') }}">
                                    @error('physical_assets') <span
                                            class="text-red-600"> {{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="flex">
                                <div class="flex">
                                <input type="checkbox" class="rounded-sm self-center" name="interested_in_quotations" @if (old('interested_in_quotations')) checked @endif> <span
                                        class="inline-flex ml-4 text-[#828282]" >I’m interested in receiving quotations from Advisors / Boutique Investment Banks who can manage this transaction. </span>
                            </div>
                        </div>
                        </div>

                        <div class="mb-10 bg-white p-8">
                            <h3 class="text-primary font-semibold mb-4"><span class="text-xl">d. </span><span
                                        class="text-2xl">Documents</span></h3>
                            <p class="text-[#9D9D9D]">Photos are an important part of your profile and are publicly
                                displayed. Documents help us verify and approve your profile faster. Documents names
                                entered here are publicly visible but are accessible only to introduced members.</p>
                            <hr class="my-8 border-t-[1px] border-gray-300">

                            <div class="grid gap-4 grid-cols-1 md:grid-cols-2">
                                <div>
                                    <h5 class="mb-4">Business photo</h5>

                                    <div class="py-20 pl-20  border-2 border-dashed flex items-center ">

                                        <input type="file" name="business_photo" id="business_photo"
                                               accept=".jpg,.png,.jpeg" >
                                    </div>
                                    @error('business_photo') <span
                                            class="text-red-600"> {{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <h5 class="mb-4">Information Memorandum</h5>
                                    <div class="py-20 pl-20  border-2 border-dashed flex items-center ">

                                        <input type="file" name="information_memorandum" id="information_memorandum"
                                               accept=".pdf, .docx, .pptx, .xlsx, .txt">
                                    </div>
                                    @error('information_memorandum') <span
                                    class="text-red-600"> {{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <h5 class="mb-4">Financial Report</h5>
                                    <div class="py-20 pl-20  border-2 border-dashed flex items-center ">

                                        <input type="file" name="financial_report" id="financial_report"
                                               accept=".pdf, .docx, .pptx, .xlsx, .txt">
                                    </div>
                                    @error('financial_report') <span
                                    class="text-red-600"> {{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <h5 class="mb-4">Valuation Worksheet</h5>
                                    <div class="py-20 pl-20  border-2 border-dashed flex items-center ">

                                        <input type="file" name="valuation_worksheets" id="valuation_worksheets"
                                               accept=".xlsx">
                                    </div>
                                    @error('valuation_worksheets') <span
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
                                            <input type="radio" name="active_business" id="active_business"
                                                   class="text-sm rounded-sm h-3 w-3"  @if (old('active_business')) checked @endif>
                                        </div>
                                        <div>
                                            <h5>Monthly</h5>
                                        </div>
                                    </div>
                                    <div>
                                        <h5 class="font-bold">KES 12,000</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="plan-2 mb-12" x-data=" {isOpen : false}">
                                <div class="flex justify-between cursor-pointer" @click="isOpen = !isOpen">
                                    <div class="flex space-x-8 items-center">
                                        <div>
                                            <input type="radio" name="active_business" id="active_business"
                                                   class="text-sm rounded-sm h-3 w-3"  @if (old('active_business')) checked @endif>
                                        </div>
                                        <div>
                                            <h5><span>Yearly</span> <span class="text-green-400">(Recommended)</span>
                                            </h5>
                                        </div>
                                    </div>
                                    <div>
                                        <h5 class="font-bold">KES 143,999</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="flex">
                                <input type="checkbox" class="rounded-sm self-center"> <span class="inline-flex ml-4">I accept 1% finder's fee (payable post transaction) and other terms of engagement. </span>
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