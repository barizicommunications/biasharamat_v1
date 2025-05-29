<x-guest-layout>
    <section class="bg-[#f4f4f4]">
        <article class="mx-auto max-w-screen-xl px-4 py-16 sm:px-6 lg:py-8">
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
                    Investor profile
                </a>
            </div>

            <h2 class="text-primary font-bold text-xl md:text-3xl mb-8">Investor profile registration</h2>
            <div class="flex flex-wrap md:flex-nowrap space-x-20">
                <div class="w-3/4">

                    <div class=" bg-white p-8 mb-8" >

                        <div class="flex justify-between">
                            <h3 class="text-primary font-extrabold text-xl  md:text-2xl mb-4">Verification call</h3>
                            <img src="{{ asset('images/profile.png') }}" alt="">
                        </div>
                        <p class="text-[#9D9D9D]">Thank you for submitting your investor details. </p>
                        <p class="text-[#9D9D9D] mb-6">We're currently processing your information and will be in touch as soon as your verification is complete.</p>

                        <h3>Please note:</h3>
                        <p class="text-[#9D9D9D] mb-4">Our verification process may take up to seven (7) days. We apologize for any inconvenience this may cause, but we take the security and privacy of our users seriously and want to ensure that our verification process is thorough and accurate.</p>
                        <p class="text-[#9D9D9D] mb-3 ">We appreciate your patience and understanding during this time. If you have any questions or concerns, please do not hesitate to  <a href="#" class="text-indigo-500">contact our support team.</a></p>

                        <h3>Verification status</h3>

                        <p class="text-[#f08181]">Pending</p>

                    </div>


                </div>


                <div class="w-1/4">
                    <ol class=" text-gray-500 border-l border-[#c4c4c4] sticky top-10">
                        <li class="mb-10 ml-6">
                            <span class="absolute flex items-center justify-center w-10 h-10 bg-green-200 rounded-full -left-5">
                                <svg class="w-3.5 h-3.5 text-green-500 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 12">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5.917 5.724 10.5 15 1.5"/>
                                </svg>
                            </span>
                            <div class="ml-3 text-green-500"><h3 class="font-medium leading-tight">Provide details</h3>
                              <p class="text-sm">Step details here</p></div>
                        </li>
                        <li class="mb-10 ml-6">
                          <span class="absolute flex items-center justify-center w-10 h-10 bg-green-200 rounded-full -left-5">
                            <svg class="w-3.5 h-3.5 text-green-500 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 12">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5.917 5.724 10.5 15 1.5"/>
                            </svg>
                        </span>
                            <div class="ml-3 text-green-500"><h3 class="font-medium leading-tight">Verification call</h3>
                              <p class="text-sm">Step details here</p></div>
                        </li>
                        <li class="mb-10 ml-6">
                          <span class="absolute flex items-center justify-center w-10 h-10 bg-[#c4c4c4] rounded-full -left-5">
                            <svg class="w-3.5 h-3.5 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 12">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5.917 5.724 10.5 15 1.5"/>
                            </svg>
                        </span>
                           <div class="ml-3"> <h3 class="font-medium leading-tight">Approval</h3>
                            <p class="text-sm">Step details here</p></div>
                        </li>

                      </ol>
                </div>

            </div>

        </article>

    </section>
</x-guest-layout>